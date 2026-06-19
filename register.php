<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - TemuIn</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="container">
        <h1 class="judul">Registrasi</h1>
        <p class="tagline">Daftar sekarang dan bantu barang menemukan jalan pulang.</p>

        <div class="login-card">
            <form id="form-register" action="proses_register.php" method="POST">
                
                <div class="input-group">
                    <label for="nim">Nomor Induk Mahasiswa</label>
                    <input type="text" id="nim" name="nim" placeholder="Contoh: 241011402064" required>
                </div>

                <div class="input-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="input-group">
                    <label for="email">Email Mahasiswa</label>
                    <input type="email" id="email" name="email" placeholder="Contoh: pemburusawit@gmail.com" required>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>

                <button type="button" id="btn-daftar" class="btn-submit" disabled>Daftar Akun Baru</button>

                <div class="daftar-link">
                    Sudah punya akun? <a href="index.php">Masuk di sini!</a>
                </div>
                
            </form>
        </div>
    </div>

    <script src="register.js"></script>
</body>
</html>