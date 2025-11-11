@extends('layouts.app')
{{-- Mengatur judul halaman --}}
@section('title', 'Atur Ulang Kata Sandi')
@section('content')
  <section id="reset-password" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    {{-- Kartu dibuat max-w-md, serasi dengan Lupa Password --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-md p-10 md:p-14 shadow-lg flex flex-col items-center">

        {{-- Ikon Premium --}}
        <div class="flex justify-center mb-6">
            <div class="bg-[#05284C] rounded-full p-5 shadow-md">
                <i data-lucide="key-round" class="w-10 h-10 text-white"></i>
            </div>
        </div>

        {{-- Judul Premium --}}
        <h2 class="text-3xl font-bold text-[#05284C] mb-6 text-center">Atur Ulang Kata Sandi</h2>

        <form method="POST" action="{{ route('password.store') }}" class="w-full space-y-4">
            @csrf

            {{-- Token (Tersembunyi) --}}
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            {{-- Input Email (Gaya Premium) --}}
            <div>
                <label for="email" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Email') }}</label>
                {{-- Mengganti x-text-input dengan input gaya kustom --}}
                <input id="email" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" 
                       type="email" 
                       name="email" 
                       value="{{ old('email', $request->email) }}" 
                       placeholder="Masukkan email Anda"
                       required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            {{-- Input Password Baru (Gaya Premium) --}}
            <div class->
                <label for="password" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Kata Sandi Baru') }}</label>
                {{-- Mengganti x-text-input dengan input gaya kustom --}}
                <input id="password" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" 
                       type="password" 
                       name="password" 
                       placeholder="Masukkan kata sandi baru Anda"
                       required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Input Konfirmasi Password (Gaya Premium) --}}
            <div>
                <label for="password_confirmation" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Konfirmasi Kata Sandi') }}</label>
                {{-- Mengganti x-text-input dengan input gaya kustom --}}
                <input id="password_confirmation" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg"
                       type="password"
                       name="password_confirmation" 
                       placeholder="Konfirmasi kata sandi baru Anda"
                       required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            {{-- Tombol (Gaya Premium) --}}
            <div class="flex items-center justify-end pt-2">
                {{-- Mengganti x-primary-button dengan tombol gaya kustom --}}
                <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
                    {{ __('Atur Ulang Kata Sandi') }}
                </button>
            </div>
        </form>
    
    </div>
  </section>
@endsection