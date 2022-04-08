<?php
//include connect.php
include "../../../config/connect.php";
//kita akan membuat halaman untuk store data dari POST ke database
//jika tombol simpan di klik
//type jSon
header('Content-Type: application/json');
if(isset($_POST['nilai_angka'])){
    //cek validasi kode_prodi sudah isi
    //cek validasi
    if(empty($_POST['kode_mk'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'kode_prodi tidak boleh kosong'));
    }else{
        //$kode explode kode_prodi
        $kode = explode('-', $_POST['kode_mk']);
        //kode_prodi
        $kode_prodi = $kode[0];
        //kode_mk
        $kode_mk = $kode[1];
    }
    if(empty($_POST['tahun_ajaran'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'tahun_ajaran tidak boleh kosong'));
    }else{
        $tahun_ajaran=$_POST['tahun_ajaran'];
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
    if(empty($_POST['nilai_angka'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'nilai_angka tidak boleh kosong'));
    }else{
        $nilai_angka=$_POST['nilai_angka'];
    }
    if(empty($_POST['nilai_huruf'])){
        //jika kode_prodi kosong
        echo json_encode(array('status'=>'failed', 'message'=>'nilai_huruf tidak boleh kosong'));
    }else{
        $nilai_huruf=$_POST['nilai_huruf'];
    }
    //insert ke table nilai
    $sql = "INSERT INTO nilai (kode_prodi, kode_mk, tahun_ajaran, semester, nim, nama, nilai_angka, nilai_huruf) VALUES ('$kode_prodi','$kode_mk', '$tahun_ajaran', '$semester', '$nim', '$nama', '$nilai_angka', '$nilai_huruf')";
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