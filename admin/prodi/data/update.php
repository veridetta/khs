<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['kode_prodi'])) {
    //cek validasi
    if (empty($_POST['kode_prodi'])) {
        $error = 'Kode Prodi harus diisi!';
    } else{
        $kode_prodi = $_POST['kode_prodi'];
    }
    if (empty($_POST['nama_prodi'])) {
        $error = 'Nama harus diisi!';
    } else{
        $nama = $_POST['nama_prodi'];
    }
    //cek error
    //if empty $_POST['id']
    if (empty($_POST['id'])) {
        $error = 'id harus diisi!';
    } else {
        $id = $_POST['id'];
    }
    
    if (empty($error)) {
        //update table prodi
        $sql = "UPDATE prodi SET kode_prodi='$kode_prodi', nama='$nama' WHERE id='$id'";
        
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
