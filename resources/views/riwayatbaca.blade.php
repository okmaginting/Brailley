@extends('layouts.app')

@section('title', 'Riwayat Baca')

@section('content')
  <section id="riwayatbaca" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- Header: Judul dan Search Bar --}}
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
        <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Riwayat Baca</h2>
        
        {{-- Search Bar Fungsional --}}
        <form action="{{ route('history.index') }}" method="GET" class="relative w-full md:w-80">
          <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
          <input 
            type="text"
            name="search" 
            placeholder="Cari riwayat..." 
            class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all"
            value="{{ request('search') }}"
          >
        </form>
      </div>

      {{-- Grid Riwayat Baca (Dinamis) --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        @forelse ($historyItems as $item)
          {{-- Lewati jika item aslinya (buku/cerita) telah dihapus --}}
          @if (!$item->readable)
            @continue
          @endif

          <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            {{-- Judul & Info Terakhir Dibaca --}}
            <div class="mb-4"> 
              <h3 class="font-bold text-lg text-gray-900 truncate" title="{{ $item->title }}">
                {{ $item->title }}
              </h3>
              <p class="text-xs text-gray-500 mt-1 flex items-center">
                <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                {{ $item->updated_at->diffForHumans() }}
              </p>
            </div>

            {{-- Gambar Sampul (Rasio 3:4) --}}
            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
               <img src="{{ $item->cover_image_url }}" 
                    alt="Sampul {{ $item->title }}" 
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-auto"> 
              <a href="{{ $item->read_url }}" 
                 @if($item->readable_type === 'App\Models\OfficialBook') target="_blank" @endif
                 class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                  Lanjutkan Membaca
              </a>
            </div>
          </div>
        
        {{-- Tampil jika tidak ada riwayat --}}
        @empty
          <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12">
            <i data-lucide="book-open-check" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-700">Riwayat Baca Kosong</h3>
            <p class="text-gray-500 mt-1">
              @if (request('search'))
                Riwayat dengan judul "{{ request('search') }}" tidak ditemukan.
              @else
                Anda belum membaca cerita apapun. Mulailah menjelajah!
              @endif
            </p>
          </div>
        @endforelse

      </div> {{-- Akhir Grid --}}

      {{-- Link Pagination --}}
      <div class="mt-12">
        {{ $historyItems->links() }}
      </div>

    </div>
  </section>
@endsection