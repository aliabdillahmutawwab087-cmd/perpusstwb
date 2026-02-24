<?php
// pastikan koneksi ada
if (!isset($koneksi)) {
    die("Koneksi database tidak ditemukan.");
}

// proses simpan data
if (isset($_POST['simpan'])) {

    $kategori = trim($_POST['kategori']);

    if ($kategori == "") {
        echo "<script>alert('Nama kategori tidak boleh kosong');</script>";
    } else {

        // cek apakah kategori sudah ada
        $cek = mysqli_query($koneksi, 
            "SELECT * FROM eperpus_kategori WHERE kategori='$kategori'"
        );

        if (mysqli_num_rows($cek) > 0) {

            echo "<script>alert('Kategori sudah ada!');</script>";

        } else {

            $query = mysqli_query($koneksi, 
                "INSERT INTO eperpus_kategori (kategori) VALUES ('$kategori')"
            );

            if ($query) {
                echo "<script>
                        alert('Data berhasil ditambahkan!');
                        window.location='?page=kategori';
                      </script>";
            } else {
                echo "<script>alert('Gagal menambahkan data');</script>";
            }

        }
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Kategori Buku</h1>

    <div class="card shadow mb-4" style="max-width: 600px;">
        <div class="card-body">

            <form method="POST">

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="kategori"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
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