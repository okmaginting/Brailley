@extends('layouts.app')

@section('title', 'Dengarkan: ' . $audiobook->judul)

@section('content')
<section class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg relative">

        <div class="flex flex-col-reverse md:flex-row items-start justify-between gap-12 md:gap-16">

            {{-- ============================ --}}
            {{-- KOLOM KIRI: Player & Detail --}}
            {{-- ============================ --}}
            <div class="w-full md:flex-1">

                {{-- Judul --}}
                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] leading-tight break-words">
                    {{ $audiobook->judul }}
                </h2>

                {{-- ============================ --}}
                {{-- BLUE PLAYER (WEB AUDIO)      --}}
                {{-- ============================ --}}
                <div 
                    x-data="blueSpotify('{{ Storage::url($audiobook->file_audio) }}')"
                    x-init="initPlayer()"
                    @mousemove.window="onDrag"
                    @mouseup.window="stopDrag"
                    @touchmove.window="onDrag"
                    @touchend.window="stopDrag"
                    class="mt-10 bg-white p-6 sm:p-8 rounded-3xl shadow-xl shadow-[#05284C]/5 border border-[#05284C]/10 flex flex-col gap-8"
                >
                    {{-- Info Track di dalam Player --}}
                    <div class="flex items-center gap-5">
                        <div class="relative shrink-0">
                             <img src="{{ Storage::url($audiobook->gambar_cover) }}"
                                  class="w-20 h-20 rounded-xl object-cover shadow-md border border-gray-100">
                             {{-- Ikon overlay kecil --}}
                             <div class="absolute -bottom-2 -right-2 bg-[#05284C] text-white rounded-full p-1.5 border-2 border-white">
                                <i class="fa-solid fa-music text-xs"></i>
                             </div>
                        </div>

                        <div class="overflow-hidden">
                            <div class="text-xl font-bold text-[#05284C] truncate">{{ $audiobook->judul }}</div>
                            <div class="text-gray-500 text-sm font-medium truncate">{{ $audiobook->pengisi_audio }}</div>
                        </div>
                    </div>

                    {{-- Controls & Progress --}}
                    <div class="flex flex-col items-center gap-6 w-full">

                        {{-- Tombol Control --}}
                        <div class="flex items-center justify-center gap-8">
                            {{-- Skip Back --}}
                            <button @click="skip(-5)" class="text-gray-400 hover:text-[#05284C] transition-colors text-2xl" title="Mundur 5 detik">
                                <i class="fa-solid fa-backward-step"></i>
                            </button>

                            {{-- Play / Pause --}}
                            <button @click="togglePlay"
                                class="w-16 h-16 rounded-full bg-[#05284C] text-white flex items-center justify-center shadow-lg shadow-[#05284C]/30 hover:scale-105 hover:bg-[#073b6e] transition-all duration-200">
                                <i x-show="!isPlaying" class="fa-solid fa-play text-2xl ml-1"></i>
                                <i x-show="isPlaying" class="fa-solid fa-pause text-2xl"></i>
                            </button>

                            {{-- Skip Forward --}}
                            <button @click="skip(5)" class="text-gray-400 hover:text-[#05284C] transition-colors text-2xl" title="Maju 5 detik">
                                <i class="fa-solid fa-forward-step"></i>
                            </button>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="w-full">
                            <div x-ref="progressBar"
                                 @mousedown="startSeek"
                                 @touchstart="startSeek"
                                 class="w-full h-2 bg-gray-200 rounded-full relative cursor-pointer group">

                                {{-- Fill --}}
                                <div class="h-2 bg-[#05284C] rounded-full relative"
                                     :style="`width: ${progress}%`">
                                     {{-- Knob (muncul saat hover group atau seeking) --}}
                                     <div class="absolute right-0 top-1/2 -mt-2 w-4 h-4 bg-white border-2 border-[#05284C] rounded-full shadow-sm transform scale-0 group-hover:scale-100 transition-transform duration-200"
                                          :class="{'scale-100': isSeeking}"></div>
                                </div>
                            </div>
                            
                            {{-- Waktu --}}
                            <div class="flex justify-between text-xs font-bold text-gray-400 mt-2 uppercase tracking-wider">
                                <span x-text="currentTime">0:00</span>
                                <span x-text="totalTime">0:00</span>
                            </div>
                        </div>

                        {{-- Speed Button --}}
                        <div class="w-full flex justify-end">
                            <button @click="changeSpeed"
                                class="px-3 py-1 rounded-lg bg-gray-100 text-[#05284C] hover:bg-gray-200 text-xs font-bold uppercase tracking-wide transition-colors">
                                Speed: <span x-text="speed + 'x'"></span>
                            </button>
                        </div>

                    </div>
                </div>

                {{-- ============================ --}}
                {{-- DETAIL AUDIOBOOK (GRID)      --}}
                {{-- ============================ --}}
                <div class="mt-12 border-t border-[#05284C]/10 pt-8">
                    <h3 class="text-xl font-bold text-[#05284C] mb-6 flex items-center gap-2">
                        <i data-lucide="info" class="w-5 h-5"></i> Detail Audiobook
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-8 text-base text-gray-700">
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Penulis</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $audiobook->penulis }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 uppercase font-semibold tracking-wide mb-1">Narator</span>
                            <span class="font-medium text-[#05284C] text-lg">{{ $audiobook->pengisi_audio }}</span>
                        </div>
                        {{-- Bisa ditambah kolom lain jika ada, misal: Penerbit, Tahun, dll --}}
                    </div>
                </div>

            </div>

            {{-- ============================ --}}
            {{-- KOLOM KANAN: Cover Besar     --}}
            {{-- ============================ --}}
            <div class="w-full md:w-auto flex justify-center md:justify-end flex-shrink-0">
                <div class="w-[280px] md:w-[340px]">
                     <img src="{{ Storage::url($audiobook->gambar_cover) }}" 
                          class="rounded-2xl shadow-xl w-full aspect-[3/4] object-cover border-4 border-white">
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/wavesurfer.js"></script>
<script>
document.addEventListener("alpine:init", () => {
    Alpine.data("blueSpotify", (fileUrl) => ({
        wavesurfer: null,
        isPlaying: false,
        progress: 0,
        speed: 1,
        isSeeking: false,
        currentTime: "0:00",
        totalTime: "0:00",

        initPlayer() {
            this.wavesurfer = WaveSurfer.create({
                container: document.createElement("div"),
                waveColor: '#1D5BFF', // Warna wave (tidak ditampilkan visual barWidth 0, tapi butuh utk logic)
                progressColor: '#05284C',
                cursorColor: 'transparent',
                height: 0, // Hidden wave
                backend: "webaudio",
                barWidth: 0,
                interact: false
            });

            this.wavesurfer.load(fileUrl);

            this.wavesurfer.on("ready", () => {
                this.totalTime = this.format(this.wavesurfer.getDuration());
            });

            this.wavesurfer.on("audioprocess", () => {
                if (!this.isSeeking) {
                    const t = this.wavesurfer.getCurrentTime();
                    this.currentTime = this.format(t);
                    this.progress = (t / this.wavesurfer.getDuration()) * 100;
                }
            });

            this.wavesurfer.on("finish", () => {
                this.isPlaying = false;
                this.progress = 100;
            });
        },

        togglePlay() {
            this.wavesurfer.playPause();
            this.isPlaying = !this.isPlaying;
        },

        skip(sec) {
            const dur = this.wavesurfer.getDuration();
            let t = this.wavesurfer.getCurrentTime() + sec;
            t = Math.max(0, Math.min(t, dur));

            this.wavesurfer.setTime(t);
            this.currentTime = this.format(t);
            this.progress = (t / dur) * 100;
        },

        changeSpeed() {
            const speeds = [1, 1.25, 1.5, 1.75, 2];
            const i = speeds.indexOf(this.speed);
            this.speed = speeds[(i + 1) % speeds.length];
            this.wavesurfer.setPlaybackRate(this.speed);
        },

        format(t) {
            if (!t) return "0:00";
            const m = Math.floor(t / 60);
            const s = Math.floor(t % 60).toString().padStart(2, "0");
            return `${m}:${s}`;
        },

        /* Seek bar drag */
        startSeek(e) {
            this.isSeeking = true;
            this.seek(e);
        },

        stopDrag() { 
            this.isSeeking = false; 
        },

        onDrag(e) {
            if (this.isSeeking) this.seek(e);
        },

        seek(e) {
            const bar = this.$refs.progressBar;
            const rect = bar.getBoundingClientRect();
            const x = e.touches ? e.touches[0].clientX : e.clientX;

            let percent = ((x - rect.left) / rect.width) * 100;
            percent = Math.max(0, Math.min(100, percent));

            this.progress = percent;

            const dur = this.wavesurfer.getDuration();
            const t = (percent / 100) * dur;

            this.wavesurfer.setTime(t);
            this.currentTime = this.format(t);
        }
    }));
});
</script>
@endpush