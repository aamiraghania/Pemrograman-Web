<?php
require __DIR__ . '/koneksi.php';

$err = '';
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

try {
    $res = qparams('SELECT * FROM public.books WHERE id=$1', [$id]);
    $book = pg_fetch_assoc($res);
    if (!$book) {
        http_response_code(404);
        exit('Data buku tidak ditemukan.');
    }
} catch (Throwable $e) {
    exit('Error: ' . htmlspecialchars($e->getMessage()));
}

// Ambil data awal dari database
$title       = $book['title'];
$author      = $book['author'];
$publisher   = $book['publisher'];
$price       = $book['price'];
$stock       = $book['stock'];
$image_url   = $book['image_url'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title'] ?? '');
    $author      = trim($_POST['author'] ?? '');
    $publisher   = trim($_POST['publisher'] ?? '');
    $price       = isset($_POST['price']) && $_POST['price'] !== '' ? (float)$_POST['price'] : null;
    $stock       = isset($_POST['stock']) && $_POST['stock'] !== '' ? (int)$_POST['stock'] : null;
    $old_image   = $_POST['old_image'] ?? '';

    // Upload gambar jika ada
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $tmp   = $_FILES['image']['tmp_name'];
        $upload_path = __DIR__ . '/uploads/' . $image;

        if (move_uploaded_file($tmp, $upload_path)) {
            $image_url = $image;
        } else {
            $err = 'Gagal mengunggah gambar baru.';
        }
    } else {
        $image_url = $old_image;
    }

    if ($title === '') {
        $err = 'Judul buku wajib diisi.';
    } else {
        try {
            qparams(
                'UPDATE public.books 
                    SET title=$1, author=$2, publisher=$3, price=$4, 
                        stock=$5, image_url=$6, updated_at=NOW()
                  WHERE id=$7',
                [$title, $author, $publisher, $price, $stock, $image_url, $id]
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
  <title>Edit Buku - Bookverse</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">
  <section class="py-5">
    <div class="container">
      <div class="card shadow border-0 mx-auto" style="max-width: 700px;">
        <div class="card-body p-4">
          <h4 class="fw-bold text-dark mb-3 text-center">
            <i class="bi bi-pencil-square text-warning me-1"></i> Edit Buku
          </h4>
          <p class="text-secondary text-center mb-4">Perbarui informasi buku di bawah ini</p>

          <?php if ($err): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($err) ?></div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($image_url) ?>">

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
              <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Stok</label>
                <input type="number" name="stock" class="form-control rounded-3" value="<?= htmlspecialchars($stock) ?>">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-semibold">Cover Buku</label>
              <div class="mb-2">
                <?php if (!empty($image_url)): ?>
                  <img src="uploads/<?= htmlspecialchars($image_url) ?>" alt="Cover" width="100" class="rounded shadow-sm mb-2">
                <?php endif; ?>
              </div>
              <input type="file" name="image" class="form-control rounded-3">
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="index.php" class="btn btn-outline-dark rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
              </a>
              <button type="submit" class="btn btn-warning text-white fw-semibold rounded-3 shadow-sm">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
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
