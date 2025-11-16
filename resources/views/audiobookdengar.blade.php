@extends('layouts.app')

@section('title', 'Dengarkan: ' . $audiobook->judul)

@section('content')
<section class="flex justify-center items-start px-6 md:px-10 pt-[180px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[40px] w-full max-w-7xl p-8 md:p-16 shadow-lg">

        <div class="flex flex-col-reverse md:flex-row items-start justify-center gap-10 md:gap-16">

            {{-- ============================ --}}
            {{-- KOLOM KIRI --}}
            {{-- ============================ --}}
            <div class="w-full md:max-w-prose">

                <h2 class="text-4xl lg:text-5xl font-extrabold text-[#05284C] break-words">
                    {{ $audiobook->judul }}
                </h2>

                {{-- ============================ --}}
                {{-- NEW BLUE PLAYER (WEB AUDIO) --}}
                {{-- ============================ --}}
                <div 
                    x-data="blueSpotify('{{ Storage::url($audiobook->file_audio) }}')"
                    x-init="initPlayer()"
                    @mousemove.window="onDrag"
                    @mouseup.window="stopDrag"
                    @touchmove.window="onDrag"
                    @touchend.window="stopDrag"
                    class="mt-10 bg-white p-6 rounded-2xl shadow-lg border border-gray-200 flex flex-col gap-6"
                >
                    <div class="flex items-center gap-4">
                        <img src="{{ Storage::url($audiobook->gambar_cover) }}"
                             class="w-20 h-20 rounded-lg object-cover shadow-lg">

                        <div>
                            <div class="text-xl font-bold text-[#05284C]">{{ $audiobook->judul }}</div>
                            <div class="text-gray-600">{{ $audiobook->pengisi_audio }}</div>
                        </div>
                    </div>

                    <div class="flex flex-col items-center gap-4">

                        {{-- Buttons --}}
                        <div class="flex items-center gap-6">

                            <button @click="skip(-5)" class="text-[#05284C] text-2xl hover:text-black">
                                <i class="fa-solid fa-backward"></i>
                            </button>

                            <button @click="togglePlay"
                                class="w-16 h-16 rounded-full bg-[#1D5BFF] flex items-center justify-center shadow-lg hover:scale-105 transition">
                                <i x-show="!isPlaying" class="fa-solid fa-play text-white text-2xl ml-1"></i>
                                <i x-show="isPlaying" class="fa-solid fa-pause text-white text-2xl"></i>
                            </button>

                            <button @click="skip(5)" class="text-[#05284C] text-2xl hover:text-black">
                                <i class="fa-solid fa-forward"></i>
                            </button>

                        </div>

                        {{-- Progress Bar --}}
                        <div class="w-full">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span x-text="currentTime">0:00</span>
                                <span x-text="totalTime">0:00</span>
                            </div>

                            <div x-ref="progressBar"
                                 @mousedown="startSeek"
                                 @touchstart="startSeek"
                                 class="w-full h-2 bg-gray-300 rounded-full relative cursor-pointer">

                                <div class="h-2 bg-[#1D5BFF] rounded-full"
                                     :style="`width: ${progress}%`"></div>

                                <div class="absolute top-1/2 -mt-2 w-4 h-4 bg-white border-2 border-[#1D5BFF] rounded-full shadow -ml-2"
                                     :style="`left: calc(${progress}% )`"></div>
                            </div>
                        </div>

                        {{-- Speed Button --}}
                        <button @click="changeSpeed"
                            class="px-4 py-1 rounded-full bg-gray-200 text-[#05284C] hover:bg-gray-300 text-sm font-semibold">
                            <span x-text="speed + 'x'"></span>
                        </button>

                    </div>
                </div>

                {{-- DETAIL --}}
                <div class="mt-10 pt-6 border-t border-gray-300">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Detail Buku</h3>
                    <p><span class="font-semibold">Penulis:</span> {{ $audiobook->penulis }}</p>
                    <p><span class="font-semibold">Narator:</span> {{ $audiobook->pengisi_audio }}</p>
                </div>
            </div>

            {{-- ============================ --}}
            {{-- KOLOM KANAN --}}
            {{-- ============================ --}}
            <div class="flex-shrink-0">
                <div class="w-full max-w-[340px]">
                    <img src="{{ Storage::url($audiobook->gambar_cover) }}" 
                         class="rounded-xl shadow-2xl w-full aspect-[3/4] object-cover">
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
                waveColor: '#1D5BFF',
                progressColor: '#05284C',
                cursorColor: 'transparent',
                height: 0,
                backend: "webaudio",      // 🔥 FIX SKIP BUG
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

            this.wavesurfer.setTime(t);   // 🔥 PURE SEEK
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

        stopDrag() { this.isSeeking = false; },

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
