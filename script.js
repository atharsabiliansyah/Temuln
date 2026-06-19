document.addEventListener('DOMContentLoaded', function() {
    
 
    const splash = document.getElementById('splash-screen');
    const login = document.getElementById('login-section');

   
    setTimeout(function() {
        
        
        splash.style.opacity = '0';
        splash.style.transform = 'scale(0.9)';

        
        setTimeout(function() {
            splash.style.display = 'none'; // Sembunyikan logo total
            login.style.display = 'block'; // Munculkan bungkus form login

            // Beri jeda sangat sebentar agar animasi masuk formnya mulus
            setTimeout(function() {
                login.style.opacity = '1';
                login.style.transform = 'translateY(0)'; // Form naik ke posisi asli
            }, 50);

        }, 800); // 800ms adalah durasi CSS transition yang kita buat tadi

    }, 2000); // Ubah angka 2000 ini kalau mau logonya tampil lebih lama/sebentar


    // =======================================================
    // 2. LOGIKA WARNA TOMBOL LOGIN INTERAKTIF
    // =======================================================
    const inputNim = document.getElementById('nim_email');
    const inputPassword = document.getElementById('password');
    const btnMasuk = document.getElementById('btn-masuk');

    function cekIsiForm() {
        // Kalau kolom NIM dan Password ada isinya (tidak kosong)
        if (inputNim.value.trim() !== '' && inputPassword.value.trim() !== '') {
            btnMasuk.classList.add('aktif');       // Tombol jadi biru
            btnMasuk.removeAttribute('disabled');   // Tombol bisa diklik
        } else {
            // Kalau salah satu kosong
            btnMasuk.classList.remove('aktif');    // Tombol kembali abu-abu
            btnMasuk.setAttribute('disabled', 'true'); // Tombol mati
        }
    }

    // Pasang sensor setiap kali kamu mengetik di keyboard
    inputNim.addEventListener('input', cekIsiForm);
    inputPassword.addEventListener('input', cekIsiForm);
});