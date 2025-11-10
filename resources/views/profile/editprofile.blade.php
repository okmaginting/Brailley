@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Edit Profil')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')

{{-- Form tersembunyi untuk mengirim ulang verifikasi email --}}
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<main class="flex flex-1 justify-center items-start pt-[180px] px-6 md:px-10 pb-20">
    
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-4xl p-8 md:p-16 flex flex-col items-center shadow-lg transition-all duration-300">
        
        {{-- BAGIAN HEADER: PROFIL & LOGOUT --}}
        <div class="w-full max-w-lg flex flex-col items-center text-center mb-6"> {{-- mb-8 -> mb-6 --}}
            {{-- Ikon Profil --}}
            <div class="bg-[#05284C] rounded-full p-5 mb-3 shadow-md"> {{-- mb-4 -> mb-3 --}}
                <i data-lucide="user" class="w-10 h-10 text-white"></i>
            </div>
            
            {{-- Nama Pengguna --}}
            <h2 class="text-2xl font-bold text-[#05284C] mb-2">{{ Auth::user()->name }}</h2> {{-- mb-3 -> mb-2 --}}
            
            {{-- Tombol Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-sm transition-colors flex items-center gap-2 px-4 py-2 rounded-full hover:bg-red-50">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    {{ __('Keluar') }}
                </button>
            </form>
        </div>

        {{-- Garis Pemisah --}}
        <hr class="border-gray-300 w-full max-w-lg mb-8"> {{-- mb-10 -> mb-8 --}}

        {{-- Judul Bagian Edit --}}
        <h3 class="text-2xl font-bold text-[#05284C] mb-6 text-center w-full max-w-lg"> {{-- mb-8 -> mb-6 --}}
            Edit Profil Anda
        </h3>
        
        {{-- BAGIAN 1: PERBARUI INFORMASI PROFIL --}}
        <div class="w-full max-w-lg">
            {{-- space-y-5 -> space-y-4 (Lebih rapat) --}}
            <form method="POST" action="{{ route('profile.update') }}" class="w-full flex flex-col space-y-4">
                @csrf
                @method('PATCH')

                {{-- Edit Nama --}}
                <div>
                    <label for="name" class="block text-base font-semibold text-gray-800 mb-1">Nama</label> {{-- mb-2 -> mb-1 --}}
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $user->name) }}"
                           required autofocus autocomplete="name"
                           class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                    <x-input-error class="mt-1" :messages="$errors->get('name')" /> {{-- mt-2 -> mt-1 --}}
                </div>
                
                {{-- Edit Email --}}
                <div>
                    <label for="email" class="block text-base font-semibold text-gray-800 mb-1">Email</label> {{-- mb-2 -> mb-1 --}}
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           required autocomplete="username"
                           class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg">
                    <x-input-error class="mt-1" :messages="$errors->get('email')" /> {{-- mt-2 -> mt-1 --}}

                    {{-- Logika Verifikasi Email --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-700">
                                {{ __('Alamat email Anda belum diverifikasi.') }}
                                <button form="send-verification" class="underline text-sm text-[#05284C] hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#05284C]">
                                    {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                
                {{-- Tombol Simpan --}}
                <div class="pt-2 flex items-center gap-4"> {{-- pt-4 -> pt-2 --}}
                    <button type="submit" class="bg-[#05284C] rounded-xl py-2.5 px-6 text-white text-center font-semibold hover:bg-opacity-90 transition-all shadow-md hover:shadow-lg">
                        {{ __('Simpan') }}
                    </button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
                    @endif
                </div>
            </form>
        </div>

        {{-- Pemisah --}}
        <hr class="my-8 border-gray-300 w-full max-w-lg"> {{-- my-12 -> my-8 --}}

        {{-- BAGIAN 2: PERBARUI KATA SANDI --}}
        <div class="w-full max-w-lg">
            <header class="text-left mb-4"> {{-- mb-6 -> mb-4 --}}
                <h2 class="text-2xl font-bold text-[#05284C]">
                    {{ __('Perbarui Kata Sandi') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.') }}
                </p>
            </header>

            {{-- space-y-5 -> space-y-4 --}}
            <form method="post" action="{{ route('password.update') }}" class="w-full flex flex-col space-y-4">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Kata Sandi Saat Ini') }}</label> {{-- mb-2 -> mb-1 --}}
                    <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
                </div>

                <div>
                    <label for="update_password_password" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Kata Sandi Baru') }}</label>
                    <input id="update_password_password" name="password" type="password" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-base font-semibold text-gray-800 mb-1">{{ __('Konfirmasi Kata Sandi') }}</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-white rounded-2xl py-2.5 px-4 text-black text-base font-medium placeholder-gray-400 focus:outline-none border border-gray-200 focus:border-gray-400 transition-all shadow-md focus:shadow-lg" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
                </div>

                <div class="pt-2 flex items-center gap-4"> {{-- pt-4 -> pt-2 --}}
                    <button type="submit" class="bg-[#05284C] rounded-xl py-2.5 px-6 text-white text-center font-semibold hover:bg-opacity-90 transition-all shadow-md hover:shadow-lg">
                        {{ __('Simpan') }}
                    </button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
                    @endif
                </div>
            </form>
        </div>

        {{-- Pemisah --}}
        <hr class="my-8 border-gray-300 w-full max-w-lg"> {{-- my-12 -> my-8 --}}

        {{-- BAGIAN 3: HAPUS AKUN --}}
        <div class="w-full max-w-lg">
            <header class="text-left mb-4"> {{-- mb-6 -> mb-4 --}}
                <h2 class="text-2xl font-bold text-red-600">
                    {{ __('Hapus Akun') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.') }}
                </p>
            </header>

            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 rounded-xl py-2.5 px-6 text-white text-center font-semibold hover:bg-red-700 transition-all shadow-md hover:shadow-lg">
                {{ __('Hapus Akun') }}
            </button>
        </div>

    </div>
</main>

{{-- Modal Konfirmasi Hapus Akun --}}
{{-- PERBAIKAN: Menambahkan kelas untuk memusatkan modal --}}
<div x-data="{ show: @js($errors->userDeletion->isNotEmpty()) }"
     x-show="show"
     x-on:open-modal.window="if ($event.detail == 'confirm-user-deletion') show = true"
     x-on:close-modal.window="if ($event.detail == 'confirm-user-deletion') show = false"
     x-on:keydown.escape.window="show = false"
     class="fixed inset-0 z-50 overflow-y-auto"
     style="display: none;">
    
    {{-- Overlay Gelap --}}
    <div x-show="show" class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" x-transition.opacity></div>

    {{-- Container Modal (Dipusatkan dengan flex items-center justify-center) --}}
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        
        {{-- Isi Modal --}}
        <div x-show="show"
             x-transition
             x-on:click.away="show = false"
             class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')
        
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                </h2>
        
                <p class="text-sm text-gray-600 mb-6">
                    {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
                </p>
        
                <div class="mb-6">
                    <label for="delete_password" class="sr-only">{{ __('Kata Sandi') }}</label>
                    <input id="delete_password" name="password" type="password" class="w-full bg-gray-100 rounded-2xl py-3 px-4 text-black text-base font-medium placeholder-gray-500 focus:outline-none border border-gray-200 focus:border-red-500 transition-all shadow-sm focus:shadow-md" placeholder="{{ __('Kata Sandi') }}">
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>
        
                <div class="flex justify-end gap-3">
                    <button type="button" x-on:click="show = false" class="bg-gray-200 text-gray-800 rounded-xl py-2.5 px-5 font-semibold hover:bg-gray-300 transition-all">
                        {{ __('Batal') }}
                    </button>
                    <button type="submit" class="bg-red-600 text-white rounded-xl py-2.5 px-5 font-semibold hover:bg-red-700 transition-all shadow-md hover:shadow-lg">
                        {{ __('Hapus Akun') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection