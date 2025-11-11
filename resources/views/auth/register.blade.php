@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Daftar')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="register" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
<div class="bg-[#F1EFEC] rounded-[40px] shadow-xl w-full max-w-xl p-10 md:p-12 text-center">

    {{-- Ikon Daftar --}}
    <div class="flex justify-center mb-6">
        <div class="bg-[#05284C] rounded-full p-5 shadow-md">
            <i data-lucide="user-plus" class="w-10 h-10 text-white"></i>
        </div>
    </div>

    <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-3">Daftar Akun Baru</h2>
    <p class="text-gray-700 mb-8 text-base md:text-lg">Silakan isi detail Anda untuk mendaftar</p>

    {{-- Form diupdate dengan method="POST" dan action="{{ route('register') }}" --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-4 text-left">
        @csrf

        {{-- BAGIAN NAMA --}}
        <div>
            <label for="name" class="block text-base font-semibold text-gray-800 mb-1">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   placeholder="Masukkan nama Anda"
                   class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        {{-- BAGIAN EMAIL --}}
        <div>
            <label for="email" class="block text-base font-semibold text-gray-800 mb-1">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   placeholder="Masukkan email Anda"
                   class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- BAGIAN PASSWORD --}}
        <div>
            <label for="password" class="block text-base font-semibold text-gray-800 mb-1">Kata Sandi</label>
            <div class="relative">
                <input type="password" id="password" name="password" required autocomplete="new-password"
                       placeholder="Buat kata sandi Anda"
                       class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                {{-- Ikon toggle password --}}
                <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        {{-- BAGIAN KONFIRMASI PASSWORD --}}
        <div>
            <label for="password_confirmation" class="block text-base font-semibold text-gray-800 mb-1">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                       placeholder="Konfirmasi kata sandi Anda"
                       class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                {{-- Ikon toggle konfirmasi password --}}
                <svg id="togglePasswordConfirm" xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 mt-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
            Daftar
        </button>
    </form>

    <p class="text-sm text-gray-700 mt-8">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-[#05284C] font-semibold hover:underline">
            Masuk
        </a>
    </p>
</div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Fungsi pembantu untuk toggle password
        function setupPasswordToggle(toggleId, inputId) {
            const toggleButton = document.getElementById(toggleId);
            const inputField = document.getElementById(inputId);

            if (toggleButton && inputField) {
                toggleButton.addEventListener('click', function () {
                    // Toggle tipe atribut
                    const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                    inputField.setAttribute('type', type);
                    
                    // Opsional: ganti ikon (saat ini tidak diimplementasikan)
                    // this.classList.toggle('text-blue-500'); 
                });
            }
        }

        // Terapkan ke kedua pasang input/tombol
        setupPasswordToggle('togglePassword', 'password');
        setupPasswordToggle('togglePasswordConfirm', 'password_confirmation');
    });
</script>
@endpush