<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = isset($_GET['error']) ? $_GET['error'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Akun - Bookverse</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
  <section class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow border-0 p-4" style="max-width: 480px; width: 100%;">
      <div class="text-center mb-4">
        <h3 class="fw-bold text-dark mb-2">Daftar ke <span class="text-warning">Bookverse</span></h3>
        <p class="text-secondary small mb-0">Buat akun baru untuk mulai menjelajahi dunia buku</p>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger py-2 text-center">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success py-2 text-center">
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <form action="register_process.php" method="post" autocomplete="off" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <div class="mb-3">
          <label for="username" class="form-label fw-semibold">Username</label>
          <input type="text" class="form-control rounded-3" id="username" name="username" placeholder="Masukkan username" required minlength="3" maxlength="100">
        </div>

        <div class="mb-3">
          <label for="full_name" class="form-label fw-semibold">Nama Lengkap</label>
          <input type="text" class="form-control rounded-3" id="full_name" name="full_name" placeholder="Masukkan nama lengkap" maxlength="200">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password</label>
          <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Masukkan password" required minlength="6">
        </div>

        <div class="mb-3">
          <label for="password_confirm" class="form-label fw-semibold">Konfirmasi Password</label>
          <input type="password" class="form-control rounded-3" id="password_confirm" name="password_confirm" placeholder="Masukkan ulang password" required minlength="6">
          <small class="text-secondary">Minimal 6 karakter untuk password.</small>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-warning text-white fw-semibold rounded-3 shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Daftar
          </button>
        </div>

        <div class="text-center mt-3">
          <span class="text-secondary">Sudah punya akun?</span>
          <a href="login.php" class="text-warning fw-semibold text-decoration-none">Masuk Sekarang</a>
        </div>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
