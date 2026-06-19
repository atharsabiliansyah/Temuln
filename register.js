document.addEventListener('DOMContentLoaded', function() {
    
    // Mengambil semua elemen input dari form registrasi
    const inputNim = document.getElementById('nim');
    const inputNama = document.getElementById('nama');
    const inputEmail = document.getElementById('email');
    const inputPassword = document.getElementById('password');
    const btnDaftar = document.getElementById('btn-daftar');

    function cekIsiForm() {
        // Cek apakah KEEMPAT kolom sudah diisi (tidak kosong)
        if (
            inputNim.value.trim() !== '' && 
            inputNama.value.trim() !== '' && 
            inputEmail.value.trim() !== '' && 
            inputPassword.value.trim() !== ''
        ) {
            btnDaftar.classList.add('aktif');       // Tombol jadi biru gelap
            btnDaftar.removeAttribute('disabled');   // Tombol bisa diklik
        } else {
            btnDaftar.classList.remove('aktif');    // Tombol kembali abu-abu
            btnDaftar.setAttribute('disabled', 'true'); // Tombol mati
        }
    }

    // Pasang sensor pengetikan di keempat kolom
    inputNim.addEventListener('input', cekIsiForm);
    inputNama.addEventListener('input', cekIsiForm);
    inputEmail.addEventListener('input', cekIsiForm);
    inputPassword.addEventListener('input', cekIsiForm);
});