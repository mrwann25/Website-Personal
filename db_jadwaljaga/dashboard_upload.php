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
// //Tampilkan semua data
// $gambar = mysqli_query($conn, "SELECT * FROM tb_image_upload"); 

// kondisi ketika tombol submit di klik
if (isset($_POST["submit"])) {
  // data input nama
  $name = $_POST["name"];
  // kondisi upload file (jika d=tidak ada file upload sama dengan 4 matau kosong )
  // tampilkan pesan errro
  if ($_FILES["image"]["error"] == 4) {
    echo
    "<script> alert('Image Does Not Exist'); </script>";
  } else {
    $fileName = $_FILES["image"]["name"]; // nama file
    $fileSize = $_FILES["image"]["size"]; // ukuran file
    $tmpName = $_FILES["image"]["tmp_name"]; // tujuan penyimpanan

    $validImageExtension = ['jpg', 'jpeg', 'png']; //exstensei file
    $imageExtension = explode('.', $fileName); // nama file dipecah 
    $imageExtension = strtolower(end($imageExtension)); // ambil extension yang paling akhir
    //  cek tipe eks tipe file, jika didalam array yang tidak didalam array yg diizinkan/valid ekstension maka tampil pesan gagal
    if (!in_array($imageExtension, $validImageExtension)) {
      echo
      "
      <script>
        alert('Gambar Gagal di Upload');
      </script>
      ";
    }
    //  maksimal ukuran file yg boleh di upload (satuan kb)
    else if ($fileSize > 10000000) {
      echo
      "
      <script>
        alert('Ukuran Gambar Terlalu Besar');
      </script>
      ";
    } else {
      $newImageName = uniqid(); // unik id untuk nama file yang disimpan kedalam database
      $newImageName .= '.' . $imageExtension; // unik id + enkstension
      // pindahkan file tersebut kedalam folder img
      move_uploaded_file($tmpName, '../img/' . $newImageName);
      // tambahkan nama file baru kedalam database
      $query = "INSERT INTO tb_image_upload VALUES(NULL, '$name', '$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'dashboard_upload.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../assets/styleBt.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Upload Image File</title>
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
      <div>Selamat datang di aplikasi Instalasi GIZI </div>
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


  <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="container mt-2">
      <div class="row g-2 align-items-center mb-2">
        <div class="col-auto">
          <label for="name">Name : </label>
          <input type="text" name="name" id="name" required value="">
        </div>
        <div class="col-auto">
          <label for="image">Image : </label>
          <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="">
        </div>
        <div class="col-auto ml-0">
          <button type="submit" name="submit">Submit</button>
        </div>
      </div>

  </form>

  <br>
  <h1 style="text-align: center;">Jadwal Jaga/Shift</h1>
  <table class="table table-sm table-bordered border border-dark">
    <tr class="text-center" style="background-color: #c2d6d6; vertical-align: middle;">
      <th>No</th>
      <th>Jadwal_Jaga</th>
      <th>Foto</th>
      <th>Edit Data</th>
    </tr>

    <?php
    // sql untuk menampilkan gambar
    $i = 1;
    $SQLGetDataGambar = mysqli_query($conn, "SELECT * FROM tb_image_upload ORDER BY id DESC")
    ?>

    <?php
    // looping untuk menampilkan gambar
    foreach ($SQLGetDataGambar as $row) : ?>

      <tr class="text-center" style="font-size:15px">
        <td><?= $i++; ?></td>
        <td><?= $row["name_gambar"]; ?></td>
        <td> <img src="../img/<?= $row["image_id"]; ?>" width="900" height="600" title="<?= $row['image_id']; ?>"> </td>
        <td>
          <!-- function ubah data akan dikembangkan dikemudian hari -->
          <!-- <button type="button" class="btn btn-warning">
                  <a href="../Function_Ubah/ubahgambar.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')"  style="text-decoration: none; color:black"   >Ubah</a>
                  </button> -->
          <button type="button" class="btn btn-warning"> <span class="bi bi-trash">
              <a href="../Function_Hapus/hapusgambar.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')" style="text-decoration: none; color:black">Hapus</a>
            </span>
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  </div>
  <br>
  <!-- <a href="../uploadimagefile">Upload Image File</a> -->

  <!-- <a href="./data.php">Data</a> -->
  <div class="footer">
      <p><?= $Credit ?></p>
    </div>
  <script src="../assets/Js.js"></script>
</body>

</html>