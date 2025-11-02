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
        document.addEventListener("DOMContentLoaded", () => {
            const desktopMenuBtn = document.getElementById('desktopMenuBtn');
            const desktopMenuDropdown = document.getElementById('desktopMenuDropdown');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');

            // Toggle dropdown desktop
            if (desktopMenuBtn && desktopMenuDropdown) {
                desktopMenuBtn.addEventListener('click', () => {
                    desktopMenuDropdown.style.display = desktopMenuDropdown.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Toggle dropdown mobile
            if (mobileMenuBtn && mobileMenuDropdown) {
                mobileMenuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileMenuDropdown.style.display = mobileMenuDropdown.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Menutup dropdown saat klik di luar
            document.addEventListener('click', e => {
                if (desktopMenuDropdown && desktopMenuBtn && !desktopMenuBtn.contains(e.target) && !desktopMenuDropdown.contains(e.target)) {
                    desktopMenuDropdown.style.display = 'none';
                }
                if (mobileMenuDropdown && mobileMenuBtn && !mobileMenuBtn.contains(e.target) && !mobileMenuDropdown.contains(e.target)) {
                    mobileMenuDropdown.style.display = 'none';
                }
            });

            // Inisialisasi Ikon Lucide
            lucide.createIcons();
        });
    </script>
    @stack('scripts')
</body>
</html>