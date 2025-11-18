@extends('layouts.app')

@section('title', $article->judul)

@section('content')
<section id="bukukomunitasbaca" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">

        @if ($article->gambar)
            {{-- LAYOUT 2 KOLOM (ADA GAMBAR) --}}
            <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">

                <div class="w-full md:flex-1">
                    <div id="article-body">
                        {{-- Judul --}}
                        <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words mb-4">
                            {{ $article->judul }}
                        </h2>
                        
                        {{-- Penulis (Class harus text-gray-600 agar terbaca logic artikel JS) --}}
                        <div class="flex items-center gap-2 text-gray-600 mb-8">
                            <div class="p-1.5 bg-[#05284C]/10 rounded-full">
                                <i data-lucide="pen-tool" class="w-4 h-4 text-[#05284C]"></i>
                            </div>
                            {{-- Tag <p> dengan class spesifik untuk JS --}}
                            <p class="text-gray-600 font-medium">Oleh: {{ $article->penulis }}</p>
                        </div>
                    </div>

                    {{-- TTS WIDGET --}}
                    <div class="mb-10">
                        <div class="bg-white/50 border border-[#05284C]/10 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                <div class="p-2.5 bg-[#05284C]/10 rounded-full text-[#05284C]">
                                    <i data-lucide="headphones" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Dengarkan Artikel</p>
                                    <p class="text-sm font-medium text-[#05284C]">Putar suara</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button id="tts-stop-button" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-red-600 transition-colors">
                                    <i data-lucide="stop-circle" class="w-5 h-5"></i>
                                </button>
                                <button id="tts-play-pause-button" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#05284C] text-white shadow-lg shadow-[#05284C]/20 hover:bg-[#073b6e] transition-colors">
                                    <span id="tts-play-icon"><i data-lucide="play" class="w-5 h-5 ml-1"></i></span>
                                    <span id="tts-pause-icon" class="hidden"><i data-lucide="pause" class="w-5 h-5"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- GAMBAR --}}
                <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                    <div class="w-full md:w-[400px]">
                        <img src="{{ Storage::url($article->gambar) }}" 
                             alt="{{ $article->judul }}" 
                             class="rounded-2xl shadow-xl w-full h-auto object-cover border-4 border-white">
                    </div>
                </div>

            </div>

            {{-- KONTEN ARTIKEL (Dengan ID #article-content) --}}
            <div class="mt-10 pt-8 border-t border-[#05284C]/10">
                <div id="article-content" class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify whitespace-pre-line">
                    {!! $article->isi_artikel !!}
                </div>
            </div>

        @else
            {{-- LAYOUT FULL WIDTH (TANPA GAMBAR) --}}
            <div class="w-full max-w-4xl mx-auto">
                
                {{-- WRAPPER ID UNTUK JS --}}
                <div id="article-body" class="text-center">
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight mb-6">
                        {{ $article->judul }}
                    </h2>
                    
                    <div class="flex items-center justify-center gap-2 text-gray-600 mb-10">
                        <div class="p-1.5 bg-[#05284C]/10 rounded-full">
                            <i data-lucide="pen-tool" class="w-4 h-4 text-[#05284C]"></i>
                        </div>
                        <p class="text-gray-600 font-medium">Oleh: {{ $article->penulis }}</p>
                    </div>
                </div>

                {{-- TTS WIDGET --}}
                <div class="mb-10 max-w-2xl mx-auto">
                    <div class="bg-white/50 border border-[#05284C]/10 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="p-2.5 bg-[#05284C]/10 rounded-full text-[#05284C]">
                                <i data-lucide="headphones" class="w-5 h-5"></i>
                            </div>
                            <span class="font-bold text-gray-700">Dengarkan Artikel</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <button id="tts-stop-button" class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:bg-gray-100 hover:text-red-600 transition-colors">
                                <i data-lucide="stop-circle" class="w-5 h-5"></i>
                            </button>
                            <button id="tts-play-pause-button" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#05284C] text-white shadow-lg hover:bg-[#073b6e] transition-colors">
                                <span id="tts-play-icon"><i data-lucide="play" class="w-5 h-5 ml-1"></i></span>
                                <span id="tts-pause-icon" class="hidden"><i data-lucide="pause" class="w-5 h-5"></i></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- KONTEN ARTIKEL (Dengan ID #article-content) --}}
                <div id="article-content" class="prose prose-lg max-w-none text-gray-700 leading-relaxed text-justify whitespace-pre-line border-t border-[#05284C]/10 pt-8">
                    {!! $article->isi_artikel !!}
                </div>
            </div>
        @endif

    </div>
</section>
@endsection

@push('scripts')
@vite('resources/js/texttospeech.js')
@endpush