<?php
//public fungsi jika tidak ada sesi maka akan dialihkan ke halaman login
function session_checker(){
    //jika tidak ada sesi maka akan dialihkan ke halaman login
    if(!isset($_SESSION['username'])){
        //header location with $_SERVER document root
        header("location:http://".$_SERVER['HTTP_HOST']."/khs/auth/login.php");
    }
}
?>