

<?php

if(isset($_POST['simpan'])){
    $nim = $_POST['nim'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    
    // validasi
    $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>NIM sudah ada</strong>
        </div>
        <?php
    } else {
        // proses simpan
        $sql = "INSERT INTO mahasiswa (nim, nama_mahasiswa, alamat, telp) VALUES ('$nim', '$nama_mahasiswa', '$alamat', '$telp')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=mahasiswa");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah data Mahasiswa</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama_mahasiswa" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telepon</label>
                            <input type="text" class="form-control" name="telp" maxlength="15" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="simpan">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a class="btn btn-warning" href="?page=mahasiswa"><i class="fas fa-reply"></i>Batal </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
