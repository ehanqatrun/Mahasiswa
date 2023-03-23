<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database   = "akademik";
    
    $koneksi = mysqli_connect($server, $user, $pass, $database);
    if (!$koneksi) { //cek koneksi
        die("Tidak bisa terkoneksi ke database");
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $upassword = ($_POST['upassword']);
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    

    $query = "insert into adminn values ('', '$username', '$email', '$upassword', '$notelp', '$alamat')";
    mysqli_query($koneksi, $query);
    header("location: register.php");

?>