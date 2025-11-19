@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $story->judul)

@section('content')
<section id="karya-detail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">
        
        <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">
            
            {{-- Kolom Kiri: Teks & Aksi --}}
            <div class="w-full md:flex-1">
                
                {{-- Judul Utama --}}
                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words mb-8">
                    {{ $story->judul }}
                </h2>

                {{-- Tombol-Tombol Aksi --}}
                <div class="flex flex-wrap gap-4 mb-10">
                    
                    {{-- Tombol Baca (Primary Action) --}}
                    {{-- Menambahkan wire:navigate --}}
                    <a href="/ceritakomunitas/{{ $story->id }}/baca" 
                       class="flex items-center justify-center gap-2 bg-[#05284C] text-white px-6 py-3 rounded-xl font-bold hover:bg-[#073b6e] transition-colors shadow-lg shadow-[#05284C]/20 min-w-[160px]">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                        Baca Cerita
                    </a>
                    
                    {{-- Tombol Download .BRF (Secondary Action) --}}
                    {{-- Tidak pakai wire:navigate karena ini download file --}}
                    @if ($story->braille_file)
                        <a href="{{ route('file.download', ['id' => $story->id, 'type' => 'brf']) }}" 
                           download 
                           class="flex items-center justify-center gap-2 border-2 border-[#05284C] text-[#05284C] px-6 py-3 rounded-xl font-bold hover:bg-[#05284C] hover:text-white transition-all min-w-[160px]">
                            <i data-lucide="download" class="w-5 h-5"></i>
                            Download .BRF
                        </a>
                    @endif

                    {{-- Tombol Download .ZIP (Secondary Action) --}}
                    {{-- Tidak pakai wire:navigate karena ini download file --}}
                    @if ($story->braille_mirrored_image)
                        <a href="{{ route('file.download', ['id' => $story->id, 'type' => 'zip']) }}" 
                           download 
                           class="flex items-center justify-center gap-2 border-2 border-[#05284C] text-[#05284C] px-6 py-3 rounded-xl font-bold hover:bg-[#05284C] hover:text-white transition-all min-w-[160px]">
                            <i data-lucide="file-archive" class="w-5 h-5"></i>
                            Download .ZIP
                        </a>
                    @endif
                </div>
                
                {{-- Metadata Cerita (Grid Layout) --}}
                <div class="border-t border-[#05284C]/10 pt-8">
                    <h3 class="text-xl font-bold text-[#05284C] mb-6 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Detail Cerita
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-base text-gray-700">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Genre</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $story->genre }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Penulis</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $story->penulis }}</span>
                        </div>
                        <div class="flex flex-col sm:col-span-2">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Diunggah Oleh</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $story->user->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Gambar Cover --}}
            <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                <div class="w-[280px] md:w-[340px]">
                    @if ($story->gambar_cerita)
                        <img src="{{ asset('storage/' . $story->gambar_cerita) }}" 
                             alt="Sampul {{ $story->judul }}" 
                             class="rounded-2xl shadow-xl w-full aspect-[3/4] object-cover border-4 border-white">
                    @else
                        {{-- Gambar cadangan --}}
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
            
            <div class="prose prose-lg max-w-none text-gray-700 whitespace-pre-line leading-relaxed text-justify">
                {{ $story->sipnosis ?? 'Sinopsis tidak tersedia.' }}
            </div>
        </div>
        
    </div>
</section>
@endsection