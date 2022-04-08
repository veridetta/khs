<?php
//hapus data dosen
//include file connect.php
//type json 
header('Content-Type: application/json');
include "../../../config/connect.php";
// jika ada S_POST
if(isset($_POST['id'])){
    //mengambil data dari form
    $id = $_POST['id'];
    //mengambil data dari database
    $sql = "DELETE FROM nilai WHERE id='$id'";
    //menjalankan query
    $query = mysqli_query($connect, $sql);
    //jika berhasil
    if($query){
        //maka akan menjalankan perintah dibawah
       //return json status success
       echo json_encode(array('status'=>'success', 'msg'=>'Data berhasil dihapus', 'query'=>$sql));

    }
    //jika gagal
    else{
        //maka akan menjalankan perintah dibawah
        //return json
         //jika gagal json
         echo json_encode(array('status'=>'failed', 
         //menampilkan log error
         'error'=>mysqli_error($connect)));
    }
}