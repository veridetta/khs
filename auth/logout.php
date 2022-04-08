<?php
//fungsi logoout
function logout(){
    //mengatur session
    session_start();
    //menghapus session
    session_destroy();
    //mengalihkan halaman
    header("location:../index.php");
}
//menjalankan fungsi
logout();