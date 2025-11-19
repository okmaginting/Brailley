@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Bagikan Karya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')

  {{-- ======================= --}}
  {{-- MODAL POP-UP SUKSES --}}
  {{-- ======================= --}}
  @if (session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 5000)" {{-- Sembunyikan setelah 5 detik --}}
         class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
         x-cloak style="display: none;">

      {{-- Overlay Gelap dengan Blur --}}
      <div x-show="show" 
           x-transition:enter="ease-out duration-300"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="ease-in duration-200"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" 
           x-on:click="show = false"></div>

      {{-- Konten Modal --}}
      <div x-show="show"
           x-transition:enter="ease-out duration-300"
           x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
           x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave="ease-in duration-200"
           x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
           x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
           class="relative bg-white rounded-[30px] px-8 pt-8 pb-8 overflow-hidden shadow-2xl transform transition-all sm:max-w-sm w-full flex flex-col items-center text-center">
        
        {{-- Ikon Sukses Besar --}}
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
        
        {{-- Tombol Oke --}}
        <div class="w-full">
            <button type="button" 
                    x-on:click="show = false"
                    class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-2xl text-white bg-[#05284C] hover:bg-[#073b6e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#05284C] transition-all duration-200 shadow-md hover:shadow-lg">
                Oke, Mengerti
            </button>
        </div>
      </div>
    </div>
  @endif

  {{-- ======================= --}}
  {{-- KONTEN UTAMA HALAMAN --}}
  {{-- ======================= --}}
  <section id="bagikankarya" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-5xl p-16 text-center shadow-lg">
      <h2 class="text-4xl font-extrabold text-[#05284C] mb-6">Bagikan Karya</h2>

      {{-- Logika Kondisional: Cek apakah user sudah login --}}
      
      @auth
        {{-- JIKA SUDAH LOGIN, TAMPILKAN INI --}}
        <p class="text-2xl text-gray-700 font-medium mb-10 leading-relaxed">
          “Karya kecilmu bisa jadi inspirasi besar bagi orang lain.”
        </p>
        <div class="flex justify-center gap-6">
          {{-- Menambahkan wire:navigate --}}
          <a href="{{ route('karya.create') }}" 
             class="bg-[#05284C] text-white px-8 py-4 rounded-2xl text-lg font-bold hover:bg-[#073b6e] transition-all shadow-md hover:shadow-xl flex items-center gap-3">
            <i data-lucide="pen-tool" class="w-6 h-6"></i>
            Mulai Bagikan Karya
          </a>
        </div>
      @endauth

      @guest
        {{-- JIKA BELUM LOGIN (GUEST), TAMPILKAN INI --}}
        <p class="text-2xl text-gray-700 font-medium mb-10 leading-relaxed">
          "Login atau mendaftar menjadi pengguna untuk membagikan karyamu"
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
          {{-- Tombol Login --}}
          <a href="{{ route('login') }}" 
             wire:navigate
             class="bg-[#05284C] text-white px-8 py-4 rounded-2xl text-lg font-bold hover:bg-[#073b6e] transition-all shadow-md hover:shadow-xl flex items-center justify-center gap-3">
            <i data-lucide="log-in" class="w-6 h-6"></i>
            Login
          </a>
          {{-- Tombol Register --}}
          <a href="{{ route('register') }}" 
             wire:navigate
             class="bg-gray-600 text-white px-8 py-4 rounded-2xl text-lg font-bold hover:bg-gray-700 transition-all shadow-md hover:shadow-xl flex items-center justify-center gap-3">
            <i data-lucide="user-plus" class="w-6 h-6"></i>
            Register
          </a>
        </div>
      @endguest

    </div>
  </section>
@endsection