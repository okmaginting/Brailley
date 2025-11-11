@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Audiobook')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  {{-- Padding bawah 'pb-20' ditambahkan --}}
  <section id="audiobook" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Audiobook</h2>
        
        {{-- Search Bar Fungsional --}}
        <form action="{{ route('audiobook.index') }}" method="GET" class="relative w-full md:w-80">
          <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
          <input 
            type="text" 
            name="search"
            placeholder="Cari audiobook..." 
            class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all"
            value="{{ request('search') }}"
          >
        </form>
      </div>

      {{-- Grid Buku: 4 Kolom (Dinamis) --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Loop data dari controller --}}
        @forelse ($audiobooks as $audiobook)
          <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- 1. Judul & Narator -->
            <div class="mb-4"> 
              <h3 class="font-bold text-lg text-gray-900 truncate" title="{{ $audiobook->judul }}">
                {{ $audiobook->judul }}
              </h3>
              {{-- Menghapus "Oleh:" agar sesuai style target --}}
              <p class="text-sm text-gray-600">{{ $audiobook->pengisi_audio }}</p>
            </div>
  
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
              @if ($audiobook->gambar_cover)
                {{-- Menggunakan asset() agar konsisten dengan file lain --}}
                <img src="{{ asset('storage/' . $audiobook->gambar_cover) }}" 
                     alt="Sampul {{ $audiobook->judul }}" 
                     class="w-full h-full object-cover">
              @else
                {{-- Gambar cadangan jika tidak ada cover --}}
                <img src="https://placehold.co/300x400/9ca3af/F1EFEC?text=Tanpa+Cover" 
                     alt="Tanpa Cover" 
                     class="w-full h-full object-cover">
              @endif
            </div>
  
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
              {{-- Menggunakan route() untuk konsistensi --}}
              <a href="{{ route('audiobook.show', $audiobook->id) }}" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                Lihat Detail
              </a>
            </div>
          </div>
        
        {{-- Tampil jika tidak ada audiobook --}}
        @empty
          <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12">
            <i data-lucide="mic-off" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700">Belum Ada Audiobook</h3>
            <p class="text-gray-500 mt-1">
              @if (request('search'))
                Audiobook dengan kata kunci "{{ request('search') }}" tidak ditemukan.
              @else
                Saat ini belum ada audiobook yang ditambahkan.
              @endif
            </p>
          </div>
        @endforelse

      </div> {{-- Akhir dari .grid --}}

      {{-- Link Pagination --}}
      <div class="mt-12">
        {{ $audiobooks->links() }}
      </div>

    </div>
  </section>
@endsection