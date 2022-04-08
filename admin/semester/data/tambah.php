<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['semester'])){
    //cek validasi kode_prodi sudah isi
    if(empty($_POST['semester'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'semester tidak boleh kosong'));
    }else{
        $semester=$_POST['semester'];
    }
    //insert ke table matkul
    $sql = "INSERT INTO semester (semester) VALUES ('$semester')";
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