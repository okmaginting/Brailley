@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Karya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="tuliskarya" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-6xl p-14 shadow-lg flex flex-col">
      <div class="mb-10">
        <h2 class="text-4xl font-extrabold text-[#000]">Bagikan Karya</h2>
        <p class="text-2xl font-semibold text-[#000] mt-1">Tulis Karya</p>
      </div>

      {{-- 
        Satu form yang membungkus kedua langkah. 
        PENTING: Menambahkan enctype untuk file upload.
      --}}
      <form action="/karya/submit" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf {{-- Penting untuk Laravel forms --}}

        {{-- LANGKAH 1: Detail Karya --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="flex flex-col gap-5">
            <div>
              <label for="nama_penulis" class="block text-gray-700 text-sm mb-2">Nama penulis</label>
              {{-- Ini adalah kelas referensi --}}
              <input type="text" id="nama_penulis" name="nama_penulis" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" required />
            </div>
            <div>
              <label for="judul_buku" class="block text-gray-700 text-sm mb-2">Judul buku</label>
              {{-- DIUBAH: rounded-lg -> rounded-xl dan ditambahkan focus:ring-0 --}}
              <input type="text" id="judul_buku" name="judul_buku" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" required />
            </div>
            <div>
              <label for="tema_buku" class="block text-gray-700 text-sm mb-2">Tema buku</label>
              {{-- DIUBAH: rounded-lg -> rounded-xl dan ditambahkan focus:ring-0 --}}
              <input type="text" id="tema_buku" name="tema_buku" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" />
            </div>
            {{-- TAMBAHAN: Kolom Upload Cover Cerita --}}
            <div>
              <label for="cover_cerita" class="block text-gray-700 text-sm mb-2">Cover Cerita</label>
              {{-- DIUBAH: rounded-lg -> rounded-xl dan ditambahkan focus:ring-0 --}}
              <input type="file" id="cover_cerita" name="cover_cerita" class="w-full p-3 rounded-xl border border-gray-300 bg-white shadow-lg file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#041e38] focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" accept="image/*" />
              <p class="text-xs text-gray-500 mt-1">Upload gambar (JPG, PNG, dll)</p>
            </div>
            {{-- AKHIR TAMBAHAN --}}
          </div>
          <div class="flex flex-col">
            <label for="sinopsis" class="block text-gray-700 text-sm mb-2">Sinopsis</label>
            {{-- Menyesuaikan rows agar seimbang --}}
            {{-- DIUBAH: rounded-lg -> rounded-xl dan ditambahkan focus:ring-0 --}}
            <textarea id="sinopsis" name="sinopsis" rows="16" class="w-full p-3 resize-none rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out"></textarea>
          </div>
        </div>

        {{-- LANGKAH 2: Tulis Cerita (Sekarang terlihat) --}}
        <div class="flex flex-col mt-8">
          <label for="cerita" class="block text-gray-700 text-sm mb-3">Masukkan Cerita</label>
          {{-- DIUBAH: rounded-lg -> rounded-xl dan ditambahkan focus:ring-0 (padding p-4 tetap) --}}
          <textarea id="cerita" name="cerita" rows="10" class="w-full p-4 resize-none rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out"></textarea>
          <div class="flex justify-end items-center mt-8">
            {{-- Tombol "Upload" (submit) untuk mengirimkan seluruh form --}}
            {{-- DIUBAH: Diubah menjadi tombol dengan gaya --}}
            <button type="submit" class="flex items-center gap-2 font-semibold bg-[#05284C] text-white py-2 px-6 rounded-lg shadow-xl hover:shadow-lg  hover:bg-[#041e38] transition-all duration-200 ease-in-out">
              Kirim <i data-lucide="send" class="w-5 h-5"></i>
            </button>
          </div>
        </div>

      </form>
    </div>
  </section>
@endsection

