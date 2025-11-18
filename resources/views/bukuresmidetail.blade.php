@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $book->judul)

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="bukuresmidetail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">
      
        <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">
        
            {{-- Kolom Kiri: Teks & Aksi --}}
            <div class="w-full md:flex-1">
          
                {{-- Judul Utama --}}
                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words mb-8">
                    {{ $book->judul }}
                </h2>

                {{-- Tombol-Tombol Aksi --}}
                <div class="flex flex-wrap gap-4 mb-10">
            
                    {{-- Tombol Kunjungi Sumber (Primary Action) --}}
                    <a href="{{ route('bukuresmi.visit', $book->id) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="flex items-center justify-center gap-2 bg-[#05284C] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#073b6e] transition-colors shadow-lg shadow-[#05284C]/20 min-w-[160px]">
                        <i data-lucide="external-link" class="w-5 h-5"></i>
                        Kunjungi Sumber
                    </a>

                    {{-- Area untuk tombol tambahan (Download, dsb) jika nanti dibutuhkan --}}
                </div>
          
                {{-- Metadata Buku (Grid Layout) --}}
                <div class="border-t border-[#05284C]/10 pt-8">
                    <h3 class="text-xl font-bold text-[#05284C] mb-6 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Detail Buku
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-base text-gray-700">
                        
                        {{-- Penulis --}}
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Penulis</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $book->penulis }}</span>
                        </div>

                        {{-- Penerbit --}}
                        @if ($book->penerbit)
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Penerbit</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $book->penerbit }}</span>
                        </div>
                        @endif

                        {{-- ISBN --}}
                        @if ($book->isbn)
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">ISBN</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $book->isbn }}</span>
                        </div>
                        @endif

                        {{-- Edisi --}}
                        @if ($book->edisi)
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Edisi</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $book->edisi }}</span>
                        </div>
                        @endif

                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Gambar Sampul --}}
            <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                <div class="w-[280px] md:w-[340px]">
                    @if ($book->gambar_cover)
                        <img src="{{ asset('storage/' . $book->gambar_cover) }}" 
                             alt="Sampul {{ $book->judul }}" 
                             class="rounded-2xl shadow-xl w-full aspect-[3/4] object-cover border-4 border-white">
                    @else
                        {{-- Gambar Placeholder --}}
                        <div class="rounded-2xl shadow-xl w-full aspect-[3/4] bg-gray-300 flex items-center justify-center border-4 border-white text-gray-500">
                            <span class="font-medium">Tanpa Cover</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Bagian Sinopsis --}}
        <div class="mt-12 pt-8 border-t border-[#05284C]/10">
            <h3 class="text-2xl font-bold text-[#05284C] mb-4">Sinopsis</h3>
            
            {{-- Teks Rata Kiri-Kanan (Justify) --}}
            <div class="prose prose-lg max-w-none text-gray-700 whitespace-pre-line leading-relaxed text-justify">
                {{ $book->sipnosis_cerita ?? 'Sinopsis tidak tersedia.' }}
            </div>
        </div>
      
    </div>
</section>
@endsection