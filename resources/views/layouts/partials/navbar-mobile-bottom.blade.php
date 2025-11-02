{{-- 
  KONDISI: Tampilkan bottom nav HANYA JIKA kita TIDAK di halaman Home, Login, atau Register.
  Ini meniru logika navbar desktop (KONDISI 2).
--}}
@if( !request()->is('/') && !request()->is('login*') && !request()->is('register*') )

<div class="md:hidden fixed bottom-0 left-0 w-full bg-[#F1EFEC] border-t border-gray-300 flex justify-around py-2 shadow-lg z-50">
    
    {{-- 
      Request: "buat tulisannya center"
      Class 'flex-col items-center' sudah membuat <span> di bawah <i> terpusat.
      Saya juga menyesuaikan 'px' menjadi 'px-2' dan menambahkan 'whitespace-nowrap' 
      agar muat dan rapi di layar kecil.
    --}}

    <a href="/terjemahkan" class="flex flex-col items-center text-gray-800 hover:text-[#05284C] px-2 py-2 rounded-md {{ request()->is('terjemahkan*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="arrow-left-right" class="w-5 h-5"></i><span class="text-xs mt-1">Terjemahkan</span>
    </a>
    <a href="/bukukomunitas" class="flex flex-col items-center text-gray-800 hover:text-[#05284C] px-2 py-2 rounded-md {{ request()->is('bukukomunitas*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="book-text" class="w-5 h-5"></i><span class="text-xs mt-1 whitespace-nowrap">Buku Komunitas</span>
    </a>
    <a href="/bukuresmi" class="flex flex-col items-center text-gray-800 hover:text-[#05284C] px-2 py-2 rounded-md {{ request()->is('bukuresmi*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="book-open" class="w-5 h-5"></i><span class="text-xs mt-1 whitespace-nowrap">Buku Resmi</span>
    </a>
    <a href="/audiobook" class="flex flex-col items-center text-gray-800 hover:text-[#05284C] px-2 py-2 rounded-md {{ request()->is('audiobook*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="play" class="w-5 h-5"></i><span class="text-xs mt-1">Audiobook</span>
    </a>
    <a href="/artikel" class="flex flex-col items-center text-gray-800 hover:text-[#05284C] px-2 py-2 rounded-md {{ request()->is('artikel*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="edit" class="w-5 h-5"></i><span class="text-xs mt-1">Artikel</span>
    </a>
    <a href="/bagikankarya" class="flex flex-col items-center text-gray-800 px-2 py-2 rounded-md {{ request()->is('bagikankarya*') ? 'bg-[#D4C9BE]' : '' }}">
        <i data-lucide="share-2" class="w-5 h-5"></i><span class="text-xs mt-1 whitespace-nowrap">Bagikan Karya</span>
    </a>
</div>

@endif