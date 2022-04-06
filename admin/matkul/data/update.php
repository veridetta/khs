<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['kode_prodi'])) {
    //cek validasi
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
    if (empty($error)) {
        //update table matkul
        $sql = "UPDATE matkul SET kode_mk='$kode_mk', kode_prodi='$kode_prodi', nama='$nama', sks='$sks' WHERE id='$id'";
        
        $query = mysqli_query($connect, $sql);

        if ($query) {
            echo json_encode(array('status'=>'success'));
        } else {
             //jika gagal json
            echo json_encode(array('status'=>'failed', 
            //menampilkan log error
            'error'=>mysqli_error($connect)));
        }
    }
}
