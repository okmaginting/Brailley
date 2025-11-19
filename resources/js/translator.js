/**
 * Braille Translator & Generator
 * Mendukung:
 * 1. Terjemahan teks Latin ke Unicode Braille
 * 2. Download file .BRF
 * 3. Download gambar cermin (Mirrored) untuk Reglet (A4, 30x27 grid)
 */

function initBrailleTranslator() {
    // 1. Cek ketersediaan elemen (Mencegah error di halaman lain)
    const inputText = document.getElementById('inputText');
    if (!inputText) return;

    // 2. Definisi Elemen
    const brailleOutput = document.getElementById('brailleOutput');
    const downloadBrfBtn = document.getElementById('downloadBrf');
    const downloadImageBtn = document.getElementById('downloadImage');
    const canvas = document.getElementById('brailleCanvas');
    const link = document.getElementById('downloadLink');

    // 3. Peta Braille (Mapping)
    const brailleMap = {
        'a': '⠁', 'b': '⠃', 'c': '⠉', 'd': '⠙', 'e': '⠑', 'f': '⠋', 'g': '⠛', 'h': '⠓', 'i': '⠊', 'j': '⠚',
        'k': '⠅', 'l': '⠇', 'm': '⠍', 'n': '⠝', 'o': '⠕', 'p': '⠏', 'q': '⠟', 'r': '⠗', 's': '⠎', 't': '⠞',
        'u': '⠥', 'v': '⠧', 'w': '⠺', 'x': '⠭', 'y': '⠽', 'z': '⠵',
        '1': '⠁', '2': '⠃', '3': '⠉', '4': '⠙', '5': '⠑', '6': '⠋', '7': '⠛', '8': 'ⓓ', '9': '⠊', '0': '⠚',
        ' ': '⠀', '.': '⠲', ',': '⠂', '?': '⠦', '!': '⠖', '-': '⠤', "'": '⠄', ':': '⠒', ';': '⠆', '/': '⠌',
        '\n': '\n' // Support enter/newline
    };
    const numberSign = '⠼';
    const capitalSign = '⠠';

    // 4. Fungsi Utama: Translate
    function translateToBraille(text) {
        let result = '';
        let isNumber = false;
        
        for (let char of text) {
            // Handle Newline
            if (char === '\n') {
                result += '\n';
                isNumber = false;
                continue;
            }

            const lower = char.toLowerCase();
            
            // Handle Angka
            if (/[0-9]/.test(char)) {
                if (!isNumber) {
                    result += numberSign;
                    isNumber = true;
                }
                result += brailleMap[char] || '';
            } 
            // Handle Huruf/Simbol
            else {
                if (isNumber && char !== '.' && char !== ',') isNumber = false; // Reset number mode kecuali tanda baca angka

                if (/[A-Z]/.test(char)) {
                    result += capitalSign + (brailleMap[lower] || '⠀');
                } else {
                    result += brailleMap[lower] || '⠀';
                }
            }
        }
        return result;
    }

    // 5. Fungsi Helper: Setup Halaman Canvas (Cermin)
    function setupNewPage(ctx, width, height, font) {
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, width, height);
        ctx.save();
        // 
        // Membalik canvas secara horizontal (Mirroring) untuk kebutuhan Reglet
        ctx.translate(width, 0); 
        ctx.scale(-1, 1);        
        ctx.fillStyle = "#000000";
        ctx.font = font;
        ctx.textBaseline = "top"; 
    }

    // --- EVENT LISTENER 1: Input Real-time ---
    // Clone node untuk menghapus listener lama (Livewire safety)
    const newInput = inputText.cloneNode(true);
    inputText.parentNode.replaceChild(newInput, inputText);
    
    newInput.addEventListener('input', () => {
        const translated = translateToBraille(newInput.value);
        brailleOutput.textContent = translated;
        brailleOutput.style.whiteSpace = "pre-wrap"; // Agar enter terbaca di div output
        
        const hasText = newInput.value.trim().length > 0;
        if(downloadBrfBtn) downloadBrfBtn.disabled = !hasText;
        if(downloadImageBtn) downloadImageBtn.disabled = !hasText;
    });

    // --- EVENT LISTENER 2: Download .BRF ---
    if (downloadBrfBtn) {
        downloadBrfBtn.onclick = () => {
            const blob = new Blob([brailleOutput.textContent], { type: 'text/plain;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            link.href = url;
            link.download = 'hasil_braille.brf';
            link.click();
            URL.revokeObjectURL(url);
        };
    }

    // --- EVENT LISTENER 3: Download Gambar Cermin (Logika Utama) ---
    if (downloadImageBtn) {
        downloadImageBtn.onclick = async () => {
            if (typeof JSZip === 'undefined') {
                alert("Library JSZip belum dimuat. Mohon refresh halaman.");
                return;
            }

            // A. Konstanta Ukuran (A4 300 DPI & Reglet)
            const A4_WIDTH = 2480;
            const A4_HEIGHT = 3508;
            const CHARS_PER_LINE = 30; 
            const LINES_PER_PAGE = 27; 
            const MARGIN = 150; 
            
            // Perhitungan Grid
            const PRINT_WIDTH = A4_WIDTH - (MARGIN * 2);
            const PRINT_HEIGHT = A4_HEIGHT - (MARGIN * 2);
            const CELL_WIDTH_PX = PRINT_WIDTH / CHARS_PER_LINE;   
            const LINE_HEIGHT_PX = PRINT_HEIGHT / LINES_PER_PAGE; 
            
            const FONT_SIZE_PX = Math.floor(LINE_HEIGHT_PX * 0.85); // Sedikit lebih kecil dari tinggi baris agar rapi
            const FONT_STYLE = `${FONT_SIZE_PX}px Arial`; // Bisa diganti font Braille jika ada

            // B. Persiapan Canvas
            const allText = brailleOutput.textContent;
            if (!allText) return;

            canvas.width = A4_WIDTH;
            canvas.height = A4_HEIGHT;
            const ctx = canvas.getContext('2d');
            const imagePages = [];

            // C. Pre-processing Text (Memecah menjadi array baris)
            // Kita perlu memecah manual karena canvas tidak otomatis wrap text
            const textLines = [];
            let currentLine = '';
            
            // Split berdasarkan enter (\n) dulu
            const paragraphs = allText.split('\n');
            
            paragraphs.forEach(paragraph => {
                // Pecah paragraf panjang menjadi baris-baris selebar 30 char
                for (let i = 0; i < paragraph.length; i += CHARS_PER_LINE) {
                    textLines.push(paragraph.substring(i, i + CHARS_PER_LINE));
                }
                // Opsional: Tambah baris kosong antar paragraf jika perlu? 
                // textLines.push(''); 
            });

            // D. Rendering Loop
            let lineCounter = 0;
            setupNewPage(ctx, A4_WIDTH, A4_HEIGHT, FONT_STYLE);

            for (let i = 0; i < textLines.length; i++) {
                // Ganti Halaman jika penuh
                if (lineCounter >= LINES_PER_PAGE) {
                    ctx.restore(); // Restore sebelum simpan
                    imagePages.push(canvas.toDataURL("image/png"));
                    
                    setupNewPage(ctx, A4_WIDTH, A4_HEIGHT, FONT_STYLE);
                    lineCounter = 0;
                }

                const currentLineText = textLines[i];
                const y = MARGIN + (lineCounter * LINE_HEIGHT_PX);

                // Gambar per karakter untuk presisi grid
                for (let j = 0; j < currentLineText.length; j++) {
                    const char = currentLineText[j];
                    const charWidth = ctx.measureText(char).width;
                    
                    // Centering karakter di dalam sel grid
                    const x_offset = (CELL_WIDTH_PX - charWidth) / 2;
                    const x = MARGIN + (j * CELL_WIDTH_PX) + x_offset;

                    ctx.fillText(char, x, y);
                }
                lineCounter++;
            }

            // Simpan halaman terakhir
            ctx.restore();
            imagePages.push(canvas.toDataURL("image/png"));

            // E. Proses Download (Single PNG atau ZIP)
            if (imagePages.length === 1) {
                link.href = imagePages[0];
                link.download = 'hasil_braille_cermin.png';
                link.click();
            } else {
                try {
                    const zip = new JSZip();
                    imagePages.forEach((dataUrl, index) => {
                        const base64Data = dataUrl.split(',')[1];
                        zip.file(`halaman_${index + 1}.png`, base64Data, { base64: true });
                    });

                    const zipBlob = await zip.generateAsync({ type: "blob" });
                    const url = URL.createObjectURL(zipBlob);
                    link.href = url;
                    link.download = 'hasil_braille_cermin_pages.zip';
                    link.click();
                    URL.revokeObjectURL(url);
                } catch (error) {
                    console.error("Gagal membuat ZIP:", error);
                    alert("Gagal membuat file ZIP.");
                }
            }
        };
    }
}
document.addEventListener('DOMContentLoaded', initBrailleTranslator);
document.addEventListener('livewire:navigated', initBrailleTranslator);