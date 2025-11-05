@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Cerita Komunitas')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  {{-- ID section diubah agar sesuai dengan konten --}}
  <section id="ceritakomunitas" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        
        {{-- Judul Halaman Dipercantik --}}
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Cerita Komunitas</h2>
        
        {{-- Search Bar Dipercantik (dengan shadow-sm) --}}
        <div class="relative w-full md:w-80">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
            <input type="text" placeholder="Cari cerita komunitas..." class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all">
        </div>

      </div>

      {{-- Grid Cerita: 4 Kolom --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Card Cerita 1 (Template Baru) --}}
        {{-- PERUBAHAN: shadow-lg diubah menjadi shadow-xl, hover:shadow-xl menjadi hover:shadow-2xl --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Cerita A">Judul Cerita A</h3>
                <p class="text-sm text-gray-600">Nama Penulis A</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/9333ea/F1EFEC?text=Sampul+Cerita" 
                     alt="Sampul Cerita A" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> {{-- mt-auto mendorong tombol ke bawah --}}
                <a href="/ceritakomunitas/detail" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Cerita 2 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Cerita B">Judul Cerita B</h3>
                <p class="text-sm text-gray-600">Nama Penulis B</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/2563eb/F1EFEC?text=Sampul+Cerita" 
                     alt="Sampul Cerita B" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/ceritakomunitas/detail" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Cerita 3 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Cerita C">Judul Cerita C</h3>
                <p class="text-sm text-gray-600">Nama Penulis C</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/16a34a/F1EFEC?text=Sampul+Cerita" 
                     alt="Sampul Cerita C" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/ceritakomunitas/detail" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Cerita 4 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Cerita D">Judul Cerita D</h3>
                <p class="text-sm text-gray-600">Nama Penulis D</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/d97706/F1EFEC?text=Sampul+Cerita" 
                     alt="Sampul Cerita D" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/ceritakomunitas/detail" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

      </div>
    </div>
  </section>
@endsection