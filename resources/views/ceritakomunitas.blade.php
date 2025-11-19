@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Cerita Komunitas')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="ceritakomunitas" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Cerita Komunitas</h2>
        
        {{-- Search Bar Fungsional --}}
        <form action="{{ route('karya.index') }}" method="GET" class="relative w-full md:w-80">
          <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
          <input 
            type="text" 
            name="search"
            placeholder="Cari cerita komunitas..." 
            class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all"
            value="{{ request('search') }}"
          >
        </form>
      </div>

      {{-- Grid Cerita Dinamis --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Loop data dari controller --}}
        @forelse ($stories as $story)
          {{-- 
             PERUBAHAN UTAMA: 
             1. Mengubah div menjadi <a> untuk full clickable card.
             2. Menambahkan wire:navigate.
          --}}
          <a href="/ceritakomunitas/{{ $story->id }}" 
             wire:navigate
             class="group bg-white rounded-2xl shadow-xl p-5 flex flex-col h-full transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 cursor-pointer decoration-0 relative">
            
            {{-- Judul dan Penulis --}}
            <div class="mb-4"> 
              <h3 class="font-bold text-lg text-gray-900 truncate group-hover:text-[#05284C] transition-colors" title="{{ $story->judul }}">
                {{ $story->judul }}
              </h3>
              <p class="text-sm text-gray-600">{{ $story->penulis }}</p>
            </div>
  
            {{-- Gambar Sampul --}}
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4 border border-gray-100">
              @if ($story->gambar_cerita)
                <img src="{{ asset('storage/' . $story->gambar_cerita) }}" 
                     alt="Sampul {{ $story->judul }}" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              @else
                {{-- Gambar cadangan jika tidak ada cover --}}
                <img src="https://placehold.co/300x400/9ca3af/F1EFEC?text=Tanpa+Cover" 
                     alt="Tanpa Cover" 
                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
              @endif

              {{-- Overlay Icon Baca saat hover --}}
              <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                  <div class="bg-white/90 p-3 rounded-full shadow-lg backdrop-blur-sm">
                    <i data-lucide="book-open" class="w-6 h-6 text-[#05284C]"></i>
                  </div>
              </div>
            </div>
  
            {{-- Footer Card (Mengganti tombol dengan ikon panah) --}}
            <div class="mt-auto flex justify-between items-center pt-2"> 
               <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Baca Cerita</span>
               
               {{-- Ikon Panah (Aksi Default) --}}
               <div class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-10 h-10 group-hover:bg-opacity-90 group-hover:scale-110 transition-all shadow-md">
                   <i data-lucide="arrow-right" class="w-5 h-5"></i>
               </div>
            </div>
          </a>
        
        {{-- Tampil jika tidak ada cerita sama sekali --}}
        @empty
          <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12">
            <i data-lucide="book-off" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700">Belum Ada Cerita</h3>
            <p class="text-gray-500 mt-1">
              @if (request('search'))
                Cerita dengan judul "{{ request('search') }}" tidak ditemukan.
              @else
                Saat ini belum ada cerita komunitas yang dipublikasikan.
              @endif
            </p>
          </div>
        @endforelse

      </div> {{-- Akhir dari .grid --}}

      {{-- Link Pagination --}}
      <div class="mt-12">
        {{ $stories->links() }}
      </div>

    </div>
  </section>
@endsection