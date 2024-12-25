<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" 
      type="image/png" 
      href="assets/logo Beasiswa.png" /> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPK Beasiswa</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>
<body>

<?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
?> 

<nav class="navbar navbar-dark bg-primary border navbar-expand-sm fixed-top">
    <a class="navbar-brand" href="#">SPK beasiswa</a>
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home </a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=daftar"><i class="fas fa-address-book"></i> Pendaftaran </a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=users"><i class="fas fa-user"></i> Users </a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=mahasiswa"><i class="fas fa-user-circle"></i> Mahasiswa </a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=rangking&tahun="><i class="fas fa-award"></i> Rangking </a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=logout"><i class="fas fa-door-closed"></i> Logout </a></li>
    </ul>
</nav>

<div class="container" style="margin-top:100px;margin-bottom:100px">
    <?php

        // pengaturan menu
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "welcome.php";
        }elseif ($page=="mahasiswa"){
            if ($action==""){
                include "halaman_tampil_mhs.php";
            }elseif($action=="tambah"){
                include "halaman_tambah_mhs.php";
            }elseif($action=="update"){
                include "halaman_update_mhs.php";
            }else{
                include "hapus_mhs.php";
            }

        }elseif ($page=="daftar"){
            if ($action==""){
                include "halaman_tampil_daftar.php";
            }elseif($action=="tambah"){
                include "halaman_tambah_daftar.php";
            }elseif($action=="update"){
                include "halaman_update_daftar.php";
            }else{
                include "hapus_daftar.php";
            }

        }elseif ($page=="rangking"){
            if ($action==""){
                include "rangking.php";
            }

        }elseif ($page=="users"){
            if ($action==""){
                include "halaman_tampil_users.php";
            }elseif($action=="tambah"){
                include "halaman_tambah_users.php";
            }elseif($action=="update"){
                include "halaman_update_users.php";
            }else{
                include "hapus_users.php";
            }

        }else{
            if ($action==""){
                include "logout.php";
            }
        }
    ?>
</div>

    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script>
       $(document).ready(function () {
           $('#myTable').dataTable();
       });
    </script>

    <script src="assets/js/chosen.jquery.min.js"></script>
    <script>
     $(function() {
       $('.chosen').chosen();
     });
    </script>

</body>
</html>