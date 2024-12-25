<?php

$page = isset($_GET['page']) ? $_GET['page'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "";

if ($page==""){
    include "NAMA_HALAMAN";
}elseif ($page=="NAMA_PAGE"){
    if ($action==""){
        include "NAMA_HALAMAN";
    }elseif ($action=="NAMA_ACTION"){
        include "NAMA_HALAMAN";
    }elseif ($action=="NAMA_ACTION"){
        include "NAMA_HALAMAN";
    }else{
        include "NAMA_HALAMAN";
    }
}else{
    include "NAMA_HALAMAN";
}
?>