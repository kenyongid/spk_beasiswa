<?php

if(isset($_POST['simpan'])){
    $tgl                = date("Y-m-d");
    $tahun              = $_POST['tahun'];
    $nim                = $_POST['nama_mahasiswa'];
    $pendapatan_ortu    = $_POST['pendapatan_ortu'];
    $ipk                = $_POST['ipk'];
    $jml_saudara        = $_POST['jml_saudara'];

    // Validasi input
    if(empty($tahun) || empty($nim) || empty($pendapatan_ortu) || empty($ipk) || empty($jml_saudara)) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Semua kolom harus diisi!</strong>
        </div>
        <?php
    } else {
        // Escape input untuk mencegah SQL Injection
        $tahun = $conn->real_escape_string($tahun);
        $nim = $conn->real_escape_string($nim);
        $pendapatan_ortu = $conn->real_escape_string($pendapatan_ortu);
        $ipk = $conn->real_escape_string($ipk);
        $jml_saudara = $conn->real_escape_string($jml_saudara);

        // Periksa apakah data sudah ada
        $sql_check = "SELECT * FROM pendaftaran WHERE tahun='$tahun' AND nim='$nim'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data dengan tahun dan nim tersebut sudah ada!</strong>
            </div>
            <?php
        } else {
            // Proses simpan data
            $sql_insert = "INSERT INTO pendaftaran (iddaftar, tgldaftar, tahun, nim, pendapatan_ortu, ipk, jml_saudara)
                           VALUES (NULL, '$tgl', '$tahun', '$nim', '$pendapatan_ortu', '$ipk', '$jml_saudara')";

            if ($conn->query($sql_insert) === TRUE) {
                header("Location: ?page=daftar");
                exit();
            } else {
                ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error:</strong> <?php echo $conn->error; ?>
                </div>
                <?php
            }
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Pendaftaran Beasiswa</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                            <option value=""></option>
                            <?php
                                for($x=date("Y");$x>=2015;$x--){
                            ?>  
                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>   
                                <?php
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <select class="form-control chosen" data-placeholder="Pilih Nama Mahasiswa" name="nama_mahasiswa">
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM mahasiswa ORDER BY nama_mahasiswa ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['nim']; ?>"><?php echo $row['nim'] ."--".  $row['nama_mahasiswa']; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pendapatan Ortu</label>
                            <input type="number" class="form-control" name="pendapatan_ortu" min="0" max="9999999999" required>
                        </div>
                        <div class="form-group">
                            <label for="">IPK Terakhir</label>
                            <input type="number" class="form-control" name="ipk" value="0.00" step="0.01" min="1" max="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Saudara</label>
                            <input type="number" class="form-control" name="jml_saudara" min="0" max="12" required>
                        </div>
                        <button class="btn btn-primary" type="submit" name="simpan">
                            <i class="fas fa-save"></i> Simpan
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
