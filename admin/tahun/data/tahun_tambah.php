<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['tahun_ajaran'])){
    //ambil data dari form
    $tahun_ajaran = $_POST['tahun_ajaran'];

    //buat query dengan urutan nama_dosen, nip, alamat, email, no_telp, username, password, status, kode_prodi, kode_mk
    $sql = "INSERT INTO tahun_ajaran VALUES('','$tahun_ajaran')";

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