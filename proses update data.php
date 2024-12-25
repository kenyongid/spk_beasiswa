<?php 

if(isset($_POST['update'])){
    $NAMA_VAR=$_POST['NAME'];

    // proses update
    $sql = "UPDATE nama_tabel SET nama_field1='$nama_var1',nama_field2='$nama_var2',nama_field3='$nama_var3' WHERE nama_field_kunci='$nama_var_kunci'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=NAMA_PAGE");
    }
}

$NAMA_VAR=$_GET['NAMA_DATA'];

$sql = "SELECT * FROM nama_tabel WHERE nama_field='$nama_var'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>