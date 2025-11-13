<?php
require __DIR__ . '/koneksi.php';

// Pastikan hanya menerima request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

// Ambil dan validasi ID
$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    exit('ID tidak valid.');
}

try {
    // Jalankan query hapus dengan parameter aman
    qparams('DELETE FROM public.books WHERE id = $1', [$id]);

    // Redirect ke halaman utama setelah berhasil
    header('Location: index.php');
    exit;
} catch (Throwable $e) {
    // Tangani error dan beri pesan aman
    http_response_code(500);
    echo 'Gagal menghapus: ' . htmlspecialchars($e->getMessage());
}