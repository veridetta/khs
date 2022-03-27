<?php
//kita akan membuat file koneksi menggunakan mysqli
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_khs";
$connect= mysqli_connect($host, $user, $pass, $db);
//jika gagal koneksi akan ada pesan error
if(!$connect){
    echo "Koneksi gagal";
}
?>

