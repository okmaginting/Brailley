@extends('layouts.app')

@section('title', 'Baca: ' . $story->judul)

@section('content')
<section id="karya-detail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">
        
        {{-- ============================================================ --}}
        {{-- DATA KHUSUS UNTUK TEXT-TO-SPEECH (JS HOOKS)              --}}
        {{-- ============================================================ --}}
        
        {{-- 1. Wrapper ID untuk Judul (Agar JS bisa menemukan judul) --}}
        <div id="article-body" class="sr-only">
            <h2>{{ $story->judul }}</h2>
        </div>

        {{-- 
           2. Data Metadata untuk TTS
           PENTING: 
           - Class 'space-y-3 text-base text-gray-700' WAJIB ADA karena dicari oleh file JS Anda.
           - Jangan gunakan class 'hidden' (karena innerText JS tidak bisa bacanya).
           - Gunakan inline style position absolute untuk menyembunyikannya secara visual saja.
           - Isi teks dibuat kalimat mengalir agar enak didengar dan jedanya pas.
        --}}
        <div class="space-y-3 text-base text-gray-700" style="position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden;">
            Cerita ini bergenre {{ $story->genre }}
            Ditulis oleh {{ $story->penulis }}
            Diunggah oleh {{ $story->user->name ?? 'Pengguna' }}
        </div>
        {{-- ============================================================ --}}


        <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">
            
            {{-- Kolom Kiri: Teks Utama & Player --}}
            <div class="w-full md:flex-1">

                {{-- Judul Visual --}}
                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words mb-8">
                    {{ $story->judul }}
                </h2>

                {{-- WIDGET TEXT-TO-SPEECH (Tampilan Baru) --}}
                <div class="mb-10">
                    <div class="bg-white/50 border border-[#05284C]/10 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                        
                        {{-- Label & Ikon --}}
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <div class="p-2.5 bg-[#05284C]/10 rounded-full text-[#05284C]">
                                <i data-lucide="headphones" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Dengarkan Cerita</p>
                                <p class="text-sm font-medium text-[#05284C]">Putar suara</p>
                            </div>
                        </div>

                        {{-- Tombol Kontrol --}}
                        <div class="flex items-center gap-3">
                            <button id="tts-stop-button" 
                                    class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-red-600 transition-colors"
                                    aria-label="Hentikan pembacaan">
                                <i data-lucide="stop-circle" class="w-5 h-5"></i>
                            </button>

                            <button id="tts-play-pause-button" 
                                    class="w-12 h-12 flex items-center justify-center rounded-full bg-[#05284C] text-white shadow-lg shadow-[#05284C]/20 hover:bg-[#073b6e] transition-colors"
                                    aria-label="Mulai membaca">
                                <span id="tts-play-icon"><i data-lucide="play" class="w-5 h-5 ml-1"></i></span>
                                <span id="tts-pause-icon" class="hidden"><i data-lucide="pause" class="w-5 h-5"></i></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Detail Cerita (Tampilan Visual Grid) --}}
                <div class="border-t border-[#05284C]/10 pt-6">
                    <h3 class="text-xl font-bold text-[#05284C] mb-4 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Detail Cerita
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-base text-gray-700">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide">Genre</span>
                            <span class="font-medium text-[#05284C]">{{ $story->genre }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide">Penulis</span>
                            <span class="font-medium text-[#05284C]">{{ $story->penulis }}</span>
                        </div>
                        <div class="flex flex-col sm:col-span-2">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide">Diunggah Oleh</span>
                            <span class="font-medium text-[#05284C]">{{ $story->user->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Gambar --}}
            <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                <div class="w-[260px] md:w-[280px]">
                    @if ($story->gambar_cerita)
                        <img src="{{ asset('storage/' . $story->gambar_cerita) }}"
                             alt="Sampul cerita {{ $story->judul }}"
                             class="rounded-2xl shadow-xl w-full aspect-[3/4] object-cover border-4 border-white">
                    @else
                        <div class="rounded-2xl shadow-xl w-full aspect-[3/4] bg-gray-300 flex items-center justify-center border-4 border-white text-gray-500">
                            <span class="font-medium">Tanpa Cover</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- Bagian Isi Cerita --}}
        <div class="mt-12 pt-8 border-t border-[#05284C]/10">
            <h3 class="text-2xl font-bold text-[#05284C] mb-6">Isi Cerita</h3>
            
            {{-- ID article-content WAJIB ADA untuk JS TTS --}}
            <div id="article-content" class="prose prose-lg max-w-none text-gray-800 whitespace-pre-line leading-relaxed text-justify">
                {!! $content ?? '<p class="text-gray-500 italic">Konten cerita tidak tersedia.</p>' !!}
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/texttospeech.js')
@endpush