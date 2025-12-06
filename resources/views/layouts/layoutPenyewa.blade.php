<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Link Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Css Penyewa --}}
    <link rel="stylesheet" href="{{ asset('css/penyewa.css') }}">

</head>

<body class="py-8">
    <!-- Navbar -->
    @include('layouts.components.navbar')

    <main>
        @yield('konten')
    </main>

    <!-- Footer -->
    @include('layouts.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Font Awesome Icon --}}
    <script src="https://kit.fontawesome.com/32571c53f3.js" crossorigin="anonymous"></script>

    {{-- JS Penyewa --}}
    <script src="{{ asset('js/penyewa.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, // Durasi animasi 1 detik
            once: true, // Animasi hanya berjalan sekali saat scroll
            offset: 100 // Offset trigger
        });
    </script>
</body>

</html>
