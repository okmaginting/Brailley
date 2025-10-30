<nav class="md:hidden fixed top-0 left-0 w-full bg-[#F1EFEC] shadow-md z-50 flex justify-between items-center py-4 px-6">
    <a href="/">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
    </a>
    <div class="relative">
        <button id="mobileMenuBtn" class="border border-gray-400 p-2 rounded-md hover:bg-gray-100 inline-flex items-center justify-center">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        
        <div id="mobileMenuDropdown" 
             class="hidden absolute top-full right-0 bg-[#F1EFEC] border border-gray-300 rounded-xl py-2 min-w-[150px] shadow-md z-[1000]">
            
            <a href="#" class="flex flex-col items-center justify-center px-4 py-4 border-b border-gray-200 hover:bg-gray-100">
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
</nav>