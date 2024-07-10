<?php
session_start();
if (!isset($_SESSION["Login"])) {
  header("Location:../Form_Login/formlogin.php");
  exit;
} else {
  //Get Session Level
  $Level = $_SESSION["Level"];
}
// memamnggil function
require "../Functions/functions.php";
if (isset($_POST["submit"])) {
  $Date = date("Y-m-d", time() + 3600);
  // pengecekan apakah data berhasil ditambahkan atau tidak
  if (tambahbahan($_POST) > 0) {
    echo " <script>
    alert('data berhasil ditambahkan!');
    
     </script>
       ";
  } else {
    echo " 
    <script>
    alert('data gagal ditambahkan!');
    
     </script>";
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/styleBt.css" />
  <title>Pemesanan Bahan Makanan</title>
</head>
<body>
  <!-- css footer -->
  <style>
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: lightblue;
      color: black;
      text-align: center;
    }
  </style>
<body>
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        _Menu_
      </a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../Form_Login/dashboard.php">INSTALASI GIZI <?= date('Y-m-d H:i:s', time() + 3600) ?></a>
          </li>
        </ul>
      </div>
      <a href="../Function_Logout/Logout.php">
        <button type="button" class="btn btn-danger">Log Out</button>
      </a>
    </div>
  </nav>

  <!--Sidebar-->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">
        RSUD H. Badaruddin Kasim
      </h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>Selamat datang di aplikasi Instalasi GIZI</div>
      <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
          Klik_Disini
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li>
            <a class="dropdown-item" href="../Form_Rekap_Data/rekapdatadiet.php">Laporan Diet Pasien</a>
          </li>

          <!-- jika level user sama dengan 2 atau 3 tampilkan -->
          <?php if ($Level == 2 or $Level == 3) { ?>
            <li>
              <a class="dropdown-item" href="../Form_Rekap_Data/pemesananbahan.php">Permintaan Stok Bahan Makan</a>
            </li>
            <li>
              <a class="dropdown-item" href="../Form_Rekap_Data/permintaanalat.php">Permintaan Alat Masak</a>
            </li>
            <li>
              <a class="dropdown-item" href="../Form_Rekap_Data/rekaplaporanstok.php">Laporan Stok</a>
            </li>

          <?php } ?>

          <?php if ($Level == 2) { ?>
            <li>
              <a class="dropdown-item" href="../data_user/index.php">Master Data User</a>
            </li>
          <?php } ?>
          <li>
            <a class="dropdown-item" href="../kalkulasi_gizi/index.php">Kalkulasi Gizi</a>
          </li>

          <li>
            <a class="dropdown-item" href="../db_jadwaljaga/dashboard_upload.php">Jadwal Jaga Shift</a>
          </li>
          <li>
            <a class="dropdown-item" href="../master_data/master_data_dokter.php">Master Data Dokter</a>
          </li>
          <li>
            <a class="dropdown-item" href="../upload_insert_excel/upload_file.php">Master Data Pasien</a>
          </li>
          <li>
              <a class="dropdown-item" href="../laporan CPPT/laporan_cppt.php">Laporan Perkembangan Pasien</a>
            </li>
          <li>
            <a class="dropdown-item" href="../kalkulasi_gizi/index.php">Kalkulator Gizi</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="container mt-1">
    <h4 class="text-center">Form Permintaan Bahan Makan Kering</h4>
    <div style="background-color: rgb(228, 228, 228)">
      <div class="container-fluid">
        <form action="" method="post" class="row g-3 mt-2">
          <div class="col-md-6">
            <label for="namabarang" class="form-label">Nama Bahan</label>
            <input type="text" class="form-control" id="namabarang" name="namabarang" />
          </div>
          <!-- <div class="col-md-6">
              <label for="standarmakanan" class="form-label">Standar Makanan</label>
              <input type="text" class="form-control" id="standarmakanan" name="standarmakanan"/>
            </div> -->
          <div class="col-md-6">
            <label for="jumlahpermintaan" class="form-label">Jumlah yang diminta</label>
            <input type="text" class="form-control" id="jumlahpermintaan" name="jumlahpermintaan" />
          </div>
          <div class="col-md-6">
            <label for="jumlahdatang" class="form-label">Jumlah yang diberi</label>
            <input type="text" class="form-control" id="jumlahdatang" name="jumlahdatang" />
          </div>
          <div class="col-md-6">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" />
          </div>
          <!-- <div class="col-md-6">
              <label for="yangmenyetujui" class="form-label">Yang Menyetujui</label
              >
              <input type="text" class="form-control" id="yangmenyetujui" name="yangmenyetujui" />
            </div> -->
          <div class="col-md-6">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control form-control-sm-2" id="tanggal" name="tanggal" required />
          </div>
          <div class="d-flex gap-2 d-md-relative justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-warning">Submit_Data</button>
            <a href="../Form_Rekap_Data/pemesananbahan.php" class="btn btn-secondary btn-mb active" role="button" aria-pressed="true">Menu_Rekap</a>
          </div>
        </form>
      </div>
    </div>
    <div class="footer">
      <p><?= $Credit ?></p>
    </div>

  </div>
  <script src="../assets/Js.js"></script>
</body>

</html>