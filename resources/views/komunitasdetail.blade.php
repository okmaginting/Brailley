@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Bacaan Komunitas')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
    <section id="bukukomunitasdetail" class="flex justify-center items-start px-6 md:px-10 pt-[180px]">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      <div class="flex flex-col md:flex-row items-center justify-between gap-10">
        <div class="flex-1 text-[#05284C] space-y-4">
          <h2 class="text-4xl font-extrabold">Buku Komunitas</h2>
          <h3 class="text-2xl font-semibold">SI BOKE</h3>
          <div class="flex gap-3 mt-4">
            <a href="/bukukomunitas/detail/baca" class="bg-[#D4C9BE] text-[#05284C] px-6 py-2 rounded-lg font-medium hover:bg-[#c7bcb0] transition">Baca</a>
            <button class="border border-[#05284C] text-[#05284C] px-6 py-2 rounded-lg font-medium hover:bg-[#05284C] hover:text-white transition">Download</button>
          </div>
          <div class="text-sm mt-6 leading-relaxed">
            <p><span class="font-semibold">Penulis :</span> Wenny Oktavia</p>
            <p><span class="font-semibold">Jenjang :</span> SD</p>
            <p><span class="font-semibold">Jumlah :</span> 28 halaman</p>
            <p><span class="font-semibold">Bahasa :</span> Indonesia</p>
            <p><span class="font-semibold">Format :</span> Buku Komik</p>
          </div>
          <div class="mt-6">
            <p class="font-semibold">Sinopsis :</p>
            <p class="text-sm leading-relaxed">
              “Aku memang bokek. Kalian boleh saja panggil aku si Boke. Tapi, aku akan jadi orang sukses nantinya jika aku rajin berusaha dan berdoa!”<br>
              Setuju dengan perkataan si Boke? Baca komik ini untuk mengenal si Boke lebih lanjut!
            </p>
          </div>
        </div>
        <div class="flex-1 flex justify-center">
          <img src="{{ asset('images/siboke.png') }}" alt="Buku Si Boke" class="rounded-xl shadow-md w-[280px] md:w-[340px]">
        </div>
      </div>
    </div>
  </section>
@endsection