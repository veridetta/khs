<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['kode_prodi'])){
    //cek validasi kode_prodi sudah isi
    if(empty($_POST['kode_prodi'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Kode Prodi tidak boleh kosong'));
    }else{
        $kode_prodi=$_POST['kode_prodi'];
    }
    if(empty($_POST['nama_prodi'])){
        //jika nama_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Nama Prodi tidak boleh kosong'));
    }else{
        $nama_prodi=$_POST['nama_prodi'];
    }
    //insert ke table prodi
    $sql = "INSERT INTO prodi (kode_prodi, nama) VALUES ('$kode_prodi', '$nama_prodi')";
    
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