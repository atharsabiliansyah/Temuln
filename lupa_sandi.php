<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - TemuIn</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="container">
        
        <div id="step-1" class="step-section aktif">
            <h1 class="judul">Atur Ulang Kata Sandi</h1>
            <p class="tagline">Masukkan email kamu untuk mengatur ulang kata sandi.</p>
            <div class="login-card">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" id="reset-email" placeholder="Masukkan email yang terdaftar">
                    <small id="email-error" class="error-text" style="display: none; color: red;">Format email tidak valid (contoh: nama@email.com)</small>
                </div>
                <button type="button" id="btn-kirim" class="btn-submit" disabled>Kirim kode</button>
            </div>
        </div>

    <div id="step-2" class="step-section">
    <h1 class="judul">Verifikasi Email</h1>
    <p class="tagline">Masukkan 4 digit kode OTP yang telah kami kirim ke email kamu.</p>
    <div class="login-card">
        <div class="input-group">
            <label>Kode OTP</label>
            <div class="otp-wrapper">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
                <input type="text" class="otp-input" maxlength="1">
            </div>
        </div>

        <div id="otp-timer" style="text-align: center; margin-bottom: 15px; font-weight: bold; color: #e53e3e;">
            Kode berlaku dalam: <span id="countdown">02:00</span>
        </div>

        <button type="button" id="btn-verifikasi" class="btn-submit" disabled>Verifikasi</button>
        <div class="daftar-link" style="text-align: left; display: flex; justify-content: space-between; margin-top: 15px;">
            <span>Tidak menerima kode OTP?</span> <a href="#" id="btn-kirim-ulang" style="color:#0b132b; font-weight: bold;">Kirim Ulang?</a>
        </div>
    </div>
</div>
        <div id="step-3" class="step-section">
            <h1 class="judul">Kata Sandi Baru</h1>
            <p class="tagline">Langkah terakhir untuk mendapatkan kembali akses akun kamu.</p>
            <div class="login-card">
                <div class="input-group">
                    <label>Kata Sandi baru</label>
                    <input type="password" id="pass-baru" placeholder="Masukkan kata sandi baru">
                </div>
                <div class="input-group">
                    <label>Konfirmasi Kata Sandi</label>
                    <input type="password" id="pass-konfirm" placeholder="Masukkan kembali kata sandi">
                </div>
                <button type="button" id="btn-perbarui" class="btn-submit" disabled>Perbarui Kata Sandi</button>
            </div>
        </div>

    </div>

    <div id="modal-sukses" class="modal-overlay">
        <div class="modal-card">
            <h2 style="color:#0b132b; margin-bottom:10px;">Horeee!</h2>
            <p style="color:#4a5568; margin-bottom:25px; font-weight:bold;">Kata sandi kamu sudah<br>selesai diperbarui</p>
            <a href="index.php" class="btn-submit aktif" style="text-decoration:none; display:inline-block; width:100%; text-align:center;">Kembali Masuk</a>
        </div>
    </div>

    <script src="lupa_sandi.js"></script>
</body>
</html>