<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        echo "Konfirmasi password tidak cocok";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM users WHERE email = $1";
    $check_result = pg_query_params($conn, $check_query, array($email));

    if (!$check_result) {
        echo "Query cek gagal: " . pg_last_error($conn);
        exit;
    }

    if (pg_num_rows($check_result) > 0) {
        echo "Email sudah digunakan";
        exit;
    }

    $insert_query = "INSERT INTO users (fullname, email, password) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $insert_query, array($fullname, $email, $hashed_password));

    if ($result) {
        echo "Registrasi berhasil! Silakan login.";
    } else {
        echo "Gagal menyimpan data: " . pg_last_error($conn);
    }
}
?>
