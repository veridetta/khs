<?php
//membuat file header.php dengan bootstrap cdn dan jquer cdn
//include from base url config/connect.php
include ($_SERVER['DOCUMENT_ROOT'].'/khs/config/connect.php');
//membuat variable kosong
$username = "";
$password = "";
$nama = "";
$level = "";
$email = "";
//start session
session_start();

//cek jika sudah ada session
if(isset($_SESSION['username'])){
    //jika sudah ada session maka akan menjalankan perintah dibawah
    //mengambil data dari session
    $username = $_SESSION['username'];
    //mengambil data dari database
    $sql = "SELECT * FROM user WHERE username='$username'";
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
        
        }
    }
    //membuat tombol logout pada header jika ada session
    $status= "<a href='logout.php' class='btn btn-danger'>Logout</a>";
}else{
    //jika belum ada sesion maka tombol login
    $status= "<a href='login.php' class='btn btn-primary'>Login</a>";
}
?>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if(isset($_SESSION['username'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown" id="li_data">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!-- jika url sama dengan href maka dropdown aktiv -->
                    <a class="dropdown-item <?php if($_SERVER['REQUEST_URI'] == "/khs/admin/mahasiswa/"){echo "active";} ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/khs/admin/mahasiswa';?>">Mahasiswa</a>
                    <a class="dropdown-item <?php if($_SERVER['REQUEST_URI'] == "/khs/admin/dosen/"){echo "active";} ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/khs/admin/dosen';?>">Dosen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                <?php
                }
                ?>
            </ul>
            <!-- buat tombol logout / login di pojok kanan-->
            <?php echo $status; ?>
            
        </div>
    </nav>

