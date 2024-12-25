
<?php 

if(isset($_POST['update'])){
   $nim              = $_POST['nim'];
   $nama_mahasiswa   = $_POST['nama_mahasiswa'];
   $alamat           = $_POST['alamat'];
   $telp             = $_POST['telp'];

    // proses update
    $sql = "UPDATE mahasiswa SET nama_mahasiswa='$nama_mahasiswa',alamat='$alamat',telp='$telp' WHERE nim='$nim'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=mahasiswa");
    }
}

$nim=$_GET['nim'];

$sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Ubah data Mahasiswa</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" value="<?php echo $row["nim"] ?>" name="nim"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_mahasiswa"] ?>" name="nama_mahasiswa" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" value="<?php echo $row["alamat"] ?>" name="alamat" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telepon</label>
                            <input type="text" class="form-control" value="<?php echo $row["telp"] ?>" name="telp" maxlength="15" required>
                        </div>
                        <button class="btn btn-primary" type="update" name="update">
                            <i class="far fa-edit"></i> Edit
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
