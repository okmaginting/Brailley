@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Karya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    <section id="tuliskaryanew" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-6xl p-14 shadow-lg flex flex-col">
      <div class="mb-10">
        <h2 class="text-4xl font-extrabold text-[#000]">Bagikan Karya</h2>
        <p class="text-2xl font-semibold text-[#000] mt-1">Tulis Karya</p>
      </div>
      <form class="flex flex-col">
        <label class="block text-gray-700 text-sm mb-3">Masukkan Cerita</label>
        <textarea rows="10" class="w-full p-4 resize-none"></textarea>
        <div class="flex justify-end mt-8">
          <a href="#" class="flex items-center gap-2 text-gray-800 font-semibold hover:text-[#05284C] transition">Upload <i data-lucide="arrow-right" class="w-5 h-5"></i></a>
        </div>
      </form>
    </div>
  </section>
@endsection