<?php
//membuat page login menggunakan bootstrap
//include file connect.php
include "../config/connect.php";
//cek jika sudah ada session
if(isset($_SESSION['username'])){
    //jika sudah ada session, maka akan diarahkan ke halaman admin
    header("location:admin/index.php");
}
//include file header.php
include "../include/header.php";

?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <!-- membuat login card mobile responsive center vertical -->
            <div class="col-md-4 offset-md-4 card mt-5">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzI
    B7b3AgPSerkwHtw" crossorigin="anonymous"></script>
</body>
</html>
<?php
//jika sudah ada tombol login
if(isset($_POST['login'])){
    //maka akan menjalankan perintah dibawah
    //mengambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    //mengambil data dari database
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    //menjalankan query
    $query = mysqli_query($connect, $sql);
    //menghitung jumlah data yang ditemukan
    $count = mysqli_num_rows($query);
    //jika data yang ditemukan sama dengan 1
    if($count == 1){
        //maka akan menjalankan perintah dibawah
        //mengambil data dari database
        $data = mysqli_fetch_assoc($query);
        //mengambil data dari database
        $level = $data['level'];
        //jika level sama dengan admin
        if($level == "admin"){
            //maka akan menjalankan perintah dibawah
            //mengambil data dari database
            $id = $data['id'];
            //mengambil data dari database
            $username = $data['username'];
            //mengambil data dari database
            $password = $data['password'];
            //mengambil data dari database
            $level = $data['level'];
            //mengambil data dari database
            $nama = $data['nama'];
            //mengambil data dari database
            $email = $data['email'];
            //set session aktif
            session_start();
            //mengatur session
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['level'] = $level;
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $email;
            
            //akan dialihkan ke halaman admin
            header("location:../admin/mahasiswa");
        }
        //jika level sama dengan user
        else if($level == "user"){
            //maka akan menjalankan perintah dibawah
            //mengambil data dari database
            $id = $data['id'];
            //mengambil data dari database
            $username = $data['username'];
            //mengambil data dari database
            $password = $data['password'];
            //mengambil data dari database
            $level = $data['level'];
            //mengambil data dari database
            $nama = $data['nama'];
            //mengambil data dari database
            $email = $data['email'];
            //mengambil data dari database
        
        }
    }
    //jika data yang ditemukan sama dengan 0 maka pesan username dan password salah
    else{
        echo "<script>alert('Username atau Password Salah');</script>";
    }
}
?>
    
