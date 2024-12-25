<?php
if (isset($_POST['proses'])) {
    $tahun = $_POST['tahun'];
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk mengambil data pendaftaran berdasarkan tahun
    $stmt = $conn->prepare("SELECT * FROM pendaftaran WHERE tahun = ?");
    $stmt->bind_param("i", $tahun);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Proses untuk mencari nilai min dan max
        $stmt = $conn->prepare("SELECT MIN(pendapatan_ortu) as mpendapatan_ortu, MAX(ipk) as mipk, MAX(jml_saudara) as mjml_saudara FROM pendaftaran WHERE tahun = ?");
        $stmt->bind_param("i", $tahun);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Mengambil nilai min dan max
        $mpendapatan_ortu = $row["mpendapatan_ortu"];
        $mipk = $row["mipk"];
        $mjml_saudara = $row["mjml_saudara"];

        // Proses normalisasi
        $stmt = $conn->prepare("SELECT * FROM pendaftaran WHERE tahun = ?");
        $stmt->bind_param("i", $tahun);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Mengambil data pendaftaran
            $iddaftar = $row["iddaftar"];
            $pendapatan_ortu = $row["pendapatan_ortu"];
            $ipk = $row["ipk"];
            $jml_saudara = $row["jml_saudara"];

            // Menghapus data perangkingan yang lama
            $stmt_delete = $conn->prepare("DELETE FROM perangkingan WHERE iddaftar = ?");
            $stmt_delete->bind_param("i", $iddaftar);
            $stmt_delete->execute();

            // Hitung normalisasi
            $npendapatan_ortu = $mpendapatan_ortu / $pendapatan_ortu;
            $nipk = $ipk / $mipk;
            $njml_saudara = $jml_saudara / $mjml_saudara;

            // Hitung nilai preferensi
            $preferensi = ($npendapatan_ortu * 0.5) + ($nipk * 0.3) + ($njml_saudara * 0.2);

            // Simpan data perangkingan
            $stmt_insert = $conn->prepare("INSERT INTO perangkingan (iddaftar, n_pendapatan, n_ipk, n_saudara, preferensi) VALUES (?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("idddd", $iddaftar, $npendapatan_ortu, $nipk, $njml_saudara, $preferensi);
            if (!$stmt_insert->execute()) {
                echo "Error: " . $stmt_insert->error;
            }
        }
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Data tidak ditemukan!</strong>
        </div>
        <?php
    }
}
?>

<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Data Ranking</strong></div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                    <option value=""></option>
                    <?php
                    for ($x = date("Y"); $x >= 2015; $x--) {
                        ?>  
                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>   
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-primary mb-4" type="submit" name="proses">
                <i class="fa fa-spinner"></i> Proses
            </button>
        </form>

        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th width="77">No.</th>
                    <th width="200">NPM</th>
                    <th width="200">Nama Mahasiswa</th>
                    <th width="77">N_Pendapatan</th>
                    <th width="77">N_IPK</th>
                    <th width="77">N_Saudara</th>
                    <th width="77">Preferensi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['proses'])) {
                    $stmt = $conn->prepare("SELECT 
                                                perangkingan.idperangkingan,
                                                pendaftaran.iddaftar,
                                                pendaftaran.tgldaftar,  
                                                pendaftaran.nim,
                                                mahasiswa.nama_mahasiswa,
                                                perangkingan.n_pendapatan,
                                                perangkingan.n_ipk,
                                                perangkingan.n_saudara,
                                                perangkingan.preferensi
                                            FROM 
                                                perangkingan
                                            INNER JOIN 
                                                pendaftaran ON perangkingan.iddaftar = pendaftaran.iddaftar
                                            INNER JOIN 
                                                mahasiswa ON pendaftaran.nim = mahasiswa.nim
                                            WHERE
                                                pendaftaran.tahun = ?
                                            ORDER BY 
                                                perangkingan.preferensi DESC");
                    $stmt->bind_param("i", $_POST['tahun']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama_mahasiswa']; ?></td>
                            <td><?php echo $row['n_pendapatan']; ?></td>
                            <td><?php echo $row['n_ipk']; ?></td>
                            <td><?php echo $row['n_saudara']; ?></td>
                            <td><?php echo $row['preferensi']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
