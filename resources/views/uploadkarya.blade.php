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

        {{-- Detail Karya --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          {{-- Kolom Kiri --}}
          <div class="flex flex-col gap-5">
            <div>
              <label for="nama_penulis" class="block text-gray-700 text-sm mb-2">Nama penulis</label>
              <input type="text" id="nama_penulis" name="nama_penulis" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" required />
            </div>
            <div>
              <label for="judul_buku" class="block text-gray-700 text-sm mb-2">Judul buku</label>
              <input type="text" id="judul_buku" name="judul_buku" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" required />
            </div>
            <div>
              <label for="tema_buku" class="block text-gray-700 text-sm mb-2">Tema buku</label>
              <input type="text" id="tema_buku" name="tema_buku" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" />
            </div>
            {{-- Kolom Upload Cover (Gambar) --}}
            <div>
              <label for="cover_cerita" class="block text-gray-700 text-sm mb-2">Cover Cerita (Gambar)</label>
              <input type="file" id="cover_cerita" name="cover_cerita" class="w-full p-3 rounded-xl border border-gray-300 bg-white shadow-lg file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#041e38] focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" accept="image/*" />
              <p class="text-xs text-gray-500 mt-1">Upload gambar (JPG, PNG, dll)</p>
            </div>
          </div>
          
          {{-- Kolom Kanan --}}
          <div class="flex flex-col gap-5">
            <div>
              <label for="sinopsis" class="block text-gray-700 text-sm mb-2">Sinopsis</label>
              {{-- Disesuaikan rows agar seimbang --}}
              <textarea id="sinopsis" name="sinopsis" rows="10" class="w-full p-3 resize-none rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out"></textarea>
            </div>
            {{-- Kolom Upload File Karya (Dokumen) --}}
            <div>
              <label for="file_karya" class="block text-gray-700 text-sm mb-2">Masukkan file karya (Dokumen)</label>
              {{-- DIUBAH: Menghapus div.relative dan menyamakan style dengan input cover_cerita --}}
              <input type="file" id="file_karya" name="file_karya" class="w-full p-3 rounded-xl border border-gray-300 bg-white shadow-lg file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#041e38] focus:ring-0 focus:shadow-xl focus:outline-none transition-shadow duration-200 ease-in-out" accept=".docx" />
              {{-- DIUBAH: Memperbarui helper text dan menghapus ikon --}}
               <p class="text-xs text-gray-500 mt-1">Upload dokumen (Hanya .docx)</p>
            </div>
          </div>
        </div>

        {{-- Tombol "Upload" (submit) --}}
        <div class="flex justify-end items-center mt-10">
          <button type="submit" class="flex items-center gap-2 font-semibold bg-[#05284C] text-white py-2 px-6 rounded-lg shadow-xl hover:shadow-lg hover:bg-[#041e38] transition-all duration-200 ease-in-out">
            Kirim <i data-lucide="send" class="w-5 h-5"></i>
          </button>
        </div>

      </form>
    </div>
  </section>
@endsection

