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
$q = mysqli_query($conn, "SELECT * FROM db_formdiet");


$searchName = isset($_GET['search']) ? $_GET['search'] : '';
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

$sql = "SELECT * FROM db_formdiet  WHERE 1=1";

if (!empty($searchName) || !empty($startDate) && !empty($endDate)) {
  // $sql .= " WHERE 1=1";

  if (!empty($searchName)) {
    $sql .= " AND nama_pasien LIKE '%$searchName%' OR nama_ruangan LIKE '%$searchName%'";
  }

  if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND (tanggal BETWEEN '$startDate' AND '$endDate')";
  }
}

$mysqlSql = mysqli_query($conn, $sql);
$mysqlCount = mysqli_num_rows($mysqlSql);

$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql .= " LIMIT $limit OFFSET $offset";

// tombol cari ditekan
// if (isset($_POST["submit1"])) {
//   $a = [$_POST["keyword"], $_POST['date1'], $_POST['date2']];

//   $SQL = getSQL($a);

//   $q = query($SQL);

//   // var_dump($SQL);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/styleBt.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Rekap Data</title>
  <a href="../Form_Rekap_Data/rekapdatadiet.php"></a>
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
    <br>
    <h2 style="text-align: center;">LAPORAN PERMINTAAN DIET PASIEN </h2>
    <br>
    <!-- <form action="" method="post" class="mb-2">
      <input type="text" name="keyword" size="40" autofocus 
      placeholder="masukkan keyword pencarian!!" autocomplete="off"> 
      <button type="submit" name="cari" >Cari Data</button>
      </form> -->
    <form action="" method="get">
      <div class="row g-2 align-items-center mb-2">
        <div class="col-auto">
          <label for="date1">Cari Data</label>
        </div>

        <div class="col-auto">
          <input type="text" name="search" class="form-control mr-2">
        </div>
        <div class="col-auto">
          <label for="date1">Tanggal mulai </label>
        </div>

        <div class="col-auto">
          <input type="date" name="startDate" id="startDate" class="form-control mr-2" value="<?= $startDate ?>">
        </div>

        <div class="col-auto">
          <label for="endDate">sampai </label>
        </div>

        <div class="col-auto">
          <input type="date" name="endDate" id="endDate" class="form-control mr-2" value="<?= $endDate ?>">
        </div>

        <div class="col-auto ">
          <button type="submit" name="submit1" class="btn btn-primary">Cari</button>
        </div>

        <div class="col-auto ">
          <a href="../dashboard_diet/dasboard_lpdiet.php" class="btn btn-dark"> Form Input</a>
        </div>

      </div>
    </form>

    <!-- Table Data Rekap Diet Pasien -->
    <table class="table table-sm table-bordered border border-dark">
      <style type="text/css">
        th {
          vertical-align: middle;
        }
      </style>
      <!-- Table Head -->
      <thead>
        <tr class="text-center" style="background-color: #c2d6d6; vertical-align: middle; ">
          <th>No</th>
          <th>Ruangan</th>
          <th>Tgl_Permintaan</th>
          <th>Nama Pasien</th>
          <th>Tgl_Lahir</th>
          <th>No Rm</th>
          <th>Tgl/Jam_Mrs</th>
          <th>Diagnosa</th>
          <th>No_Kamar</th>
          <th>Dpjp</th>
          <th>Diet Siang</th>
          <th>Diet Sore</th>
          <th>Diet Pagi</th>
          <th>Keterangan</th>
          <th>Edit Data</th>
        </tr>
      </thead>




      <!-- Table Data -->
      <tbody>
        <?php

        $i = 1;
        $mysqlData = mysqli_query($conn, $sql);
        $totalPages = ceil($mysqlCount / $limit);
        $previous = $page - 1;
        $next = $page + 1;

        $queryString = '';
        if (!empty($searchName)) {
          $queryString .= '&search=' . $searchName;
        }
        if (!empty($startDate) && !empty($endDate)) {
          $queryString .= '&startDate=' . $startDate . '&endDate=' . $endDate;
        }
        $nomor = ($page > 1) ? (($page - 1) * $limit) + 1 : 1;
        while ($row = mysqli_fetch_array($mysqlData)) { ?>

          <tr class="text-center" style="font-size:15px">
            <td><?= $nomor++ ?></td>
            <td><?= $row["nama_ruangan"]; ?></td>
            <td><?= date('d-M-Y', strtotime($row['tanggal'])); ?></td>
            <td><?= $row["nama_pasien"]; ?></td>
            <td><?= date('d-M-Y', strtotime($row['tanggal_lahir'])); ?></td>
            <td><?= $row["no_rm"]; ?></td>
            <td><?= date('D-M-Y H:i:s', strtotime($row["tanggal2"])) ?></td>
            <td><?= $row["diagnosa"]; ?></td>
            <td><?= $row["kamar"]; ?></td>
            <td><?= $row["nama_dokter"]; ?></td>
            <td><?= $row["diet_siang"]; ?></td>
            <td><?= $row["diet_sore"]; ?></td>
            <td><?= $row["diet_pagi"]; ?></td>
            <td><?= ucwords($row["status"]); ?></td>
            <td>
              <!-- <button type="button" class="btn btn-info"> <span class="bi bi-pencil-square">
                  <a href="../editdata/editdiet.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black"></a>
                </span>
              </button>
              <button type="button" class="btn btn-warning"> <span class="bi bi-trash">
                  <a href="../Function_Hapus/functionhapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black"></a>
                </span>
              </button> -->

              <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Aksi
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a class="dropdown-item" href="../editdata/editdiet.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">Edit</a></li>
                  <li><a class="dropdown-item" href="../Function_Hapus/functionhapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">Delete</a></li>
                  <?php if ($_SESSION["Level"] == 2) { ?>
                    <?php if ($row['status'] == 'pending') { ?>
                      <li><a class="dropdown-item" href="konfirmasi.php?id=<?= $row["id"]; ?>&status=diterima" onclick="return confirm('yakin?')">Terima</a></li>
                      <li><a class="dropdown-item" href="konfirmasi.php?id=<?= $row["id"]; ?>&status=ditolak" onclick="return confirm('yakin?')">Tolak</a></li>
                    <?php } else { ?>
                      <li><a class="dropdown-item" href="konfirmasi.php?id=<?= $row["id"]; ?>&status=pending" onclick="return confirm('yakin?')">Batalkan Permintaan</a></li>
                    <?php } ?>
                  <?php } ?>
                </ul>
              </div>

            </td>
          </tr>
        <?php } ?>


      </tbody>

    </table>
    <!-- tombol pagination -->
    <nav>
      <ul>
        <ul class="pagination justify-content-end">
          <!-- tombol sebelumnya -->
          <?php

          if ($page <= 1) { ?>
            <li class="page-item disabled"><a href="?page=<?= $page - 1; ?><?= $queryString; ?>" class="page-link">Sebelumnya</a></li>
          <?php } else { ?>
            <li class="page-item"><a href="?page=<?= $page - 1; ?><?= $queryString; ?>" class="page-link">Sebelumnya</a></li>
          <?php } ?>
          <?php for ($i = 1; $i <= $totalPages; $i++) {
          ?>
            <li class="page-item"> <a href="?page=<?= $i; ?><?= $queryString; ?>" class="page-link"><?= $i; ?></a></li>
          <?php } ?>
          <!-- tombol selanjutnya -->
          <?php
          if ($page >= $totalPages) { ?>
            <li class="page-item disabled"><a href="?page=<?= $page + 1; ?><?= $queryString; ?>" class="page-link">selanjutnya</a></li>
          <?php } else { ?>
            <li class="page-item"><a href="?page=<?= $page + 1; ?><?= $queryString; ?>" class="page-link">selanjutnya</a></li>
          <?php } ?>
        </ul>

      </ul>
      <div class="d-flex justify-content-end mb-2">
        <label for="" style="padding-right: 4px;">Download hasil laporan</label>
        <a target="_blank" href="../cetak_pdf.php?SQL=<?= $sql .= " LIMIT $limit OFFSET $offset"; ?>"><button style="background-color: smoke;">Download Data</button></a>
      </div>
    </nav>

    <div class="footer">
      <p><?= $Credit ?></p>
    </div>

    <script src="../assets/Js.js"></script>
</body>

</html>