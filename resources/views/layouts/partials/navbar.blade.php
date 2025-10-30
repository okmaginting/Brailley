<nav class="hidden md:flex flex-col bg-[#F1EFEC] w-full shadow-sm fixed top-0 left-0 z-50">

  <div class="w-full border-b border-gray-300">
    <div class="flex justify-center w-full max-w-7xl mx-auto px-16 py-4">
      <a href="/" class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-9 w-auto">
      </a>
    </div>
  </div>

  <div class="flex items-center w-full max-w-7xl mx-auto px-16 text-gray-800 gap-x-8 py-3">

    <a href="{{ route('terjemahkan') }}" class="flex items-center gap-2 {{ request()->is('terjemahkan*') ? 'bg-[#D4C9BE]' : '' }} px-5 py-2 rounded-full hover:text-[#05284C]">
      <i data-lucide="arrow-left-right" class="w-5 h-5"></i>Terjemahkan
    </a>

    <div class="flex flex-1 justify-evenly items-center whitespace-nowrap">
      <a href="/bukukomunitas" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="book-text" class="w-5 h-5"></i>Buku Komunitas
      </a>
      <a href="/bukuresmi" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="book-open" class="w-5 h-5"></i>Buku Resmi
      </a>
      <a href="/audiobook" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="play" class="w-5 h-5"></i>Audiobook
      </a>
      <a href="/artikel" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="edit" class="w-5 h-5"></i>Artikel
      </a>
      <a href="/bagikankarya" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="share-2" class="w-5 h-5"></i>Bagikan Karya
      </a>
    </div>

    <div class="relative">
      <a href="javascript:void(0)" id="desktopMenuBtn" class="flex items-center gap-2 hover:text-[#05284C]">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </a>
      
      <div id="desktopMenuDropdown" 
           class="hidden absolute top-full right-0 bg-[#F1EFEC] border border-gray-300 rounded-xl py-2 min-w-[150px] shadow-md z-[1000]">
        
        <a href="#" class="flex flex-col items-center justify-center px-4 py-4 border-b border-gray-300 hover:bg-gray-100">
          <i data-lucide="user" class="w-5 h-5 text-gray-800"></i>
          <span class="text-gray-800 font-semibold mt-1">Nama Pengguna</span>
        </a>
        
        <a href="/riwayatbaca" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Riwayat Baca</a>
        <a href="/riwayatunduh" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Riwayat Unduh</a>
        <a href="/karyasaya" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Karya Saya</a>
        <a href="/editprofile" class="block px-4 py-2 text-[#05284C] text-sm hover:bg-[#D4C9BE]">Edit Profile</a>
        
        <a href="/login" class="logout block px-4 py-2 text-[#FF0000] text-sm hover:bg-[#D4C9BE] hover:text-[#05284C]">Logout</a>
      </div>
    </div>

  </div>
</nav>