<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-5 text-center">
    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
      <div class="card-body">
        <h1 class="mb-3">
          Selamat datang, 
          <?= htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']) ?>
        </h1>
        <p class="mb-4">Ini adalah halaman yang hanya bisa diakses setelah login.</p>
        <div class="d-flex justify-content-center gap-3">
          <a href="index.php" class="btn bg-dark text-warning">Daftar Buku</a>
          <a href="logout.php" class="btn bg-dark text-warning">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
