document.addEventListener('DOMContentLoaded', () => {
      // Cek dukungan browser
      if (!('speechSynthesis' in window)) {
        console.error('Browser Anda tidak mendukung Text-to-Speech.');
        // Sembunyikan tombol
        const ttsContainer = document.getElementById('tts-play-pause-button')?.parentElement;
        if (ttsContainer) ttsContainer.style.display = 'none';
        return;
      }

      const synth = window.speechSynthesis;
      let utterance = null;
      let isPaused = false; 

      // Ambil tombol
      const ttsPlayPauseButton = document.getElementById('tts-play-pause-button');
      const ttsStopButton = document.getElementById('tts-stop-button');
      const playIcon = document.getElementById('tts-play-icon');
      const pauseIcon = document.getElementById('tts-pause-icon');

      // --- LOGIKA BARU YANG FLEKSIBEL ---
      // Kita cek kedua skenario halaman
      const infoLegacy = document.getElementById('article-body');
      const contentLegacy = document.getElementById('article-content');

      const infoNew = document.getElementById('tts-info');
      const contentNew = document.getElementById('article-body'); // Di halaman baru, #article-body adalah ISI
      const authorNew = document.getElementById('tts-author');

      // Guard clause
      if (!ttsPlayPauseButton || !ttsStopButton || !playIcon || !pauseIcon) {
        console.error("Elemen tombol TTS tidak ditemukan.");
        return; 
      }

      // Fungsi untuk menampilkan ikon
      const showPlayIcon = () => {
        if (playIcon && pauseIcon) {
          playIcon.classList.remove('hidden');
          pauseIcon.classList.add('hidden');
        }
      };
      const showPauseIcon = () => {
        if (playIcon && pauseIcon) {
          playIcon.classList.add('hidden');
          pauseIcon.classList.remove('hidden');
        }
      };

      ttsPlayPauseButton.addEventListener('click', () => {
        if (!utterance) {
          let textToSpeak = "";

          // Cek apakah ini Halaman Artikel (Struktur Lama)
          if (infoLegacy && contentLegacy) {
            console.log("Mode TTS: Halaman Artikel (Lama)");
            textToSpeak = infoLegacy.textContent.trim() + " . " + contentLegacy.textContent.trim();
          } 
          // Cek apakah ini Halaman Cerita (Struktur Baru)
          else if (infoNew && contentNew) {
            console.log("Mode TTS: Halaman Cerita (Baru)");
            // Ambil Judul, Penulis (jika ada), dan Isi
            const title = infoNew.querySelector('h2')?.textContent.trim() || "";
            const author = authorNew?.textContent.trim() || "";
            const content = contentNew.textContent.trim();
            
            textToSpeak = title + " . " + author + " . " + content;
          } 
          // Fallback jika tidak ada yang cocok
          else if (infoLegacy) {
            console.warn("Mode TTS: Fallback (Hanya #article-body)");
            textToSpeak = infoLegacy.textContent.trim();
          } else {
            console.error("Tidak ada konten yang bisa dibaca. Cek ID tts-info, article-body, atau article-content.");
            return;
          }

          // Bersihkan label "Text-to-Speech:"
          textToSpeak = textToSpeak.replace(/Text-to-Speech:/gi, '');
          
          if (textToSpeak.trim().length === 0) return; 

          // Buat objek ucapan
          utterance = new SpeechSynthesisUtterance(textToSpeak);
          utterance.lang = 'id-ID'; 
          
          utterance.onend = () => {
            if (utterance) { 
               showPlayIcon();
              utterance = null;
              isPaused = false;
            }
          };

          // Mulai berbicara
          synth.speak(utterance);
          showPauseIcon();
          isPaused = false;
        } 
        // Kasus 2: Pause/Resume
        else {
          if (!isPaused) {
            synth.pause();
            isPaused = true;
            showPlayIcon();
          } else {
            synth.resume();
            isPaused = false;
            showPauseIcon();
          }
        }
      });

      // Event listener tombol Stop
      ttsStopButton.addEventListener('click', () => {
        if (synth.speaking) { 
          synth.cancel(); 
        }
        showPlayIcon();
        utterance = null;
        isPaused = false;
      });

      // Berhenti bicara saat pindah halaman
      window.addEventListener('beforeunload', () => {
        if (synth.speaking) {
          synth.cancel();
        }
      });
});