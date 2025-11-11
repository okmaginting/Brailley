@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $book->judul)

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bukuresmidetail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      <div class="flex flex-col-reverse md:flex-row items-start justify-center gap-10 md:gap-16">
        {{-- Lebar kolom teks diatur agar nyaman dibaca --}}
        <div class="w-full md:max-w-prose">
          
          {{-- Judul Utama --}}
          <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
            {{ $book->judul }}
          </h2>

          {{-- Tombol-Tombol Aksi --}}
          <div class="flex flex-wrap gap-4 mt-6">
            
            {{-- Tombol Kunjungi Sumber (Aksi Primer) --}}
            <a href="{{ route('bukuresmi.visit', $book->id) }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="flex items-center gap-2 bg-[#05284C] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-md">
              <i data-lucide="external-link" class="w-5 h-5"></i>
              Kunjungi Sumber
            </a>
            
            {{-- Anda bisa menambahkan tombol sekunder di sini jika ada,
               seperti tombol download BRF/ZIP jika buku resmi juga memilikinya --}}

          </div>
          
          {{-- Metadata Buku --}}
          <div class="mt-8 pt-6 border-t border-gray-300">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Buku</h3>
            <div class="space-y-3 text-base text-gray-700">
              <p><span class="font-semibold w-28 inline-block">Penulis</span>: {{ $book->penulis }}</p>
              
              {{-- Data kondisional --}}
              @if ($book->penerbit)
                <p><span class="font-semibold w-28 inline-block">Penerbit</span>: {{ $book->penerbit }}</p>
              @endif
              
              @if ($book->isbn)
                <p><span class="font-semibold w-28 inline-block">ISBN</span>: {{ $book->isbn }}</p>
              @endif
              
              @if ($book->edisi)
                <p><span class="font-semibold w-28 inline-block">Edisi</span>: {{ $book->edisi }}</p>
              @endif
            </div>
          </div>

        </div>

        {{-- Kolom Gambar Sampul --}}
        <div class="flex-shrink-0 flex justify-center w-full md:w-auto">
          {{-- Wrapper untuk ukuran konstan --}}
          <div class="w-full max-w-[340px] md:w-[340px] flex-shrink-0">
            @if ($book->gambar_cover)
              {{-- Disesuaikan menggunakan asset() agar konsisten --}}
              <img src="{{ asset('storage/' . $book->gambar_cover) }}" 
                   alt="Sampul {{ $book->judul }}" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @else
              {{-- Gambar cadangan jika tidak ada cover --}}
              <img src="https://placehold.co/340x450/9ca3af/F1EFEC?text=Tanpa+Cover" 
                   alt="Tanpa Cover" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @endif
          </div>
        </div>

      </div>

      {{-- Bagian Sinopsis di Bawah --}}
      <div class="mt-12 pt-8 border-t border-gray-300">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Sinopsis</h3>
        <div class="text-base text-gray-700 leading-relaxed whitespace-pre-line prose max-w-none">
          {{-- Dibungkus <p> agar konsisten dengan contoh --}}
          <p>{{ $book->sipnosis_cerita ?? 'Sinopsis tidak tersedia.' }}</p>
        </div>
      </div>
      
    </div>
  </section>
@endsection