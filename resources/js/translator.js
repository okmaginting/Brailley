document.addEventListener("DOMContentLoaded", () => {
    // Elemen spesifik halaman
    const inputText = document.getElementById('inputText');
    const brailleOutput = document.getElementById('brailleOutput');
    const downloadBrfBtn = document.getElementById('downloadBrf');
    const downloadImageBtn = document.getElementById('downloadImage');
    const canvas = document.getElementById('brailleCanvas');
    const link = document.getElementById('downloadLink');

    // Braille mapping (memperbaiki typo 'h')
    const brailleMap = {'a':'⠁','b':'⠃','c':'⠉','d':'⠙','e':'⠑','f':'⠋','g':'⠛','h':'⠓','i':'⠊','j':'⠚','k':'⠅','l':'⠇','m':'⠍','n':'⠝','o':'⠕','p':'⠏','q':'⠟','r':'⠗','s':'⠎','t':'⠞','u':'⠥','v':'⠧','w':'⠺','x':'⠭','y':'⠽','z':'⠵','1':'⠁','2':'⠃','3':'⠉','4':'⠙','5':'⠑','6':'⠋','7':'⠛','8':'⠓','9':'⠊','0':'⠚',' ':'⠀','.':'⠲',',':'⠂','?':'⠦','!':'⠖','-':'⠤',"'":'⠄',':':'⠒',';':'⠆','/':'⠌'};
    const numberSign = '⠼';
    const capitalSign = '⠠';

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

    inputText.addEventListener('input', () => {
        const translated = translateToBraille(inputText.value);
        brailleOutput.textContent = translated;
        const hasText = inputText.value.trim().length > 0;
        downloadBrfBtn.disabled = !hasText;
        downloadImageBtn.disabled = !hasText;
    });

    downloadBrfBtn.addEventListener('click', () => {
        const blob = new Blob([brailleOutput.textContent], { type: 'text/plain;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.download = 'hasil_braille.brf';
        link.click();
        URL.revokeObjectURL(url);
    });

    downloadImageBtn.addEventListener('click', () => {
        const text = brailleOutput.textContent;
        const canvasWidth = 2480;
        const canvasHeight = 3508;
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;

        const ctx = canvas.getContext('2d');
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, canvasWidth, canvasHeight);
        ctx.save();
        ctx.translate(canvasWidth, 0);
        ctx.scale(-1, 1);
        ctx.fillStyle = "#000000";
        ctx.font = "150px Arial";
        ctx.textBaseline = "top";

        let x = 100, y = 100;
        const maxWidth = canvasWidth - 200;
        const lineHeight = 225;
        let currentLine = "";

        for (let i = 0; i < text.length; i++) {
            currentLine += text[i];
            if (ctx.measureText(currentLine).width > maxWidth || text[i] === "\n") {
                // Gambar baris yang sudah penuh
                ctx.fillText(currentLine.substring(0, currentLine.length - 1).trim(), x, y);
                y += lineHeight;
                currentLine = text[i]; // Mulai baris baru dengan karakter saat ini
                if (y + lineHeight > canvasHeight - 100) break;
            }
        }
        if (currentLine.trim() !== "") ctx.fillText(currentLine.trim(), x, y); // Gambar baris terakhir

        ctx.restore();
        link.href = canvas.toDataURL("image/png");
        link.download = 'hasil_braille_cermin.png';
        link.click();
    });
});