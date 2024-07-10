<?php
// memanggil function
require "../Functions/functions.php";
$Date = date("Y-m-d", time() + 3600);

session_start();
if (!isset($_SESSION["Login"])) {
  header("Location:../Form_Login/formlogin.php");
  exit;
} else {
  //Get Session Level
  $Level = $_SESSION["Level"];
}
//Tampilkan semua data
$q = mysqli_query($conn, "SELECT * FROM db_permintaanalat");

// tampilkan seluruh data 
$permintaan = query("SELECT * FROM db_permintaanalat ORDER BY id DESC LIMIT $DataAwal, $jumlahdataperhalaman");

// tombol cari ditekan
if (isset($_POST["caripermintaan"])) {
  $q = caripermintaan($_POST["keyword"]);
}
// FUNCTION UNTUK SEACRH DATA BERDASARKAN TANGGAL 
if (isset($_POST['submit1'])) {
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];

  if (!empty($date1) && !empty($date2)) {
    // perintah tampil data berdasarkan range tanggal
    $q = mysqli_query($conn, "SELECT * FROM db_permintaanalat WHERE tanggal BETWEEN '$date1' and '$date2'");
  } else {
    // perintah tampil semua data
    $q = mysqli_query($conn, "SELECT * FROM db_permintaanalat");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/styleBt.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Rekap Data</title>
  <a href="../Function_Ubah_Permintaan/function_ubahpermintaan.php"></a>
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
        Menu
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

          <li>
            <a class="dropdown-item" href="../db_jadwaljaga/dashboard_upload.php">Jadwal Jaga Shift</a>
          </li>
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


  <!-- Main Content -->
  <div class="container mt-2">

    <!-- Tittle -->
    <h1 style="text-align: center;">Rekap Permintaan Alat</h1>
    <form action="" method="post" class="mb-2">
      <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian!!" autocomplete="off">
      <button type="submit" name="caripermintaan">Cari Data</button>
    </form>
    <form action="" method="post" class="mb-2">

      <div class="row g-2 align-items-center mb-0">
        <div class="col-auto">
          <label for="date1">Tanggal mulai </label>
        </div>

        <div class="col-auto">
          <input type="date" name="date1" id="date1" class="form-control mr-2" value="<?= $date1 ?>">
        </div>

        <div class="col-auto">
          <label for="date2">sampai </label>
        </div>

        <div class="col-auto">
          <input type="date" name="date2" id="date2" class="form-control mr-2" value="<?= $date2 ?>">
        </div>

        <div class="col-auto ">
          <button type="submit" name="submit1" class="btn btn-primary">Cari</button>
        </div>

        <div class="col-auto ">
          <a href="../dbPermintaan_Alat/dbPermintaanAlat.php" class="btn btn-dark"> Form Input</a>
        </div>

      </div>
    </form>

    <!-- Table Data Permintaan Alat -->
    <table class="table table-sm table-bordered">

      <!-- Table Head -->
      <thead>
        <tr class="text-center" style="background-color:#c2d6d6;">
          <th>No</th>
          <th>Nama Barang</th>
          <th>Jumlah Permintaan</th>
          <th>Jumlah Yang Diberi</th>
          <th>Keterangan</th>
          <th>Nama Petugas</th>
          <th>Yang Menyetujui</th>
          <th>Tanggal</th>
          <th>Kondisi Alat</th>
          <th>Edit Data</th>
        </tr>
      </thead>

      <!-- Table Data -->
      <tbody>
        <?php
        $i = 1;
        foreach ($q as $row) : ?>
          <tr class="text-center">
            <td><?= $i ?></td>
            <td><?= $row["nama_alat"]; ?></td>
            <td><?= $row["jumlah_permintaan"]; ?></td>
            <td><?= $row["jumlah_diberi"]; ?></td>
            <td><?= $row["keterangan"]; ?></td>
            <td><?= $row["nama_petugas"]; ?></td>
            <td><?= $row["nama_pejabat"]; ?></td>
            <td><?= date('d-M-Y', strtotime($row['tanggal'])); ?></td>
            <td><?= $row["kondisi_alat"]; ?></td>
            <td>
              <button type="button" class="btn btn-info"> 
                  <a href="../editdata/editpermintaan.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black"><span class="bi bi-pencil-square">Edit</span></a>
              </button>
              <button type="button" class="btn btn-warning"> 
                  <a href="../Function_Hapus/hapuspermintaan.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black"><span class="bi bi-trash">Hapus</span></a>
              </button>
            </td>
          </tr>
        <?php $i++;
        endforeach; ?>

      </tbody>

    </table>

    </table>
    <!-- tombol pagination -->
    <nav>
      <ul>
        <ul class="pagination justify-content-end">
          <!-- tombol sebelumnya -->
          <?php
          if ($halamanAktif <= 1) { ?>
            <li class="page-item disabled"><a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Sebelumnya</a></li>
          <?php } else { ?>
            <li class="page-item"><a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Sebelumnya</a></li>
          <?php } ?>
          <?php for ($i = 1; $i <= $JumlahHalaman; $i++) {
          ?>
            <li class="page-item"> <a href="?halaman=<?= $i; ?>" class="page-link"><?= $i; ?></a></li>
          <?php } ?>
          <!-- tombol selanjutnya -->
          <?php
          if ($halamanAktif >= $JumlahHalaman) { ?>
            <li class="page-item disabled"><a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">selanjutnya</a></li>
          <?php } else { ?>
            <li class="page-item"><a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">selanjutnya</a></li>
          <?php } ?>
        </ul>
      </ul>
      <div class="d-flex justify-content-end">
        <label for="" style="padding-right: 4px;">Download hasil laporan</label>
        <a target="_blank" href="../cetak_alat.php?TglAwal=<?= $date1 ?>&TglAkhir=<?= $date2 ?>"><button style="background-color: smoke;">Download Data</button></a>
      </div>
    </nav>
  </div>
  <div class="footer">
      <p><?= $Credit ?></p>
    </div>
  <script src="../assets/Js.js"></script>
</body>

</html>