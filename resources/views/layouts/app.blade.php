<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Brailley')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Library Eksternal --}}
    {{-- PENTING: Semua library statis diberi 'data-navigate-once' agar tidak di-load ulang saat ganti halaman --}}
    <script src="https://unpkg.com/lucide@latest" data-navigate-once></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" data-navigate-once />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" data-navigate-once></script>
    <script src="https://unpkg.com/wavesurfer.js" data-navigate-once></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    {{-- Script Utama: Dipindah ke HEAD agar hanya dieksekusi sekali --}}
    <script data-navigate-once>
        // 1. Jalan saat halaman pertama kali dibuka (Refresh/F5)
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) lucide.createIcons();
        });

        // 2. Jalan setiap kali Livewire selesai pindah halaman (SPA)
        document.addEventListener('livewire:navigated', () => {
            if (window.lucide) lucide.createIcons();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</head>
<body class="bg-[#05284C] min-h-screen flex flex-col">

    @include('layouts.partials.navbar-desktop')

    @include('layouts.partials.navbar-mobile-top')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.partials.navbar-mobile-bottom')

    {{-- Script di body dihapus karena sudah dipindah ke head --}}
    
    @stack('scripts')

    @livewireScripts
</body>
</html>