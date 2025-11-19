@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    {{-- 
       LOGIKA ALPINE.JS UNTUK REGISTER AJAX
       Menangani pengiriman form, validasi error, dan pop-up sukses
    --}}
    <section id="register" 
             class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20"
             x-data="{
                name: '{{ old('name') }}',
                email: '{{ old('email') }}',
                password: '',
                password_confirmation: '',
                isLoading: false,
                showSuccess: false,
                errors: {},
                
                async handleRegister() {
                    this.isLoading = true;
                    this.errors = {}; // Reset error

                    try {
                        // Kirim request AJAX ke route register Laravel
                        const response = await fetch('{{ route('register') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name: this.name,
                                email: this.email,
                                password: this.password,
                                password_confirmation: this.password_confirmation
                            })
                        });

                        // Jika redirect (biasanya Laravel redirect 302 kalau sukses login otomatis)
                        // atau status 201 Created / 200 OK
                        if (response.ok || response.status === 201) {
                            // JIKA SUKSES: Tampilkan Modal
                            this.showSuccess = true;
                            
                            // Tunggu 2 detik, lalu redirect
                            setTimeout(() => {
                                window.location.href = '{{ url('/') }}'; 
                            }, 2000);
                        } else {
                            // JIKA GAGAL: Tangkap error validasi JSON
                            const data = await response.json();
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
        {{-- MODAL REGISTER BERHASIL --}}
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
                
                <h3 class="text-2xl font-extrabold text-[#05284C] mb-2">Pendaftaran Berhasil!</h3>
                <p class="text-gray-600">Membuat akun Anda...</p>
                
                {{-- Loading Bar Kecil --}}
                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-6 overflow-hidden">
                    <div class="bg-green-500 h-1.5 rounded-full animate-[loading_2s_ease-in-out_forwards]" style="width: 0%"></div>
                </div>
            </div>
        </div>

        {{-- ======================= --}}
        {{-- CARD REGISTER --}}
        {{-- ======================= --}}
        <div class="bg-[#F1EFEC] rounded-[40px] shadow-xl w-full max-w-xl p-10 md:p-12 text-center relative">

            {{-- Ikon Daftar --}}
            <div class="flex justify-center mb-6">
                <div class="bg-[#05284C] rounded-full p-5 shadow-md">
                    <i data-lucide="user-plus" class="w-10 h-10 text-white"></i>
                </div>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold text-[#05284C] mb-3">Daftar Akun Baru</h2>
            <p class="text-gray-700 mb-8 text-base md:text-lg">Silakan isi detail Anda untuk mendaftar</p>

            {{-- FORM REGISTER --}}
            <form @submit.prevent="handleRegister" class="space-y-4 text-left">
                
                {{-- BAGIAN NAMA --}}
                <div>
                    <label for="name" class="block text-base font-semibold text-gray-800 mb-1">Nama</label>
                    <input type="text" id="name" x-model="name"
                           required autofocus autocomplete="name"
                           placeholder="Masukkan nama Anda"
                           class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                           :class="errors.name ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                    
                    <p x-show="errors.name" x-text="errors.name ? errors.name[0] : ''" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- BAGIAN EMAIL --}}
                <div>
                    <label for="email" class="block text-base font-semibold text-gray-800 mb-1">Email</label>
                    <input type="email" id="email" x-model="email"
                           required autocomplete="username"
                           placeholder="Masukkan email Anda"
                           class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                           :class="errors.email ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                    
                    <p x-show="errors.email" x-text="errors.email ? errors.email[0] : ''" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- BAGIAN PASSWORD --}}
                <div>
                    <label for="password" class="block text-base font-semibold text-gray-800 mb-1">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password" x-model="password"
                               required autocomplete="new-password"
                               placeholder="Buat kata sandi Anda"
                               class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                               :class="errors.password ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                        
                        <button type="button" id="togglePasswordBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 focus:outline-none">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <p x-show="errors.password" x-text="errors.password ? errors.password[0] : ''" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- BAGIAN KONFIRMASI PASSWORD --}}
                <div>
                    <label for="password_confirmation" class="block text-base font-semibold text-gray-800 mb-1">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" x-model="password_confirmation"
                               required autocomplete="new-password"
                               placeholder="Konfirmasi kata sandi Anda"
                               class="w-full bg-white rounded-2xl py-2.5 px-4 pr-10 text-black text-base font-medium placeholder-gray-400 focus:outline-none border transition-all shadow-md focus:shadow-lg"
                               :class="errors.password_confirmation ? 'border-red-500 focus:border-red-500' : 'border-gray-200 focus:border-gray-400'">
                        
                        <button type="button" id="togglePasswordConfirmBtn" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 focus:outline-none">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                     <p x-show="errors.password_confirmation" x-text="errors.password_confirmation ? errors.password_confirmation[0] : ''" class="text-sm text-red-600 mt-1" style="display: none;"></p>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <button type="submit" 
                        :disabled="isLoading"
                        class="w-full bg-[#05284C] text-white rounded-2xl py-3 mt-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                    
                    <span x-show="!isLoading">Daftar</span>
                    
                    <span x-show="isLoading" style="display: none;" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </form>

            <p class="text-sm text-gray-700 mt-8">
                Sudah punya akun?
                <a href="{{ route('login') }}" wire:navigate class="text-[#05284C] font-semibold hover:underline">
                    Masuk
                </a>
            </p>
        </div>
    </section>

    {{-- Style Custom Keyframe untuk Loading Bar Modal --}}
    <style>
        @keyframes loading {
            0% { width: 0%; }
            100% { width: 100%; }
        }
    </style>
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
                const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', type);
                
                // Ganti ikon mata (Eye / Eye-Off)
                if(type === 'text') {
                    this.innerHTML = '<i data-lucide="eye-off" class="w-5 h-5"></i>';
                } else {
                    this.innerHTML = '<i data-lucide="eye" class="w-5 h-5"></i>';
                }
                if(typeof lucide !== 'undefined') lucide.createIcons();
            });
        }
    }

    // Terapkan ke kedua pasang input/tombol
    setupPasswordToggle('togglePasswordBtn', 'password');
    setupPasswordToggle('togglePasswordConfirmBtn', 'password_confirmation');
  });
</script>
@endpush