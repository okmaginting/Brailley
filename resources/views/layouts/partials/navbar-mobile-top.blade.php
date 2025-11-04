{{-- 
    ===============================
    == NAVBAR MOBILE: BAGIAN ATAS ==
    ===============================
--}}
<nav 
    wire:loading.class="opacity-50 transition-opacity" 
    class="md:hidden flex items-center justify-between bg-[#F1EFEC] w-full shadow-sm fixed top-0 left-0 z-50 h-16 px-4 pt-safe">
    
    {{-- SLOT KIRI: Tombol Kembali (Hanya muncul di halaman internal) --}}
    <div class="flex-1 flex justify-start">
        @if( !request()->is('/') && !request()->is('login*') && !request()->is('register*') )
            <a href="javascript:history.back()" class="p-2 -ml-2 text-gray-700 hover:text-[#05284C]" title="Kembali">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
        @endif
    </div>

    {{-- SLOT TENGAH: Logo --}}
    <div class="flex-1 flex justify-center">
        <a href="/" wire:navigate class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-8 w-auto">
        </a>
    </div>

    {{-- SLOT KANAN: Autentikasi (Sesuai permintaan Anda) --}}
    <div class="flex-1 flex justify-end">
        @guest
            {{-- Jika GUEST dan berada di halaman internal (Kondisi 2), tampilkan ikon login --}}
            @if( !request()->is('/') && !request()->is('login*') && !request()->is('register*') )
                
                {{-- PERBAIKAN: wire:navigate dihapus agar layout (navbar-bottom) bisa refresh --}}
                <a href="{{ route('login') }}" class="p-2 text-gray-700 hover:text-[#05284C]" title="Login">
                    <i data-lucide="user-circle" class="w-6 h-6"></i>
                </a>
            @else
            {{-- Jika GUEST dan berada di Beranda/Login/Register, link boleh pakai wire:navigate --}}
                <div class="flex items-center gap-x-3 whitespace-nowrap">
                    <a href="{{ route('login') }}" wire:navigate class="text-sm font-medium hover:text-[#05284C] {{ request()->is('login*') ? 'text-[#05284C] font-bold' : '' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}" wire:navigate class="text-sm font-medium hover:text-[#05284C] {{ request()->is('register*') ? 'text-[#05284C] font-bold' : '' }}">
                        Register
                    </a>
                </div>
            @endif
        @else
            {{-- Jika SUDAH LOGIN (AUTH) --}}
            @if(Auth::user()->role == 'admin')
                
                {{-- PERBAIKAN: wire:navigate dihapus agar layout bisa refresh ke admin panel --}}
                <a href="/admin" class="p-2 text-gray-700 hover:text-[#05284C]" title="Admin Panel">
                    <i data-lucide="shield" class="w-6 h-6"></i>
                </a>
            @else
                
                {{-- PERBAIKAN: wire:navigate dihapus agar layout (navbar-bottom) bisa refresh --}}
                <a href="/profile" class="p-2 text-gray-700 hover:text-[#05284C]" title="Profil">
                    <i data-lucide="user-circle" class="w-6 h-6"></i>
                </a>
            @endif
        @endguest
    </div>

</nav>