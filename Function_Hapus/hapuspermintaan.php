<?php
require "../Functions/functions.php";
$Id = $_GET["id"];

if (hapuspermintaan($Id) > 0) {
    echo " <script>
    alert('data berhasil dihapus!');
    window.location.href= '../Form_Rekap_Data/permintaanalat.php';
     </script>
    ";

} else {
    echo " <script>
    alert('data gagal dihapus!');
    window.location.href= '../Form_Rekap_Data/permintaanalat.php';
     </script>
     ";
}

?>