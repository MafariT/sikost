<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Laravel Palette</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    
    {{-- Hapus margin default pada body jika ada --}}
    <style>body { margin: 0; }</style>

    @include('layouts.navbar')

    {{-- 1. Tambahkan ID dan Flex class pada <main> untuk Sticky Footer --}}
    <main id="main-content"> 
        @yield('content')
    </main>

    {{-- 2. Hapus mt-5 (Margin Top) yang menyebabkan ruang putih di atas footer --}}
    <footer class="bg-midnight text-white py-4">
        <div class="container text-center">
            <p class="mb-0">© 2025 Created with Laravel & Bootstrap.</p>
            <small style="color: var(--color-china)">Designed with custom color palette.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, 
            once: true,
            offset: 100 
        });
    </script>
</body>

</html>