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
        
        {{-- Search Bar Dipercantik (dengan shadow-sm) --}}
        <div class="relative w-full md:w-80">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
            <input type="text" placeholder="Cari artikel..." class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all">
        </div>

      </div>

      {{-- 
        PERUBAHAN BESAR: 
        Grid diubah menjadi Tampilan Daftar (List View)
        Menggunakan flex-col dan gap-6 untuk tumpukan yang rapi.
      --}}
      <div class="flex flex-col gap-6">
        
        <!-- Item Artikel 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 md:p-6 flex items-center gap-5 hover:shadow-xl hover:border-gray-300 border border-transparent transition-all duration-300">
            
            <!-- Blok Tanggal -->
            <div class="flex-shrink-0 text-center bg-gray-100 p-4 rounded-lg w-20 hidden sm:block">
                <p class="text-3xl font-bold text-[#05284C]">05</p>
                <p class="text-sm font-semibold text-gray-600 uppercase">NOV</p>
            </div>

            <!-- Konten Teks -->
            <div class="flex-1 min-w-0"> {{-- min-w-0 penting untuk 'truncate' --}}
                <h3 class="text-xl font-bold text-gray-900 truncate" title="Judul Artikel Pertama">
                    Judul Artikel Pertama
                </h3>
                <p class="text-sm text-gray-600 mb-2">Ditulis oleh: Nama Penulis A</p>
                <p class="text-sm text-gray-500 truncate hidden md:block">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex-shrink-0">
                <a href="/artikel/baca/slug-artikel-1" class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-12 h-12 hover:bg-opacity-90 transition-all" title="Baca Artikel">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

        <!-- Item Artikel 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 md:p-6 flex items-center gap-5 hover:shadow-xl hover:border-gray-300 border border-transparent transition-all duration-300">
            
            <!-- Blok Tanggal -->
            <div class="flex-shrink-0 text-center bg-gray-100 p-4 rounded-lg w-20 hidden sm:block">
                <p class="text-3xl font-bold text-[#05284C]">02</p>
                <p class="text-sm font-semibold text-gray-600 uppercase">NOV</p>
            </div>

            <!-- Konten Teks -->
            <div class="flex-1 min-w-0">
                <h3 class="text-xl font-bold text-gray-900 truncate" title="Panduan Lengkap Braille untuk Pemula">
                    Panduan Lengkap Braille untuk Pemula
                </h3>
                <p class="text-sm text-gray-600 mb-2">Ditulis oleh: Nama Penulis B</p>
                <p class="text-sm text-gray-500 truncate hidden md:block">
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat...
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex-shrink-0">
                <a href="/artikel/baca/slug-artikel-2" class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-12 h-12 hover:bg-opacity-90 transition-all" title="Baca Artikel">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

        <!-- Item Artikel 3 -->
        <div class="bg-white rounded-2xl shadow-lg p-5 md:p-6 flex items-center gap-5 hover:shadow-xl hover:border-gray-300 border border-transparent transition-all duration-300">
            
            <!-- Blok Tanggal -->
            <div class="flex-shrink-0 text-center bg-gray-100 p-4 rounded-lg w-20 hidden sm:block">
                <p class="text-3xl font-bold text-[#05284C]">29</p>
                <p class="text-sm font-semibold text-gray-600 uppercase">OKT</p>
            </div>

            <!-- Konten Teks -->
            <div class="flex-1 min-w-0">
                <h3 class="text-xl font-bold text-gray-900 truncate" title="Teknologi Baru untuk Tunanetra">
                    Teknologi Baru untuk Tunanetra
                </h3>
                <p class="text-sm text-gray-600 mb-2">Ditulis oleh: Nama Penulis C</p>
                <p class="text-sm text-gray-500 truncate hidden md:block">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur...
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex-shrink-0">
                <a href="/artikel/baca/slug-artikel-3" class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-12 h-12 hover:bg-opacity-90 transition-all" title="Baca Artikel">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

      </div>
    </div>
  </section>
@endsection