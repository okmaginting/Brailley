document.addEventListener("DOMContentLoaded", () => {
    const playPauseBtn = document.getElementById("tts-play-pause-button");
    const stopBtn = document.getElementById("tts-stop-button");
    const playIcon = document.getElementById("tts-play-icon");
    const pauseIcon = document.getElementById("tts-pause-icon");

    const contentElement = document.querySelector("#article-content");
    // Mengambil h2 atau h3 di dalam #article-body
    const titleElement = document.querySelector("#article-body h2, #article-body h3");
    // Mengambil detail cerita (hidden div)
    const detailSection = document.querySelector(".space-y-3.text-base.text-gray-700");
    // Mengambil penulis artikel
    const articleAuthor = document.querySelector("#article-body p.text-gray-600");

    // Pastikan audio bersih saat halaman baru dimuat
    speechSynthesis.cancel();

    // Jika elemen konten atau judul tidak ada, hentikan script
    if (!contentElement || !titleElement) return;

    let queue = [];
    let currentIndex = 0;
    let isPaused = false;
    let isPlaying = false;

    // ----------------------------------------------------------------------
    // FIX: Hentikan audio saat navigasi Livewire/Turbo (SPA-like)
    // ----------------------------------------------------------------------
    document.addEventListener('livewire:navigating', () => {
        // Panggil fungsi stop total Anda
        stopReading(); 
    });

    // ---------------------------
    // EVENT: SAAT KELUAR HALAMAN / REFRESH (untuk full reload)
    // ---------------------------
    window.addEventListener("beforeunload", () => {
        // Mematikan paksa suara browser saat pindah halaman/refresh
        speechSynthesis.cancel();
    });

    // ---------------------------
    // POTONG TEKS MENJADI KALIMAT
    // ---------------------------
    function splitText(text) {
        // Mengganti multiple spaces dengan satu space, lalu memotong berdasarkan tanda baca
        return text
            .replace(/\s+/g, " ")
            .match(/[^\.!\?]+[\.!\?]+|\S+/g) || [];
    }

    // ---------------------------
    // SUSUN TEKS PEMBACAAN
    // ---------------------------
    function buildReadingText() {
        // Ambil teks judul
        const title = titleElement.innerText.trim();
        let intro = `${title}. `;

        // MODE CERITA KOMUNITAS (Cek jika ada detailSection)
        if (detailSection) {
            // innerText bisa membaca element meski di-style position absolute (asal tidak hidden/display none)
            const detailText = detailSection.innerText
                .replace(/\n+/g, ". ") // Ganti enter dengan titik agar ada jeda
                .trim();
            intro += `${detailText}. `;
        }

        // MODE ARTIKEL (Cek jika ada author section)
        else if (articleAuthor) {
            const author = articleAuthor.innerText.replace("Oleh:", "").trim();
            intro += `Oleh ${author}. `;
        }

        return intro;
    }

    // ---------------------------
    // MULAI MEMBACA (STREAMING)
    // ---------------------------
    function startReading() {
        const introText = buildReadingText();
        const contentText = contentElement.innerText.trim();

        // Gabungkan (Intro + Isi)
        const fullText = introText + " " + contentText;

        // Bagi per kalimat
        queue = splitText(fullText);
        currentIndex = 0;

        isPlaying = true;
        isPaused = false;

        speakChunk();
        updateIcons();
    }

    // ---------------------------
    // BACA SATU KALIMAT
    // ---------------------------
    function speakChunk() {
        if (!isPlaying || isPaused) return;

        // Jika antrian habis
        if (currentIndex >= queue.length) {
            return finishReading();
        }

        const utterance = new SpeechSynthesisUtterance(queue[currentIndex]);
        utterance.lang = "id-ID"; // Set bahasa Indonesia

        // Event saat satu kalimat selesai dibaca
        utterance.onend = () => {
            if (!isPaused && isPlaying) {
                currentIndex++;
                speakChunk(); // Lanjut ke kalimat berikutnya
            }
        };

        // Event saat terjadi error (diperbaiki agar tidak log 'interrupted')
        utterance.onerror = (e) => {
            // HANYA log error yang TIDAK disebabkan oleh pembatalan yang disengaja (saat stop/pause/navigasi)
            if (e.error !== "interrupted") {
                console.error("TTS Error:", e);
            }
        };

        speechSynthesis.speak(utterance);
    }

    // ---------------------------
    // SELESAI MEMBACA
    // ---------------------------
    function finishReading() {
        const endVoice = new SpeechSynthesisUtterance("Terima kasih telah mendengarkan.");
        endVoice.lang = "id-ID";

        endVoice.onend = () => stopReading();
        speechSynthesis.speak(endVoice);
    }

    // ---------------------------
    // UPDATE ICON PLAY/PAUSE
    // ---------------------------
    function updateIcons() {
        if (isPlaying && !isPaused) {
            playIcon.classList.add("hidden");
            pauseIcon.classList.remove("hidden");
        } else {
            playIcon.classList.remove("hidden");
            pauseIcon.classList.add("hidden");
        }
    }

    // ---------------------------
    // STOP TOTAL
    // ---------------------------
    function stopReading() {
        speechSynthesis.cancel(); // Matikan suara browser
        isPlaying = false;
        isPaused = false;
        currentIndex = 0;
        updateIcons();
    }

    // ---------------------------
    // EVENT BUTTON CLICKS
    // ---------------------------
    playPauseBtn.addEventListener("click", () => {
        if (!isPlaying) {
            // 1. Jika belum main, mulai dari awal
            stopReading(); // Reset dulu biar aman
            startReading();
        } else if (isPaused) {
            // 2. Jika pause, resume
            isPaused = false;
            speechSynthesis.resume(); // Resume bawaan browser
            
            // Fallback: Jika resume gagal/buggy, panggil speakChunk untuk melanjutkan
            if (!speechSynthesis.speaking) {
                speakChunk();
            }
        } else {
            // 3. Jika sedang play, pause
            isPaused = true;
            speechSynthesis.cancel(); // Cancel untuk menghentikan ucapan saat ini
            updateIcons();
        }
        updateIcons();
    });

    stopBtn.addEventListener("click", () => stopReading());
});