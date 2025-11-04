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

      {{-- Menampilkan error validasi --}}
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-5" role="alert">
          <strong class="font-bold">Oops! Ada yang salah:</strong>
          <ul class="mt-2 list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('karya.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf

        {{-- LANGKAH 1: Detail Karya (Grid 2x2) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          {{-- Kolom Kiri --}}
          <div class="flex flex-col gap-5">
            <div>
              <label for="penulis" class="block text-gray-700 text-sm mb-2">Nama Penulis (Nama Pena)</label>
              <input type="text" id="penulis" name="penulis" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none" value="{{ old('penulis', Auth::user()?->name) }}" required />
              <p class="text-xs text-gray-500 mt-1">Ini nama yang akan tampil di karya Anda.</p>
            </div>
            <div>
              <label for="judul" class="block text-gray-700 text-sm mb-2">Judul Karya</label>
              <input type="text" id="judul" name="judul" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none" value="{{ old('judul') }}" required />
            </div>
          </div>
          {{-- Kolom Kanan --}}
          <div class="flex flex-col gap-5">
            <div>
              <label for="genre" class="block text-gray-700 text-sm mb-2">Genre/Tema</label>
              <input type="text" id="genre" name="genre" class="w-full p-3 rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none" value="{{ old('genre') }}" required />
            </div>
            <div>
              <label for="gambar_cerita" class="block text-gray-700 text-sm mb-2">Cover Cerita</label>
              <input type="file" id="gambar_cerita" name="gambar_cerita" class="w-full p-3 rounded-xl border border-gray-300 bg-white shadow-lg file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#041e38] focus:ring-0 focus:shadow-xl focus:outline-none" accept="image/*" />
              <p class="text-xs text-gray-500 mt-1">Upload gambar (JPG, PNG, dll). Opsional.</p>
            </div>
          </div>
        </div>

        {{-- Sinopsis (Full-width) --}}
        <div class="flex flex-col mt-8">
          <label for="sipnosis" class="block text-gray-700 text-sm mb-2">Sinopsis</label>
          {{-- DIUBAH: rows="16" -> rows="8" agar lebih proporsional --}}
          <textarea id="sipnosis" name="sipnosis" rows="8" class="w-full p-3 resize-none rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none" required>{{ old('sipnosis') }}</textarea>
        </div>


        {{-- LANGKAH 2: Tulis Cerita atau Upload File --}}
        <p class="text-lg font-semibold text-gray-800 mt-12 mb-4">
          Silakan tulis cerita Anda di bawah ini, ATAU upload file .docx. (Isi salah satu)
        </p>
        <div class="flex flex-col mt-4">
          <label for="isi_cerita" class="block text-gray-700 text-sm mb-3">Tulis Cerita di Sini</label>
          <textarea id="isi_cerita" name="isi_cerita" rows="10" class="w-full p-4 resize-none rounded-xl border border-gray-300 shadow-lg focus:ring-0 focus:shadow-xl focus:outline-none">{{ old('isi_cerita') }}</textarea>
        </div>

        {{-- TAMBAHAN: Field Upload .docx --}}
        <div class="flex flex-col mt-8">
          <label for="upload_file" class="block text-gray-700 text-sm mb-3">Atau Upload File (.docx)</label>
          <input type="file" id="upload_file" name="upload_file" class="w-full p-3 rounded-xl border border-gray-300 bg-white shadow-lg file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#041e38] focus:ring-0 focus:shadow-xl focus:outline-none" accept=".docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end items-center mt-12">
            <button type="submit" class="flex items-center gap-2 font-semibold bg-[#05284C] text-white py-2 px-6 rounded-lg shadow-xl hover:shadow-lg  hover:bg-[#041e38] transition-all duration-200 ease-in-out">
              Kirim <i data-lucide="send" class="w-5 h-5"></i>
            </button>
        </div>

      </form>
    </div>
  </section>
@endsection

