@extends('layouts.app')

{{-- Mengatur judul halaman (Dipertahankan dinamis dari kode asli Anda) --}}
@section('title', $article->judul)

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  {{-- Padding 'pb-20' ditambahkan kembali untuk memberi ruang di bagian bawah --}}
  <section id="bukukomunitasbaca" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      <div class="flex flex-col md:flex-row gap-10 md:gap-12">
        <div class="contents md:flex md:flex-col md:w-3/5 md:order-1 min-w-0 md:gap-0">
          <div class="order-1" id="article-body"> 
            <h2 class="text-3xl font-bold text-[#05284C] mb-6">{{ $article->judul }}</h2>
            {{-- <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $article->judul }}</h3> --}} {{-- Dihapus karena judul sudah dipindahkan ke H2 --}}
            <p class="text-gray-600 mb-1">Oleh: {{ $article->penulis }}</p>

            <div class="flex items-center gap-4 ml-6 my-4">
              <span class="text-gray-800 font-medium">Text-to-Speech:</span>
              <button id="tts-play-pause-button" class="cursor-pointer text-gray-800" aria-label="Play atau Pause Teks">
                <span id="tts-play-icon" class="tts-icon-wrapper">
                  <i data-lucide="play" class="w-6 h-6 tts-icon"></i>
                </span>
                <span id="tts-pause-icon" class="tts-icon-wrapper hidden">
                  <i data-lucide="pause" class="w-6 h-6 tts-icon"></i>
                </span>
              </button>
              <button id="tts-stop-button" class="cursor-pointer text-gray-800" aria-label="Hentikan Teks">
                <i data-lucide="stop-circle" class="w-6 h-6 tts-icon"></i>
              </button>
            </div>
          </div>
          
          <div class="order-3 md:order-2 min-w-0">
            <div id="article-content" class="text-gray-700 leading-relaxed mt-6 prose max-w-none">
              {!! $article->isi_artikel !!}
            </div>
          </div>
  
        </div>
  
        <div class="w-full md:w-2/5 order-2 md:order-2 flex-shrink-0">
          @if ($article->gambar)
            <img src="{{ Storage::url($article->gambar) }}" 
                 alt="{{ $article->judul }}" 
                 class="rounded-xl w-full h-auto shadow-lg object-cover">
          @endif
        </div>

      </div> {{-- Akhir dari container flex --}}
    </div>
  </section>
@endsection

@push('scripts')
  @vite('resources/js/texttospeech.js')
@endpush