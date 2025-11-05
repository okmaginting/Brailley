@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Buku Resmi')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bukuresmi" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-xl">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        
        {{-- Judul Halaman Dipercantik --}}
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Buku Resmi</h2>
        
        {{-- Search Bar Dipercantik --}}
        <div class="relative w-full md:w-80">
            <i data-lucide="search" class="w-5 h-5 text-gray-400 shadow-xl absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
            <input type="text" placeholder="Cari buku resmi..." class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all">
        </div>

      </div>

      {{-- Grid Buku: 4 Kolom --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        {{-- Card Buku 1 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Buku A">Judul Buku A</h3>
                <p class="text-sm text-gray-600">Nama Penulis A</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/05284C/F1EFEC?text=Sampul+Buku" 
                     alt="Sampul Buku A" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> {{-- mt-auto mendorong tombol ke bawah --}}
                <a href="/bukuresmi/detail-a" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Buku 2 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Buku B">Judul Buku B</h3>
                <p class="text-sm text-gray-600">Nama Penulis B</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/9333ea/F1EFEC?text=Sampul+Buku" 
                     alt="Sampul Buku B" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/bukuresmi/detail-b" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Buku 3 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Buku C">Judul Buku C</h3>
                <p class="text-sm text-gray-600">Nama Penulis C</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/16a34a/F1EFEC?text=Sampul+Buku" 
                     alt="Sampul Buku C" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/bukuresmi/detail-c" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

        {{-- Card Buku 4 (Template Baru) --}}
        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
            
            <!-- 1. Judul & Penulis -->
            <div class="mb-4"> 
                <h3 class="font-bold text-lg text-gray-900 truncate" title="Judul Buku D">Judul Buku D</h3>
                <p class="text-sm text-gray-600">Nama Penulis D</p>
            </div>
    
            <!-- 2. Gambar (Rasio 3:4) -->
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                <img src="https://placehold.co/300x400/d97706/F1EFEC?text=Sampul+Buku" 
                     alt="Sampul Buku D" 
                     class="w-full h-full object-cover">
            </div>
    
            <!-- 3. Tombol Detail -->
            <div class="mt-auto"> 
                <a href="/bukuresmi/detail-d" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                    Lihat Detail
                </a>
            </div>
        </div>

      </div>
    </div>
  </section>
@endsection