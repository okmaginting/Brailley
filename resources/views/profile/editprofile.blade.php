@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Edit Profil')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')

    {{-- Form tersembunyi untuk verifikasi email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <main class="flex flex-1 justify-center items-start pt-[180px] px-6 md:px-10 pb-20">

        <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-4xl p-8 md:p-16 shadow-xl relative overflow-hidden">
            
            {{-- Dekorasi Latar Belakang Halus --}}
            <div class="absolute top-0 left-0 w-full h-2 bg-[#05284C]"></div>

            {{-- ======================= --}}
            {{-- HEADER PROFIL --}}
            {{-- ======================= --}}
            <div class="flex flex-col items-center text-center mb-12">
                <div class="relative group">
                    {{-- Avatar --}}
                    <div class="w-24 h-24 rounded-full bg-[#05284C] flex items-center justify-center text-white text-4xl font-bold shadow-lg mb-4 border-4 border-white">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    {{-- Badge Status (Asumsi Verifikasi) --}}
                    <div class="absolute bottom-4 right-0 bg-white rounded-full p-1.5 shadow-md border border-gray-100">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500"></i>
                    </div>
                </div>

                <h2 class="text-3xl font-extrabold text-[#05284C]">{{ $user->name }}</h2>
                <p class="text-gray-500">{{ $user->email }}</p>

                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-5 py-2 rounded-full bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 transition-all font-semibold text-sm">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        Keluar Sesi
                    </button>
                </form>
            </div>

            <hr class="border-gray-300 mb-10">

            {{-- ======================= --}}
            {{-- BAGIAN 1: INFO PROFIL --}}
            {{-- ======================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                {{-- Deskripsi Bagian --}}
                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold text-[#05284C] mb-2">Informasi Profil</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Perbarui informasi profil akun dan alamat email Anda.
                    </p>
                </div>

                {{-- Form --}}
                <div class="lg:col-span-2">
                    <form method="post" action="{{ route('profile.update') }}" class="flex flex-col gap-6">
                        @csrf
                        @method('patch')

                        {{-- Nama --}}
                        <div>
                            <label for="name" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i data-lucide="user" class="w-4 h-4 text-[#05284C]"></i> Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i data-lucide="mail" class="w-4 h-4 text-[#05284C]"></i> Alamat Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-3 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                                    <p class="text-sm text-yellow-800">
                                        Email Anda belum diverifikasi.
                                        <button form="send-verification" class="underline font-bold hover:text-yellow-900">
                                            Kirim ulang verifikasi.
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            Tautan verifikasi baru telah dikirim.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-[#05284C] text-white px-6 py-2.5 rounded-xl font-bold hover:bg-[#073b6e] transition-all shadow-md hover:shadow-lg">
                                Simpan Perubahan
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium flex items-center gap-1">
                                    <i data-lucide="check" class="w-4 h-4"></i> Tersimpan
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-gray-300 mb-12">

            {{-- ======================= --}}
            {{-- BAGIAN 2: UPDATE PASSWORD --}}
            {{-- ======================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold text-[#05284C] mb-2">Perbarui Kata Sandi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                    </p>
                </div>

                <div class="lg:col-span-2">
                    <form method="post" action="{{ route('password.update') }}" class="flex flex-col gap-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i data-lucide="lock" class="w-4 h-4 text-[#05284C]"></i> Kata Sandi Saat Ini
                            </label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i data-lucide="key" class="w-4 h-4 text-[#05284C]"></i> Kata Sandi Baru
                            </label>
                            <input type="password" id="password" name="password" autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                <i data-lucide="check-check" class="w-4 h-4 text-[#05284C]"></i> Konfirmasi Kata Sandi
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-[#05284C] text-white px-6 py-2.5 rounded-xl font-bold hover:bg-[#073b6e] transition-all shadow-md hover:shadow-lg">
                                Perbarui Sandi
                            </button>
                            @if (session('status') === 'password-updated')
                                <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium flex items-center gap-1">
                                    <i data-lucide="check" class="w-4 h-4"></i> Tersimpan
                                </span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <hr class="border-gray-300 mb-12">

            {{-- ======================= --}}
            {{-- BAGIAN 3: HAPUS AKUN --}}
            {{-- ======================= --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold text-red-600 mb-2">Hapus Akun</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Setelah akun dihapus, semua data akan hilang permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>

                <div class="lg:col-span-2 flex items-start">
                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                        class="bg-red-50 text-red-600 border border-red-200 px-6 py-3 rounded-xl font-bold hover:bg-red-600 hover:text-white transition-all shadow-sm hover:shadow-md flex items-center gap-2">
                        <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                        Hapus Akun Saya
                    </button>
                </div>
            </div>

        </div>
    </main>

    {{-- ======================= --}}
    {{-- MODAL KONFIRMASI HAPUS --}}
    {{-- ======================= --}}
    <div x-data="{ show: @js($errors->userDeletion->isNotEmpty()) }"
         x-show="show"
         x-on:open-modal.window="if ($event.detail == 'confirm-user-deletion') show = true"
         x-on:close-modal.window="if ($event.detail == 'confirm-user-deletion') show = false"
         x-on:keydown.escape.window="show = false"
         class="fixed inset-0 z-[100] overflow-y-auto"
         style="display: none;">
        
        {{-- Overlay --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
             x-on:click="show = false"></div>

        {{-- Modal Centering --}}
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6">
                
                <div class="flex flex-col items-center text-center">
                    <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
                        <i data-lucide="alert-octagon" class="w-8 h-8 text-red-600"></i>
                    </div>

                    <h2 class="text-xl font-bold text-gray-900 mb-2">
                        {{ __('Yakin ingin menghapus akun?') }}
                    </h2>
            
                    <p class="text-sm text-gray-500 mb-6">
                        {{ __('Setelah akun dihapus, semua sumber daya dan data akan dihapus permanen. Masukkan kata sandi Anda untuk konfirmasi.') }}
                    </p>
                </div>
        
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
            
                    <div class="mb-6">
                        <label for="delete_password" class="sr-only">{{ __('Kata Sandi') }}</label>
                        <input id="delete_password" name="password" type="password" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none" 
                               placeholder="{{ __('Masukkan Kata Sandi Anda') }}">
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>
            
                    <div class="flex justify-end gap-3">
                        <button type="button" x-on:click="show = false" class="bg-gray-100 text-gray-700 rounded-xl py-2.5 px-5 font-semibold hover:bg-gray-200 transition-colors">
                            {{ __('Batal') }}
                        </button>
                        <button type="submit" class="bg-red-600 text-white rounded-xl py-2.5 px-5 font-semibold hover:bg-red-700 transition-colors shadow-md hover:shadow-lg">
                            {{ __('Hapus Akun Permanen') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection