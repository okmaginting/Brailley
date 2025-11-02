@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Artikel')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bukukomunitasbaca" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg flex flex-col md:flex-row gap-10">
      
      {{-- Menambahkan id "article-body" untuk memudahkan seleksi teks --}}
      <div class="flex-1" id="article-body"> 
        <h2 class="text-3xl font-bold text-[#05284C] mb-6">Artikel</h2>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Title</h3>
        <p class="text-gray-600 mb-1">Penulis</p>
        
        {{-- Memperbarui kontainer TTS dengan tombol Play/Pause dan Stop terpisah --}}
        <div class="flex items-center gap-4 ml-6 my-4">
          <span class="text-gray-800 font-medium">Text-to-Speech:</span>
          
          {{-- Tombol Play/Pause --}}
          <button id="tts-play-pause-button" class="cursor-pointer text-gray-800" aria-label="Play atau Pause Teks">
            {{-- PERBAIKAN: Bungkus ikon dengan <span> yang memiliki ID --}}
            <span id="tts-play-icon" class="tts-icon-wrapper">
              <i data-lucide="play" class="w-5 h-5 tts-icon"></i>
            </span>
            <span id="tts-pause-icon" class="tts-icon-wrapper hidden">
              <i data-lucide="pause" class="w-5 h-5 tts-icon"></i>
            </span>
          </button>

          {{-- Tombol Stop --}}
          <button id="tts-stop-button" class="cursor-pointer text-gray-800" aria-label="Hentikan Teks">
            <i data-lucide="stop-circle" class="w-5 h-5 tts-icon"></i>
          </button>
        </div>
        
        <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
        </p>
        <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
        </p>
        <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
        </p>

      </div>
      <div class="flex justify-center md:justify-end items-start">
        <!-- <img src="{{ asset('images/siboke.png') }}" alt="Buku Komunitas" class="rounded-xl w-72 md:w-80 shadow-lg"> -->
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  @vite('resources/js/texttospeech.js')
@endpush

