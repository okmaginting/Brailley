@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Terjemahkan ke Braille')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    <section id="artikel" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20 md:pb-40">
      <div class="bg-[#F1EFEC]  rounded-[40px] w-full max-w-6xl p-10 md:p-16 ">
        <h2 class="text-3xl font-semibold text-black mb-10">Brailley Menu</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 mb-6">
          <a href="/terjemahkan" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Terjemahkan</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="arrow-left-right" class="w-5 h-5"></i>
              </div>
            </div>
          </a>

          <a href="/bukukomunitas" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Buku Komunitas</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="book-text" class="w-5 h-5"></i>
              </div>
            </div>
          </a>

          <a href="/bukuresmi" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Buku Resmi</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="book-open" class="w-5 h-5"></i>
              </div>
            </div>
          </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
          <a href="/audiobook" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Audiobook</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="play" class="w-5 h-5"></i>
              </div>
            </div>
          </a>

          <a href="/artikel" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Artikel</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="edit" class="w-5 h-5"></i>
              </div>
            </div>
          </a>

          <a href="/bagikankarya" class="block">
            <div class="bg-[#fffcf6] rounded-2xl p-5 flex flex-col justify-center items-center shadow-xl/20 hover:shadow-xl transition h-40 cursor-pointer">
              <h3 class="text-base font-semibold text-black mb-2">Bagikan Karya</h3>
              <div class="flex items-center gap-2">
                <i data-lucide="share-2" class="w-5 h-5"></i>
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>
@endsection