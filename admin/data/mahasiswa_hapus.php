<?php
//hapus data mahasiswa
//include file connect.php
include "../../config/connect.php";
// jika ada S_POST
if(isset($_POST['id'])){
    //mengambil data dari form
    $id = $_POST['id'];
    //mengambil data dari database
    $sql = "DELETE FROM mahasiswa WHERE id='$id'";
    //menjalankan query
    $query = mysqli_query($connect, $sql);
    //jika berhasil
    if($query){
        //maka akan menjalankan perintah dibawah
       //return json
         echo json_encode(array("status" => TRUE));
    }
    //jika gagal
    else{
        //maka akan menjalankan perintah dibawah
        //return json
        echo json_encode(array('errorMsg' => 'Some errors occured.'));
    }
}