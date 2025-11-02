@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Terjemahkan')

{{-- Mengirimkan konten unik halaman ini ke layout utama --}}
@section('content')
<section id="terjemahkan" class="flex justify-center items-start px-6 md:px-10 pt-[180px]"> {{-- Tambah padding bottom untuk mobile nav --}}
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-6xl p-8 md:p-12 shadow-lg">
        
        <h2 class="text-3xl md:text-4xl font-bold text-[#1c1b1a] mb-8 text-center">Terjemahkan Ke Braille</h2>

        <main class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label for="inputText" class="text-lg font-semibold mb-2">Enter Text</label>
                <textarea id="inputText" rows="10" class="w-full p-4 border border-gray-300 bg-gray-50 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" placeholder="Type or paste your text here..."></textarea>
            </div>

            <div class="flex flex-col">
                <label for="brailleOutput" class="text-lg font-semibold mb-2">Braille Output</label>
                <div id="brailleOutput" class="w-full h-full p-4 border border-gray-200 bg-gray-50 rounded-lg braille-output min-h-[250px]">
                    </div>
            </div>
            
            {{-- Footer ini sekarang mencakup 2 kolom pada desktop (md:col-span-2) --}}
            <footer class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 md:col-span-2">
                <button id="downloadBrf" class="w-full sm:w-auto bg-black hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none" disabled>Unduh .brf</button>
                <button id="downloadImage" class="w-full sm:w-auto bg-black hover:bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-transform transform hover:scale-105 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:transform-none" disabled>Unduh Gambar Cermin (A4)</button>
            </footer>
        </main>
        
    </div>
    <canvas id="brailleCanvas" style="display: none;"></canvas>
    <a id="downloadLink" style="display: none;"></a>
</section>

@endsection

{{-- Mengirimkan skrip spesifik halaman ini ke layout utama --}}
@push('scripts')
@vite('resources/js/translator.js')
@endpush