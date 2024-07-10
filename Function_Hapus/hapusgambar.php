<?php
require "../Functions/functions.php";
$Id = $_GET["id"];

if (hapusgambar($Id) > 0) {
    echo " <script>
    alert('data berhasil dihapus!');
    window.location.href= '../db_jadwaljaga/dashboard_upload.php';
     </script>
    ";

} else {
    echo " <script>
    alert('data gagal dihapus!');
    window.location.href= '../Form_Rekap_Data/rekapdatadiet.php';
     </script>
     ";
}

?>


