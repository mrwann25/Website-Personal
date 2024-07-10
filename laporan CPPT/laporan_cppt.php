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
  if (tambahcppt($_POST) > 0) {
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <title>dashboard_lpdiet</title>
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
    <h4 class="text-center">Laporan Catatan Perkembangan Pasien</h4>
    <div style="background-color: rgb(228, 228, 228)">
      <div class="container-fluid">
        <form action="" method="post" class="row g-3 mt-2">

          <div class="col-md-3">
            <label for="NoRm" class="form-label">No RM</label>
            <input type="text" name="NoRm" class="form-control form-control-sm" id="NoRm" />
          </div>
          <div class="col-md-3">
            <label for="tgl" class="form-label">Tanggal</label>
            <input type="datetime-local" name="tgl" class="form-control form-control-sm" id="tgl" required />
          </div>
          <div class="col-md-3">
            <label for="NamaPasien" class="form-label">Nama Pasien</label>
            <input type="text" name="NamaPasien" class="form-control form-control-sm" id="NamaPasien" />
          </div>
          
          <div class="col-md-3">
            <label for="Ruangan" class="form-label">Ruangan</label>
            <select name="Ruangan" id="Ruangan" class="form-select form-select-sm" required>
              <option value="">Pilih Ruangan</option>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM db_data_ruangan");
              while ($data = mysqli_fetch_array($sql)) {
                echo "<option value='$data[nama_ruangan]'>$data[nama_ruangan]</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-md-3">
            <label for="ptinput" class="form-label">Petugas Input (profesi)</label>
            <input type="text" name="ptinput" class="form-control form-control-sm" id="ptinput" />
          </div>
          <div class="col-md-3">
            <label for="Diagnosa" class="form-label">Diagnosa</label>
            <input type="text" name="Diagnosa" class="form-control form-control-sm" id="Diagnosa" />
          </div>
          <div class="col-md-3">
            <label for="Kamar" class="form-label">No_Kamar</label>
            <input type="text" name="Kamar" class="form-control form-control-sm" id="Kamar" />
          </div>
          <div class="col-md-3">
            <label for="dpjp" class="form-label">Nama_Dokter</label>
            <select name="namadokter" id="namadokter" class="form-select form-select-sm">
              <option value="">Pilih Dokter</option>
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM database_dokter");
              while ($data = mysqli_fetch_array($sql)) {
                echo "<option value='$data[nama_dokter]'>$data[nama_dokter]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="cppt">Hasil Pemeriksaan/Analisis Rencana Penatalaksaan Pasien</label>
            <textarea class="form-control" name="cppt" id="cppt" rows="3"></textarea>
          </div>

          <!-- Form Diet -->

          <div class="d-flex gap-2 d-md-relative justify-content-md-end mb-1">
            <button type="submit" name="submit" class="btn btn-warning">Submit_Data</button>
            <a href="../Form_Rekap_Data/rekapcppt.php" class="btn btn-secondary btn-mb active" role="button" aria-pressed="true">Menu_Rekap</a>

          </div>

        </form>
        <h4 style="position: absolute;">#Silahkan Masukkan No RM terlebih dahulu</h4>


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
          // document.getElementById('Tanggal1').value = response.tgl_lahir;
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