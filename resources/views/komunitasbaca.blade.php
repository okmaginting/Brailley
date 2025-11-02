@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Bacaan Komunitas')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bukukomunitasbaca" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg flex flex-col md:flex-row gap-10">
      <div class="flex-1">
        <h2 class="text-3xl font-bold text-[#05284C] mb-6">Buku Komunitas</h2>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Title</h3>
        <p class="text-gray-600 mb-1">Theme</p>
        <div id="ttsContainer" class="flex items-center gap-2 ml-6 cursor-pointer my-4">
          <i data-lucide="volume-2" class="w-5 h-5 tts-icon"></i>
          <span class="text-gray-800 font-medium">Text-to-Speech</span>
        </div>
          <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
      </p>
      <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
      </p>
      <p class="text-gray-700 mb-4 leading-relaxed">Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa! Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
      </p>

      </div>
      <div class="flex justify-center md:justify-end items-start">
        <img src="{{ asset('images/siboke.png') }}" alt="Buku Komunitas" class="rounded-xl w-72 md:w-80 shadow-lg">
      </div>
    </div>
  </section>
@endsection