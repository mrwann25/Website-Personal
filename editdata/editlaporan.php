<?php
require "../Functions/functions.php";

session_start();
if (!isset($_SESSION["Login"])) {
  header("Location:../Form_Login/formlogin.php");
  exit;
} else {
  //Get Session Level
  $Level = $_SESSION["Level"];
}
// ambil data diurl
if (!isset($_GET["id"])) {
  echo "Diperlukan Parameter ID";
  exit;
} else {

  $stok = $_GET["id"];

  // query data formdiet berdasarkan Id
  $form_laporan = query("SELECT * FROM db_laporanstok WHERE id = $stok");

  $TotalData = count($form_laporan);

  if ($TotalData == 0) {
    echo "ID tidak ditemukan";
    exit;
  } else {
    $form_laporan = query("SELECT * FROM db_laporanstok WHERE id = $stok")[0];
  }
}

if (isset($_POST["submit2"])) {

  // pengecekan apakah data berhasil diubah atau tidak
  if (ubahstok($_POST) > 0) {
    echo " <script>
    alert('data berhasi l diubah!');
    
     </script>
       ";
  } else {
    echo " 
    <script>
    alert('data gagal diubah!');
    
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
            <a class="nav-link active" aria-current="page" href="../Form_Login/dashboard.php">SISFO INSTALASI GIZI <?= date('Y-m-d H:i:s', time() + 3600) ?> </a>
          </li>
        </ul>
      </div>
      <button type="button" class="btn btn-danger">Log Out</button>
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
            <a class="dropdown-item" href="../kalkulasi_gizi/index.php">Kalkulator Gizi</a>
          </li>
        </ul>

      </div>
    </div>
  </div>

  <!--Main Content-->
  <div class="container mt-1">
    <h4 class="text-center">Form Laporan Stok (Edit Data)</h4>
    <div style="background-color: rgb(228, 228, 228)">
      <div class="container-fluid">
        <form action="" method="post" class="row g-3 mt-2">
          <input type="hidden" name="id" value="<?= $form_laporan["id"]; ?>">
          <div class="col-md-3">
            <label for="Nm" class="form-label">Nama_Bahan</label>
            <input type="text" name="Nm" class="form-control form-control-sm" id="Nm" value="<?= $form_laporan["nama_bahan"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Tgl" class="form-label">Tanggal</label>
            <input type="date" name="Tgl" class="form-control form-control-sm" id="Tgl" value="<?= $form_laporan["tanggal"]; ?>" required />
          </div>
          <div class="col-md-3">
            <label for="Masuk" class="form-label">Masuk</label>
            <input type="text" name="Masuk" class="form-control form-control-sm" id="Masuk" value="<?= $form_laporan["masuk"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Keluar" class="form-label">Keluar</label>
            <input type="text" name="Keluar" class="form-control form-control-sm" id="Keluar" value="<?= $form_laporan["keluar"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Stk" class="form-label">Sisa stok akhir</label>
            <input type="text" name="Stk" class="form-control form-control-sm" id="Stk" value="<?= $form_laporan["sisa_stok"]; ?>" />
          </div>

          <div class="d-flex gap-2 d-md-relative justify-content-md-end">
            <button type="submit" name="submit2" class="btn btn-warning">Ubah Data!</button>
            <a href="../Form_Rekap_Data/rekaplaporanstok.php" class="btn btn-sm btn-secondary" style="width: 150px;">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
      <p><?= $Credit ?></p>
    </div>
  <script src="../assets/Js.js"></script>

</body>

</html>