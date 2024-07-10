<?php

include "../Functions/functions.php";

$no_rm = trim(strip_tags($_GET['no_rm']));

$query = mysqli_query($conn, "SELECT * FROM `db_data_pasien` WHERE no_rm = '$no_rm'  LIMIT 1");
$dataResult = mysqli_fetch_assoc($query);

$jenkel = $_GET['jenkel'];
$usia = $_GET['usia'];
$berat_badan = $_GET['berat_badan'];
$tinggi_badan = $_GET['tinggi_badan'];
$level = $_GET['level'];

$usia = (int) $usia;
$berat_badan = (float) $berat_badan;
$tinggi_badan = (float) $tinggi_badan;
$level = (float) $level;

if ($jenkel == 'L') {
    $bmr = 88.4 + (13.4 * $berat_badan) + (4.8 * $tinggi_badan) - (5.68 * $usia);
} else {
    $bmr = 447.6 + (9.25 * $berat_badan) + (3.10 * $tinggi_badan) - (4.33 * $usia);
}

$totalCalories = $bmr * $level;

if ($level == 1.2) {
    $textLevel = "Sangat jarang olahraga";
} elseif ($level == 1.375) {
    $textLevel = "Jarang olahraga (1-3 hari/ minggu)";
} elseif ($level == 1.55) {
    $textLevel = "Cukup olahraga (3-5 hari/ minggu)";
} elseif ($level == 1.725) {
    $textLevel = "Sering olahraga (6-7 hari/ minggu)";
} elseif ($level == 1.9) {
    $textLevel = "Sangat sering olahraga (sekitar 2 kali dalam sehari)";
}else{
    $textLevel = "Sangat jarang olahraga";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Kalkulasi Gizi</title>
    <style>
        body {
            font-family: Arial, sans-serif;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 2px solid black;
            padding: 5px;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center;">Hasil Kalkulasi Gizi</h1>
    <table>
        <tr>
            <th colspan="2">
                Kalkulasi Gizi
            </th>
        </tr>
        <tr>
            <th>No. RM</th>
            <td><?= $no_rm ?></td>
        </tr>
        <tr>
            <th>Nama Pasien</th>
            <td><?= $dataResult['nama'] ?></td>
        </tr>
        <tr>
            <th>Berat Badan</th>
            <td><?= $berat_badan ?></td>
        </tr>
        <tr>
            <th>Tinggi Badan</th>
            <td><?= $tinggi_badan ?></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td><?= $jenkel ?></td>
        </tr>
        <tr>
            <th>Usia</th>
            <td><?= $usia ?></td>
        </tr>
        <tr>
            <th>Level Aktivitas Fisik</th>
            <td><?= $textLevel ?></td>
        </tr>
    </table>

    <table>
        <tr>
            <th colspan="2">
                Hasil Kalkulasi
            </th>
        </tr>
        <tr>
            <th>BMR atau Basal Metabolic Rate (laju metabolisme basal):</th>
            <td><?= round($bmr, 2) ?> <small>kcal per hari</small></td>
        </tr>
        <tr>
            <th>Kalori harian berdasarkan tingkat aktivitas:</th>
            <td><?= round($totalCalories, 2) ?> <small>kcal per hari</small></td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
    
</body>

</html>