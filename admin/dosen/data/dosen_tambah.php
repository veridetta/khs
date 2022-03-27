<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['nip'])){
    //ambil data dari form
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $kode_prodi = $_POST['kode_prodi'];
    $kode_mk = $_POST['kode_mk'];
    $username = $nip;
    $password= $nip;
    $status = "dosen";
    //buat query dengan urutan nama_dosen, nip, alamat, email, no_telp, username, password, status, kode_prodi, kode_mk
    $sql = "INSERT INTO dosen VALUES('','$nama','$nip','$alamat','$email','$no_telp','$username','$password','$status','$kode_prodi','$kode_mk')";

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