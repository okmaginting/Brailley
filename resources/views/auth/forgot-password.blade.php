@extends('layouts.app')
{{-- Mengatur judul halaman --}}
@section('title', 'Lupa Password')
@section('content')
  <section id="forgot-password" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    {{-- Kartu dibuat max-w-md, serasi dengan Konfirmasi Password --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-md p-10 md:p-14 shadow-lg flex flex-col items-center">

        {{-- Ikon Premium --}}
        <div class="flex justify-center mb-6">
            <div class="bg-[#05284C] rounded-full p-5 shadow-md">
                <i data-lucide="mail-question" class="w-10 h-10 text-white"></i>
            </div>
        </div>

        {{-- Judul Premium --}}
        <h2 class="text-3xl font-bold text-[#05284C] mb-3 text-center">Lupa Kata Sandi</h2>

        <div class="mb-6 text-sm text-gray-700 text-center">
            {{ __('Lupa password Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link untuk mengatur ulang password.') }}
        </div>

        {{-- Status session (jika link terkirim) --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="w-full">
            @csrf

            {{-- Input Email (Gaya Premium) --}}
            <div>
                <label for="email" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Email') }}</label>
                {{-- Mengganti x-text-input dengan input gaya kustom --}}
                <input id="email" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Masukkan email Anda"
                       required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- Tombol (Gaya Premium) --}}
            <div class="flex justify-end mt-6">
                {{-- Mengganti x-primary-button dengan tombol gaya kustom --}}
                <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
                    {{ __('Kirim Link Reset Password') }}
                </button>
            </div>
        </form>
    </div>
  </section>
@endsection