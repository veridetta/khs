<?php

//update data dosen
//include file connect.php
include "../../../config/connect.php";
//type json
header('Content-Type: application/json');
//cek POST
if (isset($_POST['nama'])) {
    //cek validasi
    if (empty($_POST['nama'])) {
        $error = 'Nama Dosen harus diisi!';
    } else {
        $nama = $_POST['nama'];
    }

    if (empty($_POST['nip'])) {
        $error = 'NIP harus diisi!';
    } else {
        $nip = $_POST['nip'];
    }

    if (empty($_POST['alamat'])) {
        $error = 'Alamat harus diisi!';
    } else {
        $alamat = $_POST['alamat'];
    }

    if (empty($_POST['email'])) {
        $error = 'Email harus diisi!';
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['no_telp'])) {
        $error = 'Telepon harus diisi!';
    } else {
        $telepon = $_POST['no_telp'];
    }

    if (empty($_POST['kode_prodi'])) {
        $error = 'Password harus diisi!';
    } else {
        $password = $_POST['kode_prodi'];
    }

    if (empty($_POST['kode_mk'])) {
        $error = 'Level harus diisi!';
    } else {
        $level = $_POST['kode_mk'];
    }
    //if empty $_POST['id']
    if (empty($_POST['id'])) {
        $error = 'id harus diisi!';
    } else {
        $id = $_POST['id'];
    }

    if (empty($error)) {
        $sql = "UPDATE dosen SET nama='$nama', nip='$nip', alamat='$alamat', email='$email', no_telp='$telepon', password='$nip', username='$nip', kode_mk = '$level', kode_prodi='$password' WHERE id='$id'";
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
