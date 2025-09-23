<?php
$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];

echo "<h3>Perhitungan Nilai Siswa</h3>";
echo "Daftar nilai awal: " . implode(", ", $nilaiSiswa) . "<br><br>";

sort($nilaiSiswa);

array_shift($nilaiSiswa);
array_shift($nilaiSiswa);

array_pop($nilaiSiswa);
array_pop($nilaiSiswa);

$totalNilai = array_sum($nilaiSiswa);

$rataRata = $totalNilai / count($nilaiSiswa);

echo "Total nilai setelah mengabaikan 2 nilai tertinggi dan 2 nilai terendah adalah: <b>$totalNilai</b><br>";
echo "Rata-rata nilai siswa setelah pengabaian adalah: <b>$rataRata</b>";
?>
