<?php
include 'conn/koneksi.php';

// Hitung total pengaduan (semua)
$totalQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengaduan");
$total = mysqli_fetch_assoc($totalQuery)['total'];

// Hitung pengaduan status 'proses' (semua)
$prosesQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS proses FROM pengaduan WHERE status = 'proses'");
$proses = mysqli_fetch_assoc($prosesQuery)['proses'];

// Hitung pengaduan status 'selesai' (semua)
$selesaiQuery = mysqli_query($koneksi, "SELECT COUNT(*) AS selesai FROM pengaduan WHERE status = 'selesai'");
$selesai = mysqli_fetch_assoc($selesaiQuery)['selesai'];

// Ambil data pengaduan terbaru (limit 10)
$pengaduanQuery = mysqli_query($koneksi, "SELECT * FROM pengaduan ORDER BY tgl_pengaduan DESC LIMIT 10");

if (!$pengaduanQuery) {
    die("Query error: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan Masyarakat - Tualang</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }
    header {
      background-color: #fff;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .btn-login {
      background: #3b82f6;
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 999px;
      font-weight: 600;
      cursor: pointer;
    }
    .hero {
      position: relative;
      width: 100%;
      overflow: hidden;
    }
    .hero img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      display: block;
    }
    .btn-buat {
      position: absolute;
      top: 20px;
      left: 20px;
      background: #3b82f6;
      color: white;
      padding: 0.6rem 1.2rem;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
      z-index: 1;
    }
    .steps {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
      gap: 1rem;
      flex-wrap: wrap;
      padding: 0 1rem;
    }
    .card {
      background: white;
      padding: 1rem;
      border-radius: 1rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      text-align: center;
      width: 150px;
    }
    .steps i {
      font-size: 2rem;
      color: #3b82f6;
    }
    .stats {
      display: flex;
      justify-content: center;
      margin-top: 2rem;
      gap: 2rem;
      background: #eef5ff;
      padding: 2rem 0;
      flex-wrap: wrap;
    }
    .stat {
      flex: 1;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .stat-icon {
      font-size: 2rem;
      color: #3b82f6;
    }
    footer {
      margin-top: 2rem;
      padding: 2rem;
      background-color: #1e3a8a;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
    }
    footer a {
      color: #93c5fd;
      text-decoration: none;
    }
  </style>
  <script>
    function cekLoginDanArahkan() {
      const isLoggedIn = localStorage.getItem("isLoggedIn");
      if (isLoggedIn === "true") {
        window.location.href = "buat-pengaduan.html";
      } else {
        alert("Silakan login terlebih dahulu untuk membuat pengaduan.");
      }
    }
  </script>
</head>
<body>
  <header>
    <h2>Pengaduan Masyarakat</h2>
    <button class="btn-login" onclick="window.location.href='masuk.php'">Login</button>
  </header>

  <div class="hero">
    <img src="11.jpg" alt="Kecamatan Tualang">
    <a href="javascript:void(0);" onclick="cekLoginDanArahkan()" class="btn-buat">BUAT PENGADUAN</a>
  </div>

  <div class="steps">
    <div class="card"><i class="ri-edit-2-line"></i><p>Tulis Pengaduan</p></div>
    <div class="card"><i class="ri-search-eye-line"></i><p>Proses Verifikasi</p></div>
    <div class="card"><i class="ri-tools-line"></i><p>Tindak Lanjut</p></div>
    <div class="card"><i class="ri-checkbox-circle-line"></i><p>Selesai</p></div>
  </div>

  <div class="stats">
    <div class="stat">
      <div class="stat-icon"><i class="bx bx-list-ul"></i></div>
      <h2><?php echo $total; ?></h2>
      <p>Semua Pengaduan</p>
    </div>

    <div class="stat">
      <div class="stat-icon"><i class="bx bx-loader-circle"></i></div>
      <h2><?php echo $proses; ?></h2>
      <p>Sedang Diproses</p>
    </div>

    <div class="stat">
      <div class="stat-icon"><i class="bx bx-check-circle"></i></div>
      <h2><?php echo $selesai; ?></h2>
      <p>Selesai</p>
    </div>
  </div>

  <footer>
    <div>
      <h3>PENGADUAN MASYARAKAT</h3>
      <p>Kecamatan Tualang<br>Pengaduan</p>
    </div>
    <div>
      <p>Kontak</p>
      <p>Phone: +62 8596289490</p>
      <p>Email: tualang@gmail.com</p>
    </div>
  </footer>
</body>
</html>
