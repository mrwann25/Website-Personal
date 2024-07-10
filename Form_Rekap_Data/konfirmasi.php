<?php
require "../Functions/functions.php";

session_start();
if (!isset($_SESSION["Login"])) {
    header("Location:../Form_Login/formlogin.php");
    exit;
} else {
    $id = $_GET["id"];
    $status = $_GET["status"];

    $mysql_update = mysqli_query($conn, "UPDATE db_formdiet SET status = '$status' WHERE id = $id");

    if ($mysql_update) {
        echo "
        <script>
        alert('Data Berhasil');
        document.location.href = 'rekapdatadiet.php';
        </script>
        ";
    }else{
        echo "
        <script>
        alert('Data Gagal Diubah');
        document.location.href = 'rekapdatadiet.php';
        </script>
        ";
    }
}
