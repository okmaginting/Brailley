@extends('layouts.app')

{{-- Judul halaman dinamis (Dipertahankan dari file asli 'Baca') --}}
@section('title', 'Baca: ' . $story->judul)

@section('content')
  <section id="karya-detail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      <div class="flex flex-col md:flex-row gap-10 md:gap-12">
        <div class="contents md:flex md:flex-col md:w-3/5 md:order-1 min-w-0 md:gap-0">
              
          <div id="article-body" class="order-1">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
              {{ $story->judul }}
            </h2>
            <div class="flex flex-wrap gap-4 mt-6">
              <div class="flex items-center gap-4">
                <span class="text-[#05284C] font-medium">Text-to-Speech:</span>
                
                {{-- Tombol Play/Pause --}}
                <button id="tts-play-pause-button" class="cursor-pointer text-[#05284C]" aria-label="Play atau Pause Teks">
                  <span id="tts-play-icon" class="tts-icon-wrapper">
                    <i data-lucide="play" class="w-6 h-6 tts-icon"></i>
                  </span>
                  <span id="tts-pause-icon" class="tts-icon-wrapper hidden">
                    <i data-lucide="pause" class="w-6 h-6 tts-icon"></i>
                  </span>
                </button>

                {{-- Tombol Stop --}}
                <button id="tts-stop-button" class="cursor-pointer text-[#05284C]" aria-label="Hentikan Teks">
                  <i data-lucide="stop-circle" class="w-6 h-6 tts-icon"></i>
                </button>
              </div>

            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-300">
              <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Cerita</h3>
              <div class="space-y-3 text-base text-gray-700">
                <p><span class="font-semibold w-28 inline-block">Genre</span>: {{ $story->genre }}</p>
                <p><span class="font-semibold w-28 inline-block">Penulis</span>: {{ $story->penulis }}</p>
                <p><span class="font-semibold w-28 inline-block">Uploader</span>: {{ $story->user->name ?? 'N/A' }}</p>
              </div>
            </div>
          </div>
          <div class="order-3 md:order-2 min-w-0">
            <div class="mt-12 pt-8 border-t border-gray-300 md:mt-8 md:pt-0 md:border-t-0">
              <h3 class="text-2xl font-bold text-gray-900 mb-2">Isi Cerita</h3>
              <div id="article-content" class="text-base text-gray-700 leading-relaxed whitespace-pre-line prose max-w-none">
                {!! $content ?? '<p>Konten cerita tidak tersedia.</p>' !!}
              </div>
            </div>
          </div>

        </div>
        <div class="w-full md:w-2/5 order-2 md:order-2 flex-shrink-0">
          <div class="flex-shrink-0 flex justify-center w-full md:w-auto">
            <div class="w-full flex-shrink-0">
              @if ($story->gambar_cerita)
                <img src="{{ asset('storage/' . $story->gambar_cerita) }}" 
                     alt="Sampul {{ $story->judul }}" 
                     class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
              @else
                {{-- Gambar cadangan jika tidak ada cover --}}
                <img src="https://placehold.co/340x450/9ca3af/F1EFEC?text=Tanpa+Cover" 
                     alt="Tanpa Cover" 
                     class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
              @endif
            </div>
          </div>
        </div> {{-- Akhir dari Image Block --}}

      </div> {{-- Akhir dari Flex Container Utama --}}
    </div>
  </section>
@endsection

@push('scripts')
  @vite('resources/js/texttospeech.js')
@endpush