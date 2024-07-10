<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_rm = $_POST['no_rm'];
    $jenkel = $_POST['jenkel'];
    $usia = $_POST['usia'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $level = $_POST['level'];

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

    echo '<div class="p-1">';
    echo '<h4 class="text-danger text-bold mb-4" align="center">ESTIMASI<br>Kebutuhan Kalori per Hari</h4>';
    echo '<h5>BMR atau Basal Metabolic Rate (laju metabolisme basal): </h5>';
    echo '<h4 class="text-primary">' . round($bmr, 2) . '</h4> <small>kcal per hari</small><br><br>';
    echo '<h5>Kalori harian berdasarkan tingkat aktivitas: </h5>';
    echo '<h4 class="text-success">' . round($totalCalories, 2) . '</h4> <small>kcal per hari</small>';
    echo '</div>';

    echo '<a target="_blank" href="../kalkulasi_gizi/kalkulator-gizi-print.php?no_rm=' . $no_rm . '&jenkel=' . $jenkel . '&usia=' . $usia . '&berat_badan=' . $berat_badan . '&tinggi_badan=' . $tinggi_badan . '&level=' . $level . '" class="btn btn-sm btn-danger mt-3">Print</a>';
}

?>