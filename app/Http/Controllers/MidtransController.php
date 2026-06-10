<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\KategoriKeuangan;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    // --------------------------------------------------------
    // Webhook dari Midtrans — dipanggil otomatis saat bayar
    // POST /midtrans/notification
    // --------------------------------------------------------
    public function handleNotification(Request $request)
    {
        $this->configureMidtrans();
    
        try {
            $payload = $request->all();
    
            $orderId           = $payload['order_id'];
            $transactionStatus = $payload['transaction_status'];
            $paymentType       = $payload['payment_type'];
            $fraudStatus       = $payload['fraud_status'] ?? 'accept';
            $grossAmount       = (int) $payload['gross_amount'];
    
            $parts       = explode('-', $orderId);
            $reservasiId = $parts[1] ?? null;
            $isLunas     = str_starts_with($orderId, 'LUNAS-'); 
    
            $reservasi = Reservasi::find($reservasiId);
            if (!$reservasi) {
                return response()->json(['message' => 'Reservasi tidak ditemukan'], 404);
            }
    
            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'challenge') {
                    $this->setStatusMenunggu($reservasi);
                } elseif ($fraudStatus === 'accept') {
                    $isLunas
                        ? $this->setStatusLunasPending($reservasi)
                        : $this->setStatusDpPending($reservasi, $paymentType); // 1. Ubah ke fungsi baru ini
                }
            } elseif ($transactionStatus === 'settlement') {
                $isLunas
                    ? $this->setStatusLunasPending($reservasi)
                    : $this->setStatusDpPending($reservasi, $paymentType); // 2. Ubah ke fungsi baru ini
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $this->setStatusGagal($reservasi);
            } elseif ($transactionStatus === 'pending') {
                $this->setStatusMenunggu($reservasi);
            }
    
            return response()->json(['message' => 'Notifikasi berhasil diproses']);
    
        } catch (\Exception $e) {
            \Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
   
    private function setStatusLunasPending(Reservasi $reservasi): void
    {
        if ($reservasi->status_dp === 'lunas') return;
    
        $reservasi->update([
            'status_dp' => 'dp_lunas_pending',
            'status'    => 'DP Lunas – Menunggu Konfirmasi Admin',
        ]);
    }
    
    private function setStatusDpPending(Reservasi $reservasi, string $paymentType): void
    {
        if ($reservasi->status_dp === 'disetujui' || $reservasi->status_dp === 'lunas') return;
    
        $reservasi->update([
            'status_dp' => 'menunggu', 
            'status'    => 'DP Lunas (Midtrans) - Menunggu Konfirmasi Admin',
            'bukti_dp'  => 'LUNAS via Midtrans (' . $paymentType . ')',
        ]);
    }
    
    // --------------------------------------------------------
    // Status: DP Lunas > catat ke kas 
    // --------------------------------------------------------
    private function setStatusLunas(Reservasi $reservasi, string $paymentType, int $nominal): void
    {
        if ($reservasi->status_dp === 'lunas') return;

        $reservasi->update([
            'status_dp' => 'lunas',
            'status'    => 'DP Lunas - Menunggu Konfirmasi Admin',
            'bukti_dp'  => 'LUNAS via Midtrans (' . $paymentType . ')',
        ]);
    }

    private function setStatusMenunggu(Reservasi $reservasi): void
    {
        $reservasi->update([
            'status_dp' => 'menunggu',
            'status'    => 'Menunggu Konfirmasi Pembayaran',
        ]);
    }

    private function setStatusGagal(Reservasi $reservasi): void
    {
        $reservasi->update([
            'status_dp' => 'ditolak',
            'status'    => 'Pembayaran Gagal/Dibatalkan',
            'bukti_dp'  => 'GAGAL',
        ]);
    }
    private function configureMidtrans(): void
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }
    
}