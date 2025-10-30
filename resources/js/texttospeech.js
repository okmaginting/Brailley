document.addEventListener('DOMContentLoaded', () => {
      // Cek dukungan browser
      if (!('speechSynthesis' in window)) {
        console.error('Browser Anda tidak mendukung Text-to-Speech.');
        const ttsContainer = document.querySelector('.flex.items-center.gap-4.ml-6.my-4'); // Selektor untuk kontainer
        if(ttsContainer) {
          ttsContainer.style.display = 'none'; // Sembunyikan tombol jika tidak didukung
        }
        return;
      }

      const synth = window.speechSynthesis;
      let utterance = null; // Variabel untuk menyimpan objek ucapan
      let isPaused = false; // Penanda internal untuk status pause

      // Ambil elemen dari DOM
      const ttsPlayPauseButton = document.getElementById('tts-play-pause-button');
      const ttsStopButton = document.getElementById('tts-stop-button');
      
      // PERBAIKAN: Ambil elemen <span> wrapper, bukan <i>
      const playIcon = document.getElementById('tts-play-icon');
      const pauseIcon = document.getElementById('tts-pause-icon');
      
      const articleBody = document.getElementById('article-body');

      // Fungsi untuk menampilkan ikon yang sesuai
      // Fungsi ini sekarang akan bekerja karena 'playIcon' dan 'pauseIcon' merujuk ke <span>
      const showPlayIcon = () => {
        playIcon.classList.remove('hidden');
        pauseIcon.classList.add('hidden');
      };

      const showPauseIcon = () => {
        playIcon.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
      };

      // Tambahkan event listener ke tombol Play/Pause
      ttsPlayPauseButton.addEventListener('click', () => {
        // Kasus 1: Mulai bicara (pertama kali klik atau setelah di-stop)
        if (!utterance) {
          // Kumpulkan semua teks
          const paragraphs = articleBody.querySelectorAll('p.text-gray-700');
          const textToSpeak = Array.from(paragraphs)
                                   .map(p => p.textContent)
                                   .join(' ');

          if (textToSpeak.trim().length === 0) return; 

          // Buat objek ucapan baru
          utterance = new SpeechSynthesisUtterance(textToSpeak);
          utterance.lang = 'id-ID'; 
          
          // Event handler ketika ucapan selesai SECARA ALAMI
          utterance.onend = () => {
            // Kita cek 'utterance' untuk memastikan 'cancel' tidak memicu ini
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
        // Logika ini akan mengubah ikon dengan benar
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

      // Tambahkan event listener ke tombol Stop
      ttsStopButton.addEventListener('click', () => {
        // Cek 'speaking' karena nilainya true bahkan saat dijeda
        if (synth.speaking) { 
          synth.cancel(); // Berhenti berbicara
        }
        
        // PERBAIKAN: Reset status secara manual setelah 'cancel'
        // Ini untuk mengatasi bug di mana 'onend' tidak terpicu
        // dan 'utterance' tidak di-reset.
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