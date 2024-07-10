<?php
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location:../Form_Login/formlogin.php");
    exit;
} else {
    
    require "../Functions/functions.php";

    $id = $_GET["id"];
    $hapus = mysqli_query($conn, "DELETE FROM db_registrasi WHERE id = $id");

    if ($hapus) {
        echo "
        <script>
        alert('data berhasil dihapus!');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('data gagal dihapus!');
        document.location.href = 'index.php';
        </script>
        ";
    }
}