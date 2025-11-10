@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Karya Saya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')

    {{-- 
      WRAPPER UTAMA ALPINE.JS
      Digunakan untuk mengontrol state modal konfirmasi hapus dari mana saja.
    --}}
    <div x-data="{ openDeleteModal: false, deleteUrl: '' }">

        {{-- ======================= --}}
        {{-- MODAL POP-UP SUKSES --}}
        {{-- ======================= --}}
        @if (session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = true, 100)"
                 class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
                 style="display: none;">

                {{-- Overlay Gelap --}}
                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                     @click="show = false"></div>

                {{-- Konten Modal --}}
                <div x-show="show"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="relative bg-white rounded-[30px] px-8 pt-8 pb-8 overflow-hidden shadow-2xl transform transition-all sm:max-w-sm w-full flex flex-col items-center text-center">

                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                        <i data-lucide="check-circle-2" class="w-12 h-12 text-green-600"></i>
                    </div>

                    <h3 class="text-2xl font-extrabold text-[#05284C] mb-3">
                        Berhasil!
                    </h3>

                    <div class="mt-2 mb-8">
                        <p class="text-base text-gray-600 leading-relaxed">
                            {{ session('success') }}
                        </p>
                    </div>

                    <div class="w-full">
                        <button type="button"
                                @click="show = false"
                                class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-2xl text-white bg-[#05284C] hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#05284C] transition-all duration-200 shadow-md hover:shadow-lg">
                            Oke, Mengerti
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- ======================= --}}
        {{-- KONTEN UTAMA --}}
        {{-- ======================= --}}
        <section id="karyasaya" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
            <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">

                {{-- Header: Judul dan Search Bar --}}
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-6 md:mb-0">Karya Saya</h2>
                    <form action="{{ route('karya.mine') }}" method="GET" class="relative w-full md:w-80">
                        <i data-lucide="search" class="w-5 h-5 text-gray-400 absolute top-1/2 left-4 -translate-y-1/2 z-10"></i>
                        <input type="text" name="search" placeholder="Cari karya saya..." class="w-full text-base text-gray-900 outline-none bg-white rounded-full py-3 pl-12 pr-4 shadow-sm border border-transparent focus:border-gray-300 focus:ring-1 focus:ring-gray-300 transition-all" value="{{ request('search') }}">
                    </form>
                </div>

                {{-- Grid Karya Saya (Dinamis) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                    @forelse ($stories as $story)
                        <div class="bg-white rounded-2xl shadow-xl p-5 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <div class="mb-4">
                                <h3 class="font-bold text-lg text-gray-900 truncate" title="{{ $story->judul }}">
                                    {{ $story->judul }}
                                </h3>
                                <p class="text-sm text-gray-600">{{ $story->penulis }}</p>

                                {{-- Badge Status Dinamis --}}
                                <span class="mt-2 inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    @switch($story->status)
                                        @case(\App\Enums\CommunityStoryStatus::Pengecekan) bg-gray-200 text-gray-800 @break
                                        @case(\App\Enums\CommunityStoryStatus::Ditolak) bg-red-200 text-red-800 @break
                                        @case(\App\Enums\CommunityStoryStatus::Proses) bg-yellow-200 text-yellow-800 @break
                                        @case(\App\Enums\CommunityStoryStatus::Dipublish) bg-green-200 text-green-800 @break
                                        @case(\App\Enums\CommunityStoryStatus::RequestHapus) bg-red-300 text-red-900 @break
                                        @default bg-blue-200 text-blue-800
                                    @endswitch
                                ">
                                    {{ $story->status->getLabel() }}
                                </span>
                            </div>

                            <div class="relative w-full aspect-[3/4] bg-gray-200 rounded-lg overflow-hidden mb-4">
                                @if ($story->gambar_cerita)
                                    <img src="{{ asset('storage/' . $story->gambar_cerita) }}"
                                         alt="Sampul {{ $story->judul }}"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <img src="https://placehold.co/300x400/9ca3af/F1EFEC?text=Tanpa+Cover"
                                         alt="Tanpa Cover"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @endif
                            </div>

                            <div class="mt-auto space-y-2">
                                {{-- Link ke halaman detail (hanya jika sudah dipublish) --}}
                                @if($story->status == \App\Enums\CommunityStoryStatus::Dipublish)
                                    <a href="{{ route('karya.show', $story->id) }}" class="block w-full bg-[#05284C] text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-opacity-90 transition-all duration-300">
                                        Lihat Detail Publik
                                    </a>
                                @else
                                    <span class="block w-full bg-gray-300 text-gray-600 text-center rounded-lg py-2.5 px-4 font-semibold text-sm cursor-not-allowed">
                                        Belum Dipublish
                                    </span>
                                @endif

                                {{-- TOMBOL MINTA HAPUS (MEMICU MODAL) --}}
                                @if(!in_array($story->status, [\App\Enums\CommunityStoryStatus::Pengecekan, \App\Enums\CommunityStoryStatus::RequestHapus]))
                                    {{-- 
                                      PERUBAHAN PENTING:
                                      Tombol ini sekarang tidak langsung submit form.
                                      Ia mengisi 'deleteUrl' dengan route yang sesuai untuk cerita INI,
                                      lalu membuka modal konfirmasi.
                                    --}}
                                    <button type="button"
                                            @click="openDeleteModal = true; deleteUrl = '{{ route('karya.requestDelete', $story->id) }}'"
                                            class="block w-full bg-red-600 text-white text-center rounded-lg py-2.5 px-4 font-semibold text-sm hover:bg-red-700 transition-all duration-300">
                                        Minta Hapus
                                    </button>
                                @endif
                            </div>
                        </div>

                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12">
                            <i data-lucide="book-off" class="w-16 h-16 mx-auto text-gray-400 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700">Anda Belum Memiliki Karya</h3>
                            <p class="text-gray-500 mt-1">
                                @if (request('search'))
                                    Karya dengan judul "{{ request('search') }}" tidak ditemukan.
                                @else
                                    <a href="{{ route('karya.create') }}" class="text-[#05284C] hover:underline font-semibold">Bagikan karya pertama Anda!</a>
                                @endif
                            </p>
                        </div>
                    @endforelse

                </div> {{-- Akhir dari .grid --}}

                {{-- Link Pagination --}}
                <div class="mt-12">
                    {{ $stories->links() }}
                </div>

            </div>
        </section>

        {{-- ======================= --}}
        {{-- MODAL KONFIRMASI HAPUS --}}
        {{-- ======================= --}}
        <div x-show="openDeleteModal"
             class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
             x-cloak style="display: none;"> {{-- x-cloak mencegah kedipan --}}

            {{-- Overlay --}}
            <div x-show="openDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                 @click="openDeleteModal = false"></div>

            {{-- Konten Modal --}}
            <div x-show="openDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-white rounded-[30px] p-8 overflow-hidden shadow-2xl transform transition-all sm:max-w-md w-full text-center">

                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <i data-lucide="alert-triangle" class="w-8 h-8 text-red-600"></i>
                </div>

                <h3 class="text-2xl font-bold text-gray-900 mb-4">Ajukan Penghapusan?</h3>
                <p class="text-gray-600 mb-8">
                    Apakah Anda yakin ingin mengajukan penghapusan untuk karya ini? Tindakan ini akan mengirim permintaan ke admin.
                </p>

                {{-- Form dengan action dinamis --}}
                <form :action="deleteUrl" method="POST" class="flex gap-4">
                    @csrf
                    <button type="button"
                            @click="openDeleteModal = false"
                            class="flex-1 py-3 px-4 bg-gray-200 text-gray-800 rounded-xl font-semibold hover:bg-gray-300 transition-all">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 py-3 px-4 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-all shadow-md">
                        Ya, Ajukan
                    </button>
                </form>
            </div>
        </div>

    </div> {{-- Akhir Wrapper Alpine.js --}}

@endsection