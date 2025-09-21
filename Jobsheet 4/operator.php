<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "<h3>Hasil Operasi Aritmatika</h3>";
echo "Nilai a = {$a} <br>";
echo "Nilai b = {$b} <br><br>";

echo "Hasil Penjumlahan (a + b) = {$hasilTambah} <br>";
echo "Hasil Pengurangan (a - b) = {$hasilKurang} <br>";
echo "Hasil Perkalian (a * b) = {$hasilKali} <br>";
echo "Hasil Pembagian (a / b) = {$hasilBagi} <br>";
echo "Hasil Sisa Bagi (a % b) = {$sisaBagi} <br>";
echo "Hasil Pangkat (a ** b) = {$pangkat} <br><br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "<h3>Hasil Operasi Perbandingan</h3>";
echo "Apakah a == b? "; var_dump($hasilSama); echo "<br>";
echo "Apakah a != b? "; var_dump($hasilTidakSama); echo "<br>";
echo "Apakah a < b? "; var_dump($hasilLebihKecil); echo "<br>";
echo "Apakah a > b? "; var_dump($hasilLebihBesar); echo "<br>";
echo "Apakah a <= b? "; var_dump($hasilLebihKecilSama); echo "<br>";
echo "Apakah a >= b? "; var_dump($hasilLebihBesarSama); echo "<br><br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "<h3>Hasil Operasi Logika</h3>";
echo "a && b = "; var_dump($hasilAnd); echo "<br>";
echo "a || b = "; var_dump($hasilOr); echo "<br>";
echo "!a = "; var_dump($hasilNotA); echo "<br>";
echo "!b = "; var_dump($hasilNotB); echo "<br><br>";

$a = 10; 
echo "<h3>Hasil Operasi Assignment</h3>";
$a += $b;
echo "Setelah a += b, nilai a = {$a} <br>";
$a -= $b;
echo "Setelah a -= b, nilai a = {$a} <br>";
$a *= $b;
echo "Setelah a *= b, nilai a = {$a} <br>";
$a /= $b;
echo "Setelah a /= b, nilai a = {$a} <br>";
$a %= $b;
echo "Setelah a %= b, nilai a = {$a} <br><br>";

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "<h3>Hasil Operasi Identik</h3>";
echo "Apakah a === b? "; var_dump($hasilIdentik); echo "<br>";
echo "Apakah a !== b? "; var_dump($hasilTidakIdentik); echo "<br>";

?>
