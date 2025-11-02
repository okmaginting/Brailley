@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Register')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="register" class="flex justify-center items-start px-6 md:px-10 pt-[120px] pb-20">
<div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[90%] max-w-[60rem] p-10 text-center">
<h2 class="text-3xl font-bold mb-2">Register</h2>

{{-- Form diupdate dengan method="POST" dan action="{{ route('register') }}" --}}
<form method="POST" action="{{ route('register') }}" class="space-y-5 text-left">
@csrf

{{-- BAGIAN NAMA --}}
<div>
{{-- Label dan input disesuaikan agar cocok dengan Breeze (name="name") --}}
<label for="name" class="block text-gray-800 mb-1">Name</label>
<input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
placeholder="Enter your name..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
{{-- Peringatan error kustom diganti dengan komponen error Breeze --}}
<x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

{{-- BAGIAN EMAIL --}}
<div>
<label for="email" class="block text-gray-800 mb-1">Email</label>
<input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
placeholder="Enter your email..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

{{-- Field 'phone/username' dihapus agar sesuai dengan file Breeze --}}

{{-- BAGIAN PASSWORD --}}
<div>
<label for="password" class="block text-gray-800 mb-1">Password</label>
<div class="relative">
<input type="password" id="password" name="password" required autocomplete="new-password"
placeholder="Create a password..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
<svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
</svg>
</div>
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

{{-- BAGIAN KONFIRMASI PASSWORD --}}
<div>
{{-- Label dan input disesuaikan (name="password_confirmation") --}}
<label for="password_confirmation" class="block text-gray-800 mb-1">Confirm Password</label>
<input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
placeholder="Confirm password..." 
class="w-full border border-gray-300 rounded-xl py-2 px-4 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

{{-- Checkbox "Terms" dihapus agar sesuai dengan file Breeze --}}

<button type="submit" class="w-full bg-black text-white rounded-xl py-2 mt-3 hover:bg-gray-800 transition">Register</button>
</form>

<p class="text-sm text-gray-700 mt-6">
Already have an account? 
{{-- Link diupdate menggunakan route() --}}
<a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Login</a>
</p>
</div>
</section>

{{-- 
  HANYA skrip untuk toggle password yang dipertahankan.
  Skrip validasi dihapus karena sudah ditangani oleh Breeze di backend.
--}}
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