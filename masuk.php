<?php
include('conn/koneksi.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    $sql = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE (username='$username' OR email='$username') AND password='$password'");
    $cek = mysqli_num_rows($sql);
    $data = mysqli_fetch_assoc($sql);

    $sql2 = mysqli_query($koneksi, "SELECT * FROM petugas WHERE (username='$username' OR email='$username') AND password='$password'");
    $cek2 = mysqli_num_rows($sql2);
    $data2 = mysqli_fetch_assoc($sql2);

    if ($cek > 0) {
        if ($data['verif'] == 0) {
            echo "<script>alert('Silahkan verifikasi akun anda terlebih dahulu!');</script>";
            echo "<script>location='telat.php';</script>";
        } elseif ($data['verif'] == 1) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['data'] = $data;
            $_SESSION['level'] = 'masyarakat';
            header('Location: masyarakat/');
            exit();
        }
    } elseif ($cek2 > 0) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['data'] = $data2;

        if ($data2['level'] == "admin") {
            header('Location: admin/');
        } elseif ($data2['level'] == "petugas") {
            header('Location: petugas/');
        }
        exit();
    } else {
        echo "<script>alert('Gagal login. Username atau password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(to bottom, #8e7cff 50%, #0a1734 50%);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }

        .box {
            text-align: center;
            margin-bottom: 20px;
        }

        .box h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .box p {
            color: #dcdcdc;
            font-size: 14px;
        }

        .form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .inputBox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

       

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #6a5bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #5948e0;
        }

        .links,
        .cr {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .links a,
        .cr a {
            color: #6a5bff;
            text-decoration: none;
        }

        .links a:hover,
        .cr a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Login</h2>
        <p>Silahkan login menggunakan akun yang sudah didaftarkan.</p>
    </div>
    <div class="form">
        <form action="#" method="POST">
            <h2>Silahkan Masuk</h2>
           <div class="inputBox">
    <input type="text" name="email" required autocomplete="off" placeholder="Alamat Email / Nama Pengguna">
</div>
<div class="inputBox">
    <input type="password" name="password" required autocomplete="off" placeholder="Kata Sandi">
</div>

            
            <input type="submit" name="login" value="Masuk">
            <div class="cr">
                <p>Tidak mempunyai akun?</p>
                <a href="daftar.php">Daftar disini</a>
            </div>
        </form>
    </div>
</body>
</html>
