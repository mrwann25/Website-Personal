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

//Get user by id query param
$id = $_GET["id"];
$user = mysqli_query($conn, "SELECT * FROM db_registrasi WHERE id = $id");
$user = mysqli_fetch_assoc($user);

if (isset($_POST["submit"])) {
    $username = strtolower(stripslashes($_POST["username"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $level = strtolower(stripslashes($_POST["jabatan"]));

    //cek apakah username sudah ada
    $cek = mysqli_query($conn, "SELECT * FROM db_registrasi WHERE username = '$username' AND id != $id");
    if (mysqli_num_rows($cek) > 0) {
        echo "
            <script>
                alert('Username sudah ada!');
                document.location.href = 'edit.php?id=$id';
            </script>
        ";
        exit;
    }else{

        if ($password == "") {
            $password = $user["password"];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $query = "UPDATE db_registrasi SET username = '$username', password = '$password', level = '$level' WHERE id = $id";
        $cek = mysqli_query($conn, $query);

        if ($cek) {
            echo "
                <script>
                    alert('Data user telah diubah!');
                    document.location.href = 'edit.php?id=$id';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data user gagal diubah!');
                    document.location.href = 'edit.php?id=$id';
                </script>
            ";
        }
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
                        <a class="dropdown-item" href="../dashboard_diet/dasboard_lpdiet.php">Laporan Diet Pasien</a>
                    </li>

                    <!-- jika level user sama dengan 2 atau 3 tampilkan -->
                    <?php if ($Level == 2 or $Level == 3) { ?>
                        <li>
                            <a class="dropdown-item" href="../dashboard_pemesanan/dashboardpemasanan.php">Permintaan Stok Bahan Makan</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../dbPermintaan_Alat/dbPermintaanAlat.php">Permintaan Alat Masak</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../Laporan_Stok/laporanStok.php">Laporan Stok</a>
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
                </ul>
            </div>
        </div>
    </div>

    <!--Main Content-->
    <div class="container mt-1">
        <h4 class="text-center">Input Data User</h4>
        <div style="background-color: rgb(228, 228, 228)">
            <div class="container-fluid">
                <form action="" method="post" class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control form-control-sm" id="username" value="<?= $user["username"]; ?>" />
                    </div>
                    <div class="col-md-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" id="password" />
                        <small>Kosongkan jika password tidak ingin diubah</small>
                    </div>
                    <div class="col-md-4">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select" require>
                            <option value="" selected>Pilih Jabatan</option>
                            <option <?= $user["level"] == 1 ? 'selected' : '' ?> value="1">Admin</option>
                            <option <?= $user["level"] == 2 ? 'selected' : '' ?> value="2">Super Admin</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2 d-md-relative justify-content-md-end mb-1">
                        <button type="submit" name="submit" class="btn btn-warning">Sumbit Data</button>
                        <a href="../data_user/index.php" class="btn btn-secondary btn-mb active" role="button" aria-pressed="true">Kembali</a>

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