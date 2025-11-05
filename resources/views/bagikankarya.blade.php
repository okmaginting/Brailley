@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Bagikan Karya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="bagikankarya" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-5xl p-16 text-center shadow-lg">
      <h2 class="text-4xl font-extrabold text-[#000] mb-6">Bagikan Karya</h2>
      <p class="text-2xl text-[#000] font-medium mb-10">“Karya kecilmu bisa jadi inspirasi besar bagi orang lain.”</p>
      <div class="flex justify-center gap-6">
        <a href="/bagikankarya/tuliskarya" class="bg-black text-white px-8 py-3 rounded-xl text-lg hover:bg-[#333]">Mulai bagikan Karya</a>
        
      </div>
    </div>
  </section>
@endsection