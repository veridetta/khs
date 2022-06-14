<?php
//include config/connect.php
include "../config/connect.php";
//include file header.php
include "../include/header.php";
//membuat variable kosong
$username = "";
$password = "";
$nama = "";
$level = "";
include "../include/session_checker.php";
//call function on session_checker.php
session_checker();
//cek jika sudah ada session
//membuat halaman admin KHS Mahasiswa dengan bootsrap dan jquery cdn online
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak KHS</title>
    <?php
    //include assets.php
    include "../include/assets.php";
    ?>
</head>
<body>
    <div class="container col-11" style="padding: 12px;">
        <div class="row">
            <!-- membuat halaman Kartu Hasil Studi dengan bootsrap dan jquery cdn online -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Cetak Kartu Hasil Studi</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="../admin/cetak/cetak-action-KHS.php" target="_blank" method="post">
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <!-- input value nim from $_GET['id'] -->
                                        <input type="text" class="form-control" name="nim" id="nim" value="<?php echo $_SESSION['username']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <!-- option semester from table semester -->
                                        <select class="form-control" name="semester" id="semester">
                                            <!-- option select semester -->
                                            <option value="">-- Pilih Semester --</option>
                                            <?php
                                            //membuat query untuk menampilkan data semester
                                            $sql = "SELECT * FROM semester";
                                            //menjalankan query
                                            $query = mysqli_query($connect, $sql);
                                            //menghitung jumlah data yang ditemukan
                                            $count = mysqli_num_rows($query);
                                           //while loop untuk menampilkan data semester
                                            while($data = mysqli_fetch_assoc($query)){
                                                //mengambil data dari database
                                                $id = $data['id'];
                                                //mengambil data dari database
                                                $semester = $data['semester'];
                                                //menampilkan data semester
                                                echo "<option value='$semester'>$semester</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <!-- loop option tahun ajaran from table tahun_ajaran -->
                                        <select class="form-control" name="tahun_ajaran" id="tahun_ajaran">
                                            <!-- option pilih tahun ajaran -->
                                            <option value="">-- Pilih Tahun Ajaran --</option>
                                            <?php
                                            //membuat query untuk menampilkan data tahun ajaran
                                            $sql = "SELECT * FROM tahun_ajaran";
                                            //menjalankan query
                                            $query = mysqli_query($connect, $sql);
                                            //menghitung jumlah data yang ditemukan
                                            $count = mysqli_num_rows($query);
                                            //while loop untuk menampilkan data tahun ajaran
                                            while($data = mysqli_fetch_assoc($query)){
                                                //mengambil data dari database
                                                $id = $data['id'];
                                                //mengambil data dari database
                                                $tahun_ajaran = $data['tahun_ajaran'];
                                                //menampilkan data tahun ajaran
                                                echo "<option value='$tahun_ajaran'>$tahun_ajaran</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Cetak</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include '../include/footer.php';
?>
</body>
<script>
    $(document).ready(function() {
       
    });
</script>
</html>




    
