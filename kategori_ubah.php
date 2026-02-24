<?php
// pastikan koneksi ada
if (!isset($koneksi)) {
    die("Koneksi database tidak ditemukan.");
}

// ambil ID dari query string
$id = isset($_GET['id']) ? $_GET['id'] : null;

// jika tidak ada ID, redirect ke halaman kategori
if ($id == null) {
    echo "<script>
            alert('ID kategori tidak ditemukan');
            window.location='?page=kategori';
          </script>";
    exit;
}

// ambil data kategori yang akan diubah
$queryData = mysqli_query($koneksi, 
    "SELECT * FROM eperpus_kategori WHERE id_kategori='$id'"
);

if (mysqli_num_rows($queryData) == 0) {
    echo "<script>
            alert('Kategori tidak ditemukan');
            window.location='?page=kategori';
          </script>";
    exit;
}

$data = mysqli_fetch_array($queryData);

// proses update data
if (isset($_POST['simpan'])) {

    $kategori = trim($_POST['kategori']);

    if ($kategori == "") {
        echo "<script>alert('Nama kategori tidak boleh kosong');</script>";
    } else {

        // cek apakah kategori sudah ada (kecuali kategori saat ini)
        $cek = mysqli_query($koneksi, 
            "SELECT * FROM eperpus_kategori WHERE kategori='$kategori' AND id_kategori!='$id'"
        );

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>alert('Kategori sudah ada!');</script>";

        } else {

            $query = mysqli_query($koneksi, 
                "UPDATE eperpus_kategori SET kategori='$kategori' WHERE id_kategori='$id'"
            );

            if ($query) {
                echo "<script>
                        alert('Data berhasil diubah!');
                        window.location='?page=kategori';
                      </script>";
            } else {
                echo "<script>alert('Gagal mengubah data');</script>";
            }

        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Kategori Buku</h1>

    <div class="card shadow mb-4" style="max-width: 600px;">
        <div class="card-body">

            <form method="POST">

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           value="<?= htmlspecialchars($data['kategori']); ?>"
                           required>
                </div>

                <button type="submit" name="simpan"
                        class="btn btn-primary">
                        Simpan
                </button>

                <button type="reset"
                        class="btn btn-secondary">
                        Reset
                </button>

                <a href="?page=kategori"
                   class="btn btn-danger">
                   Kembali
                </a>

            </form>

        </div>
    </div>
</div>