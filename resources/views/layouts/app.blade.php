<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul akan dinamis berdasarkan halaman --}}
    <title>@yield('title', 'Brailley')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    
    @vite('resources/css/app.css', 'resources/js/app.js',)
</head>
<body class="bg-[#05284C] min-h-screen flex flex-col">

    @include('layouts.partials.navbar-desktop')

    @include('layouts.partials.navbar-mobile-top')

    {{-- flex-grow memastikan konten mengisi ruang & mendorong footer ke bawah --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.partials.navbar-mobile-bottom')

    <script>
        window.addEventListener('alpine:init', () => {
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>