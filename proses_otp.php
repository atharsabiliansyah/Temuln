<?php
session_start();
include 'koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

header('Content-Type: application/json');

$action = $_GET['action'] ?? '';


if ($action == 'kirim') {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    
    $cek_user = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");
    if (mysqli_num_rows($cek_user) > 0) {
        $otp = rand(1000, 9999); 
        
        
        $waktu_sekarang = date('Y-m-d H:i:s');
        $waktu_expired = date('Y-m-d H:i:s', strtotime('+2 minutes', strtotime($waktu_sekarang)));

        
        mysqli_query($conn, "UPDATE pengguna SET kode_otp = '$otp', otp_expired = '$waktu_expired' WHERE email = '$email'");
        $_SESSION['reset_email'] = $email;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'qaulannisa.as@gmail.com';
            $mail->Password   = 'wcdg hymg hovq abwo'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('qaulannisa.as@gmail.com', 'TemuIn');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Atur Ulang Kata Sandi';
            $mail->Body    = "Kode verifikasi Anda adalah: <b>" . $otp . "</b>. Kode ini hanya berlaku selama 2 menit.";

            $mail->send();
            echo json_encode(['status' => 'sukses', 'pesan' => 'OTP berhasil dikirim!']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'gagal', 'pesan' => 'Gagal mengirim email.']);
        }
    } else {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Email tidak terdaftar!']);
    }
}


if ($action == 'verifikasi') {
    $email = $_SESSION['reset_email'] ?? '';
    $otp_input = $_POST['otp'] ?? '';
    $waktu_sekarang = date('Y-m-d H:i:s');

   
    $query = mysqli_query($conn, "SELECT kode_otp, otp_expired FROM pengguna WHERE email = '$email'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        
        if ($waktu_sekarang > $data['otp_expired']) {
            echo json_encode(['status' => 'gagal', 'pesan' => 'Kode OTP sudah kedaluwarsa! Silakan kirim ulang kodenya.']);
        } 
        
        elseif ($otp_input == $data['kode_otp']) {
            echo json_encode(['status' => 'sukses']);
        } else {
            echo json_encode(['status' => 'gagal', 'pesan' => 'Kode OTP salah!']);
        }
    } else {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Data tidak ditemukan.']);
    }
}


if ($action == 'perbarui') {
    $email = $_SESSION['reset_email'] ?? '';
    $pass_baru = $_POST['password'] ?? '';
    $pass_hashed = password_hash($pass_baru, PASSWORD_DEFAULT);

    
    $update = mysqli_query($conn, "UPDATE pengguna SET password = '$pass_hashed', kode_otp = NULL, otp_expired = NULL WHERE email = '$email'");
    
    if ($update) {
        session_destroy(); 
        echo json_encode(['status' => 'sukses']);
    } else {
        echo json_encode(['status' => 'gagal', 'pesan' => 'Gagal memperbarui kata sandi.']);
    }
}
?>