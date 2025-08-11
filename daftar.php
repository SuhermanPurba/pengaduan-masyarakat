<?php 
session_start();
include('conn/koneksi.php');

// Handle AJAX request dulu
if (isset($_POST['action']) && $_POST['action'] === 'get_penduduk') {
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $query = mysqli_query($koneksi, "SELECT rt, rw, kelurahan, kecamatan, kabupaten FROM penduduk WHERE nik='$nik'");
    if (mysqli_num_rows($query) > 0) {
        echo json_encode(mysqli_fetch_assoc($query));
    } else {
        echo json_encode(null);
    }
    exit;
}

// Handle form submit register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['action'])) {
    // Ambil data dari POST dengan escape
    $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['name']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Cek NIK sudah ada di penduduk
    $cek_penduduk = mysqli_query($koneksi, "SELECT * FROM penduduk WHERE nik='$nik'");
    if(mysqli_num_rows($cek_penduduk) == 0){
        echo "<script>alert('NIK tidak ditemukan di data penduduk!');window.history.back();</script>";
        exit;
    }

    // Cek duplikat di masyarakat
    $cek_masyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik' OR username='$username' OR email='$email'");
    if(mysqli_num_rows($cek_masyarakat) > 0){
        echo "<script>alert('Akun dengan NIK, username atau email sudah ada!');window.history.back();</script>";
        exit;
    }

    if($password !== $cpassword){
        echo "<script>alert('Password tidak sama!');window.history.back();</script>";
        exit;
    }

    $password_hash = md5($password);

    // Insert dan langsung set verif = 1 (langsung aktif)
    $insert = mysqli_query($koneksi, "INSERT INTO masyarakat (nik, nama, username, email, password, verif) VALUES ('$nik', '$nama', '$username', '$email', '$password_hash', 1)");

    if($insert){
        echo "<script>alert('Registrasi berhasil! Silakan login.');window.location='cek.php';</script>";
    } else {
        echo "<script>alert('Gagal registrasi, coba lagi!');window.history.back();</script>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Masyarakat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            margin: 0;
            background: linear-gradient(to top, #0a1734 50%, #7b61ff 50%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px 40px;
            width: 400px;
            margin-top: 100px;
        }

        .form-header {
            text-align: center;
            color: white;
            margin-top: 60px;
        }

        .form-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 14px;
            color: #e0e0e0;
        }

        form label {
            display: block;
            margin: 15px 0 5px;
            font-weight: 600;
            color: #333;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #6a5bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form input[type="submit"]:hover {
            background-color: #5746d2;
        }

        #pendudukData {
            margin-top: 10px;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="form-header">
    <h2>Register</h2>
    <p>Silakan isi form dibawah ini untuk membuat akun baru.</p>
</div>

<div class="form-container">
    <form method="POST" id="registerForm" autocomplete="off">
        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" required minlength="16" maxlength="16" pattern="\d{16}" title="Masukkan 16 digit NIK" />

        <div id="pendudukData" style="display:none;">
            <label for="rt">RT:</label>
            <input type="text" id="rt" name="rt" readonly />

            <label for="rw">RW:</label>
            <input type="text" id="rw" name="rw" readonly />

            <label for="kelurahan">Kelurahan:</label>
            <input type="text" id="kelurahan" name="kelurahan" readonly />

            <label for="kecamatan">Kecamatan:</label>
            <input type="text" id="kecamatan" name="kecamatan" readonly />

            <label for="kabupaten">Kabupaten:</label>
            <input type="text" id="kabupaten" name="kabupaten" readonly />
        </div>

        <label for="name">Nama Lengkap:</label>
        <input type="text" id="name" name="name" required maxlength="32" />

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required maxlength="32" />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required minlength="8" />

        <label for="cpassword">Konfirmasi Password:</label>
        <input type="password" id="cpassword" name="cpassword" required minlength="8" />

        <input type="submit" value="Daftar" />
    </form>
</div>

<script>
$(document).ready(function(){
    $('#nik').on('blur', function(){
        const nik = $(this).val();
        if(nik.length === 16 && /^\d{16}$/.test(nik)){
            $.ajax({
                url: '', // halaman yang sama
                method: 'POST',
                data: { action: 'get_penduduk', nik: nik },
                success: function(response){
                    const data = JSON.parse(response);
                    if(data){
                        $('#rt').val(data.rt);
                        $('#rw').val(data.rw);
                        $('#kelurahan').val(data.kelurahan);
                        $('#kecamatan').val(data.kecamatan);
                        $('#kabupaten').val(data.kabupaten);
                        $('#pendudukData').slideDown();
                    } else {
                        alert('Data NIK tidak ditemukan!');
                        $('#pendudukData').slideUp();
                        $('#rt, #rw, #kelurahan, #kecamatan, #kabupaten').val('');
                    }
                },
                error: function(){
                    alert('Gagal mengambil data penduduk!');
                    $('#pendudukData').slideUp();
                    $('#rt, #rw, #kelurahan, #kecamatan, #kabupaten').val('');
                }
            });
        } else {
            $('#pendudukData').slideUp();
            $('#rt, #rw, #kelurahan, #kecamatan, #kabupaten').val('');
        }
    });
});
</script>

</body>
</html>
