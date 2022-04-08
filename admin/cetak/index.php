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
            <!-- menampilkan data menggunakan boostrap datatables server side -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Mahasiswa</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table_mahasiswa" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
        $.fn.dataTable.ext.errMode = 'none';
        //datatables with server side processing
        $('#table_mahasiswa').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url":"data/get_mahasiswa.php",
                "data": function(d) {
                    d.id = $('#id').val();
                    d.nim = $('#nim').val();
                    d.nama = $('#nama').val();
                    d.kelas = $('#kelas').val();
                    d.jurusan = $('#jurusan').val();
                    d.tipe = $('#tipe').val();
                }
            },
            //tambah tombol hapus dan edit dengan fungsi
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                $('td:eq(6)',nRow).html(`
                    <a href="cetak-action.php?id=${aData[2]}" class="btn btn-warning btn-sm cetakKHS" ><i class="fas fa-print"></i></a>
                `);
                //set id iinput
                $('#id').val(aData[1]);
                //set value nim dan nama mahasiswa
                $('#nim').val(aData[2]);
                return nRow;
            },
            //menambahkan tombol visibility, copy, csv, excel, pdf, print
            columnDefs: [
                {
                    targets: [0,6],
                    className: 'text-center'
                }
            ],
            //set column yang dapat di sort
            "columns": [
                {"orderable": false},
                {"orderable": true},
                {"orderable": true},
                {"orderable": true},
                {"orderable": true},
                {"orderable": true},
                {"orderable": false}
            ],
            //menambahkan urut
            order: [[ 0, "asc" ]],
            //menambahkan tombol cetek
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fas fa-copy"></i>',
                    className: 'btn btn-info'
                },
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i>',
                    className: 'btn btn-info'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i>',
                    className: 'btn btn-info'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i>',
                    className: 'btn btn-info'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    className: 'btn btn-info'
                }
            ],
            //btn editUser click
            "fnDrawCallback": function() {
                $('.cetakKHS').click(function() {
                    var id = $(this).attr('id');
                   // get value row
                   var dtrow = $(this).closest('tr');
                   //var id
                     var ids= dtrow.find('td:eq(1)').text();
                     var nim = dtrow.find('td:eq(2)').text();

                });
                //hapus data
            }

        });
        //btn_tambah click
    });
</script>
</html>




    
