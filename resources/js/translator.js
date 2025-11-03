document.addEventListener("DOMContentLoaded", () => {
    // Elemen spesifik halaman
    const inputText = document.getElementById('inputText');
    const brailleOutput = document.getElementById('brailleOutput');
    const downloadBrfBtn = document.getElementById('downloadBrf');
    const downloadImageBtn = document.getElementById('downloadImage');
    const canvas = document.getElementById('brailleCanvas');
    const link = document.getElementById('downloadLink');

    // --- PETA BRAILLE (Sama seperti sebelumnya) ---
    const brailleMap = {'a':'⠁','b':'⠃','c':'⠉','d':'⠙','e':'⠑','f':'⠋','g':'⠛','h':'⠓','i':'⠊','j':'⠚','k':'⠅','l':'⠇','m':'⠍','n':'⠝','o':'⠕','p':'⠏','q':'⠟','r':'⠗','s':'⠎','t':'⠞','u':'⠥','v':'⠧','w':'⠺','x':'⠭','y':'⠽','z':'⠵','1':'⠁','2':'⠃','3':'⠉','4':'⠙','5':'⠑','6':'⠋','7':'⠛','8':'ⓓ','9':'⠊','0':'⠚',' ':'⠀','.':'⠲',',':'⠂','?':'⠦','!':'⠖','-':'⠤',"'":'⠄',':':'⠒',';':'⠆','/':'⠌'};
    const numberSign = '⠼';
    const capitalSign = '⠠';

    // --- FUNGSI TRANSLATE (Sama seperti sebelumnya) ---
    function translateToBraille(text) {
        let result = '';
        let isNumber = false;
        for (let char of text) {
            const lower = char.toLowerCase();
            if (/[0-9]/.test(char)) {
                if (!isNumber) { result += numberSign; isNumber = true; }
                result += brailleMap[char];
            } else {
                if (isNumber) isNumber = false;
                if (/[A-Z]/.test(char)) result += capitalSign + (brailleMap[lower] || '⠀');
                else result += brailleMap[lower] || '⠀';
            }
        }
        return result;
    }

    // --- EVENT LISTENER INPUT (Sama seperti sebelumnya) ---
    inputText.addEventListener('input', () => {
        const translated = translateToBraille(inputText.value);
        brailleOutput.textContent = translated;
        const hasText = inputText.value.trim().length > 0;
        downloadBrfBtn.disabled = !hasText;
        downloadImageBtn.disabled = !hasText;
    });

    // --- EVENT LISTENER .BRF (Sama seperti sebelumnya) ---
    downloadBrfBtn.addEventListener('click', () => {
        const blob = new Blob([brailleOutput.textContent], { type: 'text/plain;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = 'hasil_braille.brf';
        link.click();
        URL.revokeObjectURL(url);
    });

    // === LOGIKA BARU UNTUK UNDUH GAMBAR (REGLET 27x30) ===

    /**
     * Helper function untuk menyiapkan halaman baru di canvas.
     */
    function setupNewPage(ctx, width, height, font) {
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, width, height);
        ctx.save();
        ctx.translate(width, 0); // Pindah ke kanan atas
        ctx.scale(-1, 1);        // Balik horizontal (cermin)
        ctx.fillStyle = "#000000";
        ctx.font = font;
        ctx.textBaseline = "top"; // Penting agar 'y' adalah 'top'
    }

    /**
     * Event listener utama untuk "Unduh Gambar Cermin"
     */
    downloadImageBtn.addEventListener('click', async () => {
        if (typeof JSZip === 'undefined') {
            alert("Error: Gagal memuat library JSZip. Tidak dapat membuat file .zip.");
            console.error("JSZip library is missing. Please include it in your project.");
            return;
        }

        // --- 1. Definisi Konstanta Halaman & Reglet ---
        
        // Ukuran A4 dalam piksel (300 DPI)
        const A4_WIDTH = 2480;
        const A4_HEIGHT = 3508;

        // *** PERUBAHAN DIMULAI DI SINI ***

        // Spesifikasi Reglet (FIXED)
        const CHARS_PER_LINE = 30; // 30 kotak/sel per baris
        const LINES_PER_PAGE = 27; // 27 baris per halaman

        // Margin (FIXED & SAMA RATA)
        const MARGIN = 150; // 150px (sekitar 1.27cm), sama di semua sisi
        const MARGIN_TOP = MARGIN;
        const MARGIN_BOTTOM = MARGIN;
        const MARGIN_LEFT = MARGIN;
        const MARGIN_RIGHT = MARGIN;

        // Area yang bisa dicetak (Dihitung)
        const PRINT_WIDTH = A4_WIDTH - MARGIN_LEFT - MARGIN_RIGHT; // 2480 - 300 = 2180px
        const PRINT_HEIGHT = A4_HEIGHT - MARGIN_TOP - MARGIN_BOTTOM; // 3508 - 300 = 3208px

        // Ukuran Sel Braille (Dihitung)
        const CELL_WIDTH_PX = PRINT_WIDTH / CHARS_PER_LINE;   // 2180 / 30 = 72.67px
        const LINE_HEIGHT_PX = PRINT_HEIGHT / LINES_PER_PAGE; // 3208 / 27 = 118.81px (ini ~10mm!)

        // Font & Styling (Dihitung)
        // Kita set ukuran font agar pas dengan tinggi baris
        const FONT_SIZE_PX = Math.floor(LINE_HEIGHT_PX); // -> 118px
        const FONT_STYLE = `${FONT_SIZE_PX}px Arial`;
        
        // *** PERUBAHAN SELESAI ***


        // --- 2. Persiapan Data & Canvas ---
        
        const allText = brailleOutput.textContent;
        if (!allText) return;

        canvas.width = A4_WIDTH;
        canvas.height = A4_HEIGHT;
        const ctx = canvas.getContext('2d');
        
        const imagePages = [];

        // Bagi semua teks menjadi baris-baris berdasarkan CHARS_PER_LINE (30)
        const textLines = [];
        for (let i = 0; i < allText.length; i += CHARS_PER_LINE) {
            textLines.push(allText.substring(i, i + CHARS_PER_LINE));
        }

        // --- 3. Proses Pagination (Menggambar Halaman) ---

        let lineCounter = 0; // Menghitung baris di halaman saat ini (0 s/d 26)
        setupNewPage(ctx, A4_WIDTH, A4_HEIGHT, FONT_STYLE); // Siapkan halaman pertama

        for (let i = 0; i < textLines.length; i++) {
            
            // Cek apakah halaman sudah penuh (sudah 27 baris)
            if (lineCounter >= LINES_PER_PAGE) {
                ctx.restore(); // Balikkan mode cermin
                imagePages.push(canvas.toDataURL("image/png")); // Simpan halaman
                
                // Siapkan halaman baru
                setupNewPage(ctx, A4_WIDTH, A4_HEIGHT, FONT_STYLE);
                lineCounter = 0; // Reset penghitung baris
            }

            // Dapatkan baris teks saat ini (isi maks 30 karakter)
            const currentLineText = textLines[i];
            
            // Hitung posisi Y (atas) untuk baris ini
            const y = MARGIN_TOP + (lineCounter * LINE_HEIGHT_PX);

            // *** LOGIKA GAMBAR BARU: GAMBAR SATU PER SATU KARAKTER ***
            for (let j = 0; j < currentLineText.length; j++) {
                const char = currentLineText[j];
                
                // Ukur lebar karakter spesifik ini
                const charWidth = ctx.measureText(char).width;
                
                // Hitung offset agar karakter ada di TENGAH sel-nya
                const x_offset = (CELL_WIDTH_PX - charWidth) / 2;
                
                // Hitung posisi X (kiri) untuk sel ini
                const x = MARGIN_LEFT + (j * CELL_WIDTH_PX) + x_offset;

                // Gambar karakter
                ctx.fillText(char, x, y);
            }
            
            lineCounter++; // Pindah ke baris berikutnya
        }

        // Simpan halaman terakhir (yang mungkin tidak penuh)
        ctx.restore();
        imagePages.push(canvas.toDataURL("image/png"));

        // --- 4. Proses Unduh (ZIP atau PNG Tunggal) ---

        if (imagePages.length === 1) {
            link.href = imagePages[0];
            link.download = 'hasil_braille_cermin.png';
            link.click();
        } 
        else {
            try {
                const zip = new JSZip();
                
                imagePages.forEach((dataUrl, index) => {
                    const base64Data = dataUrl.split(',')[1];
                    const fileName = `(${index + 1}).png`;
                    zip.file(fileName, base64Data, { base64: true });
                });

                const zipBlob = await zip.generateAsync({ type: "blob" });
                
                const url = URL.createObjectURL(zipBlob);
                link.href = url;
                link.download = 'hasil_braille_cermin.zip';
                link.click();
                URL.revokeObjectURL(url);

            } catch (error) {
                console.error("Gagal membuat file .zip:", error);
                alert("Terjadi kesalahan saat membuat file .zip.");
            }
        }
    });
});