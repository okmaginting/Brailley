@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $audiobook->judul)

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="audiobookdetail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">
      
        <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">
        
            {{-- Kolom Kiri: Teks & Aksi --}}
            <div class="w-full md:flex-1">
          
                {{-- Judul Utama --}}
                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words mb-8">
                    {{ $audiobook->judul }}
                </h2>

                {{-- Tombol-Tombol Aksi --}}
                <div class="flex flex-wrap gap-4 mb-10">
            
                    {{-- Tombol Dengarkan (Primary Action) --}}
                    <a href="{{ route('audiobook.listen', $audiobook->id) }}" 
                       class="flex items-center justify-center gap-2 bg-[#05284C] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#073b6e] transition-colors shadow-lg shadow-[#05284C]/20 min-w-[160px]">
                        <i data-lucide="headphones" class="w-5 h-5"></i>
                        Dengarkan
                    </a>
            
                    {{-- Tombol Download Audio (Secondary Action) --}}
                    <a href="{{ route('audiobook.download', $audiobook->id) }}" 
                       class="flex items-center justify-center gap-2 border-2 border-[#05284C] text-[#05284C] px-6 py-3 rounded-xl font-bold hover:bg-[#05284C] hover:text-white transition-all min-w-[160px]">
                        <i data-lucide="download" class="w-5 h-5"></i>
                        Download Audio
                    </a>
                </div>
          
                {{-- Metadata Audiobook (Grid Layout) --}}
                <div class="border-t border-[#05284C]/10 pt-8">
                    <h3 class="text-xl font-bold text-[#05284C] mb-6 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Detail Audiobook
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-base text-gray-700">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Penulis</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $audiobook->penulis }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Narator</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $audiobook->pengisi_audio }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Gambar Sampul --}}
            <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                <div class="w-[280px] md:w-[340px]">
                    @if ($audiobook->gambar_cover)
                        <img src="{{ asset('storage/' . $audiobook->gambar_cover) }}" 
                             alt="Sampul {{ $audiobook->judul }}" 
                             class="rounded-2xl shadow-xl w-full aspect-[3/4] object-cover border-4 border-white">
                    @else
                        <div class="rounded-2xl shadow-xl w-full aspect-[3/4] bg-gray-300 flex items-center justify-center border-4 border-white text-gray-500">
                            <span class="font-medium">Tanpa Cover</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>
      
    </div>
</section>
@endsection