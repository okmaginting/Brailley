@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Artikel')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  {{-- Padding bawah 'pb-20' ditambahkan --}}
  <section id="artikel" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        
        {{-- Judul Halaman Dipercantik --}}
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Artikel</h2>
        
        {{-- Search Bar Fungsional (dari kode dinamis Anda) --}}
        <form action="{{ route('artikel.index') }}" method="GET" class="relative w-full md:w-80">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
            <input 
              type="text" 
              name="search"
              placeholder="Cari artikel..." 
              class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all"
              value="{{ request('search') }}"
            >
        </form>

      </div>

      {{-- 
        PERUBAHAN BESAR: 
        Grid diubah menjadi Tampilan Daftar (List View)
        Menggunakan flex-col dan gap-6 untuk tumpukan yang rapi.
      --}}
      <div class="flex flex-col gap-6">
        
        @forelse ($articles as $article)
          <div class="bg-white rounded-2xl shadow-lg p-5 md:p-6 flex items-center gap-5 hover:shadow-xl hover:border-gray-300 border border-transparent transition-all duration-300">
            
            <div class="flex-shrink-0 text-center bg-gray-100 p-4 rounded-lg w-20 hidden sm:block">
                <p class="text-3xl font-bold text-[#05284C]">{{ $article->created_at->format('d') }}</p>
                <p class="text-sm font-semibold text-gray-600 uppercase">{{ $article->created_at->format('M') }}</p>
            </div>

            <div class="flex-1 min-w-0"> {{-- min-w-0 penting untuk 'truncate' --}}
                <h3 class="text-xl font-bold text-gray-900 truncate" title="{{ $article->judul }}">
                    {{ $article->judul }}
                </h3>
                <p class="text-sm text-gray-600 mb-2">Ditulis oleh: {{ $article->penulis }}</p>
                <p class="text-sm text-gray-500 truncate hidden md:block">
                    {{-- Menggunakan helper 'excerpt' Anda --}}
                    {{ \App\Http\Controllers\ArticleController::excerpt($article->isi_artikel, 120) }}
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="/artikel/{{ $article->id }}" class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-12 h-12 hover:bg-opacity-90 transition-all" title="Baca Artikel">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
          </div>
        
        @empty
          <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 text-center">
            <i data-lucide="file-text" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700">Belum Ada Artikel</h3>
            <p class="text-gray-500 mt-1">
              @if (request('search'))
                Artikel dengan kata kunci "{{ request('search') }}" tidak ditemukan.
              @else
                Saat ini belum ada artikel yang dipublikasikan.
              @endif
            </p>
          </div>
        @endforelse

      </div> {{-- Akhir dari .flex-col --}}

      {{-- Link Pagination --}}
      <div class="mt-12">
        {{ $articles->links() }}
      </div>

    </div>
  </section>
@endsection