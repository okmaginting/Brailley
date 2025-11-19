<nav 
    wire:loading.class="opacity-50 transition-opacity" 
    class="hidden md:flex flex-col bg-[#F1EFEC] w-full shadow-sm fixed top-0 left-0 z-50">
    
    {{-- BAGIAN 1: LOGO --}}
    <div class="w-full border-b border-gray-300">
        <div class="flex justify-center w-full max-w-7xl mx-auto px-16 py-4">
            {{-- Tambahkan wire:navigate disini --}}
            <a href="/" wire:navigate class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-9 w-auto">
            </a>
        </div>
    </div>

    {{-- BAGIAN 2: NAVIGASI UTAMA & MENU USER --}}
    <div class="flex items-center w-full max-w-7xl mx-auto px-16 text-gray-800 py-6">
        
        @if( request()->is('profile*') || request()->is('riwayatbaca*') || request()->is('riwayatunduh*') || request()->is('karyasaya*') )
            {{-- 
              KONDISI 3: HALAMAN PROFIL
            --}}
            
            <div class="pr-4"> 
                {{-- JANGAN pakai wire:navigate untuk history.back() --}}
                <a href="javascript:history.back()" class="flex items-center gap-2 hover:text-[#05284C]" title="Kembali ke halaman sebelumnya">
                    <i data-lucide="arrow-left" class="w-6 h-6"></i>
                </a>
            </div>
            
            <div class="flex flex-1 justify-evenly items-center whitespace-nowrap gap-x-8">
                <a href="/profile" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('profile*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="user" class="w-5 h-5"></i>Profil
                </a>
                <a href="/riwayatbaca" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('riwayatbaca*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="history" class="w-5 h-5"></i>Riwayat Baca
                </a>
                <a href="/riwayatunduh" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('riwayatunduh*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="download" class="w-5 h-5"></i>Riwayat Unduh
                </a>
                <a href="/karyasaya" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('karyasaya*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="archive" class="w-5 h-5"></i>Karya Saya
                </a>
            </div>

        @elseif( request()->is('/') || request()->is('login*') || request()->is('register*') )
            {{-- 
              KONDISI 1: Home, Login, Register
            --}}

            <div class="flex-1">
            </div>

            <div class="flex-shrink-0 whitespace-nowrap px-8">
                @guest
                    <div class="flex items-center gap-x-10">
                        <a href="{{ route('login') }}" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ 
                            request()->is([
                                'login*', 
                                'forgot-password*', 
                                'verify-email*', 
                                'reset-password*', 
                                'confirm-password*'
                            ]) ? 'text-[#05284C] font-bold' : '' 
                        }}">
                            <i data-lucide="log-in" class="w-5 h-5"></i>Login
                        </a>
                        <a href="{{ route('register') }}" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('register*') ? 'text-[#05284C] font-bold' : '' }}">
                            <i data-lucide="user-plus" class="w-5 h-5"></i>Register
                        </a>
                    </div>
                @else
                    @if( request()->is('/') )
                        <div class="text-center">
                            <span class="text-2xl font-medium text-gray-800">Hallo, {{ Auth::user()->name }}!</span>
                        </div>
                    @endif
                @endguest
            </div>

            {{-- Kanan: Admin / Profile --}}
            <div class="flex-1 flex justify-end">
                <div class="relative">
                    @auth
                        @if(Auth::user()->role == 'admin')
                            {{-- HAPUS wire:navigate untuk Admin Panel agar aset termuat sempurna --}}
                            <a href="/admin" class="flex items-center gap-2 hover:text-[#05284C] font-medium">
                                <i data-lucide="shield" class="w-5 h-5"></i>
                                <span>Admin Panel</span> 
                            </a>
                        @else
                            {{-- User biasa --}}
                            <a href="/profile" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] font-medium">
                                <i data-lucide="user-circle" class="w-5 h-5"></i>
                                <span>{{ Auth::user()->name }}</span> 
                            </a>
                        @endif
                    @else
                    @endauth
                </div>
            </div>
            
        @else
            {{-- 
              KONDISI 2: Halaman Internal Lainnya (Terjemahkan, Buku, dll.)
            --}}

            <div class="pr-4"> 
                <a href="javascript:history.back()" class="flex items-center gap-2 hover:text-[#05284C]" title="Kembali ke halaman sebelumnya">
                    <i data-lucide="arrow-left" class="w-6 h-6"></i>
                </a>
            </div>
            
            <div class="flex flex-1 justify-evenly items-center whitespace-nowrap gap-x-8">
                <a href="/terjemahkan" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('terjemahkan*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="arrow-left-right" class="w-5 h-5"></i>Terjemahkan
                </a>
                <a href="/ceritakomunitas" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('ceritakomunitas*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="book-text" class="w-5 h-5"></i>Cerita Komunitas
                </a>
                <a href="/bukuresmi" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('bukuresmi*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="book-open" class="w-5 h-5"></i>Buku Resmi
                </a>
                <a href="/audiobook" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('audiobook*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="play" class="w-5 h-5"></i>Audiobook
                </a>
                <a href="/artikel" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('artikel*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="edit" class="w-5 h-5"></i>Artikel
                </a>
                <a href="/bagikankarya" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] {{ request()->is('bagikankarya*') ? 'text-[#05284C] font-bold' : '' }}">
                    <i data-lucide="share-2" class="w-5 h-5"></i>Bagikan Karya
                </a>
            </div>
            <div class="relative">
                @auth
                    @if(Auth::user()->role == 'admin')
                        {{-- HAPUS wire:navigate untuk Admin Panel --}}
                        <a href="/admin" class="flex items-center gap-2 hover:text-[#05284C] font-medium">
                            <i data-lucide="shield" class="w-5 h-5"></i>
                            <span>Admin Panel</span> 
                        </a>
                    @else
                        <a href="/profile" wire:navigate class="flex items-center gap-2 hover:text-[#05284C] font-medium">
                            <i data-lucide="user-circle" class="w-5 h-5"></i>
                            <span>{{ Auth::user()->name }}</span> 
                        </a>
                    @endif
                @elseguest
                    <a href="{{ route('login') }}" wire:navigate class="flex items-center gap-2 hover:text-[#05284C]" title="Login / Register">
                        <i data-lucide="user-circle" class="w-6 h-6"></i> 
                    </a>
                @endguest
            </div>
        @endif
        
    </div>
</nav>