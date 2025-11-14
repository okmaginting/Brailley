@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', $audiobook->judul)

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="audiobookdetail" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Wrapper Konten Atas --}}
      <div class="flex flex-col-reverse md:flex-row items-start justify-center gap-10 md:gap-16">
        
        {{-- Kolom Teks (Dinamis) --}}
        <div class="w-full md:max-w-prose">
          
          {{-- Judul Utama --}}
          <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
            {{ $audiobook->judul }}
          </h2>

          {{-- Tombol-Tombol Aksi (Dinamis) --}}
          <div class="flex flex-wrap gap-4 mt-6">
            
            {{-- Tombol Dengarkan (Aksi Primer) --}}
            <a href="{{ route('audiobook.listen', $audiobook->id) }}" 
               class="flex items-center gap-2 bg-[#05284C] text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-opacity-90 transition-all shadow-md">
              <i data-lucide="headphones" class="w-5 h-5"></i>
              Dengarkan
            </a>
            
            {{-- Tombol Download Audio (Sekunder) --}}
            <a href="{{ route('audiobook.download', $audiobook->id) }}" 
               class="flex items-center gap-2 border border-[#05284C] text-[#05284C] px-6 py-2.5 rounded-lg font-semibold hover:bg-[#05284C] hover:text-white transition-all">
              <i data-lucide="download" class="w-5 h-5"></i>
              Download Audio
            </a>
          </div>
          
          {{-- Metadata Audiobook (Dinamis) --}}
          <div class="mt-8 pt-6 border-t border-gray-300">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Buku</h3>
            <div class="space-y-3 text-base text-gray-700">
              <p><span class="font-semibold w-28 inline-block">Penulis</span>: {{ $audiobook->penulis }}</p>
              <p><span class="font-semibold w-28 inline-block">Narator</span>: {{ $audiobook->pengisi_audio }}</p>
            </div>
          </div>

        </div>

        {{-- Kolom Gambar Sampul (Dinamis) --}}
        <div class="flex-shrink-0 flex justify-center w-full md:w-auto">
          <div class="w-full max-w-[340px] md:w-[340px] flex-shrink-0">
            @if ($audiobook->gambar_cover)
              {{-- Menggunakan asset() untuk konsistensi --}}
              <img src="{{ asset('storage/' . $audiobook->gambar_cover) }}" 
                   alt="Sampul {{ $audiobook->judul }}" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @else
              <img src="https://placehold.co/340x450/9ca3af/F1EFEC?text=Tanpa+Cover" 
                   alt="Tanpa Cover" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @endif
          </div>
        </div>

      </div>
      
      {{-- Bagian Sinopsis yang saya tambahkan sebelumnya telah dihapus --}}

    </div>
  </section>
@endsection