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
    <title>Admin KHS Mahasiswa</title>
    <!-- BOOSTRAP dan Jquery CDN dan SWAL-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JQUERY CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
    <!-- BOOTSRAP JS CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   
    <!-- BOOTSRAP JS CDN-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- SWAL CDN-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/r-2.2.9/rg-1.1.4/rr-1.2.8/sb-1.3.2/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/r-2.2.9/rg-1.1.4/rr-1.2.8/sb-1.3.2/datatables.min.js"></script>
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container col-12" style="padding: 12px;">
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
                                    <th>Aksi <button type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add" id="btn_tambah" ><span class="fa fa-plus" aria-hidden="true"></span></button></th>
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
<!-- membuat modal ubah data mahasiswa nim, nama, kelas, jurusan -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" name="form_update" id="form_update">
                    <!-- input hidden-->
                    <input type="hidden" name="tipe" id="tipe">
                    <!-- input id disabled-->
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <!-- ambil data kelas dari table mahasiswa kolom kelas-->
                            <?php
                            $sql = "SELECT DISTINCT kelas FROM mahasiswa";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['kelas']."'>".$row['kelas']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <!-- ambil data jurusan dari table mahasiswa kolom jurusan-->
                            <?php
                            $sql = "SELECT DISTINCT jurusan FROM mahasiswa";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['jurusan']."'>".$row['jurusan']."</option>";
                            }
                            ?>
                        </select>
                    </div>  
                    <button type="submit" class="btn btn-primary" id="btn_update" name="btn_update">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- membuat modal tambah data mahasiswa nim, nama, kelas, jurusan -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" name="form_add" id="form_add">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <!-- ambil data kelas dari table mahasiswa kolom kelas-->
                            <?php
                            $sql = "SELECT DISTINCT kelas FROM mahasiswa";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['kelas']."'>".$row['kelas']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <!-- ambil data jurusan dari table mahasiswa kolom jurusan-->
                            <?php
                            $sql = "SELECT DISTINCT jurusan FROM mahasiswa";
                            $result = mysqli_query($connect, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['jurusan']."'>".$row['jurusan']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn_add" name="btn_add">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    <a href="edit.php?id=${aData[1]}" class="btn btn-warning btn-sm editUser" data-toggle='modal' data-target='#updateModal' >Edit</a>
                    <a href="#" id="${aData[1]}" class="btn btn-danger btn-sm btn_hapus" >Hapus</a>
                `);
                //set id iinput
                $('#id').val(aData[1]);
                //set value nim dan nama mahasiswa
                $('#nim').val(aData[2]);
                $('#nama').val(aData[3]);
                //set value kelas dan jurusan
                $('#kelas').val(aData[4]);
                $('#jurusan').val(aData[5]);
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
                $('.editUser').click(function() {
                    var id = $(this).attr('id');
                   // get value row
                   var dtrow = $(this).closest('tr');
                   //var id
                     var ids= dtrow.find('td:eq(1)').text();
                     var nim = dtrow.find('td:eq(2)').text();
                        var nama = dtrow.find('td:eq(3)').text();
                            var kelas = dtrow.find('td:eq(4)').text();
                                var jurusan = dtrow.find('td:eq(5)').text();
                    //ubah tipe ke edit
                    $('#tipe').val('edit');
                    //set value id
                    $('#id').val(ids);
                    //set value nim dan nama mahasiswa
                    $('#nim').val(nim);
                    $('#nama').val(nama);
                    //set value kelas dan jurusan
                    $('#kelas').val(kelas);
                    $('#jurusan').val(jurusan);

                });
                //hapus data
                $('.btn_hapus').click(function() {
                    var id = $(this).attr('id');
                    var dtrow = $(this).closest('tr');
                    var ids= dtrow.find('td:eq(1)').text();
                    //swal confirm hapus
                    swal({
                        title: "Apakah anda yakin?",
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            //ajax
                            $.ajax({
                                url: 'data/mahasiswa_hapus.php',
                                type: 'POST',
                                data: {
                                    id: $(this).attr('id')
                                },
                                success: function(data) {
                                    //jika data.status = success
                                    if (data.status == 'success') {
                                        swal("Data berhasil dihapus!", {
                                            icon: "success",
                                        });
                                        //refresh table
                                        $('#table_mahasiswa').DataTable().ajax.reload();
                                    } else {
                                        swal("Data gagal dihapus!", {
                                            icon: "error",
                                            //rincian
                                            text: data.error
                                        });
                                    }
                                }
                            });
                        }
                    });
                });
            }

        });
        //btn_tambah click
        $('#btn_tambah').click(function() {
            //ubah tipe ke tambah
            $('#tipe').val('tambah');
            //set value nim dan nama mahasiswa
            $('#nim').val('');
            $('#nama').val('');
            //set value kelas dan jurusan
            $('#kelas').val('');
            $('#jurusan').val('');
            //buka modal tambah
            $('#tambahModal').modal('show');

        });
        //btn_add click ajax
        $('#form_add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'data/mahasiswa_tambah.php',
                type: 'POST',
                data: $('#form_add').serialize(),
                success: function(data) {
                    $('#tambahModal').modal('hide');
                    //swal then reload
                    swal("Data berhasil ditambahkan!", {
                        icon: "success",
                    }).then(function() {
                        $('#table_mahasiswa').DataTable().ajax.reload();
                    });
                }
            });
        });
        //form update click ajax
        $('#form_update').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'data/mahasiswa_update.php',
                type: 'POST',
                data: $('#form_update').serialize(),
                success: function(data) {
                    $('#updateModal').modal('hide');
                        swal({
                            title: 'Berhasil!',
                            text: 'Data berhasil diubah!',
                            type: 'success',
                            timer: 1400,
                            showConfirmButton: false
                            //swall callback
                        }).then(function() {
                            $('#table_mahasiswa').DataTable().ajax.reload();
                        });
                }
                //on error
            }).fail(function() {
                swal({
                    title: "Gagal!",
                    text: "Data gagal diubah!",
                    icon: "error",
                    button: "Tutup",
                });
            });
        });
    });
</script>
</html>




    
