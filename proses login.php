----------------------
Proses Login
----------------------
<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    $username=$_POST["username"];
    $pass=md5($_POST["pass"]);

    $sql = "SELECT*FROM nama_tabel where field_user='$username' and field_pass='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        
        $_SESSION['username'] = $row["nama_field"];
        $_SESSION['level'] = $row["nama_field"];
        $_SESSION['status'] = "y";
    
       header("Location:index.php");

    } else {
        header("Location:?msg=n");
    }
}
$conn->close();
?>


----------------------------------
pesan login gagal
----------------------------------
<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login Gagal</strong>
    </div>
    <?php
    }       
}
?>


----------------------------------
aktifkan session di halaman index
----------------------------------
session_start();


----------------------------------
cek status login
----------------------------------
<?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
?>


