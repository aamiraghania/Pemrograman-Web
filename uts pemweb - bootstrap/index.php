<?php
require __DIR__ . '/koneksi.php';
$sql = "SELECT id, title, author, publisher, price, stock, image_url FROM books ORDER BY id ASC";
$result = q($sql);
$books = pg_fetch_all($result) ?: [];
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Bookverse | Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top py-3">
    <div class="container">
      <a class="navbar-brand fw-bold fs-4 text-warning" href="../home.html">Bookverse</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto ms-3 mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-light" href="../home.html">Home</a></li>
          <li class="nav-item"><a class="nav-link text-light" href="../shop.html">Shop</a></li>
          <li class="nav-item"><a class="nav-link text-light" href="../contact.html">Contact</a></li>
        </ul>

        <div class="dropdown">
          <button class="btn btn-warning rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <div class="text-center mb-4">
      <h2 class="fw-bold border-bottom border-3 border-warning d-inline-block pb-2">
        Daftar Buku
      </h2>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <a href="add.php" class="btn btn-warning text-white fw-semibold rounded-3 px-3 shadow-sm">
        <i class="bi bi-plus-lg"></i> Tambah Buku
      </a>
    </div>

    <div class="table-responsive shadow rounded-3 bg-white p-3">
      <table class="table table-striped table-bordered align-middle mb-0">
        <thead class="table-warning text-dark">
          <tr>
            <th>No</th>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Harga</th>
            <th>Stok</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($books)): ?>
            <tr>
              <td colspan="8" class="text-center text-secondary py-4">Belum ada data buku.</td>
            </tr>
          <?php else:
            $no = 1;
            foreach ($books as $book): ?>
              <tr>
                <td><?= $no++; ?></td>
                <td class="text-center">
                  <?php if (!empty($book['image_url'])): ?>
                    <img src="uploads/<?= htmlspecialchars($book['image_url']); ?>" 
                         class="img-thumbnail border-warning" style="width:60px; height:80px; object-fit:cover;">
                  <?php else: ?>
                    <span class="text-secondary">Tidak ada</span>
                  <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($book['title']); ?></td>
                <td><?= htmlspecialchars($book['author']); ?></td>
                <td><?= htmlspecialchars($book['publisher']); ?></td>
                <td class="fw-semibold text-warning">Rp <?= number_format($book['price'], 0, ',', '.'); ?></td>
                <td><?= htmlspecialchars($book['stock']); ?></td>
                <td class="text-center">
                  <a href="edit.php?id=<?= urlencode($book['id']); ?>" 
                     class="btn btn-sm btn-warning text-white fw-semibold me-1">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <button class="btn btn-sm btn-danger fw-semibold"
                          onclick="if(confirm('Yakin ingin menghapus buku ini?')) { document.getElementById('deleteForm<?= $book['id']; ?>').submit(); }">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                  <form id="deleteForm<?= $book['id']; ?>" action="delete.php" method="post" class="d-none">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($book['id']); ?>">
                  </form>
                </td>
              </tr>
            <?php endforeach;
          endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <h4 class="text-warning fw-bold">Bookverse</h4>
          <p>Bookverse adalah toko buku online yang menyediakan berbagai koleksi buku inspiratif, fiksi, dan non-fiksi.</p>
        </div>
        <div class="col-md-4">
          <h5 class="text-warning fw-semibold mb-3">Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="../home.html" class="text-white text-decoration-none">Home</a></li>
            <li><a href="../shop.html" class="text-white text-decoration-none">Shop</a></li>
            <li><a href="../contact.html" class="text-white text-decoration-none">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5 class="text-warning fw-semibold mb-3">Newsletter</h5>
          <p>Dapatkan promo dan update terbaru langsung ke email Anda!</p>
          <form class="d-flex">
            <input type="email" class="form-control me-2 rounded-pill" placeholder="Masukkan email">
            <button class="btn btn-warning text-white rounded-pill px-3">Langganan</button>
          </form>
        </div>
      </div>
      <hr class="border-light">
      <p class="text-center text-secondary mb-0">&copy; 2025 Bookverse. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
