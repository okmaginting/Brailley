<nav class="md:hidden fixed top-0 left-0 w-full bg-[#F1EFEC] shadow-md z-50 flex justify-between items-center py-4 px-6">
    
    {{-- KIRI: Tombol Kembali (hanya di halaman internal) --}}
    <div class="flex-1">
        @if( !request()->is('/') && !request()->is('login*') && !request()->is('register*') )
            <a href="javascript:history.back()" class="flex items-center gap-2 hover:text-[#05284C]" title="Kembali ke halaman sebelumnya">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
        @endif
    </div>

    {{-- TENGAH: Logo --}}
    <div class="flex-1 flex justify-center">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        </a>
    </div>

    {{-- KANAN: Menu User / Login / Register --}}
    <div class="flex-1 flex justify-end">
        <div class="relative">
            @auth
                {{-- JIKA SUDAH LOGIN: Tampilkan tombol dropdown profile --}}
                <button id="mobileMenuBtn" class="flex items-center gap-2 hover:text-[#05284C] font-medium">
                    <i data-lucide="user-circle" class="w-6 h-6"></i>
                </button>
                
                {{-- Dropdown (Logika disalin dari desktop) --}}
                <div id="mobileMenuDropdown" 
                     class="hidden absolute top-full right-0 bg-[#F1EFEC] border border-gray-300 rounded-xl py-2 min-w-[200px] shadow-md z-[1000]">
                    
                    <div class="flex flex-col items-center justify-center px-4 py-4 border-b border-gray-300">
                        <i data-lucide="user" class="w-5 h-5 text-gray-800"></i>
                        <span class="text-gray-800 font-semibold mt-1 truncate max-w-full px-2">{{ Auth::user()->name }}</span>
                    </div>
                    
                    <a href="/riwayatbaca" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Riwayat Baca</a>
                    <a href="/riwayatunduh" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Riwayat Unduh</a>
                    <a href="/karyasaya" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Karya Saya</a>
                    <a href="/editprofile" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Edit Profile</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-300 mt-1">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-[#FF0000] text-sm hover:bg-[#D4C9BE] hover:text-[#05284C] mt-1">
                            Logout
                        </button>
                    </form>
                </div>

            @elseguest
                {{-- 
                  PERUBAHAN: Sesuai permintaan, 
                  link "Login" & "Register" sekarang muncul di SETIAP HALAMAN untuk guest.
                  Logika @if sebelumnya dihapus.
                --}}
                <div class="flex items-center whitespace-nowrap gap-x-4">
                    <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-[#05284C] text-sm {{ request()->is('login*') ? 'text-[#05284C] font-bold' : '' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center gap-1 hover:text-[#05284C] text-sm {{ request()->is('register*') ? 'text-[#05284C] font-bold' : '' }}">
                        Register
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>