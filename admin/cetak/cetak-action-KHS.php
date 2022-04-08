<?php
//include config/connect.php
include "../../config/connect.php";
//include file header.php
include "../../include/header.php";
//membuat variable kosong
$username = "";
$password = "";
$nama = "";
$level = "";
include "../../include/session_checker.php";
//call function on session_checker.php
session_checker();
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
        }
        //jika level sama dengan user
        else if($level == "user"){
            //maka akan dialihkan ke halaman user
            header("location:../user/index.php");
        }
    }
}
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
    include "../../include/assets.php";
    ?>
</head>
<body>
    <div class="container col-11" style="padding: 12px;">
        <div class="row">
            <!-- Tampilan Lengkap kartu Hasil Studi Mahasiswa Selama satu semester--> 
            <div class="col-12">
                <div class="card" id="cetak">
                    <div class="card-header">
                        <!--judul text center-->
                        <h3 class="text-center">Kartu Hasil Studi Mahasiswa</h3>
                        <!-- semester dan tahun ajaran -->
                        <h5 class="text-center">Semester <?php echo $_POST['semester']; ?> Tahun Ajaran <?php echo $_POST['tahun_ajaran']; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- no induk mahasiswa jarak titik dua rapih dengan table-->
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>NIM</td>
                                                <td>:</td>
                                                <td><?php echo $_POST['nim']; ?></td>
                                            </tr>
                                            <!-- ambil data mahasiswa dari database -->
                                            <?php
                                             //ambil
                                            $nim = $_POST['nim'];
                                            //query
                                            $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
                                            //jalankan query
                                            $query = mysqli_query($connect, $sql);
                                            //ambil data
                                            $data = mysqli_fetch_assoc($query);
                                            //mengambil data dari database
                                            $nama = $data['nama'];
                                            //mengambil data dari database
                                            $kelas = $data['kelas'];
                                            //mengambil data dari database
                                            $jurusan = $data['jurusan'];
                                            //menampilkan nama
                                            ?>
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td><?php echo $nama; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                    <table class="table table-borderless">
                                            <!-- menampilkan kelas -->
                                            <tr>
                                                <td>Kelas</td>
                                                <td>:</td>
                                                <td><?php echo $kelas; ?></td>
                                            </tr>
                                            <!-- menampilkan jurusan -->
                                            <tr>
                                                <td>Jurusan</td>
                                                <td>:</td>
                                                <td><?php echo $jurusan; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- membuat table nilai tiap mata kuliah -->
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai Huruf</th>
                                            <th>Nilai Angka</th>
                                            <th>NA x K</th>
                                            <th>Mutu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- menampilkan data nilai -->
                                        <?php
                                        //ambil
                                        $nim = $_POST['nim'];
                                        //query
                                        $sql = "SELECT n.kode_prodi, n.kode_mk, n.nilai_huruf, n.nilai_angka, m.nama, m.sks FROM nilai n inner join mata_kuliah m on m.kode_mk=n.kode_mk and m.semester=n.semester WHERE n.nim='$nim' and n.tahun_ajaran='$_POST[tahun_ajaran]' and n.semester='$_POST[semester]'";
                                        //jalankan query
                                        $query = mysqli_query($connect, $sql);
                                        //while data
                                        $no = 1;
                                        $totalSKS = 0;
                                        $totalKredit = 0;
                                        $totalNaxk = 0;
                                        $naxk=0;
                                        $IPS=0;
                                        while($data = mysqli_fetch_assoc($query)){
                                            //mengambil data dari database
                                            $kode_prodi = $data['kode_prodi'];
                                            //mengambil data dari database
                                            $kode_mk = $data['kode_mk'];
                                            //mengambil data dari database
                                            $nilai_huruf = $data['nilai_huruf'];
                                            //mengambil data dari database
                                            $nilai_angka = $data['nilai_angka'];
                                            //menampilkan data
                                            $sks=$data['sks'];
                                            $totalSKS += $sks;
                                            $naxk =$sks*$nilai_angka; 
                                            $totalNaxk += $naxk;
                                            $kredit=$naxk/$nilai_angka;
                                            $totalKredit += $kredit;
                                            $IPS=$totalNaxk/$totalSKS;
                                            $nama_mk=$data['nama'];
                                            //menampilkan data
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $kode_mk; ?></td>
                                                <td><?php echo $nama_mk; ?></td>
                                                <td><?php echo $sks; ?></td>
                                                <td><?php echo $nilai_huruf; ?></td>
                                                <td><?php echo $nilai_angka; ?></td>
                                                <td><?php echo $naxk; ?></td>
                                                <td><?php echo $kredit; ?></td>
                                            </tr>
                                            <?php
                                            //menambahkan nilai
                                            $no++;
                                        }
                                        ?>
                                        <!-- menampilkan total SKS, total mutu, IPK dengan teks tebal -->
                                        <tr>
                                            <td colspan="3" align="center"><b>Total</b></td>
                                            <td><b><?php echo $totalSKS; ?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo $totalNaxk; ?></b></td>
                                            <td><b><?php echo $totalKredit; ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center"><b>Indeks Prestasi Semester (IPS)</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?php echo $IPS; ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- menampilkan tanda tangan dekan jurusan -->
                            <!-- Cirebon, tanggal hari ini -->
                            <!-- dekan jurusan -->
                            <!-- Nama dekan jurusan -->
                            <!-- rata kiri kanan -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- paragraph text center -->
                                        <p class="text-center">Cirebon, <?php echo date('d-m-Y'); ?></p>
                                        <!-- paragraph text center -->
                                        <p class="text-center">Dekan,</p>
                                        <!-- paragraph text center -->
                                        <br>
                                        <br>
                                        <br>
                                        <p class="text-center">(...............................................)</p>
                                    </div>
                                    <div class="col-6">
                                        <!-- paragraph text center -->
                                        <p class="text-center">Cirebon, <?php echo date('d-m-Y'); ?></p>
                                        <!-- paragraph text center -->
                                        <p class="text-center">Wakil Dekan,</p>
                                        <!-- paragraph text center -->
                                        <br>
                                        <br>
                                        <br>
                                        <p class="text-center">(...............................................)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="text-center">
                            <!-- membuat tombol cetak div id cetak dengan icon cetak-->
                            <button class="btn btn-primary" onclick="cetak()"><i class="fas fa-print"></i> Cetak</button>
                            <!-- button html2pdf pada halaman ini dengan div id cetak-->
                            <button class="btn btn-primary" onclick="html2pdf()"><i class="fas fa-file-pdf"></i> Save PDF</button>
                        </div>
                    </div>
                </div>
                <!-- JQUERY printThis -->
                <!-- include script printThis from cdn -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.14.0/printThis.min.js"></script>
                <!-- script cdn html2pdf -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script><script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
                <!-- script html2pdf -->
                <script>
                    //fungsi cetak
                    function cetak() {
                        //memanggil fungsi printThis
                        $('#cetak').printThis();
                    }
                    //fungsi html2pdf
                    function html2pdf() {
                        //memanggil fungsi html2canvas
                        html2canvas(document.getElementById("cetak"), {
                            //membuat canvas
                            onrendered: function(canvas) {
                                //membuat pdf
                                var myImage = canvas.toDataURL("image/png");
                                // Adjust width and height
                                var imgWidth =  (canvas.width * 35) / 240;
                                var imgHeight = (canvas.height * 40) / 240;
                                // jspdf changes
                                var pdf = new jsPDF('p', 'mm', 'a4');
                                var imgProp = pdf.getImageProperties(myImage);
                                var pdfWidth = pdf.internal.pageSize.getWidth();
                                var pdfHeight = (imgProp.height * pdfWidth) / imgProp.width;
                                pdf.addImage(myImage, 'png', 0, 0, pdfWidth, pdfHeight); // 2: 19
                                pdf.save(`KHS <?php echo $nim;?>.pdf`);
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include '../../include/footer.php';
?>
</body>
<script>
    $(document).ready(function() {
       
    });
</script>
</html>




    
