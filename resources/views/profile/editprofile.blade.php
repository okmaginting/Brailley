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
        
        {{-- BAGIAN 1: UPDATE INFORMASI PROFIL --}}
        <div class="w-full max-w-lg">
            <div class="flex justify-center mb-3">
                <div class="bg-white rounded-full p-4 shadow">
                    <i data-lucide="user" class="w-8 h-8 text-black"></i>
                </div>
            </div>
            <div class="flex items-center justify-center gap-2 mb-10 text-center">
                <p class="text-3xl font-bold text-[#05284C]">Edit Profil Anda</p>
            </div>
            
            <form method="POST" action="{{ route('profile.update') }}" class="w-full flex flex-col space-y-5">
                @csrf
                @method('PATCH')

                {{-- Edit Nama --}}
                <div>
                    <label for="name" class="block text-lg font-semibold text-gray-800 mb-2">Nama</label>
                    <input type="text" id="name" name="name" 
                         {{-- Menggunakan $user dari Breeze, bukan Auth::user() --}}
                         value="{{ old('name', $user->name) }}"
                         required autofocus autocomplete="name"
                         class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                
                {{-- Edit Email --}}
                <div>
                    <label for="email" class="block text-lg font-semibold text-gray-800 mb-2">Email</label>
                    <input type="email" id="email" name="email"
                         value="{{ old('email', $user->email) }}"
                         required autocomplete="username"
                         class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    {{-- Logika Verifikasi Email dari Breeze --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-700">
                                {{ __('Your email address is unverified.') }}
                                
                                <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
    
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
                
                {{-- Tombol Update & Pesan "Saved." --}}
                <div class="pt-4">
                    <div class="flex items-center gap-4">
                        <button type="submit" class="w-auto bg-black rounded-xl py-2.5 px-6 text-white text-center font-medium hover:bg-gray-800 transition">
                            {{ __('Save') }}
                        </button>
    
                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Pemisah --}}
        <hr class="my-10 border-gray-300 w-full max-w-lg">

        {{-- BAGIAN 2: UPDATE PASSWORD --}}
        <div class="w-full max-w-lg">
            <header class="text-left mb-6">
                <h2 class="text-2xl font-bold text-[#05284C]">
                    {{ __('Update Password') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="w-full flex flex-col space-y-5">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-lg font-semibold text-gray-800 mb-2">{{ __('Current Password') }}</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div>
                    <label for="update_password_password" class="block text-lg font-semibold text-gray-800 mb-2">{{ __('New Password') }}</label>
                    <input id="update_password_password" name="password" type="password" class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-lg font-semibold text-gray-800 mb-2">{{ __('Confirm Password') }}</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <div class="flex items-center gap-4">
                        <button type="submit" class="w-auto bg-black rounded-xl py-2.5 px-6 text-white text-center font-medium hover:bg-gray-800 transition">
                            {{ __('Save') }}
                        </button>
    
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Pemisah --}}
        <hr class="my-10 border-gray-300 w-full max-w-lg">

        {{-- BAGIAN 3: DELETE ACCOUNT --}}
        <div class="w-full max-w-lg">
            <header class="text-left">
                <h2 class="text-2xl font-bold text-red-600">
                    {{ __('Delete Account') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                </p>
            </header>

            <div class="mt-6">
                {{-- Tombol disesuaikan agar merah dan serasi --}}
                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="w-auto bg-red-600 rounded-xl py-2.5 px-6 text-white text-center font-medium hover:bg-red-700 transition"
                >{{ __('Delete Account') }}</button>
            </div>
        </div>

    </div>
</main>

{{-- Modal Konfirmasi Hapus Akun (diambil dari delete-user-form.blade.php) --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Are you sure you want to delete your account?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <div class="mt-6">
            <label for="delete_password" class="block text-lg font-semibold text-gray-800 mb-2">{{ __('Password') }}</label>
            <input
                id="delete_password"
                name="password"
                type="password"
                class="w-full bg-white rounded-xl py-3 px-4 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="{{ __('Password') }}"
            />
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <button type="button" x-on:click="$dispatch('close')" class="w-auto bg-gray-200 rounded-xl py-2 px-6 text-black text-center font-medium hover:bg-gray-300 transition">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="w-auto bg-red-600 rounded-xl py-2.5 px-6 text-white text-center font-medium hover:bg-red-700 transition ms-3">
                {{ __('Delete Account') }}
            </button>
        </div>
    </form>
</x-modal>
@endsection

