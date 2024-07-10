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
    if (tambah($_POST) > 0) {
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

    <title>Kalkulator Gizi</title>
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
        <h4 class="text-center mb-3 mt-3">Form Kalkulator Gizi</h4>
        <div style="background-color: rgb(228, 228, 228)">
            <div class="container">
                <div class="row d-flex align-items-stretch no-gutters">
                    <div class="col-md-6 ftco-animate p-2 p-md-2">
                        <div class="bg-light bor-rad-cek p-4">

                            <div class="form-group">
                                <label><b>No RM</b></label>
                                <input type="text" name="NoRm" class="form-control" id="NoRm" />
                                <p class="val-text" id="no_rm"></p>
                            </div>

                            <div class="form-group">
                                <label><b>Nama Pasien</b></label>
                                <input type="text" class="form-control" id="NamaPasien" readonly>
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label><b>Jenis Kelamin</b></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="radio" name="jenkel" id="jenkel_L" value="L" checked="true"> Laki-laki
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="radio" name="jenkel" id="jenkel_P" value="P"> Perempuan
                                        </div>
                                    </div>
                                </div>
                                <p class="val-text" id="jenkelv"></p>
                            </div>
                            <div class="form-group">
                                <label><b>Berat Badan</b></label>
                                <div class="input-group">
                                    <input type="number" min="1" step="0.01" class="form-control" id="berat_badan">
                                    <div class="input-group-append">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                                <p class="val-text" id="berat_badanv"></p>
                            </div>
                            <div class="form-group">
                                <label><b>Tinggi Badan</b></label>
                                <div class="input-group">
                                    <input type="number" min="45" max="120" step="0.01" class="form-control" id="tinggi_badan">
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <p class="val-text" id="tinggi_badanv"></p>
                            </div>
                            <div class="form-group">
                                <label><b>Usia</b></label>
                                <div class="input-group">
                                    <input type="number" min="1" step="1" class="form-control" id="usia">
                                    <div class="input-group-append">
                                        <span class="input-group-text">tahun</span>
                                    </div>
                                </div>
                                <p class="val-text" id="usiav"></p>
                            </div>
                            <div class="form-group">
                                <label><b>Level Aktivitas Fisik</b></label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="level" id="level" class="form-select">
                                                <option value="">- Pilih Level -</option>
                                                <option value="1.2">Sangat jarang olahraga</option>
                                                <option value="1.375">Jarang olahraga (1-3 hari/ minggu)</option>
                                                <option value="1.55">Cukup olahraga (3-5 kali per minggu)</option>
                                                <option value="1.725">Sering olahraga (6-7 kali per minggu)</option>
                                                <option value="1.9">Sangat sering olahraga (sekitar 2 kali dalam sehari)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <p class="val-text" id="levelv"></p>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="btnCek" name="btnCek" value="Cek Status Gizi" class="btn btn-primary py-2 px-4 mt-2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ftco-animate p-2 p-md-2 d-flex align-items-stretch">
                        <div class="bg-light bor-rad-cek p-4" style="width: 100%;">
                            <div id="hasil"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/Js.js"></script>
    <!-- <script src="../assets/Js.js"></script>

    <script>
      $(document).ready(function() {
          var search = $("#NoRm");
              search.keyup(function() {
                  if (search.val() != '') {    
                    //
                    $("#NamaPasien").val("JAJANG")
                    $("#Tanggal1").val("1990-12-12")

                  }
              });

      });
    </script> -->

    <script>
        document.getElementById('NoRm').addEventListener('input', function() {
            var noRm = this.value;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    document.getElementById('NamaPasien').value = response.nama;
                }
            };
            xhr.open("GET", "../kalkulasi_gizi/search_rm.php?no_rm=" + noRm, true);
            xhr.send();
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('btnCek').addEventListener('click', function() {
                var no_rm = document.getElementById('NoRm').value;
                var usia = document.getElementById('usia').value;
                var berat_badan = document.getElementById('berat_badan').value;
                var tinggi_badan = document.getElementById('tinggi_badan').value;
                var level = document.getElementById('level').value;

                var errors = false;

                if (no_rm === "") {
                    document.getElementById('no_rm').innerHTML = "No RM Harus Diisi";
                    window.scrollTo({
                        top: 350,
                        behavior: 'smooth'
                    });
                    errors = true;
                } else {
                    document.getElementById('no_rm').innerHTML = "";
                }
                if (usia === "") {
                    document.getElementById('usiav').innerHTML = "Usia Harus Diisi";
                    errors = true;
                } else {
                    document.getElementById('usiav').innerHTML = "";
                }
                if (berat_badan === "") {
                    document.getElementById('berat_badanv').innerHTML = "Berat Badan Harus Diisi Number";
                    errors = true;
                } else {
                    document.getElementById('berat_badanv').innerHTML = "";
                }
                if (tinggi_badan === "") {
                    document.getElementById('tinggi_badanv').innerHTML = "Tinggi Badan Harus Diisi Number";
                    errors = true;
                } else {
                    document.getElementById('tinggi_badanv').innerHTML = "";
                }

                if (!document.getElementById('jenkel_L').checked && !document.getElementById('jenkel_P').checked) {
                    document.getElementById('jenkelv').innerHTML = "Jenis Kelamin Harus Dipilih";
                    errors = true;
                } else {
                    document.getElementById('jenkelv').innerHTML = "";
                }

                if (level === "") {
                    document.getElementById('levelv').innerHTML = "Level Aktivitas Fisik Harus Diisi";
                    errors = true;
                } else {
                    document.getElementById('levelv').innerHTML = "";
                }

                if (!errors) {
                    var jenkel = document.getElementById('jenkel_L').checked ? document.getElementById('jenkel_L').value : document.getElementById('jenkel_P').value;

                    var formData = new FormData();
                    formData.append('no_rm', no_rm);
                    formData.append('jenkel', jenkel);
                    formData.append('usia', usia);
                    formData.append('berat_badan', berat_badan);
                    formData.append('tinggi_badan', tinggi_badan);
                    formData.append('level', level);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '../kalkulasi_gizi/kalkulator-gizi-action.php', true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            document.getElementById('hasil').innerHTML = xhr.responseText;
                            window.scrollTo({
                                top: 300,
                                behavior: 'smooth'
                            });
                        } else {
                            console.error('Failed to fetch data');
                        }
                    };

                    xhr.send(formData);
                }
            });
        });
    </script>
  <div class="footer">
      <p><?= $Credit ?></p>
    </div>
</body>

</html>