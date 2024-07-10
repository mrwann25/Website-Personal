<?php 
require "../Functions/functions.php";

// ambil data diurl
if(!isset($_GET["id"])) {
  echo "Diperlukan Parameter ID";
  exit;
} else {

$stok = $_GET["id"];  

// query data formdiet berdasarkan Id
$form_gambar = query("SELECT * FROM tb_image_upload WHERE id = $stok");

$TotalData = count($form_gambar);

if($TotalData == 0) {
  echo "ID tidak ditemukan";
  exit;
} else {
$form_gambar = query("SELECT * FROM tb_image_upload WHERE id = $stok")[0];
}

}

// if ( isset($_POST["submit3"])) {
  
// // pengecekan apakah data berhasil diubah atau tidak
//   if( ubahgambar($_POST) > 0 ) {
//     echo " <script>
//     alert('data berhasi l diubah!');
    
//      </script>
//        ";
//       } else {
//     echo " 
//     <script>
//     alert('data gagal diubah!');
    
//      </script>";
//     }

// }
// ?>

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
        <a
          class="navbar-brand"
          data-bs-toggle="offcanvas"
          href="#offcanvasExample"
          role="button"
          aria-controls="offcanvasExample"
        >
          _Menu_
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="../Form Login/dashboard login.html"
                >SISFO INSTALASI GIZI</a
              >
            </li>
          </ul>
        </div> 
        <button type="button" class="btn btn-danger">Log Out</button>
      </div>
    </nav>

    <!--Sidebar-->
    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="offcanvasExample"
      aria-labelledby="offcanvasExampleLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
          RSUD H. Badaruddin Kasim
        </h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <div>Selamat datang di aplikasi Instalasi GIZI</div>
        <div class="dropdown">
          <button
            class="btn btn-danger dropdown-toggle"
            type="button"
            id="dropdownMenuButton"
            data-bs-toggle="dropdown"
          >
            Klik_Disini
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
              <a
                class="dropdown-item"
                href="../dashboard_diet/dasboard_lpdiet.php"
                >Laporan Diet Pasien</a
              >
            </li>
            <li>
              <a class="dropdown-item" href="../dashboard_pemesanan/dashboardpemasanan.php">Permintaan Stok Bahan</a>
            </li>
            <li>
              <a
                class="dropdown-item"
                href="../dbPermintaan_Alat/dbPermintaanAlat.php"
                >Permintaan Alat Masak/Makan Pasien</a
              >
            </li>
            <li>
              <a class="dropdown-item" href="../Laporan_Stok/laporanStok.php"
                >Laporan Stok</a
              >
            </li>
            
          </ul>
        </div>
      </div>
    </div>

    <!--Main Content-->
    <div class="container mt-1">
      <h4 class="text-center">Ubah Data Jadwal jaga/Shift (Edit Data)</h4>
      <div style="background-color: rgb(228, 228, 228)">
        <div class="container-fluid">
          <form action="" method="post" class="row g-3 mt-2">
          <input type="hidden" name="id" value="<?= $form_gambar["id"]; ?>">  
          <div class="col-md-3">
          <label for="name1">Name : </label>
            <input type="text" name="name1" id = "name1" required value="<?= $form_gambar["name_gambar"]; ?>" />
           </div>
           <div class="col-auto">
                <label for="image2">Image : </label>
                <input type="file" name="image2" id = "image2" accept=".jpg, .jpeg, .png" value="<?= $form_laporan["image_id"]; ?>"  />
            </div>
                                  
            <div class="d-flex gap-2 d-md-relative justify-content-md-end">
              <button type="submit" name="submit3" class="btn btn-warning">Ubah Data!</button>
            <a href="../db_jadwaljaga/dashboard_upload.php" class="btn btn-sm btn-secondary" style="width: 150px;">Back</a>
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
