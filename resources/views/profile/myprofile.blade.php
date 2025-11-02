@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Profile Saya')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
{{-- Menggunakan padding section dari file referensi --}}
<main class="flex flex-1 justify-center items-start pt-[180px] px-6 md:px-10 pb-20">
    
    {{-- Card di-style agar sesuai dengan file referensi --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-4xl p-8 md:p-16 flex flex-col items-center shadow-lg transition-all duration-300">
        
        {{-- Logo Pengguna (Dipercantik) --}}
        <div class="bg-[#05284C] rounded-full p-5 mb-4 shadow-md">
            <i data-lucide="user" class="w-10 h-10 text-white"></i>
        </div>

        {{-- Judul dan Tombol Edit --}}
        <div class="flex items-center gap-3 mb-8 text-center"> {{-- Margin bawah dikurangi --}}
            
            {{-- PERUBAHAN: Mengganti "Profil Saya" dengan nama pengguna --}}
            <p class="text-3xl font-bold text-[#05284C] break-all">{{ Auth::user()->name }}</p>
            
            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800 transition-colors flex-shrink-0" title="Edit Profil">
                <i data-lucide="edit-2" class="w-5 h-5"></i>
            </a>
        </div>

        {{-- Menampilkan Data Diri --}}
        <div class="w-full max-w-lg space-y-5 text-left">
            
            {{-- PERUBAHAN: Blok "Nama" telah dihapus karena sudah dipindahkan ke judul --}}

            {{-- Menampilkan Email (Dipercantik) --}}
            <div>
                {{-- Font Label disesuaikan untuk hierarki --}}
                <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                {{-- Kotak display di-style agar lebih serasi --}}
                <div class="w-full bg-white rounded-xl py-3 px-4 text-gray-900 text-base font-medium leading-relaxed">
                    {{ Auth::user()->email }}
                </div>
            </div>
            
            {{-- Tombol Logout (Dipercantik) --}}
            <div class="pt-6"> {{-- Padding atas ditambah --}}
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    {{-- Style tombol diubah menjadi outline --}}
                    <button type="submit" class="w-full bg-transparent border border-red-600 text-red-600 rounded-xl py-2.5 mt-3 hover:bg-red-600 hover:text-white transition-all duration-300 font-medium">
                        Logout
                    </button>
                 </form>
            </div>

        </div>
    </div>
</main>
@endsection