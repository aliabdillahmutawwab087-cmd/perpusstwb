<?php
$id = $_GET['id'] ?? null;
if ($id) {
    $del = mysqli_query($koneksi, "DELETE FROM eperpus_kategori WHERE id_kategori='$id'");
    $msg = $del ? 'Data berhasil dihapus!' : 'Gagal menghapus data!';
} else {
    $msg = 'ID tidak valid!';
}
echo "<script>alert('$msg'); window.location='?page=kategori';</script>";
?>