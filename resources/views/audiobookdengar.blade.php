@extends('layouts.app')

{{-- Judul halaman dinamis --}}
@section('title', 'Dengarkan: ' . $audiobook->judul)

@section('content')
  <section id="audiobookdengar" class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">
      
      {{-- LAYOUT 2 KOLOM --}}
      <div class="flex flex-col-reverse md:flex-row items-start justify-center gap-10 md:gap-16">

        {{-- ================================== --}}
        {{-- KOLOM KIRI (Desktop) / BAWAH (Mobile) --}}
        {{-- ================================== --}}
        <div class="w-full md:max-w-prose">
          
          {{-- Judul Utama (Dinamis) --}}
          <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
            {{ $audiobook->judul }}
          </h2>

          {{-- ======================================================= --}}
          {{-- PEMUTAR AUDIO (Dibuat Fungsional dengan Alpine.js) --}}
          {{-- ======================================================= --}}
          <div 
            x-data="audioPlayer('{{ $audiobook->file_audio ? Storage::url($audiobook->file_audio) : '' }}')"
            {{-- Listener global untuk 'drag' dan 'stop drag' --}}
            @mousemove.window.throttle="onDrag"
            @mouseup.window="stopDrag"
            @touchmove.window.throttle="onDrag"
            @touchend.window="stopDrag"
            class="flex flex-col gap-3 mt-6 p-4 rounded-lg bg-white/50 shadow-inner border border-gray-300/50"
          >
            <span class="text-[#05284C] font-semibold text-lg">Dengarkan Audio</span>
            
            @if (!$audiobook->file_audio || !Storage::disk('public')->exists($audiobook->file_audio))
              <div class="text-red-600 font-medium">
                Maaf, file audio untuk item ini tidak tersedia.
              </div>
            @else
              {{-- Kontrol Player --}}
              <div class="flex items-center gap-3">
                
                {{-- Tombol Play/Pause (Font Awesome) --}}
                <button 
                  @click="togglePlay" 
                  class="flex items-center justify-center bg-[#05284C] text-white rounded-full w-12 h-12 shadow-lg hover:bg-opacity-90 transition-all flex-shrink-0"
                >
                  <i :class="{ 'hidden': isPlaying }" class="fa-solid fa-play w-6 h-6 ml-1"></i>
                  <i :class="{ 'hidden': !isPlaying }" class="fa-solid fa-pause w-6 h-6"></i>
                </button>

                {{-- Tombol Mundur 5 detik (Font Awesome) --}}
                <button 
                  @click="skip(-5)" 
                  class="flex items-center justify-center bg-gray-200 text-[#05284C] rounded-full w-9 h-9 shadow-md hover:bg-gray-300 transition-all flex-shrink-0" 
                  title="Mundur 5 detik"
                >
                  <i class="fa-solid fa-backward w-5 h-5"></i>
                </button>

                {{-- Tombol Maju 5 detik (Font Awesome) --}}
                <button 
                  @click="skip(5)" 
                  class="flex items-center justify-center bg-gray-200 text-[#05284C] rounded-full w-9 h-9 shadow-md hover:bg-gray-300 transition-all flex-shrink-0" 
                  title="Maju 5 detik"
                >
                  <i class="fa-solid fa-forward w-5 h-5"></i>
                </button>

                {{-- Tombol Kecepatan (Tidak berubah) --}}
                <button 
                  @click="changeSpeed" 
                  class="flex items-center justify-center bg-gray-200 text-[#05284C] rounded-full w-12 h-9 px-2 shadow-md hover:bg-gray-300 transition-all flex-shrink-0" 
                  title="Ubah Kecepatan"
                >
                  <span x-text="`${currentRate}x`" class="font-semibold text-sm"></span>
                </button>
                
                {{-- Progress Bar dan Waktu (Tidak berubah) --}}
                <div class="flex-1 ml-2">
                  <div class="flex justify-between text-sm font-medium text-gray-700 mb-1">
                    <span x-text="currentTime">00:00</span>
                    <span x-text="duration">00:00</span>
                  </div>
                  
                  <div 
                    x-ref="progressBar"
                    @mousedown.prevent="startSeek"
                    @touchstart.prevent="startSeek"
                    class="w-full bg-gray-300 rounded-full h-2 group cursor-pointer"
                  >
                    <div class="bg-[#05284C] h-2 rounded-full relative" :style="`width: ${progress}%`">
                      <div 
                        class="absolute right-0 top-1/2 w-4 h-4 rounded-full bg-white border-2 border-[#05284C] shadow cursor-pointer
                               -mt-2.5 -mr-2"
                      ></div>
                    </div>
                  </div>
                </div>
              </div>
              
              <audio 
                id="audio-player" 
                x-ref="player" 
                src="{{ Storage::url($audiobook->file_audio) }}" 
                preload="metadata"
              ></audio>
            @endif
          </div>
          
          {{-- Metadata Cerita (Dinamis) --}}
          <div class="mt-8 pt-6 border-t border-gray-300">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Buku</h3>
            <div class="space-y-3 text-base text-gray-700">
              <p><span class="font-semibold w-28 inline-block">Penulis</span>: {{ $audiobook->penulis }}</p>
              <p><span class="font-semibold w-28 inline-block">Narator</span>: {{ $audiobook->pengisi_audio }}</p>
            </div>
          </div>

        </div>

        {{-- =================================== --}}
        {{-- KOLOM KANAN (Desktop) / ATAS (Mobile) --}}
        {{-- =================================== --}}
        <div class="flex-shrink-0 flex justify-center w-full md:w-auto">
          <div class="w-full max-w-[340px] md:w-[340px] flex-shrink-0">
            @if ($audiobook->gambar_cover)
              <img src="{{ Storage::url($audiobook->gambar_cover) }}" 
                   alt="Sampul {{ $audiobook->judul }}" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @else
              <img src="https://placehold.co/340x450/9ca3af/F1EFEC?text=Tanpa+Cover" 
                   alt="Tanpa Cover" 
                   class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
            @endif
          </div>
        </div>

      </div> {{-- Akhir dari Flexbox 2 Kolom --}}
      
    </div>
  </section>
@endsection

{{-- Script untuk Audio Player --}}
@push('scripts')
<script>
  function audioPlayer(audioSrc) {
    return {
      // 1. PROPERTI (INI HILANG DARI KODE ANDA)
      isPlaying: false,
      currentTime: '00:00',
      duration: '00:00',
      progress: 0,
      audio: null,
      isDragging: false,
      wasPlaying: false,
      playbackRates: [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2],
      currentRateIndex: 2, // Mulai dari 1.0x
      
      // Getter untuk kecepatan
      get currentRate() {
        return this.playbackRates[this.currentRateIndex];
      },

      // 2. FUNGSI (INI JUGA HILANG)

      init() {
        if (!audioSrc) return;
        this.audio = this.$refs.player;
        
        this.audio.onloadedmetadata = () => {
          this.duration = this.formatTime(this.audio.duration);
        };
        
        this.audio.ontimeupdate = () => {
          if (this.isDragging) return; // Jangan update UI jika sedang di-drag
          this.currentTime = this.formatTime(this.audio.currentTime);
          this.progress = (this.audio.currentTime / this.audio.duration) * 100;
        };
        
        this.audio.onended = () => {
          if (this.isDragging) {
            return; 
          }
          this.isPlaying = false;
          this.progress = 100;
        };

        this.audio.playbackRate = this.currentRate;
      },
      
      togglePlay() {
        if (!this.audio) return;
        
        if (this.audio.ended) {
            this.audio.currentTime = 0;
        }

        if (this.audio.paused) {
          this.audio.play();
          this.isPlaying = true;
        } else {
          this.audio.pause();
          this.isPlaying = false;
        }
      },
      
      formatTime(seconds) {
        if (isNaN(seconds)) return '00:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
      },

      skip(seconds) {
        if (!this.audio || isNaN(this.audio.duration)) return;
        const newTime = this.audio.currentTime + seconds;
        
        this.audio.currentTime = Math.max(0, Math.min(newTime, this.audio.duration));
        
        this.progress = (this.audio.currentTime / this.audio.duration) * 100;
        this.currentTime = this.formatTime(this.audio.currentTime);

        if (this.audio.ended && seconds < 0) {
            // Jika audio selesai dan kita skip mundur, mainkan lagi
            this.audio.play();
            this.isPlaying = true;
        }
      },

      changeSpeed() {
        this.currentRateIndex = (this.currentRateIndex + 1) % this.playbackRates.length;
        this.audio.playbackRate = this.currentRate;
      },
      
      updateSeek(event) {
        if (!this.audio || isNaN(this.audio.duration)) return;

        const bar = this.$refs.progressBar;
        const rect = bar.getBoundingClientRect();
        const clientX = event.clientX || (event.touches && event.touches[0].clientX);
        
        if (typeof clientX === 'undefined') return;

        let percent = (clientX - rect.left) / bar.offsetWidth;
        percent = Math.max(0, Math.min(1, percent));
        
        this.audio.currentTime = this.audio.duration * percent;
        
        this.progress = percent * 100;
        this.currentTime = this.formatTime(this.audio.currentTime);
      },

      startSeek(event) {
        if (!this.audio) return;
        this.isDragging = true;
        this.wasPlaying = this.isPlaying; 
        if (this.isPlaying) {
          this.audio.pause();
          this.isPlaying = false;
        }
        this.updateSeek(event);
      },

      onDrag(event) {
        if (!this.isDragging) return;
        if (event.cancelable) event.preventDefault();
        this.updateSeek(event);
      },

      stopDrag() {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        
        if (this.audio.ended) {
            this.progress = 100;
            this.isPlaying = false;
        } 
        else if (this.wasPlaying) {
          this.audio.play();
          this.isPlaying = true;
        }
        
        this.wasPlaying = false;
      }
    }
  }

  document.addEventListener('alpine:init', () => {
    Alpine.data('audioPlayer', audioPlayer);
  });
</script>
@endpush