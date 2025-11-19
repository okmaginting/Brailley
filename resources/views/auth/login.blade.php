@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    {{-- 
        LOGIKA ALPINE.JS UNTUK LOGIN AJAX
    --}}
    <section id="login" 
             class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20"
             x-data="{
                email: '{{ old('email') }}',
                password: '',
                remember: false,
                isLoading: false,
                showSuccess: false,
                errors: {},
                
                async handleLogin() {
                    this.isLoading = true;
                    this.errors = {}; 

                    const formData = new FormData();
                    formData.append('email', this.email);
                    formData.append('password', this.password);
                    formData.append('remember', this.remember ? 'on' : '');
                    formData.append('_token', '{{ csrf_token() }}');

                    try {
                        const response = await fetch('{{ route('login') }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                            },
                            body: formData
                        });

                        // Coba baca respons JSON (gunakan .catch untuk handle response yang tidak valid/kosong)
                        const data = await response.json().catch(() => ({}));

                        if (response.status === 200) {
                            // SUKSES
                            const redirectPath = data.redirect || '{{ url('/') }}'; 

                            this.showSuccess = true;
                            
                            setTimeout(() => {
                                window.location.href = redirectPath; 
                            }, 2000);
                        } else {
                            // GAGAL/VALIDASI
                            this.errors = data.errors || {};
                            this.isLoading = false;
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        this.isLoading = false;
                    }
                }
             }">

        {{-- ======================= --}}
        {{-- MODAL LOGIN BERHASIL --}}
        {{-- ======================= --}}
        <div x-show="showSuccess"
             class="fixed inset-0 z-[100] flex items-center justify-center px-4 py-6 sm:px-0"
             x-cloak style="display: none;">
            
            {{-- Overlay Gelap --}}
            <div x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

            {{-- Konten Modal --}}
            <div x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 class="relative bg-white rounded-[30px] p-8 shadow-2xl transform transition-all sm:max-w-sm w-full flex flex-col items-center text-center">
                
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6 animate-bounce">
                    <i data-lucide="check-circle-2" class="w-12 h-12 text-green-600"></i>
                </div>
                
                <h3 class="text-2xl font-extrabold text-[#05284C] mb-2">Login Berhasil!</h3>
                <p class="text-gray-600">Mengalihkan ke beranda...</p>
                
                {{-- Loading Bar Kecil --}}
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-6 overflow-hidden">
                    <div class="bg-green-500 h-1.5 rounded-full animate-[loading_2s_ease-in-out_forwards]" style="width: 0%"></div>
                </div>
            </div>
        </div>

        {{-- ======================= --}}
        {{-- CARD LOGIN --}}
        {{-- ======================= --}}
        <div class="bg-[#F1EFEC] rounded-[40px] shadow-xl w-full max-w-xl p-10 md:p-12 text-center relative">

            <div class="flex justify-center mb-6">
                <div class="bg-[#05284C] rounded-full p-5 shadow-md">
                    <i data-lucide="log-in" class="w-10 h-10 text-white"></i>
                </div>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-3">Masuk</h2>
            <p class="text-gray-700 mb-8 text-base md:text-lg">Silakan masuk ke akun Anda</p>

            {{-- FORM LOGIN --}}
            <form @submit.prevent="handleLogin" class="space-y-4 text-left">
                
                {{-- EMAIL --}}
                <div>
                    <label for="email" class="block text-base font-semibold text-gray-800 mb-1">Email</label>
                    <div class="relative">
                        <input type="email" id="email" x-model="email"
                               required autofocus autocomplete="username"
                               placeholder="Masukkan email Anda"
                               class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                               :class="errors.email ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                    </div>
                    {{-- PERBAIKAN: Menggunakan errors.email?.join(' ') untuk mencegah error akses [0] --}}
                    <p x-show="errors.email" x-text="errors.email?.join(' ')" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label for="password" class="block text-base font-semibold text-gray-800 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" x-model="password"
                               required autocomplete="current-password"
                               placeholder="Masukkan kata sandi Anda"
                               class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                               :class="errors.password ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                        
                        {{-- Ikon Toggle Password --}}
                        <button type="button" id="togglePasswordBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 focus:outline-none">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    {{-- PERBAIKAN: Menggunakan errors.password?.join(' ') --}}
                    <p x-show="errors.password" x-text="errors.password?.join(' ')" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- INGAT SAYA & LUPA KATA SANDI --}}
                <div class="flex items-center justify-between text-sm pt-2">
                    <label for="remember_me" class="flex items-center gap-2 text-gray-700 cursor-pointer">
                        <input type="checkbox" x-model="remember" class="h-4 w-4 border-gray-300 rounded text-[#05284C] focus:ring-[#05284C]">
                        Ingat saya
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" wire:navigate class="text-[#05284C] font-semibold hover:underline">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                {{-- TOMBOL SUBMIT DENGAN LOADING STATE --}}
                <button type="submit" 
                        :disabled="isLoading"
                        class="w-full bg-[#05284C] text-white rounded-2xl py-3 mt-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                    
                    {{-- Teks Normal --}}
                    <span x-show="!isLoading">Masuk</span>
                    
                    {{-- Spinner Loading --}}
                    <span x-show="isLoading" style="display: none;" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>

            <p class="text-sm text-gray-700 mt-8 text-center">
                Belum punya akun?
                <a href="{{ route('register') }}" wire:navigate class="text-[#05284C] font-semibold hover:underline">
                    Daftar
                </a>
            </p>
        </div>
    </section>

    <style>
        @keyframes loading {
            0% { width: 0%; }
            100% { width: 100%; }
        }
    </style>
@endsection

@push('scripts')
<script>
// Script Toggle Password (Disesuaikan dengan struktur baru)
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    
    // Pastikan Lucide icons ter-render ulang jika perlu
    if(typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Ganti ikon mata (Eye / Eye-Off)
            const icon = this.querySelector('i'); // Ambil tag <i> lucide didalam tombol
            if(type === 'text') {
                this.innerHTML = '<i data-lucide="eye-off" class="w-5 h-5"></i>';
            } else {
                this.innerHTML = '<i data-lucide="eye" class="w-5 h-5"></i>';
            }
            if(typeof lucide !== 'undefined') lucide.createIcons();
        });
    }
});
</script>
@endpush