@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Masuk')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    {{-- Padding atas disamakan (pt-180), lebar form dibuat max-w-xl agar rapi --}}
    <section id="login" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
        <div class="bg-[#F1EFEC] rounded-[40px] shadow-xl w-full max-w-xl p-10 md:p-12 text-center">

            {{-- Ikon Login --}}
            <div class="flex justify-center mb-6">
                <div class="bg-[#05284C] rounded-full p-5 shadow-md">
                    <i data-lucide="log-in" class="w-10 h-10 text-white"></i>
                </div>
            </div>

            {{-- Menampilkan status sesi (mis. 'Link reset password terkirim') --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-3">Masuk</h2>
            <p class="text-gray-700 mb-8 text-base md:text-lg">Silakan masuk ke akun Anda</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4 text-left">
                @csrf

                {{-- BAGIAN EMAIL --}}
                <div>
                    <label for="email" class="block text-base font-semibold text-gray-800 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               required autofocus
                               autocomplete="username"
                               placeholder="Masukkan email Anda"
                               {{-- Input style disamakan dengan profile/edit --}}
                               class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- BAGIAN PASSWORD --}}
                <div>
                    <label for="password" class="block text-base font-semibold text-gray-800 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                               required
                               autocomplete="current-password"
                               placeholder="Masukkan kata sandi Anda"
                               {{-- Input style disamakan, pr-10 untuk ruang ikon --}}
                               class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                        
                        {{-- Ikon toggle password, diposisikan di tengah vertikal --}}
                        <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- BAGIAN INGAT SAYA & LUPA KATA SANDI --}}
                <div class="flex items-center justify-between text-sm pt-2">
                    <label for="remember_me" class="flex items-center gap-2 text-gray-700">
                        <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 border-gray-300 rounded text-[#05284C] focus:ring-[#05284C]">
                        Ingat saya
                    </Dlabel>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[#05284C] font-semibold hover:underline">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                {{-- Tombol Submit --}}
                <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 mt-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
                    Masuk
                </button>
            </form>

            <p class="text-sm text-gray-700 mt-8 text-center">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[#05284C] font-semibold hover:underline">
                    Daftar
                </a>
            </p>
        </div>
    </section>
@endsection

@push('scripts')
<script>
  // Skrip sederhana untuk toggle password visibility
  document.addEventListener('DOMContentLoaded', function () {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    if (togglePassword && password) {
      togglePassword.addEventListener('click', function (e) {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Opsional: Anda bisa menambahkan logika untuk mengubah ikon mata
        // (Misalnya, mengubah 'data-lucide' atau mengganti path SVG)
      });
    }
  });
</script>
@endpush