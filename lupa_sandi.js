document.addEventListener('DOMContentLoaded', function() {
    
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const modal = document.getElementById('modal-sukses');

    
    const inputEmail = document.getElementById('reset-email');
    const btnKirim = document.getElementById('btn-kirim');
    const emailError = document.getElementById('email-error');

    
    const otpInputs = document.querySelectorAll('.otp-input');
    const btnVerifikasi = document.getElementById('btn-verifikasi');
    const countdownElement = document.getElementById('countdown');
    const btnKirimUlang = document.getElementById('btn-kirim-ulang');

    
    const passBaru = document.getElementById('pass-baru');
    const passKonfirm = document.getElementById('pass-konfirm');
    const btnPerbarui = document.getElementById('btn-perbarui');

    let timerInterval; 

    function formatEmailBenar(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

   
    function mulaiHitungMundur() {
        clearInterval(timerInterval); 
        let waktuSisa = 120; 

        timerInterval = setInterval(() => {
            let menit = Math.floor(waktuSisa / 60);
            let detik = waktuSisa % 60;

            
            menit = menit < 10 ? '0' + menit : menit;
            detik = detik < 10 ? '0' + detik : detik;

            countdownElement.textContent = `${menit}:${detik}`;
            countdownElement.parentElement.style.color = "#e53e3e";

            if (waktuSisa <= 0) {
                clearInterval(timerInterval);
                countdownElement.parentElement.textContent = "Kode OTP telah kedaluwarsa!";
                
               
                btnVerifikasi.classList.remove('aktif');
                btnVerifikasi.setAttribute('disabled', 'true');
            }
            waktuSisa--;
        }, 1000);
    }

    
    inputEmail.addEventListener('input', () => {
        const isiEmail = inputEmail.value.trim();
        if (isiEmail === '') {
            emailError.style.display = 'none';
            btnKirim.classList.remove('aktif');
            btnKirim.setAttribute('disabled', 'true');
        } else if (!formatEmailBenar(isiEmail)) {
            emailError.style.display = 'block';
            btnKirim.classList.remove('aktif');
            btnKirim.setAttribute('disabled', 'true');
        } else {
            emailError.style.display = 'none';
            btnKirim.classList.add('aktif');
            btnKirim.removeAttribute('disabled');
        }
    });

    btnKirim.addEventListener('click', () => {
        btnKirim.textContent = "Mengirim...";
        btnKirim.setAttribute('disabled', 'true');
        
        const formData = new FormData();
        formData.append('email', inputEmail.value.trim());

        fetch('proses_otp.php?action=kirim', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            btnKirim.textContent = "Kirim kode";
            btnKirim.removeAttribute('disabled');
            
            if (data.status === 'sukses') {
                step1.classList.remove('aktif');
                step2.classList.add('aktif');
                mulaiHitungMundur(); 
            } else {
                alert(data.pesan);
            }
        })
        .catch(err => {
            alert("Terjadi kesalahan koneksi ke server.");
            btnKirim.textContent = "Kirim kode";
            btnKirim.removeAttribute('disabled');
        });
    });

    
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value !== '' && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            cekOtpPenuh();
        });
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    function cekOtpPenuh() {
        let semuaTerisi = true;
        otpInputs.forEach(input => { if (input.value === '') semuaTerisi = false; });
        
        
        if (semuaTerisi && countdownElement.parentElement.textContent !== "Kode OTP telah kedaluwarsa!") {
            btnVerifikasi.classList.add('aktif'); btnVerifikasi.removeAttribute('disabled');
        } else {
            btnVerifikasi.classList.remove('aktif'); btnVerifikasi.setAttribute('disabled', 'true');
        }
    }

    btnVerifikasi.addEventListener('click', () => {
        let otpGabungan = "";
        otpInputs.forEach(input => { otpGabungan += input.value; });

        const formData = new FormData();
        formData.append('otp', otpGabungan);

        fetch('proses_otp.php?action=verifikasi', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'sukses') {
                clearInterval(timerInterval); 
                step2.classList.remove('aktif');
                step3.classList.add('aktif');
            } else {
                alert(data.pesan);
            }
        });
    });

    
    btnKirimUlang.addEventListener('click', (e) => {
        e.preventDefault();
        
        document.getElementById('otp-timer').innerHTML = 'Kode berlaku dalam: <span id="countdown">02:00</span>';
        const newCountdownElement = document.getElementById('countdown');
        
        const formData = new FormData();
        formData.append('email', inputEmail.value.trim());

        fetch('proses_otp.php?action=kirim', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'sukses') {
                alert('Kode OTP baru telah dikirim!');
                location.reload(); 
            } else {
                alert(data.pesan);
            }
        });
    });

   
    function cekSandi() {
        const baru = passBaru.value.trim();
        const konfirm = passKonfirm.value.trim();
        
        if (baru !== '' && konfirm !== '' && baru === konfirm) {
            btnPerbarui.classList.add('aktif'); btnPerbarui.removeAttribute('disabled');
        } else {
            btnPerbarui.classList.remove('aktif'); btnPerbarui.setAttribute('disabled', 'true');
        }
    }
    passBaru.addEventListener('input', cekSandi);
    passKonfirm.addEventListener('input', cekSandi);

    btnPerbarui.addEventListener('click', () => {
        const formData = new FormData();
        formData.append('password', passBaru.value);

        fetch('proses_otp.php?action=perbarui', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'sukses') {
                modal.classList.add('aktif');
            } else {
                alert(data.pesan);
            }
        });
    });
});