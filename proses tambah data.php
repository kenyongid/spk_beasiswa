<?php

if(isset($_POST['simpan'])){
    $NAMA_VAR=$_POST['NAME'];
	
    // validasi
    $sql = "SELECT*FROM nama_tabel WHERE nama_field='$NAMA_VAR'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>pesan jika data sudah ada</strong>
            </div>
        <?php
    }else{
	//proses simpan
        $sql = "INSERT INTO nama_tabel VALUES ('$VAR1','$VAR2','$VAR3')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=NAMA_PAGE");
        }
    }
}
?>