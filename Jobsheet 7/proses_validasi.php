<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($nama) || empty($email) || empty($password)) {
        echo "Semua field harus diisi.";
    } elseif (strlen($password) < 8) {
        echo "Password harus minimal 8 karakter.";
    } else {
        echo "Data valid! Nama: $nama, Email: $email";
    }
}
?>
