<?php

include "../Functions/functions.php";

$no_rm = trim(strip_tags($_GET['no_rm']));

$query = mysqli_query($conn,"SELECT nama, tgl_lahir FROM db_data_pasien WHERE no_rm = '$no_rm'  LIMIT 1");
$dataResult = mysqli_fetch_assoc($query);


$array = [
    "nama" => isset($dataResult['nama']) ? $dataResult['nama'] : '',
    "tgl_lahir" => isset($dataResult['tgl_lahir']) ? $dataResult['tgl_lahir'] : ''
];

header('Content-Type: application/json');
echo json_encode($array);
?>