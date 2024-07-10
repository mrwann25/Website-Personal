<?php

// require '../vendor/PHPExcel-1.8/Classes/PHPExcel.php';
date_default_timezone_set('Asia/Jakarta');

//  $conn = mysqli_connect("localhost", "root", "", "dbs_gizi");

// HAPUS CODE DIBAWAH UNTUK KEMBALI KE KONEKSI YANG BARU
$conn = mysqli_connect("localhost", "root", "", "dbs_gizi25");

function query($query)
{
  global $conn; //variabel diluar function menggunakan global
  $result = mysqli_query($conn, $query);
  $rows = [];   //kotak kosong
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row; //menambahkan elemen baru diakhir tiap array
  }
  return $rows;
}

//Footer
$Credit = "Mirwan R || Copyright &copy 2024 - Sistem Permintaan Diet Pasien V 1.1";


// function tambah rekap data diet pasien
function tambah($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $nmpasien = htmlspecialchars($data["NamaPasien"]);
  $Ruangan = htmlspecialchars($data["Ruangan"]);
  $Tanggal = htmlspecialchars($data["Tanggal"]);
  $Tgl1 = htmlspecialchars($data["Tanggal1"]);
  $noRM = htmlspecialchars($data["NoRm"]);
  $Tgl2 = htmlspecialchars($data["Tanggal2"]);
  $Diagnosa = htmlspecialchars($data["Diagnosa"]);
  $Kamar = htmlspecialchars($data["Kamar"]);
  $Dpjp = htmlspecialchars($data["namadokter"]);
  $DietPagi = htmlspecialchars($data["DietPagi"]);
  $DietSiang = htmlspecialchars($data["DietSiang"]);
  $DietSore = htmlspecialchars($data["DietSore"]);

  // query
  $query = "INSERT INTO db_formdiet
                VALUES 
                  (NULL,'$Ruangan','$Tanggal', '$nmpasien', '$Tgl1', '$noRM', '$Tgl2', '$Diagnosa', '$Kamar','$Dpjp', '$DietPagi',
                      '$DietSiang', '$DietSore', 'pending')
                            ";
  mysqli_query($conn, $query);


  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}
// function hapus rekap diet
function hapus($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM db_formdiet WHERE id = $Id");
  return mysqli_affected_rows($conn);
}

// function Ubah rekap data diet pasien
function ubah($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $fr = $data["id"];
  $Ruangan = htmlspecialchars($data["Ruangan"]);
  $Tanggal = htmlspecialchars($data["Tanggal"]);
  $NamaPasien = htmlspecialchars($data["NamaPasien"]);
  $Tgl1 = htmlspecialchars($data["Tanggal1"]);
  $NoRm = htmlspecialchars($data["NoRm"]);
  $Tgl2 = htmlspecialchars($data["Tanggal2"]);
  $Diagnosa = htmlspecialchars($data["Diagnosa"]);
  $Kamar = htmlspecialchars($data["Kamar"]);
  $Dpjp = htmlspecialchars($data["namadokter"]);
  $DietPagi = htmlspecialchars($data["DietPagi"]);
  $DietSiang = htmlspecialchars($data["DietSiang"]);
  $DietSore = htmlspecialchars($data["DietSore"]);

  // query
  $query = "UPDATE db_formdiet SET 
                      nama_ruangan = '$Ruangan',
                      tanggal = '$Tanggal',
                      nama_pasien = '$NamaPasien',
                      tanggal_lahir = '$Tgl1',
                      no_rm = '$NoRm',
                      tanggal2 = '$Tgl2',
                      diagnosa = '$Diagnosa',
                      kamar = '$Kamar',
                      nama_dokter = '$Dpjp',
                      diet_pagi = '$DietPagi',
                      diet_siang = '$DietSiang',
                      diet_sore = '$DietSore'
                      WHERE id = $fr
                      ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}

// function untuk mencari sesuai nama_pasien atau no_rm
function cariData($keyword)
{
  $query = "SELECT * FROM `db_formdiet` WHERE nama_pasien LIKE '%$keyword%' OR nama_ruangan LIKE '%$keyword%'";


  return query($query);
}

// function getSQL($a)
// {
//   $b = $a[0]; //Keyword
//   $c = $a[1]; //Tgl Awal
//   $d = $a[2]; //Tgl Akhir

//   if (empty($b) && empty($c) && empty($d)) {
//     // jika parameter input yang dicari 0/tidak ada makan tampilkan semua data
//     $query = "SELECT * FROM db_formdiet";
//   } else {
//     // Jika keyword,tanggal awal dan tgl akhir tidak sama dengan kosong maka cari data berdasarkan keyword dan tanggal
//     if ($b != "" && $c != "" && $d != "") {
//       $query = "SELECT * FROM `db_formdiet` WHERE nama_pasien LIKE '%$b%' OR nama_ruangan LIKE '%$b%' AND tanggal BETWEEN '$c' AND '$d'";

//       // Jika keyword kosong cari berdasarkan tanggal
//     } else if ($b != '') {
//       $query = "SELECT * FROM `db_formdiet` WHERE nama_pasien LIKE '%$b%' OR nama_ruangan LIKE '%$b%'";
//     } else {
//       // kondisi khusus pencarian data berdasarkan tanggal, ruangan dan nama pasien
//       $query = "SELECT a.* FROM (SELECT * FROM `db_formdiet` WHERE tanggal BETWEEN '$c' AND '$d') as a WHERE a.nama_ruangan LIKE '%$b%' OR a.nama_pasien LIKE '%$b%'";
//     }
//   }
//   // kembalikan nilai
//   return $query;
// }


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

// function tambah stok bahan makanan 
function tambahbahan($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $NamaBarang = htmlspecialchars($data["namabarang"]);
  $JumlahPermintaan = htmlspecialchars($data["jumlahpermintaan"]);
  $JumlahDatang = htmlspecialchars($data["jumlahdatang"]);
  $Keterangan = htmlspecialchars($data["keterangan"]);
  $Tanggal = htmlspecialchars($data["tanggal"]);

  // query
  $query = "INSERT INTO db_pemesananbahanmakan
        VALUES 
        (NULL,'$NamaBarang', '$JumlahPermintaan', 
        '$JumlahDatang', '$Keterangan', '$Tanggal')
";
  mysqli_query($conn, $query);
  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}

// function hapus pemesanan
function hapuspemesanan($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM db_pemesananbahanmakan WHERE id = $Id");
  return mysqli_affected_rows($conn);
}


// function ubah rekap pemesanan bahan makan
function ubahpemesanan($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $frpemesanan = $data["id"];
  $NamaBarang = htmlspecialchars($data["namabarang"]);
  $JumlahPermintaan = htmlspecialchars($data["jumlahpermintaan"]);
  $JumlahDatang = htmlspecialchars($data["jumlahdatang"]);
  $Keterangan = htmlspecialchars($data["keterangan"]);
  $Tanggal = htmlspecialchars($data["tanggal"]);

  // query update database
  $query = "UPDATE db_pemesananbahanmakan SET 
   nama_bahan = '$NamaBarang',
   jumlah_permintaan = '$JumlahPermintaan',
   jumlah_datang = '$JumlahDatang',
   keterangan = '$Keterangan',
   tanggal = '$Tanggal'
   WHERE id = $frpemesanan
  ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}

// function untuk mencari sesuai nama_bahan
function caripemesanan($keyword)
{
  $query = "SELECT * FROM db_pemesananbahanmakan
  WHERE 
  nama_bahan LIKE '%$keyword%'
  ";

  return query($query);
}



// function tambah alat masak 
function tambahalat($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $NamaBarang = htmlspecialchars($data["namabarang"]);
  $JumlahPermintaan = htmlspecialchars($data["jumlahpermintaan"]);
  $JumlahDiberi = htmlspecialchars($data["jumlahdiberi"]);
  $Keterangan = htmlspecialchars($data["keterangan"]);
  $NamaPetugas = htmlspecialchars($data["namapetugas"]);
  $YangMenyetujui = htmlspecialchars($data["ygmenyetujui"]);
  $Tanggal = htmlspecialchars($data["tanggal"]);
  $Kondisi = htmlspecialchars($data["alat"]);

  // query
  $query = "INSERT INTO db_permintaanalat
                                                  VALUES 
                                                  (NULL,'$NamaBarang', '$JumlahPermintaan', '$JumlahDiberi', 
                                                  '$Keterangan', '$NamaPetugas', '$YangMenyetujui', '$Tanggal', '$Kondisi')
                                          ";
  mysqli_query($conn, $query);
  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}
// function hapus permintaan
function hapuspermintaan($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM db_permintaanalat WHERE id = $Id");
  return mysqli_affected_rows($conn);
}

// function ubah rekap permintaan alat
function ubahpermintaan($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $permintaan = $data["id"];
  $NamaBarang = htmlspecialchars($data["namabarang"]);
  $JumlahPermintaan = htmlspecialchars($data["jumlahpermintaan"]);
  $JumlahDiberi = htmlspecialchars($data["jumlahdiberi"]);
  $Keterangan = htmlspecialchars($data["keterangan"]);
  $NamaPetugas = htmlspecialchars($data["namapetugas"]);
  $YangMenyetujui = htmlspecialchars($data["yangmenyetujui"]);
  $Tanggal = htmlspecialchars($data["tanggal"]);


  // query
  $query = "UPDATE db_permintaanalat SET 
                                          nama_alat = '$NamaBarang',
                                          jumlah_permintaan = '$JumlahPermintaan',
                                          jumlah_diberi = '$JumlahDiberi',
                                          keterangan = '$Keterangan',
                                          nama_petugas = '$NamaPetugas',
                                          nama_pejabat = '$YangMenyetujui',
                                          tanggal = '$Tanggal'
                                          WHERE id = $permintaan
                                          ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}


// function untuk mencari sesuai nama_alat
function caripermintaan($keyword)
{
  $query = "SELECT * FROM db_permintaanalat
                                            WHERE 
                                            nama_alat LIKE '%$keyword%'
                                            ";

  return query($query);
}

// function tambah laporan stok
function tambahstok($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form

  $NamaBahan = htmlspecialchars($data["Nm"]);
  $Tanggal = htmlspecialchars($data["Tgl"]);
  $Masuk = htmlspecialchars($data["Masuk"]);
  $Keluar = htmlspecialchars($data["Keluar"]);
  $Sisa = htmlspecialchars($data["Stk"]);

  // query
  $query = "INSERT INTO db_laporanstok
                  VALUES 
                  (NULL,'$NamaBahan', '$Tanggal', '$Masuk', 
                  '$Keluar', '$Sisa')
          ";
  mysqli_query($conn, $query);
  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}
// function hapus permintaan
function hapusstok($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM db_laporanstok WHERE id = $Id");
  return mysqli_affected_rows($conn);
}

// function ubah rekap laporan sotk
function ubahstok($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $stok = $data["id"];
  $NamaBahan = htmlspecialchars($data["Nm"]);
  $Tanggal = htmlspecialchars($data["Tgl"]);
  $Masuk = htmlspecialchars($data["Masuk"]);
  $Keluar = htmlspecialchars($data["Keluar"]);
  $Sisa = htmlspecialchars($data["Stk"]);

  // query
  $query = "UPDATE db_laporanstok SET 
          nama_bahan = '$NamaBahan',
          tanggal = '$Tanggal',
          masuk = '$Masuk',
          keluar = '$Keluar',
          sisa_stok = '$Sisa'
          WHERE id = $stok
          ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}


// function untuk mencari sesuai nama_alat
function caristok($keyword)
{
  $query = "SELECT * FROM db_laporanstok
            WHERE 
            nama_bahan LIKE '%$keyword%'
            ";

  return query($query);
}



// function hapus gambar
function hapusgambar($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM tb_image_upload WHERE id = $Id");
  return mysqli_affected_rows($conn);
}

//  function ubah data gambar akan dikembangkan dikemudian hari
// function ubahgambar($data) {
//   global $conn;
//   // amibl dari data tiap elemen dalam form
//   $form_gambar = $data["id"];
//   $Image = htmlspecialchars($data["name1"]);
//   $Image1 = htmlspecialchars($data["image2"]);


//   // query
//   $query = "UPDATE tb_image_upload SET 
//    name_gambar = '$Image',
//    image_id = '$Image1'

//    WHERE id = $form_gambar
//   ";

//   mysqli_query($conn, $query);

//   // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
//   return mysqli_affected_rows($conn);
//   }

// <<<FUNCTION UNTUK MENAMBAHKAN REGISTRASI >>>

// function untuk registari username baru
function registrasi($data)
{
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $password1 = mysqli_real_escape_string($conn, $data["password1"]);
  $level = strtolower(stripslashes($data["level"]));

  // pengecekan username sudah pernah dibuat atau tidak
  $result = mysqli_query($conn, "SELECT username FROM db_registrasi 
                              WHERE username = '$username' ");

  // jika ada tampilkan
  if (mysqli_fetch_assoc($result)) {
    echo "<script> 
                        alert('username sudah terdaftar!')
                        </script>";
    // berhentikan function agar tidak ditambahkan
    return false;
  }


  // cek konfirmasi password
  if ($password !== $password1) {
    echo "<script>
                        alert('password tidak sesuai!');
                          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan user baru kedalam database
  mysqli_query($conn, "INSERT INTO db_registrasi VALUES(NULL,'$username', 
                '$password','$level')");

  return mysqli_affected_rows($conn);
}


// KONFIGURASI UNTUK PAGINATION
$jumlahdataperhalaman = 4;
// query mengembalikan array assocative
$jumlahdata = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM db_formdiet"));
$JumlahHalaman = ceil($jumlahdata / $jumlahdataperhalaman);
if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}
$DataAwal = ($jumlahdataperhalaman * $halamanAktif) - $jumlahdataperhalaman;




// function tambah data Dokter
function tambahdokter($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $Id_dokter = $data["iddokter"];
  $NamaDokter = htmlspecialchars($data["nmdokter"]);
  $JabatanDokter = htmlspecialchars($data["jbtndokter"]);
  $stsDokter = htmlspecialchars($data["stsdokter"]);

  // query
  $query = "INSERT INTO database_dokter
                    VALUES 
                    (NULL,'$NamaDokter', '$JabatanDokter', 
                    '$stsDokter') ";
  mysqli_query($conn, $query);
  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}

// function ubah data dokter
function ubahdatadokter($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $Id_dokter = $data["iddokter"];
  $NamaDokter = htmlspecialchars($data["nmdokter"]);
  $JabatanDokter = htmlspecialchars($data["jbtndokter"]);
  $stsdokter = htmlspecialchars($data["stsdokter"]);

  // query
  $query = "UPDATE database_dokter SET 
              nama_dokter = '$NamaDokter',
              jabatan_dokter = '$JabatanDokter',
              status_dokter = '$stsdokter'
              WHERE id_dokter = $Id_dokter
              ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}


                  // function tambah rekap data cppt
function tambahcppt($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $norm = htmlspecialchars($data["NoRm"]);
  $Tgl = htmlspecialchars($data["tgl"]);
  $nmpasien = htmlspecialchars($data["NamaPasien"]);
  $Ruangan = htmlspecialchars($data["Ruangan"]);
  $ptinput = htmlspecialchars($data["ptinput"]);
  $Diagnosa = htmlspecialchars($data["Diagnosa"]);
  $Kamar = htmlspecialchars($data["Kamar"]);
  $Dpjp = htmlspecialchars($data["namadokter"]);
  $hasil = htmlspecialchars($data["cppt"]);


  // query
  $query = "INSERT INTO db_cppt
                VALUES 
                  (NULL,'$norm','$Tgl', '$nmpasien', '$Ruangan', '$ptinput', '$Diagnosa', '$Kamar','$Dpjp',
                      '$hasil')
                            ";
  mysqli_query($conn, $query);


  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}
// function hapus rekap diet
function hapuscppt($Id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM db_cppt WHERE id = $Id");
  return mysqli_affected_rows($conn);
}

// function Ubah rekap data diet pasien
function ubahcppt($data)
{
  global $conn;
  // amibl dari data tiap elemen dalam form
  $cppt = $data["id"];
  $norm = htmlspecialchars($data["NoRm"]);
  $Tgl = htmlspecialchars($data["tgl"]);
  $nmpasien = htmlspecialchars($data["NamaPasien"]);
  $Ruangan = htmlspecialchars($data["Ruangan"]);
  $ptinput = htmlspecialchars($data["ptinput"]);
  $Diagnosa = htmlspecialchars($data["Diagnosa"]);
  $Kamar = htmlspecialchars($data["Kamar"]);
  $Dpjp = htmlspecialchars($data["namadokter"]);
  $hasil = htmlspecialchars($data["cppt"]);

  // query
  $query = "UPDATE db_cppt SET 
  no_rm = '$norm',
  tanggal = '$Tgl',                   
  nama_pasien = '$nmpasien',
  nama_ruangan = '$Ruangan',
  petugas = '$ptinput',
  diagnosa = '$Diagnosa',
  kamar = '$Kamar',
  nama_dokter = '$Dpjp',
  hasil = '$hasil'
                      WHERE id = $cppt
                      ";

  mysqli_query($conn, $query);

  // setelah dijalankan query, function mengembalikan angka didapat dari mysqli_affected_row
  return mysqli_affected_rows($conn);
}

// function untuk mencari sesuai nama_pasien atau no_rm
// function cariData($keyword)
// {
//   $query = "SELECT * FROM `db_formdiet` WHERE nama_pasien LIKE '%$keyword%' OR nama_ruangan LIKE '%$keyword%'";


//   return query($query);
// }