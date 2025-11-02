@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Karya')
{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
      <section id="tuliskarya" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-6xl p-14 shadow-lg flex flex-col">
      <div class="mb-10">
        <h2 class="text-4xl font-extrabold text-[#000]">Bagikan Karya</h2>
        <p class="text-2xl font-semibold text-[#000] mt-1">Tulis Karya</p>
      </div>

      <form class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="flex flex-col gap-5">
          <div>
            <label class="block text-gray-700 text-sm mb-2">Nama penulis</label>
            <input type="text" class="w-full p-3" />
          </div>
          <div>
            <label class="block text-gray-700 text-sm mb-2">Judul buku</label>
            <input type="text" class="w-full p-3" />
          </div>
          <div>
            <label class="block text-gray-700 text-sm mb-2">Tema buku</label>
            <input type="text" class="w-full p-3" />
          </div>
        </div>
        <div class="flex flex-col">
          <label class="block text-gray-700 text-sm mb-2">Sinopsis</label>
          <textarea rows="9" class="w-full p-3 resize-none"></textarea>
        </div>
      </form>

      <div class="flex justify-end mt-10">
        <a href="/bagikankarya/tuliskarya/tuliskaryanew" class="flex items-center gap-2 text-gray-800 font-semibold hover:text-[#05284C] transition">Next <i data-lucide="arrow-right" class="w-5 h-5"></i></a>
      </div>
    </div>
  </section>
@endsection