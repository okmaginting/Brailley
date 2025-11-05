{{-- 
    =================================
    == NAVBAR MOBILE: BAGIAN BAWAH ==
    =================================
    * PERUBAHAN: Item aktif kini memiliki background, shadow, dan border.
    * py-2 ditambahkan ke semua link agar tinggi tetap konsisten.
--}}
<nav 
    wire:loading.class="opacity-50 transition-opacity" 
    class="md:hidden block bg-[#F1EFEC] w-full shadow-[0_-2px_5px_rgba(0,0,0,0.1)] fixed bottom-0 left-0 z-50 pb-safe">
    
    @if( request()->is('profile*') || request()->is('riwayatbaca*') || request()->is('riwayatunduh*') || request()->is('karyasaya*') )
        {{-- 
            KONDISI 3: HALAMAN PROFIL 
        --}}
        <div class="flex justify-around items-center w-full max-w-7xl mx-auto px-2 py-2 text-gray-800">
            
            <a href="/profile" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-1/4 py-2 
                      {{ request()->is('profile*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="user" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Profil</span>
            </a>

            <a href="/riwayatbaca" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-1/4 py-2 
                      {{ request()->is('riwayatbaca*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="history" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Riwayat</span>
            </a>

            <a href="/riwayatunduh" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-1/4 py-2 
                      {{ request()->is('riwayatunduh*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="download" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Unduhan</span>
            </a>

            <a href="/karyasaya" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-1/4 py-2 
                      {{ request()->is('karyasaya*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="archive" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Karya Saya</span>
            </a>

        </div>

    @elseif( !request()->is('/') && !request()->is('login*') && !request()->is('register*') )
        {{-- 
            KONDISI 2: Halaman Internal Lainnya 
        --}}
        <div class="flex justify-around items-center w-full max-w-7xl mx-auto px-1 py-2 text-gray-800">
            
            <a href="/terjemahkan" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('terjemahkan*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="arrow-left-right" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Terjemah</span>
            </a>

            <a href="/ceritakomunitas" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('ceritakomunitas*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="book-text" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Komunitas</span>
            </a>

            <a href="/bukuresmi" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('bukuresmi*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="book-open" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Resmi</span>
            </a>

            <a href="/audiobook" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('audiobook*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="play" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Audiobook</span>
            </a>

            <a href="/artikel" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('artikel*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="edit" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Artikel</span>
            </a>

            <a href="/bagikankarya" wire:navigate 
               class="flex flex-col items-center justify-center text-xs w-[16%] py-2 
                      {{ request()->is('bagikankarya*') ? 'bg-white shadow-lg border border-gray-300 rounded-xl text-[#05284C] font-bold' : 'text-gray-800' }}">
                <i data-lucide="share-2" class="w-5 h-5 mb-1"></i>
                <span class="truncate">Bagikan</span>
            </a>

        </div>
        
    @else
        {{-- 
            KONDISI 1: Home, Login, Register 
            (Tidak ada navigasi bawah)
        --}}
    @endif
</nav>