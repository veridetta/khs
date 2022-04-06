<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['tahun_ajaran'])) {
    //cek validasi
    if (empty($_POST['tahun_ajaran'])) {
        $error = 'Tahun Ajaran harus diisi!';
    } else{
        $tahun_ajaran = $_POST['tahun_ajaran'];
    }

    //cek error
    //if empty $_POST['id']
    if (empty($_POST['id'])) {
        $error = 'id harus diisi!';
    } else {
        $id = $_POST['id'];
    }
    
    if (empty($error)) {
        $sql = "UPDATE tahun_ajaran SET tahun_ajaran='$tahun_ajaran' WHERE id='$id'";
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
