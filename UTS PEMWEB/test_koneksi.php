<?php
$host = "localhost";
$port = "5432";
$dbname = "bookverse_db";
$user = "postgres";
$pass = "mirania0124"; 

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if ($conn) {
    echo "Koneksi ke database berhasil!";
} else {
    echo "Gagal terhubung ke database: " . pg_last_error();
}
?>
