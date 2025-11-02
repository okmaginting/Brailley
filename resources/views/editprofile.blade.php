@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Edit Profil')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    <main class="flex flex-1 justify-center items-center pt-[180px] px-4">
    <div class="bg-[#F1EFEC] rounded-[30px] w-full max-w-4xl p-10 flex flex-col items-center shadow-lg transition-all duration-300">
      <div class="bg-white rounded-full p-4 mb-3 shadow">
        <i data-lucide="user" class="w-8 h-8 text-black"></i>
      </div>
      <div class="flex items-center gap-2 mb-8">
        <p class="text-xl font-semibold text-black">Edit Your Profile</p>
      </div>
      <form id="profileForm" class="w-full flex flex-col space-y-4">
        <div>
          <label class="block text-black text-sm font-medium mb-1">Username</label>
          <input type="text" id="username" placeholder="Masukkan username..." class="w-full bg-white rounded-lg py-2.5 px-3 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <p class="error-text">Username wajib diisi</p>
        </div>
        <div>
          <label class="block text-black text-sm font-medium mb-1">Email</label>
          <input type="text" id="email" placeholder="Masukkan email..." class="w-full bg-white rounded-lg py-2.5 px-3 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <p class="error-text">Email wajib diisi</p>
        </div>
        <div>
          <label class="block text-black text-sm font-medium mb-1">Phone Number</label>
          <input type="text" id="phone" placeholder="Masukkan nomor telepon..." class="w-full bg-white rounded-lg py-2.5 px-3 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <p class="error-text">Nomor telepon wajib diisi</p>
        </div>
        <div>
          <label class="block text-black text-sm font-medium mb-1">Password</label>
          <input type="password" id="password" placeholder="Masukkan password..." class="w-full bg-white rounded-lg py-2.5 px-3 text-black text-sm font-medium placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <p class="error-text">Password wajib diisi</p>
        </div>
        <a href="#" id="updateBtn" class="w-full bg-gray-400 rounded-lg py-2.5 px-3 text-white text-center font-medium cursor-not-allowed transition inline-block">Update</a>
      </form>
    </div>
  </main>
@endsection