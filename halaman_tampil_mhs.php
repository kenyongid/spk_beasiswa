<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Mahasiswa</strong></div>
  <div class="card-body">
<a class="btn btn-primary mb-2"  href="?page=mahasiswa&action=tambah">Tambah <i class="fa fa-user-plus"></i></a>
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="100">NPM</th>
        <th width="200">Nama</th>
        <th width="300">Alamat</th>
        <th width="100">No.Telpon</th>
        <th width="100"></th>
      </tr>
    </thead>
    <tbody>
		

        <?php
        $sql = "SELECT*FROM mahasiswa ORDER BY nim ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        ?>
        <tr>
          <td><?php echo $row['nim']; ?></td>
          <td><?php echo $row['nama_mahasiswa']; ?></td>
          <td><?php echo $row['alamat']; ?></td>
          <td><?php echo $row['telp']; ?></td>
          <td align="center">
                <a class="btn btn-warning" href="?page=mahasiswa&action=update&nim=<?php echo $row['nim']; ?>">
                    <span class="fa fa-edit"></span>
                </a>
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=mahasiswa&action=hapus&nim=<?php echo $row['nim']; ?>">
                    <span class="fa fa-trash"></span>
                </a>
            </td>
        </tr>
    <?php
        }
        $conn->close();
    ?>



   </tbody>
</table>
</div>
</div>