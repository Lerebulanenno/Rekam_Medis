<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 20px;
        }

        .navbar {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 1px solid #ccc;
        }

        .navbar-nav {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav-item {
            margin-right: 10px;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: #ddd;
        }

        @media screen and (max-width: 768px) {
            .navbar {
                padding: 10px;
            }

            .nav-item {
                margin-right: 5px;
            }
        }
    </style>
</head>
<body>
   
<!-- navbar -->
<nav class="navbar navbar-primary-sm bg-light">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Pasien</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Dokter</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Kunjungan</a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Rekam Medis</a>
    </li>
  </ul>
</nav>

<!-- container -->
<div class="container">

    <!-- setting menu -->
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page==""){
        include "welcome.php";
    }elseif ($page=="pasien"){
        if ($action==""){
            include "tampil_pasien.php";
        }elseif ($action=="tambah"){
            include "tambah_pasien.php";
        }elseif ($action=="update"){
            include "update_pasien.php";
        }else{
            include "hapus_pasien.php";
        }
    }elseif ($page=="dokter"){
        if ($action==""){
            include "tampil_dokter.php";
        }elseif ($action=="tambah"){
            include "tambah_dokter.php";
        }elseif ($action=="update"){
            include "update_dokter.php";
        }else{
            include "hapus_dokter.php";
        }
    }elseif ($page=="kunjungan"){
        if ($action==""){
            include "tampil_kunjungan.php";
        }elseif ($action=="tambah"){
            include "tambah_kunjungan.php";
        }elseif ($action=="update"){
            include "update_kunjungan.php";
        }else{
            include "hapus_kunjungan.php";
        }
    }elseif ($page=="rekam_medis"){ 
        if ($action==""){
            include "tampil_rekam_medis.php";
        }else{
            include "hasil_rekam_medis.php";
        }
    }else{
        include "NAMA_HALAMAN";
    }
    ?>
    </div>
</body>
</html>
