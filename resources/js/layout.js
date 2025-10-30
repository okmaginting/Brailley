document.addEventListener("DOMContentLoaded", () => {
            const desktopMenuBtn = document.getElementById('desktopMenuBtn');
            const desktopMenuDropdown = document.getElementById('desktopMenuDropdown');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenuDropdown = document.getElementById('mobileMenuDropdown');

            // Toggle dropdown desktop
            if (desktopMenuBtn && desktopMenuDropdown) {
                desktopMenuBtn.addEventListener('click', () => {
                    desktopMenuDropdown.style.display = desktopMenuDropdown.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Toggle dropdown mobile
            if (mobileMenuBtn && mobileMenuDropdown) {
                mobileMenuBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    mobileMenuDropdown.style.display = mobileMenuDropdown.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Menutup dropdown saat klik di luar
            document.addEventListener('click', e => {
                if (desktopMenuDropdown && desktopMenuBtn && !desktopMenuBtn.contains(e.target) && !desktopMenuDropdown.contains(e.target)) {
                    desktopMenuDropdown.style.display = 'none';
                }
                if (mobileMenuDropdown && mobileMenuBtn && !mobileMenuBtn.contains(e.target) && !mobileMenuDropdown.contains(e.target)) {
                    mobileMenuDropdown.style.display = 'none';
                }
            });

            // Inisialisasi Ikon Lucide
            lucide.createIcons();
        });