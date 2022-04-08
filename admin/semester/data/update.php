<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['semester'])) {
    //cek validasi
    //cek validasi kode_prodi sudah isi
    if(empty($_POST['semester'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'semester tidak boleh kosong'));
    }else{
        $semester=$_POST['semester'];
    }

    if(empty($_POST['id'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'Id tidak boleh kosong'));
    }else{
        $id=$_POST['id'];
    }
    if (empty($error)) {
        //update table matkul
        $sql = "UPDATE semester SET semester='$semester' WHERE id='$id'";
        
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
