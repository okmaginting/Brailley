@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Buku Resmi')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bukuresmi" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-0">Buku Resmi</h2>
        <div class="flex items-center bg-white rounded-full px-3 py-1 shadow-sm w-full md:w-64">
          <i data-lucide="search" class="w-5 h-5 text-gray-400 mr-2"></i>
          <input type="text" placeholder="Cari buku..." class="w-full text-sm text-gray-700 outline-none bg-transparent">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Card A -->
  <div class="bg-white rounded-2xl shadow p-4 flex flex-col hover:shadow-lg transition cursor-pointer">
    <a href="/bukuresmi/detail" class="block">
      <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-semibold">A</div>
          <div>
            <p class="text-sm font-semibold text-gray-700">Header</p>
            <p class="text-xs text-gray-500">Subhead</p>
          </div>
        </div>
        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-400"></i>
      </div>
      <div class="flex justify-center items-center h-32 bg-gray-100 rounded mb-4">
        <div class="w-12 h-12 bg-gray-300"></div>
        <div class="w-8 h-8 bg-gray-400 ml-2"></div>
        <div class="w-6 h-6 bg-gray-500 ml-2"></div>
      </div>
      <h3 class="font-semibold text-lg mb-1">Title A</h3>
      <p class="text-sm text-gray-500 mb-2">Subtitle A</p>
      <p class="text-sm text-gray-700 flex-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </a>
    <div class="mt-4 flex justify-end gap-2">
      <button class="border border-gray-300 rounded-full px-3 py-1 text-sm text-gray-700">Secondary</button>
      <a href="#" class="bg-purple-600 text-white rounded-full px-3 py-1 text-sm hover:bg-purple-700 transition">Primary</a>
    </div>
  </div>

  <!-- Card B -->
  <div class="bg-white rounded-2xl shadow p-4 flex flex-col hover:shadow-lg transition cursor-pointer">
    <a href="/bukuresmi/detail" class="block">
      <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-semibold">B</div>
          <div>
            <p class="text-sm font-semibold text-gray-700">Header</p>
            <p class="text-xs text-gray-500">Subhead</p>
          </div>
        </div>
        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-400"></i>
      </div>
      <div class="flex justify-center items-center h-32 bg-gray-100 rounded mb-4">
        <div class="w-12 h-12 bg-gray-300"></div>
        <div class="w-8 h-8 bg-gray-400 ml-2"></div>
        <div class="w-6 h-6 bg-gray-500 ml-2"></div>
      </div>
      <h3 class="font-semibold text-lg mb-1">Title B</h3>
      <p class="text-sm text-gray-500 mb-2">Subtitle B</p>
      <p class="text-sm text-gray-700 flex-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </a>
    <div class="mt-4 flex justify-end gap-2">
      <button class="border border-gray-300 rounded-full px-3 py-1 text-sm text-gray-700">Secondary</button>
      <a href="#" class="bg-purple-600 text-white rounded-full px-3 py-1 text-sm hover:bg-purple-700 transition">Primary</a>
    </div>
  </div>

  <!-- Card C -->
  <div class="bg-white rounded-2xl shadow p-4 flex flex-col hover:shadow-lg transition cursor-pointer">
    <a href="/bukuresmi/detail" class="block">
      <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">C</div>
          <div>
            <p class="text-sm font-semibold text-gray-700">Header</p>
            <p class="text-xs text-gray-500">Subhead</p>
          </div>
        </div>
        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-400"></i>
      </div>
      <div class="flex justify-center items-center h-32 bg-gray-100 rounded mb-4">
        <div class="w-12 h-12 bg-gray-300"></div>
        <div class="w-8 h-8 bg-gray-400 ml-2"></div>
        <div class="w-6 h-6 bg-gray-500 ml-2"></div>
      </div>
      <h3 class="font-semibold text-lg mb-1">Title C</h3>
      <p class="text-sm text-gray-500 mb-2">Subtitle C</p>
      <p class="text-sm text-gray-700 flex-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </a>
    <div class="mt-4 flex justify-end gap-2">
      <button class="border border-gray-300 rounded-full px-3 py-1 text-sm text-gray-700">Secondary</button>
      <a href="#" class="bg-purple-600 text-white rounded-full px-3 py-1 text-sm hover:bg-purple-700 transition">Primary</a>
    </div>
  </div>
    <div class="bg-white rounded-2xl shadow p-4 flex flex-col hover:shadow-lg transition cursor-pointer">
    <a href="/bukuresmi/detail" class="block">
      <div class="flex justify-between items-start mb-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-semibold">C</div>
          <div>
            <p class="text-sm font-semibold text-gray-700">Header</p>
            <p class="text-xs text-gray-500">Subhead</p>
          </div>
        </div>
        <i data-lucide="more-vertical" class="w-5 h-5 text-gray-400"></i>
      </div>
      <div class="flex justify-center items-center h-32 bg-gray-100 rounded mb-4">
        <div class="w-12 h-12 bg-gray-300"></div>
        <div class="w-8 h-8 bg-gray-400 ml-2"></div>
        <div class="w-6 h-6 bg-gray-500 ml-2"></div>
      </div>
      <h3 class="font-semibold text-lg mb-1">Title C</h3>
      <p class="text-sm text-gray-500 mb-2">Subtitle C</p>
      <p class="text-sm text-gray-700 flex-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </a>
    <div class="mt-4 flex justify-end gap-2">
      <button class="border border-gray-300 rounded-full px-3 py-1 text-sm text-gray-700">Secondary</button>
      <a href="#" class="bg-purple-600 text-white rounded-full px-3 py-1 text-sm hover:bg-purple-700 transition">Primary</a>
    </div>
  </div>
</div>
  </section>
@endsection