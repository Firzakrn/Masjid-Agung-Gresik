<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Pengelola - Masjid Agung Gresik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    @include('navbar')
    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-green-800 mb-3">Struktur Organisasi</h1>
            <p class="text-gray-600">Mengenal lebih dekat struktur pengelola Masjid Agung Gresik.</p>
            <div class="w-24 h-1 bg-green-600 mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <img src="{{ asset('images/struktur.jpeg') }}" alt="Struktur Organisasi Masjid Agung Gresik" class="w-full h-auto rounded-lg shadow-md">
        </div>
    </main>
    @include('footer')
</body>
</html>