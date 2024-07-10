<?php
session_start();
if (!isset($_SESSION["Login"])) {
  header("Location:../Form_Login/formlogin.php");
  exit;
} else {
  //Get Session Level
  $Level = $_SESSION["Level"];
}
// memanggil function
require "../Functions/functions.php";
if (isset($_POST["submit"])) {
  $Date = date("Y-m-d", time() + 3600);
  // pengecekan apakah data berhasil ditambahkan atau tidak
  if (tambahdokter($_POST) > 0) {
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

  <title></title>
</head>

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
            <a class="dropdown-item" href="../dashboard_diet/dasboard_lpdiet.php">Laporan Diet Pasien</a>
          </li>

          <!-- jika level user sama dengan 2 atau 3 tampilkan -->
          <?php if ($Level == 1 or $Level == 2) { ?>
            <li>
              <a class="dropdown-item" href="../dashboard_pemesanan/dashboardpemasanan.php">Permintaan Stok Bahan Makan</a>
            </li>
            <li>
              <a class="dropdown-item" href="../dbPermintaan_Alat/dbPermintaanAlat.php">Permintaan Alat Masak</a>
            </li>
            <li>
              <a class="dropdown-item" href="../Laporan_Stok/laporanStok.php">Laporan Stok</a>
            </li>
          <li>
            <a class="dropdown-item" href="../db_jadwaljaga/dashboard_upload.php">Jadwal Jaga Shift</a>
          </li>
          <?php } ?>
          <?php if ($Level == 2) { ?>
            <li>
              <a class="dropdown-item" href="../data_user/index.php">Master Data User</a>
            </li>
          <?php } ?>

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

  <!--Main Content-->
  <div class="container mt-1">
    <h4 class="text-center">Input Data Dokter</h4>
    <div style="background-color: rgb(228, 228, 228)">
      <div class="container-fluid">
        <form action="" method="post" class="row g-3 mt-2">
          <div class="col-md-3">
            <label for="iddokter" class="form-label">ID_Dokter</label>
            <input type="text" name="iddokter" class="form-control form-control-sm" id="iddokter" readonly value="terisi otomatis" />
          </div>
          <div class="col-md-3">
            <label for="nmdokter" class="form-label">Nama_Dokter</label>
            <input type="text" name="nmdokter" class="form-control form-control-sm" id="nmdokter" />
          </div>
          <div class="col-md-3">
            <label for="jbtndokter" class="form-label">Jabatan Dokter</label>
            <input type="text" name="jbtndokter" class="form-control form-control-sm" id="jbtndokter" />
          </div>
          <div class="col-md-3">
            <label for="stsdokter" class="form-label">Status Dokter</label>
            <input type="text" name="stsdokter" class="form-control form-control-sm" id="stsdokter" />
          </div>
          <div class="d-flex gap-2 d-md-relative justify-content-md-end mb-1">
            <button type="submit" name="submit" class="btn btn-warning">Submit_Data</button>
            <a href="../master_data/master_data_dokter.php" class="btn btn-secondary btn-mb active" role="button" aria-pressed="true">Menu</a>

          </div>

        </form>

      </div>
    </div>
  </div>

  <script src="../assets/Js.js"></script>

</body>

</html>