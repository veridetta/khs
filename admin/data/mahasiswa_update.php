<?php
//page update data mahasiswa
//include file connect.php
include "../../config/connect.php";
//handel post
if(isset($_POST['tipe'])){
    //mengambil data dari form
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];
    //query update data
    $sql = "UPDATE mahasiswa SET nim='$nim', nama='$nama', kelas='$kelas', jurusan='$jurusan' WHERE id='$id'";
    //menjalankan query
    $query = mysqli_query($connect, $sql);
    //jika berhasil maka akan return json success
    if($query){
        echo json_encode(array('success' => true));
    }
    //jika gagal maka akan return json error
    else{
        echo json_encode(array('errorMsg' => 'Some errors occured.'));
    }
}