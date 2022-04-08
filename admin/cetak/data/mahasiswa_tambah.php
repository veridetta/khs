<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['nim'])){
    //ambil data dari form
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $status = "mahasiswa";
    //buat query insert ke table mahasiswa
    $sql = "INSERT INTO mahasiswa (nim, nama, kelas, jurusan, status) VALUES ('$nim', '$nama', '$kelas', '$jurusan', '$status')";

    //eksekusi query
    $eksekusi = mysqli_query($connect,$sql);
    //periksa hasil query
    if($eksekusi){
        //jika berhasil return json
        echo json_encode(array('status'=>'success'));

    }else{
        //jika gagal json
        echo json_encode(array('status'=>'failed', 
        //menampilkan log error
        'error'=>mysqli_error($connect)));
    }
}