@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Konfirmasi Kata Sandi')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="confirm-password" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    {{-- Kartu dibuat lebih kecil (max-w-md) karena kontennya sedikit --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-md p-10 md:p-14 shadow-lg flex flex-col items-center">

      {{-- Ikon Premium --}}
      <div class="flex justify-center mb-6">
        <div class="bg-[#05284C] rounded-full p-5 shadow-md">
          <i data-lucide="shield-check" class="w-10 h-10 text-white"></i>
        </div>
      </div>

      {{-- Judul Premium --}}
      <h2 class="text-3xl font-bold text-[#05284C] mb-3 text-center">Konfirmasi Kata Sandi</h2>

      <div class="mb-6 text-sm text-gray-700 text-center">
        {{ __('Ini adalah area aman aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.') }}
      </div>

      <form method="POST" action="{{ route('password.confirm') }}" class="w-full">
        @csrf

        {{-- Input Password (Gaya Premium) --}}
        <div>
          <label for="password" class="block text-base font-semibold text-gray-800 mb-1">Kata Sandi</label>
          {{-- Mengganti x-text-input dengan input gaya kustom --}}
          <input id="password" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg"
                 type="password"
                 name="password"
                 placeholder="Masukkan kata sandi Anda"
                 required autocomplete="current-password" autofocus />
          <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- Tombol (Gaya Premium) --}}
        <div class="flex justify-end mt-6">
          {{-- Mengganti x-primary-button dengan tombol gaya kustom --}}
          <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
            {{ __('Konfirmasi') }}
          </button>
        </div>
      </form>
    
    </div>
  </section>
@endsection