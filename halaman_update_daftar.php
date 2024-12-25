<?php 

if(isset($_POST['update'])){
    $iddaftar         = $_POST['iddaftar'];
    $pendapatan_ortu  = $_POST['pendapatan_ortu'];
    $ipk              = $_POST['ipk'];
    $jml_saudara      = $_POST['jml_saudara'];

    // proses update
    $sql = "UPDATE pendaftaran SET pendapatan_ortu='$pendapatan_ortu', ipk='$ipk', jml_saudara='$jml_saudara' WHERE iddaftar='$iddaftar'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=daftar");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$nim = $_GET['id'];

$sql = "SELECT pendaftaran.iddaftar, pendaftaran.tgldaftar, pendaftaran.tahun, pendaftaran.nim, mahasiswa.nama_mahasiswa, pendaftaran.pendapatan_ortu, pendaftaran.ipk, pendaftaran.jml_saudara  
        FROM mahasiswa INNER JOIN pendaftaran ON mahasiswa.nim = pendaftaran.nim WHERE pendaftaran.iddaftar = '$nim'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No results found";
    exit();
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Ubah data Beasiswa</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" value="<?php echo $row["tahun"] ?>" name="tahun" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">NPM</label>
                            <input type="text" class="form-control" value="<?php echo $row["nim"] ?>" name="nim" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_mahasiswa"] ?>" name="nama_mahasiswa" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Pendapatan Ortu</label>
                            <input type="number" class="form-control" name="pendapatan_ortu" value="<?php echo $row["pendapatan_ortu"] ?>" min="0" max="9999999999" required>
                        </div>
                        <div class="form-group">
                            <label for="">IPK Terakhir</label>
                            <input type="number" class="form-control" name="ipk" value="<?php echo $row["ipk"] ?>" step="0.01" min="1" max="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Saudara</label>
                            <input type="number" class="form-control" name="jml_saudara" value="<?php echo $row["jml_saudara"] ?>" min="0" max="12" required>
                        </div>
                        <input type="hidden" name="iddaftar" value="<?php echo $row["iddaftar"] ?>">
                        <button class="btn btn-primary" type="submit" name="update">
                            <i class="far fa-edit"></i> Edit
                        </button>
                        <a class="btn btn-warning" href="?page=daftar"><i class="fas fa-reply"></i> Batal </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
