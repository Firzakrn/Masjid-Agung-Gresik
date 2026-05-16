<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email | Masjid Agung Gresik</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f3f4f6; 
            margin: 0;
            padding: 50px 20px;
        }
        .card {
            max-width: 650px; /* Sedikit dilebarkan agar header terlihat lebih panjang */
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            /* Efek shadow berlapis agar terlihat benar-benar ngambang/melayang */
            box-shadow: 0 20px 40px rgba(0,0,0,0.12), 0 5px 15px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .header {
            background-color: #15803d; 
            color: #ffffff;
            text-align: center;
            padding: 35px 20px;
        }
        /* Container untuk menyejajarkan logo dan teks di tengah */
        .header-container {
            display: inline-block;
            text-align: left;
            vertical-align: middle;
        }
        .logo-img {
            height: 55px; /* Mengatur tinggi logo */
            width: auto;
            display: inline-block;
            vertical-align: middle;
            margin-right: 15px; /* Jarak antara logo dan teks h1 */
        }
        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
            display: inline-block;
            vertical-align: middle;
            letter-spacing: 0.5px;
        }
        .body {
            padding: 45px 40px;
            text-align: center;
            color: #374151;
        }
        .body p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 35px;
        }
        .btn {
            display: inline-block;
            background-color: #15803d;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 45px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(21, 128, 61, 0.3);
        }
        .btn:hover {
            background-color: #166534;
        }
        .footer {
            background-color: #f9fafb;
            padding: 25px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="header">
            <div class="header-container">
                <img src="https://untaken-panhandle-blustery.ngrok-free.dev/images/logo.png" alt="Logo" class="logo-img">
                <h1>Masjid Agung Gresik</h1>
            </div>
        </div>
        
        <div class="body">
            <h2 style="color: #15803d; font-size: 20px; margin-top:0; font-weight: bold;">Assalamu'alaikum, {{ $user->name }}!</h2>
            
            <p>Terima kasih telah mendaftar. Sahabat muslimin, mohon verifikasi alamat email Anda terlebih dahulu agar bisa mengakses layanan infaq, zakat, dan reservasi.</p>
            
            <a href="{{ $url }}" class="btn">Verifikasi Akun Saya</a>
            
            <p style="margin-top: 40px; font-size: 12px; color: #6b7280; text-align: center;">
                Jika tombol di atas tidak berfungsi, silakan salin dan tempel tautan berikut di browser Anda:<br>
                <a href="{{ $url }}" style="color: #15803d; word-break: break-all; text-decoration: none;">{{ $url }}</a>
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Masjid Agung Gresik.<br>
            Jika Anda merasa tidak mendaftar di website kami, silakan abaikan pesan email ini.
        </div>
    </div>

</body>
</html>