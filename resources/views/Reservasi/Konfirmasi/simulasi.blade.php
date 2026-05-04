<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi Pembayaran Midtrans</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-3xl shadow-xl text-center max-w-sm w-full border border-slate-100">
        <!-- Animasi Spinner -->
        <i class="fa-solid fa-circle-notch fa-spin text-5xl text-blue-600 mb-6"></i>
        
        <h2 class="text-xl font-bold text-slate-800 mb-2">Memproses Pembayaran...</h2>
        <p class="text-slate-500 text-sm mb-6">Mohon jangan tutup halaman ini. Mensimulasikan respon dari Midtrans dalam <span id="countdown" class="font-bold text-blue-600 text-lg">15</span> detik.</p>
        
        <!-- Form Tersembunyi untuk Update Status -->
        <form id="formSimulasi" action="{{ route('simulasi.sukses', $reservasi->id) }}" method="POST">
            @csrf
        </form>
    </div>

    <script>
        let timeLeft = 15; // Waktu tunggu 15 detik
        const countdownEl = document.getElementById('countdown');
        const formSimulasi = document.getElementById('formSimulasi');

        const timer = setInterval(() => {
            timeLeft--;
            countdownEl.innerText = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(timer);
                // Jika sudah 0 detik, otomatis jalankan form (seolah-olah Midtrans merespon)
                formSimulasi.submit(); 
            }
        }, 1000);
    </script>

</body>
</html>