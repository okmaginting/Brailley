@extends('layouts.app')

{{-- Mengatur judul halaman --}}
@section('title', 'Tulis Karya')

{{-- Menambahkan CSS untuk EasyMDE --}}
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">

{{-- Style override --}}
<style>
  .editor-toolbar {
    border-top-left-radius: 1rem; 
    border-top-right-radius: 1rem;
    border-color: #E5E7EB; 
    background-color: #F9FAFB; 
    opacity: 1;
  }
  .CodeMirror {
    border-bottom-left-radius: 1rem;
    border-bottom-right-radius: 1rem;
    border-color: #E5E7EB; 
    padding: 1.5rem; 
    min-height: 300px;
    font-size: 1rem;
    color: #374151;
  }
  .CodeMirror-placeholder {
    color: #9CA3AF !important;
  }
  .CodeMirror-fullscreen, .editor-toolbar.fullscreen {
    z-index: 9999 !important; 
  }
</style>

@section('content')
  <section id="tuliskarya" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-6xl p-8 md:p-14 shadow-xl relative">
      
      {{-- Header --}}
      <div class="mb-12 border-b border-gray-300 pb-6">
        <h2 class="text-4xl font-extrabold text-[#05284C] mb-2">Bagikan Karya</h2>
        <p class="text-lg text-gray-600">Tuangkan imajinasimu menjadi cerita yang menginspirasi.</p>
      </div>

      {{-- Alert Error --}}
      @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-8 shadow-sm" role="alert">
          <div class="flex items-center mb-2">
             <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
             <strong class="font-bold">Mohon periksa kembali:</strong>
          </div>
          <ul class="list-disc list-inside text-sm ml-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
      @endif

      {{-- Form --}}
      <form action="{{ route('karya.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-8">
        @csrf

        {{-- BAGIAN 1: Metadata Karya --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          
          {{-- Kolom Kiri --}}
          <div class="flex flex-col gap-6">
            {{-- Input Penulis --}}
            <div class="group">
              <label for="penulis" class="flex items-center gap-2 text-gray-700 font-semibold text-sm mb-2">
                 <i data-lucide="user" class="w-4 h-4 text-[#05284C]"></i> Nama Penulis
              </label>
              <input type="text" id="penulis" name="penulis" 
                     class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm placeholder-gray-400" 
                     value="{{ old('penulis', Auth::user()?->name) }}" 
                     placeholder="Nama pena Anda" required />
            </div>

            {{-- Input Judul --}}
            <div>
              <label for="judul" class="flex items-center gap-2 text-gray-700 font-semibold text-sm mb-2">
                 <i data-lucide="type" class="w-4 h-4 text-[#05284C]"></i> Judul Karya
              </label>
              <input type="text" id="judul" name="judul" 
                     class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm placeholder-gray-400" 
                     value="{{ old('judul') }}" 
                     placeholder="Judul cerita yang menarik" required />
            </div>
          </div>

          {{-- Kolom Kanan --}}
          <div class="flex flex-col gap-6">
            {{-- Input Genre --}}
            <div>
              <label for="genre" class="flex items-center gap-2 text-gray-700 font-semibold text-sm mb-2">
                 <i data-lucide="tag" class="w-4 h-4 text-[#05284C]"></i> Genre
              </label>
              <input type="text" id="genre" name="genre" 
                     class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm placeholder-gray-400" 
                     value="{{ old('genre') }}" 
                     placeholder="Misal: Fiksi, Horor, Petualangan" required />
            </div>

            {{-- Input File Gambar --}}
            <div>
              <label for="gambar_cerita" class="flex items-center gap-2 text-gray-700 font-semibold text-sm mb-2">
                 <i data-lucide="image" class="w-4 h-4 text-[#05284C]"></i> Cover Cerita
              </label>
              <input type="file" id="gambar_cerita" name="gambar_cerita" 
                     class="w-full px-3 py-2.5 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] outline-none transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#05284C]/10 file:text-[#05284C] hover:file:bg-[#05284C]/20" 
                     accept="image/*" />
            </div>
          </div>
        </div>

        {{-- Sinopsis --}}
        <div>
          <label for="sipnosis" class="flex items-center gap-2 text-gray-700 font-semibold text-sm mb-2">
             <i data-lucide="align-left" class="w-4 h-4 text-[#05284C]"></i> Sinopsis
          </label>
          <textarea id="sipnosis" name="sipnosis" rows="5" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-[#05284C] focus:border-transparent outline-none transition-all shadow-sm placeholder-gray-400 resize-none" 
                    placeholder="Ceritakan ringkasan singkat karyamu..." required>{{ old('sipnosis') }}</textarea>
        </div>

        <hr class="border-gray-300 my-4">

        {{-- BAGIAN 2: Isi Cerita (Dengan Alpine x-init timing fix) --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center gap-2 text-gray-800 font-bold text-lg">
                    <i data-lucide="pen-tool" class="w-5 h-5 text-[#05284C]"></i> Isi Cerita
                </label>
                <span class="text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded-md">Opsi 1: Tulis Langsung</span>
            </div>
            
            {{-- EasyMDE Editor WRAPPER (Final Timing Fix) --}}
            <div x-data="{ editor: null }" 
                 x-init="
                    // Jeda kecil (10ms) untuk memastikan DOM selesai di-morph oleh Livewire
                    setTimeout(() => {
                        editor = new EasyMDE({
                            element: $refs.editor, 
                            spellChecker: false,
                            minHeight: '300px',
                            placeholder: 'Mulai tulis ceritamu di sini...',
                            toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', '|', 'preview', 'fullscreen', '|', 'undo', 'redo'],
                            status: ['lines', 'words'],
                        });
                    }, 10);
                 "
                 {{-- PENTING: Hook untuk menghancurkan instance saat komponen dihilangkan oleh Livewire --}}
                 x-on:unmount="if (editor) editor.toTextArea()"
                 class="bg-white rounded-2xl shadow-sm">
                
                <textarea id="isi_cerita" x-ref="editor" name="isi_cerita">{{ old('isi_cerita') }}</textarea>
            </div>
        </div>

        <div class="flex items-center w-full my-2">
             <div class="flex-grow border-t border-gray-300"></div>
             <span class="flex-shrink-0 mx-4 text-gray-400 text-sm font-semibold">ATAU</span>
             <div class="flex-grow border-t border-gray-300"></div>
        </div>

        {{-- Upload File --}}
        <div class="bg-white p-6 rounded-2xl border border-dashed border-gray-300 hover:border-[#05284C] transition-colors">
            <div class="flex items-center justify-between mb-2">
                <label for="upload_file" class="flex items-center gap-2 text-gray-700 font-semibold text-sm">
                    <i data-lucide="file-up" class="w-4 h-4 text-[#05284C]"></i> Upload File (.docx)
                </label>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-md">Opsi 2</span>
            </div>
            <input type="file" id="upload_file" name="upload_file" 
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#05284C] file:text-white hover:file:bg-[#073b6e] cursor-pointer" 
                   accept=".docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
            <p class="text-xs text-gray-400 mt-2 ml-1">Mendukung file Microsoft Word (.docx)</p>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end items-center gap-4 mt-8 pt-6 border-t border-gray-300">
            
            {{-- Tombol Batal dengan wire:navigate --}}
            <a href="{{ route('karya.mine') }}" 
               wire:navigate
               class="px-6 py-3 rounded-xl text-gray-600 font-bold hover:bg-gray-200 transition-all">
               Batal
            </a>

            <button type="submit" class="flex items-center gap-2 bg-[#05284C] text-white py-3 px-8 rounded-xl font-bold shadow-lg shadow-[#05284C]/30 hover:bg-[#073b6e] hover:scale-105 transition-all duration-200">
               <i data-lucide="send" class="w-5 h-5"></i> Kirim Karya
            </button>
        </div>

      </form>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
  <script>
  </script>
@endpush