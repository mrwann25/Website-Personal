<?php

include "../Functions/functions.php";

$term = trim(strip_tags($_GET['term']));

$query = mysqli_query($conn,"select * from database_dokter where nama_dokter like '%$term%'" );


$array = array();

while($data = mysqli_fetch_assoc($query)){
$row['value'] = $data['nama_dokter'];

array_push($array,$row);

}

echo json_encode($array);
?>