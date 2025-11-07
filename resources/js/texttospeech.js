document.addEventListener('DOMContentLoaded', () => {
      // Cek dukungan browser
      if (!('speechSynthesis' in window)) {
        console.error('Browser Anda tidak mendukung Text-to-Speech.');
        // Coba sembunyikan tombol jika tidak didukung
        const playButton = document.getElementById('tts-play-pause-button');
        if(playButton) playButton.style.display = 'none';
        const stopButton = document.getElementById('tts-stop-button');
        if(stopButton) stopButton.style.display = 'none';
        return;
      }

      const synth = window.speechSynthesis;
      let utterance = null; // Variabel untuk menyimpan objek ucapan
      
      // MENGGUNAKAN LOGIKA 'isPaused' ANDA
      let isPaused = false; 

      // Ambil elemen dari DOM
      const ttsPlayPauseButton = document.getElementById('tts-play-pause-button');
      const ttsStopButton = document.getElementById('tts-stop-button');
      const playIcon = document.getElementById('tts-play-icon');
      const pauseIcon = document.getElementById('tts-pause-icon');
      const articleBody = document.getElementById('article-body');

      // Guard clause: Pastikan semua elemen ada
      if (!ttsPlayPauseButton || !ttsStopButton || !playIcon || !pauseIcon || !articleBody) {
        return; 
      }

      // Fungsi untuk menampilkan ikon yang sesuai
      const showPlayIcon = () => {
        if (playIcon && pauseIcon) { // Tambahkan cek null
          playIcon.classList.remove('hidden');
          pauseIcon.classList.add('hidden');
        }
      };

      const showPauseIcon = () => {
        if (playIcon && pauseIcon) { // Tambahkan cek null
          playIcon.classList.add('hidden');
          pauseIcon.classList.remove('hidden');
        }
      };

      // Tambahkan event listener ke tombol Play/Pause (LOGIKA DARI ANDA)
      ttsPlayPauseButton.addEventListener('click', () => {
        // Kasus 1: Mulai bicara (pertama kali klik atau setelah di-stop)
        if (!utterance) {
          
          // --- MODIFIKASI: Mengambil SEMUA teks dari 'article-body' ---
          const textToSpeak = articleBody.textContent;
          // --- Akhir Modifikasi ---

          if (textToSpeak.trim().length === 0) return; 

          // Buat objek ucapan baru
          utterance = new SpeechSynthesisUtterance(textToSpeak);
          utterance.lang = 'id-ID'; 
          
          // Event handler ketika ucapan selesai SECARA ALAMI
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
        // Kasus 2: Ucapan sedang aktif (berbicara atau sedang dijeda)
        else {
          // Jika tidak sedang di-pause, maka pause-kan
          if (!isPaused) {
            synth.pause();
            isPaused = true;
            showPlayIcon();
          } 
          // Jika sedang di-pause, maka lanjutkan
          else {
            synth.resume();
            isPaused = false;
            showPauseIcon();
          }
        }
      });

      // Tambahkan event listener ke tombol Stop (LOGIKA DARI ANDA)
      ttsStopButton.addEventListener('click', () => {
        if (synth.speaking) { 
          synth.cancel(); // Berhenti berbicara
        }
        
        // Reset status secara manual (sesuai kode Anda)
        showPlayIcon();
        utterance = null;
        isPaused = false;
      });

      // Pastikan untuk menghentikan ucapan jika pengguna meninggalkan halaman
      window.addEventListener('beforeunload', () => {
        if (synth.speaking) {
          synth.cancel();
        }
      });
});