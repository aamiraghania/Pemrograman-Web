<?php
$totalKursi = 45;

$kursiTerisi = 28;

$kursiKosong = $totalKursi - $kursiTerisi;

$persenKosong = ($kursiKosong / $totalKursi) * 100;

echo "Jumlah kursi kosong: $kursiKosong <br>";
echo "Persentase kursi kosong: " . $persenKosong . "%";
?>
