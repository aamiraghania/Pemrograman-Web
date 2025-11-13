<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login - Bookverse</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
  <section class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="card shadow border-0 p-4" style="max-width: 420px; width: 100%;">
      <div class="text-center mb-4">
        <h3 class="fw-bold text-dark mb-2">Masuk ke <span class="text-warning">Bookverse</span></h3>
        <p class="text-secondary small mb-0">Silakan login untuk melanjutkan</p>
      </div>

      <?php if (!empty($_GET['error'])): ?>
        <div class="alert alert-danger py-2 text-center">
          <?= htmlspecialchars($_GET['error']) ?>
        </div>
      <?php endif; ?>

      <form action="authenticate.php" method="post" autocomplete="off">
        <div class="mb-3">
          <label for="username" class="form-label fw-semibold">Username</label>
          <input type="text" class="form-control rounded-3" id="username" name="username" placeholder="Masukkan username" required autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-semibold">Password</label>
          <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Masukkan password" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-warning text-white fw-semibold rounded-3 shadow-sm">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
          </button>
        </div>

        <div class="text-center mt-3">
          <span class="text-secondary">Belum punya akun?</span>
          <a href="register.php" class="text-warning fw-semibold text-decoration-none">Daftar Sekarang</a>
        </div>
      </form>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
