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

  $fr = $_GET["id"];

  // query data formdiet berdasarkan Id
  $form_diet = query("SELECT * FROM db_formdiet WHERE id = $fr");

  $TotalData = count($form_diet);

  if ($TotalData == 0) {
    echo "ID tidak ditemukan";
    exit;
  } else {
    $form_diet = query("SELECT * FROM db_formdiet WHERE id = $fr")[0];
  }
}

if (isset($_POST["submit"])) {

  // pengecekan apakah data berhasil diubah atau tidak
  if (ubah($_POST) > 0) {
    echo " <script>
    alert('data berhasil diubah!');
    
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

  <title>dashboard_lpdiet</title>
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
    <h4 class="text-center">Form Diet Pasien (Edit Data)</h4>
    <div style="background-color: rgb(228, 228, 228)">
      <div class="container-fluid">
        <form action="" method="post" class="row g-3 mt-2">
          <input type="hidden" name="id" value="<?= $form_diet["id"]; ?>">
          <div class="col-md-3">
            <label for="Ruangan" class="form-label">Ruangan</label>
            <select name="Ruangan" id="Ruangan" class="form-select form-select-sm" required>
              <option value="">Pilih Ruangan</option>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM db_data_ruangan");
              while ($data = mysqli_fetch_array($sql)) {
                echo "<option " . ($data["nama_ruangan"] == $form_diet["nama_ruangan"] ? "selected" : "") . " value='$data[nama_ruangan]'>$data[nama_ruangan]</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="Tanggal" class="form-label">Tanggal_Permintaan</label>
            <input type="date" name="Tanggal" class="form-control form-control-sm" id="Tanggal" value="<?= $form_diet["tanggal"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="NamaPasien" class="form-label">Nama Pasien</label>
            <input type="text" name="NamaPasien" class="form-control form-control-sm" id="NamaPasien" value="<?= $form_diet["nama_pasien"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Tanggal1" class="form-label">Tanggal_Lahir</label>
            <input type="date" name="Tanggal1" class="form-control form-control-sm" id="Tanggal1" value="<?= $form_diet["tanggal_lahir"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="NoRm" class="form-label">No RM</label>
            <input type="text" name="NoRm" class="form-control form-control-sm" id="NoRm" value="<?= $form_diet["no_rm"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Tanggal2" class="form-label">Tanggal/Jam_Mrs</label>
            <input type="datetime-local" name="Tanggal2" class="form-control form-control-sm" id="Tanggal2" value="<?= $form_diet["tanggal2"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="Diagnosa" class="form-label">Diagnosa</label>
            <input type="text" name="Diagnosa" class="form-control form-control-sm" id="Diagnosa" value="<?= $form_diet["diagnosa"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="kmr" class="form-label">Ruangan/No_Kamar</label>
            <input type="text" name="Kamar" class="form-control form-control-sm" id="Kamar" value="<?= $form_diet["kamar"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="namadokter" class="form-label">Nama_Dokter</label>
            <select name="namadokter" id="namadokter" class="form-select form-select-sm">
              <option value="">Pilih Dokter</option>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM database_dokter");
              while ($data = mysqli_fetch_array($sql)) {
                echo "<option " . ($form_diet["nama_dokter"] == $data["nama_dokter"] ? "selected" : "") . " value='$data[nama_dokter]'>$data[nama_dokter]</option>";
              }
              ?>
            </select>
          </div>
          <!-- Form Diet -->

          <div class="col-md-3">
            <label for="DietSiang" class="form-label">Diet_Siang</label>
            <input type="text" name="DietSiang" class="form-control form-control-sm" id="DietSiang" value="<?= $form_diet["diet_siang"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="DietSore" class="form-label">Diet_Sore</label>
            <input type="text" name="DietSore" class="form-control form-control-sm" id="DietSore" value="<?= $form_diet["diet_sore"]; ?>" />
          </div>
          <div class="col-md-3">
            <label for="DietPagi" class="form-label">Diet_Pagi</label>
            <input type="text" name="DietPagi" class="form-control form-control-sm" id="DietPagi" value="<?= $form_diet["diet_pagi"]; ?>" />
          </div>

          <div class="d-flex gap-2 d-md-relative justify-content-md-end">
            <button type="submit" name="submit" class="btn btn-warning">Ubah Data!</button>
            <a href="../Form_Rekap_Data/rekapdatadiet.php" class="btn btn-sm btn-secondary" style="width: 150px;">Back</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/Js.js"></script>
  <script>
    document.getElementById('NoRm').addEventListener('input', function() {
      var noRm = this.value;
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          document.getElementById('NamaPasien').value = response.nama;
          document.getElementById('Tanggal1').value = response.tgl_lahir;
        }
      };
      xhr.open("GET", "search_rm.php?no_rm=" + noRm, true);
      xhr.send();
    });
  </script>
      <div class="footer">
      <p><?= $Credit ?></p>
    </div>
</body>

</html>