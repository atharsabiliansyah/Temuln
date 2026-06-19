document.addEventListener('DOMContentLoaded', function() {
    
    
    const inputNim = document.getElementById('nim');
    const inputNama = document.getElementById('nama');
    const inputEmail = document.getElementById('email');
    const inputPassword = document.getElementById('password');
    const btnDaftar = document.getElementById('btn-daftar');

    function cekIsiForm() {
        
        if (
            inputNim.value.trim() !== '' && 
            inputNama.value.trim() !== '' && 
            inputEmail.value.trim() !== '' && 
            inputPassword.value.trim() !== ''
        ) {
            btnDaftar.classList.add('aktif');      
            btnDaftar.removeAttribute('disabled');   
        } else {
            btnDaftar.classList.remove('aktif');   
            btnDaftar.setAttribute('disabled', 'true'); 
        }
    }

    
    inputNim.addEventListener('input', cekIsiForm);
    inputNama.addEventListener('input', cekIsiForm);
    inputEmail.addEventListener('input', cekIsiForm);
    inputPassword.addEventListener('input', cekIsiForm);
});