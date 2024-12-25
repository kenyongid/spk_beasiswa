<?php

$id=$_GET['id'];

$sql = "DELETE FROM pendaftaran WHERE iddaftar='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=daftar");
}
$conn->close();
?>