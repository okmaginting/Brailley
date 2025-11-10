@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $story->judul)

@section('content')
  <section id="karya-detail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- 
        PERBAIKAN TATA LETAK:
        - 'flex-col-reverse' -> Gambar di atas di (Mobile)
        - 'md:flex-row' -> Teks di kiri, Gambar di kanan (Desktop)
        - 'justify-center' -> MEMPUSATKAN kedua kolom di desktop.
        - 'items-start' -> Mencegah kolom meregang secara vertikal.
      --}}
      <div class="flex flex-col-reverse md:flex-row items-start justify-center gap-10 md:gap-16">

        {{-- ================================== --}}
        {{-- KOLOM KIRI (Desktop) / BAWAH (Mobile) --}}
        {{-- ================================== --}}
        {{-- Lebar kolom teks diatur agar nyaman dibaca --}}
        <div class="w-full md:max-w-prose">
          
          {{-- Judul Utama --}}
          <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
            {{ $story->judul }}
          </h2>

          {{-- Tombol-Tombol Aksi --}}
          <div class="flex flex-wrap gap-4 mt-6">
            
            {{-- Tombol Baca (Aksi Primer) --}}
            <a href="/ceritakomunitas/{{ $story->id }}/baca" class="flex items-center gap-2 bg-[#05284C] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-md">
              <i data-lucide="book-open" class="w-5 h-5"></i>
              Baca Cerita
            </a>
            
            {{-- Tombol Download .BRF --}}
            @if ($story->braille_file)
              <a href="{{ route('file.download', ['id' => $story->id, 'type' => 'brf']) }}" 
                 download 
                 class="flex items-center gap-2 border border-[#05284C] text-[#05284C] px-6 py-2.5 rounded-lg font-semibold hover:bg-[#05284C] hover:text-white transition-all">
                <i data-lucide="download" class="w-5 h-5"></i>
                Download .BRF
              </a>
            @endif

            {{-- Tombol Download .ZIP --}}
            @if ($story->braille_mirrored_image)
              <a href="{{ route('file.download', ['id' => $story->id, 'type' => 'zip']) }}" 
                 download 
                 class="flex items-center gap-2 border border-[#05284C] text-[#05284C] px-6 py-2.5 rounded-lg font-semibold hover:bg-[#05284C] hover:text-white transition-all">
                <i data-lucide="file-archive" class="w-5 h-5"></i>
                Download .ZIP
              </a>
            @endif
          </div>
          
          {{-- Metadata Cerita --}}
          <div class="mt-8 pt-6 border-t border-gray-300">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Cerita</h3>
            <div class="space-y-3 text-base text-gray-700">
              <p><span class="font-semibold w-28 inline-block">Genre</span>: {{ $story->genre }}</p>
              <p><span class="font-semibold w-28 inline-block">Penulis</span>: {{ $story->penulis }}</p>
              <p><span class="font-semibold w-28 inline-block">Uploader</span>: {{ $story->user->name ?? 'N/A' }}</p>
            </div>
          </div>

        </div>

        {{-- =================================== --}}
        {{-- KOLOM KANAN (Desktop) / ATAS (Mobile) --}}
        {{-- =================================== --}}
        {{-- 
          PERBAIKAN: 
          - 'flex-shrink-0' dijaga agar tidak menyusut.
          - 'justify-center' ditambahkan untuk mobile.
          - 'w-full md:w-auto' -> Responsif
        --}}
        <div class="flex-shrink-0 flex justify-center w-full md:w-auto">
          {{-- Wrapper untuk ukuran konstan --}}
          <div class="w-full max-w-[340px] md:w-[340px] flex-shrink-0">
            @if ($story->gambar_cerita)
              <img src="{{ asset('storage/' . $story->gambar_cerita) }}" 
                   alt="Sampul {{ $story->judul }}" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @else
              {{-- Gambar cadangan jika tidak ada cover --}}
              <img src="https://placehold.co/340x450/9ca3af/F1EFEC?text=Tanpa+Cover" 
                   alt="Tanpa Cover" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @endif
          </div>
        </div>

      </div> {{-- Akhir dari Flexbox 2 Kolom --}}


      {{-- ================================== --}}
      {{-- BAGIAN SINOPSIS (TERPISAH) --}}
      {{-- ================================== --}}
      <div class="mt-12 pt-8 border-t border-gray-300">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Sinopsis</h3>
        <div class="text-base text-gray-700 leading-relaxed whitespace-pre-line prose max-w-none">
          {{-- 'whitespace-pre-line' menjaga baris baru dari sinopsis --}}
          {{-- 'prose' untuk styling teks otomatis, 'max-w-none' membatalkan batasan lebar prose --}}
          <p>{{ $story->sipnosis ?? 'Sinopsis tidak tersedia.' }}</p>
        </div>
      </div>
      
    </div>
  </section>
@endsection