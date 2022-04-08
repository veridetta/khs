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
    //validasi $_POST['kode_mk] sudah diisi
    if(empty($_POST['kode_mk'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Kode MK tidak boleh kosong'));
    }else{
        $kode_mk=$_POST['kode_mk'];
    }
    //validasi nama sudah diisi
    if(empty($_POST['nama'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Nama tidak boleh kosong'));
    }else{
        $nama=$_POST['nama'];
    }
    if(empty($_POST['sks'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'SKS tidak boleh kosong'));
    }else{
        $sks=$_POST['sks'];
    }
    if(empty($_POST['semester'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'semester tidak boleh kosong'));
    }else{
        $semester=$_POST['sks'];
    }
    //insert ke table matkul
    $sql = "INSERT INTO mata_kuliah (kode_mk, nama, sks, kode_prodi, semester) VALUES ('$kode_mk', '$nama', '$sks', '$kode_prodi','$semester')";
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