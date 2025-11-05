@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Register')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="register" class="flex justify-center items-start px-6 md:px-10 pt-[160px] pb-20">
<div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[90%] max-w-[60rem] p-10 text-center">
<h2 class="text-3xl font-bold mb-2">Mendaftar</h2>

{{-- Form diupdate dengan method="POST" dan action="{{ route('register') }}" --}}
<form method="POST" action="{{ route('register') }}" class="space-y-5 text-left">
@csrf

{{-- BAGIAN NAMA --}}
<div>
{{-- Label dan input disesuaikan agar cocok dengan Breeze (name="name") --}}
<label for="name" class="block text-gray-800 mb-1">Nama</label>
<input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
placeholder="Masukkan Nama..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
{{-- Peringatan error kustom diganti dengan komponen error Breeze --}}
<x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

{{-- BAGIAN EMAIL --}}
<div>
<label for="email" class="block text-gray-800 mb-1">Email</label>
<input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
placeholder="Masukkan Email..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

{{-- BAGIAN PASSWORD --}}
<div>
<label for="password" class="block text-gray-800 mb-1">Kata Sandi</label>
<div class="relative">
<input type="password" id="password" name="password" required autocomplete="new-password"
placeholder="Buat kata Sandi..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
</div>
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

{{-- BAGIAN KONFIRMASI PASSWORD --}}
<div>
{{-- Label dan input disesuaikan (name="password_confirmation") --}}
<label for="password_confirmation" class="block text-gray-800 mb-1">Konfirmasi Kata Sandi</label>
<input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
placeholder="Konfirmasi Kata Sandi..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

{{-- Checkbox "Terms" dihapus agar sesuai dengan file Breeze --}}

<button type="submit" class="w-full bg-black text-white rounded-xl py-2 mt-3 hover:bg-gray-800 transition">Daftar</button>
</form>

<p class="text-sm text-gray-700 mt-6">
Sudah punya akun? 
{{-- Link diupdate menggunakan route() --}}
<a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Masuk</a>
</p>
</div>
</section>

<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', () => {
const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
password.setAttribute('type', type);
togglePassword.classList.toggle('text-blue-500');
});
</script>
@endsection