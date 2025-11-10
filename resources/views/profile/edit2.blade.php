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

        {{-- Judul --}}
        <div class="flex items-center gap-3 mb-8 text-center">
            
            {{-- Nama pengguna sebagai judul --}}
            <p class="text-3xl font-bold text-[#05284C] break-all">{{ Auth::user()->name }}</p>
            
            {{-- Tombol Edit dihapus karena form ada di halaman ini --}}

        </div>

        {{-- Tombol Logout (Dipindahkan ke sini) --}}
        {{-- Dibungkus dengan max-w-xl agar lebarnya sama dengan form di bawah --}}
        <div class="w-full max-w-xl mb-8">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-transparent border border-red-600 text-red-600 rounded-xl py-2.5 hover:bg-red-600 hover:text-white transition-all duration-300 font-medium">
                    Logout
                </button>
             </form>
        </div>


        {{-- PERUBAHAN: Konten diubah untuk memuat formulir edit --}}
        {{-- Menggunakan max-w-xl dan space-y-6 dari file edit.blade.php --}}
        <div class="w-full max-w-xl space-y-6">
            
            {{-- Formulir Update Informasi Profil --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- File ini berisi form untuk update nama dan email --}}
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Formulir Update Password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- File ini berisi form untuk update password --}}
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Formulir Hapus Akun --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    {{-- File ini berisi form untuk hapus akun --}}
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            {{-- Tombol Logout (Dihapus dari sini) --}}

        </div>
    </div>
</main>
@endsection

