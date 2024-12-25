 <?php
     $sql = "SELECT*FROM nama_tabel ORDER BY nama_field ASC";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc()) {
 ?>
     <tr>
        <td><?php echo $row['NAMA_FIELD1']; ?></td>
	<td><?php echo $row['NAMA_FIELD2']; ?></td>
	<td><?php echo $row['NAMA_FIELD3']; ?></td>
	<td>
            <a class="btn btn-warning" href="?page=NAMA_PAGE&action=update&NAMA_FIELD=<?php echo $row['NAMA_FIELD']; ?>">
<span class=""></span>
</a>
            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=NAMA_PAGE&action=hapus&NAMA_FIELD=<?php echo $row['NAMA_FIELD']; ?>">
<span class=""></span>
</a>
        </td>
     </tr>
 <?php
     }
     $conn->close();
 ?>