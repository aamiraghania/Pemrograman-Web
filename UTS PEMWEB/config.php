<?php
$host = "localhost";
$port = "5432";
$dbname = "bookverse_db";
$user = "postgres";
$pass = "mirania0124";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("Koneksi ke database gagal: " . pg_last_error());
}
?>