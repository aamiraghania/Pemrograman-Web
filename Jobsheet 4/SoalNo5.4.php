<?php
$daftarSiswa = [
    ['Alice', 85],
    ['Bob', 92],
    ['Charlie', 78],
    ['David', 64],
    ['Eva', 90],
];

$totalNilai = 0;
foreach ($daftarSiswa as $siswa) {
    $totalNilai += $siswa[1]; 
}
$rataRata = $totalNilai / count($daftarSiswa);

$siswaDiAtasRata = [];
foreach ($daftarSiswa as $siswa) {
    if ($siswa[1] > $rataRata) {
        $siswaDiAtasRata[] = $siswa;
    }
}

echo "Rata-rata nilai kelas: " . $rataRata . "<br><br>";
echo "Daftar siswa dengan nilai di atas rata-rata:<br>";
foreach ($siswaDiAtasRata as $siswa) {
    echo "Nama: {$siswa[0]}, Nilai: {$siswa[1]}<br>";
}
?>
