<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TemuIn</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div id="splash-screen" class="splash-screen">
        <div class="logo-wrapper">
            <img src="assets/box.png" alt="Box" class="animasi-box">
            <img src="assets/tangan.png" alt="Tangan" class="gambar-tangan">
        </div>
        <h1 class="judul">TemuIn</h1>
        <p class="tagline">Karena Setiap Barang Punya Jalan Pulang.</p>
    </div>

    <div id="login-section" class="login-section">
        <h1 class="judul">TemuIn</h1>
        <p class="tagline">Temukan yang Hilang, Kembalikan yang Berarti.</p>

        <div class="login-card">
            <form id="form-login" action="" method="POST">
                <div class="input-group">
                    <label for="nim_email">NIM / Email</label>
                    <input type="text" id="nim_email" name="nim_email" placeholder="Masukkan NIM atau Email" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <div class="lupa-sandi">
                    <a href="#">Lupa Kata Sandi?</a>
                </div>

                <button type="button" id="btn-masuk" class="btn-submit" disabled>Masuk</button>

                <div class="daftar-link">
                    Belum punya akun? <a href="register.php">yuk daftar dulu !</a>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>