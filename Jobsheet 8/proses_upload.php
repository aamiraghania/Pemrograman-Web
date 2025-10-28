<?php
// Lokasi folder penyimpanan gambar
$targetDirectory = "images/";

// Buat folder jika belum ada
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Periksa apakah ada file yang diunggah
if ($_FILES['images']['name'][0]) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // hanya gambar

    // Loop untuk memproses setiap gambar
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileTmp = $_FILES['images']['tmp_name'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $targetDirectory . $fileName;

        // Cek apakah ekstensi file sesuai
        if (in_array($fileType, $allowedExtensions)) {
            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($fileTmp, $targetFile)) {
                echo "Gambar $fileName berhasil diunggah.<br>";
            } else {
                echo "Gagal mengunggah gambar $fileName.<br>";
            }
        } else {
            echo "File $fileName tidak valid. Hanya gambar diperbolehkan.<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>