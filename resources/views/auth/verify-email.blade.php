@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Verifikasi Email')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
  <section id="verify-email" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    {{-- Kartu dibuat max-w-md, serasi dengan halaman auth lainnya --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-md p-10 md:p-14 shadow-lg flex flex-col items-center">

      {{-- Ikon Premium --}}
      <div class="flex justify-center mb-6">
        <div class="bg-[#05284C] rounded-full p-5 shadow-md">
          <i data-lucide="mail-check" class="w-10 h-10 text-white"></i>
        </div>
      </div>

      {{-- Judul Premium --}}
      <h2 class="text-3xl font-bold text-[#05284C] mb-3 text-center">Verifikasi Email Anda</h2>

      <div class="mb-4 text-sm text-gray-700 text-center">
        {{ __('Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengeklik link yang baru saja kami kirimkan? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan yang lain.') }}
      </div>

      @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 text-center">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
      @endif

      {{-- Mengubah layout tombol menjadi tumpukan vertikal untuk tampilan lebih rapi --}}
      <div class="w-full mt-4 flex flex-col space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            {{-- Mengganti x-primary-button dengan tombol gaya kustom --}}
            <button type="submit" class="w-full bg-[#05284C] text-white rounded-2xl py-3 font-semibold hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl">
              {{ __('Kirim Ulang Email Verifikasi') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            {{-- Mengganti tombol default dengan tombol outline merah (serasi profile) --}}
            <button type="submit" class="w-full bg-transparent border border-red-600 text-red-600 rounded-2xl py-2.5 font-semibold hover:bg-red-600 hover:text-white transition-all duration-300">
                {{ __('Keluar') }}
            </button>
        </form>
      </div>
    
    </div>
  </section>
@endsection