<?php
session_start();

require "../Functions/functions.php";
$Date = date("Y-m-d", time() + 3600);
if (!isset($_SESSION["Login"])) {
    header("Location: formlogin.php");
    exit;
} else {
    //Get Session Level
    $Level = $_SESSION["Level"];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/styleBt.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Master Data Pasien</title>
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
    <!--Navbar bootstrap 5-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                _Menu_
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page">INSTALASI GIZI <?= date('Y-m-d H:i:s', time() + 3600) ?></a>
                    </li>
                </ul>
            </div>
            <a href="../Function_Logout/Logout.php">
                <button type="button" class="btn btn-danger">Log Out</button>
            </a>
        </div>
    </nav>

    <!--Sidebar bootsrap 5-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                RSUD H. Badaruddin Kasim || Level: <?php echo $Level; ?>
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

                    <?php if ($Level == 2 or $Level == 3) { ?>
                        <li><a class="dropdown-item" href="../Form_Rekap_Data/pemesananbahan.php">Permintaan Stok Bahan Makan</a></li>
                        <li><a class="dropdown-item" href="../Form_Rekap_Data/permintaanalat.php">Permintaan Alat Masak</a></li>
                        <li><a class="dropdown-item" href="../Form_Rekap_Data/rekaplaporanstok.php">Laporan Stok</a></li>

                    <?php } ?>
                    <li>
                        <a class="dropdown-item" href="../kalkulasi_gizi/index.php">Kalkulasi Gizi</a>
                    </li>
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
    <div class="container mt-2">
        <h4 class="text-center">Master Data User</h4>
        <div class="col-lg-6 col-lg-offset-3">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <button type="button" class="btn btn-warning">
                        <a href="../data_user/tambah.php" onclick="return confirm('yakin?')" style="text-decoration: none; color:black">Masukkan Data</a>
                    </button>

                </div>
            </form>

        </div>

        <thead>

            <table class="table table-sm table-bordered border border-dark mt-2">
                <style type="text/css">
                    th {
                        vertical-align: middle;
                    }
                </style>
                <!-- Table Head -->
                <thead>
                    <tr class="text-center" style="background-color: #c2d6d6; vertical-align: middle;">
                        <th>No</th>
                        <th>Username</th>
                        <th>Jabatan</th>
                        <th width="20%">Action</th>
                    </tr>

                    <?php
                    //  sql untuk menampilkan 
                    $i = 1;
                    $sqlgetdata = mysqli_query($conn, "SELECT * FROM db_registrasi ORDER BY id DESC")
                    ?>

                    <?php
                    // looping untuk menampilkan data
                    foreach ($sqlgetdata as $row) : ?>
                        <tr class="text-center" style="font-size: 15px;"></tr>
                        <td> <?= $i++ ?> </td>
                        <td> <?= $row["username"]; ?> </td>
                        <td>
                            <?php
                            if ($row["level"] == 1) {
                                echo "Admin";
                            } elseif ($row["level"] == 2) {
                                echo "Super Admin";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row["id"] != $_SESSION["id"]) {
                            ?>
                                <button type="button" class="btn btn-info">
                                    <span class="bi bi-pencil-square">
                                        <a href="../data_user/edit.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black">Edit</a>
                                    </span>
                                </button>

                                <button type="button" class="btn btn-danger">
                                    <span class="bi bi-trash">
                                        <a href="../data_user/delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black">Delete</a>
                                    </span>
                                </button>
                            <?php } ?>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </thead>
            </table>
    </div>
    <div class="footer">
      <p><?= $Credit ?></p>
    </div>
    <script src="../assets/Js.js"></script>
</body>

</html>