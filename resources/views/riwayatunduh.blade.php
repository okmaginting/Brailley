@extends('layouts.app')

@section('title', 'Riwayat Unduh')

@section('content')
  <section id="riwayatunduh" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Riwayat Unduh</h2>
        
        {{-- Search Bar Fungsional --}}
        <form action="{{ route('history.download') }}" method="GET" class="relative w-full md:w-80">
          <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
          <input 
            type="text" 
            name="search"
            placeholder="Cari riwayat unduh..." 
            class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all"
            value="{{ request('search') }}"
          >
        </form>
      </div>

      {{-- Grid Riwayat Unduh: 4 Kolom --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

      @forelse ($historyItems as $item)
        @if (!$item->downloadable)
          @continue
        @endif

        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 relative">
          
          {{-- Bagian Atas: Judul, Tipe File & Waktu --}}
          <div class="mb-4">
            <div class="flex justify-between items-start mb-2">
              <h3 class="font-bold text-lg text-gray-900 truncate flex-1 pr-2 group-hover:text-[#05284C] transition-colors" title="{{ $item->title }}">
                {{ $item->title }}
              </h3>
              {{-- Badge Tipe File --}}
              <span class="inline-flex items-center justify-center px-2 py-1 rounded-full text-xs font-bold whitespace-nowrap
                @if($item->file_type === 'brf') bg-blue-100 text-blue-800
                @elseif($item->file_type === 'zip') bg-purple-100 text-purple-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ strtoupper($item->file_type) }}
              </span>
            </div>
            <p class="text-xs text-gray-500 flex items-center">
              <i data-lucide="download-cloud" class="w-3 h-3 mr-1"></i>
              Diunduh: {{ $item->created_at->diffForHumans() }}
            </p>
          </div>
          
          {{-- Bagian Tengah: Gambar Cover --}}
          {{-- Wrapper untuk Gambar --}}
          <a href="{{ $item->detail_url }}" 
             class="block relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4 border-4 border-white shadow-md">
            <img src="{{ $item->cover_image_url }}" 
                 alt="Cover {{ $item->title }}" 
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

            {{-- Overlay Tautan --}}
            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                <div class="bg-white/90 p-3 rounded-full shadow-lg backdrop-blur-sm">
                    <i data-lucide="info" class="w-6 h-6 text-[#05284C]"></i>
                </div>
            </div>
          </a>
          
          {{-- Bagian Bawah: Tombol Aksi --}}
          <div class="mt-auto flex gap-2">
            {{-- Tombol Detail --}}
            <a href="{{ $item->detail_url }}" 
               class="flex-1 flex items-center justify-center border border-gray-300 text-gray-700 rounded-xl py-2 text-sm font-semibold hover:bg-gray-100 transition-all shadow-sm">
                Detail
            </a>
            {{-- Tombol Unduh Lagi --}}
            <a href="{{ $item->download_url }}" 
               class="flex-1 flex items-center justify-center bg-[#05284C] text-white rounded-xl py-2 text-sm font-semibold hover:bg-[#073b6e] transition-all shadow-md">
                <i data-lucide="download" class="w-4 h-4 mr-1"></i> Unduh
            </a>
          </div>

        </div>
      
      @empty
        <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12 bg-white rounded-2xl shadow-xl p-8">
            <i data-lucide="download" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700">Riwayat Unduh Kosong</h3>
            <p class="text-gray-500 mt-1">
              @if (request('search'))
                Riwayat unduh dengan judul "{{ request('search') }}" tidak ditemukan.
              @else
                Anda belum mengunduh file apapun.
              @endif
            </p>
          </div>
      @endforelse

      </div> {{-- Akhir Grid --}}

      {{-- Link Pagination --}}
      <div class="mt-12">
        {{ $historyItems->links() }}
      </div>

    </div>
  </section>
@endsection