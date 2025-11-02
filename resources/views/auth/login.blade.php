@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Login')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    <section id="login" class="flex justify-center items-start px-6 md:px-10 pt-[120px] pb-20">
<div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[95%] max-w-[70rem] px-16 py-12 text-center">

{{-- Menampilkan status sesi (mis. 'Link reset password terkirim') --}}
<x-auth-session-status class="mb-4" :status="session('status')" />

<h2 class="text-3xl md:text-4xl font-bold mb-3">Login</h2>
<p class="text-gray-700 mb-6 text-base md:text-lg">Please login to your account</p>

{{-- 
  Form diupdate dengan method, action, dan @csrf dari Breeze.
  'id="loginForm"' dihilangkan kecuali Anda membutuhkannya untuk JS,
  tapi 'id' pada input password dipertahankan untuk toggle visibility.
--}}
<form method="POST" action="{{ route('login') }}" class="space-y-5 text-left">
@csrf

{{-- BAGIAN EMAIL --}}
<div>
<label for="email" class="block text-gray-800 mb-1 font-medium">Email</label>
<div class="relative">
{{-- Input diupdate dengan value, required, autofocus, autocomplete --}}
<input type="email" id="email" name="email" 
value="{{ old('email') }}" 
required autofocus 
autocomplete="username"
placeholder="Enter your email" 
class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
</div>
{{-- INI ADALAH PERINGATAN JIKA ERROR (diminta) --}}
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

{{-- BAGIAN PASSWORD --}}
<div>
<label for="password" class="block text-gray-800 mb-1 font-medium">Password</label>
<div class="relative">
{{-- Input diupdate dengan required dan autocomplete --}}
<input type="password" id="password" name="password" 
required 
autocomplete="current-password"
placeholder="Enter your password" 
class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
{{-- Ikon toggle password dipertahankan --}}
<svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
</svg>
</div>
{{-- INI ADALAH PERINGATAN JIKA ERROR (diminta) --}}
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

{{-- BAGIAN REMEMBER ME & FORGOT PASSWORD --}}
<div class="flex items-center justify-between text-sm">
{{-- 'for', 'id', dan 'name' ditambahkan ke remember me --}}
<label for="remember_me" class="flex items-center gap-2">
<input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 border-gray-300 rounded"> Remember me
</label>
{{-- Link 'Forgot Password' diupdate menggunakan route() dan @if --}}
@if (Route::has('password.request'))
<a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot password?</a>
@endif
</div>

<button type="submit" class="w-full bg-black text-white rounded-xl py-2 mt-3 hover:bg-gray-800 transition">Login</button>
</form>

<p class="text-sm text-gray-700 mt-6 text-center">
don’t have an account? 
{{-- Link 'Register' diupdate menggunakan route() --}}
<a href="{{ route('register') }}" class="text-blue-600 font-medium hover:underline">register</a>
</p>
</div>
</section>
@endsection