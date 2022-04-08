<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['na'])) {
    //cek validasi
    if(empty($_POST['kode_prodi'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'kode_prodi tidak boleh kosong'));
    }else{
        //$kode explode kode_prodi
        $kode = explode('-', $_POST['kode_prodi']);
        //kode_prodi
        $kode_prodi = $kode[0];
        //kode_mk
        $kode_mk = $kode[1];
    }
    if(empty($_POST['ta'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'tahun_ajaran tidak boleh kosong'));
    }else{
        $tahun_ajaran=$_POST['ta'];
    }
    if(empty($_POST['semester'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'semester tidak boleh kosong'));
    }else{
        $semester=$_POST['semester'];
    }
    if(empty($_POST['nim'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'nim tidak boleh kosong'));
    }else{
        //$datadiri explode nim
        $datadiri = explode('-', $_POST['nim']);
        //nim
        $nim = $datadiri[0];
        //nama
        $nama = $datadiri[1];
    }
    if(empty($_POST['na'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'nilai_angka tidak boleh kosong'));
    }else{
        $nilai_angka=$_POST['na'];
    }
    if(empty($_POST['nh'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'nilai_huruf tidak boleh kosong'));
    }else{
        $nilai_huruf=$_POST['nh'];
    }
    if(empty($_POST['id'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Id tidak boleh kosong'));
    }else{
        $id=$_POST['id'];
    }
    if (empty($error)) {
        //update table nilai
        $sql = "UPDATE nilai SET kode_prodi='$kode_prodi', kode_mk='$kode_mk', tahun_ajaran='$tahun_ajaran', semester='$semester', nim='$nim', nama='$nama', nilai_angka='$nilai_angka', nilai_huruf='$nilai_huruf' WHERE id='$id'";
        
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
