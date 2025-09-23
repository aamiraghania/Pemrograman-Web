<?php
$hargaProduk = 120000;
$diskon = 0;

if ($hargaProduk > 100000) {
    $diskon = 0.20 * $hargaProduk; 
}

$hargaAkhir = $hargaProduk - $diskon;

echo "<h3>Perhitungan Diskon</h3>";
echo "Harga produk: Rp " . number_format($hargaProduk, 0, ',', '.') . "<br>";
echo "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "<br>";
echo "Harga yang harus dibayar: <b>Rp " . number_format($hargaAkhir, 0, ',', '.') . "</b>";
?>
