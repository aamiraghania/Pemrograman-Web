<?php
require __DIR__ . '/koneksi.php';

$err = '';
$title = $author = $publisher = $year = $price = $stock = $description = '';
$image = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $author      = trim($_POST['author'] ?? '');
    $publisher   = trim($_POST['publisher'] ?? '');
    $year        = trim($_POST['year'] ?? '');
    $price       = trim($_POST['price'] ?? '');
    $stock       = trim($_POST['stock'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $uploadedFilename = '';

    if ($title === '') {
        $err = 'Judul buku wajib diisi.';
    } else {
        try {
            if (isset($_FILES['image']) && ($_FILES['image']['error'] === UPLOAD_ERR_OK)) {
                $uploadDir = __DIR__ . '/uploads';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $originalName = $_FILES['image']['name'];
                $ext = pathinfo($originalName, PATHINFO_EXTENSION);
                $safeBase = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
                $uniqueName = $safeBase . '_' . time() . '_' . bin2hex(random_bytes(4)) . ($ext ? ".$ext" : '');
                $targetPath = $uploadDir . '/' . $uniqueName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    throw new RuntimeException('Gagal memindahkan file upload.');
                }

                $uploadedFilename = $uniqueName;
            }

            qparams(
                'INSERT INTO books (title, author, publisher, year, price, stock, description, image_url)
                 VALUES ($1, NULLIF($2, \'\'), NULLIF($3, \'\'), NULLIF($4, \'\')::INT, NULLIF($5, \'\')::NUMERIC, NULLIF($6, \'\')::INT, NULLIF($7, \'\'), NULLIF($8, \'\'))',
                [$title, $author, $publisher, $year, $price, $stock, $description, $uploadedFilename]
            );

            header('Location: index.php');
            exit;
        } catch (Throwable $e) {
            $err = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Buku - Bookverse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">
  <section class="py-5">
    <div class="container">
      <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
          <h4 class="fw-bold text-dark mb-3 text-center">
            <i class="bi bi-journal-plus text-warning me-1"></i> Tambah Buku Baru
          </h4>
          <p class="text-secondary text-center mb-4">Lengkapi informasi buku di bawah ini</p>

          <?php if ($err): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($err) ?></div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="mb-3">
              <label class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control rounded-3" value="<?= htmlspecialchars($title) ?>" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Penulis</label>
              <input type="text" name="author" class="form-control rounded-3" value="<?= htmlspecialchars($author) ?>">
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Penerbit</label>
              <input type="text" name="publisher" class="form-control rounded-3" value="<?= htmlspecialchars($publisher) ?>">
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" class="form-control rounded-3" value="<?= htmlspecialchars($price) ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Stok</label>
              <input type="number" name="stock" class="form-control rounded-3" value="<?= htmlspecialchars($stock) ?>">
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Cover Buku</label>
              <input type="file" name="image" class="form-control rounded-3" <?php if ($image === '') echo 'required'; ?>>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-dark rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
              </a>
              <button type="submit" class="btn btn-warning text-white fw-semibold rounded-3 shadow-sm">
                <i class="bi bi-save me-1"></i> Simpan Buku
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
