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
//include session_checker.php
include "../../include/session_checker.php";
//panggil fungsi session
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
    <title>Dosen Page</title>
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
                        <h3 class="card-title">Data Dosen</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table_dosen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <!-- data dosen-->
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Email</th>
                                    <th>Prodi</th>
                                    <th>Matkul</th>
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
<!-- membuat modal ubah data dosen -->
<div class="modal fade" id="modal-ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_ubah">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select class="form-control" id="prodi" name="kode_prodi">
                            <option value="">Pilih Prodi</option>
                            <?php
                            $query = "SELECT * FROM prodi";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['kode_prodi'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Matkul</label>
                        <select class="form-control" id="matkul" name="kode_mk">
                            <option value="">Pilih Matkul</option>
                            <?php
                            $query = "SELECT * FROM mata_kuliah";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['kode_mk'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" id="id" name="id">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn_submit_ubah">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- membuat modal tambah data dosen -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_tambah">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No. Telp</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="No. Telp">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="prodi">Prodi</label>
                        <select class="form-control" id="prodi" name="kode_prodi">
                            <option value="
                            ">Pilih Prodi</option>
                            <?php
                            $query = "SELECT * FROM prodi";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['kode_prodi'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Matkul</label>
                        <select class="form-control" id="matkul" name="kode_mk">
                            <option value="">Pilih Matkul</option>
                            <?php
                            $query = "SELECT * FROM mata_kuliah";
                            $result = mysqli_query($connect, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['kode_mk'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn_submit_tambah">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        //datatables with server side processing
        $('#table_dosen').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "data/get_dosen.php",
                "data":function(d){
                    d.prodi = $('#prodi').val();
                    d.matkul = $('#matkul').val();
                }
            },
            //tambah tombol hapus dan edit dengan fungsi
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                $('td:eq(9)',nRow).html(`
                    <a href="edit.php?id=${aData[1]}" class="btn btn-warning btn-sm editUser" data-toggle='modal' data-target='#modal-ubah' >Edit</a>
                    <a href="#" id="${aData[1]}" class="btn btn-danger btn-sm btn_hapus" >Hapus</a>
                `);
                //set id iinput
                $('#id').val(aData[1]);
                $('#nama').val(aData[2]);
                $('#nip').val(aData[3]);
                $('#alamat').val(aData[4]);
                $('#telp').val(aData[5]);
                $('#email').val(aData[6]);
                $('#prodi').val(aData[7]);
                $('#matkul').val(aData[8]);

                return nRow;
            },
            //menambahkan tombol visibility, copy, csv, excel, pdf, print
            columnDefs: [
                {
                    targets: [0,9],
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
                        var nama = dtrow.find('td:eq(2)').text();
                        var nip = dtrow.find('td:eq(3)').text();
                        var alamat = dtrow.find('td:eq(4)').text();
                        var telp = dtrow.find('td:eq(5)').text();
                        var email = dtrow.find('td:eq(6)').text();
                        var prodi = dtrow.find('td:eq(7)').text();
                        var matkul = dtrow.find('td:eq(8)').text();
                        //set value
                        $('#id').val(ids);
                        $('#nama').val(nama);
                        $('#nip').val(nip);
                        $('#alamat').val(alamat);
                        $('#no_telp').val(telp);
                        $('#email').val(email);
                        $('#prodi').val(prodi);
                        $('#matkul').val(matkul);

                    //ubah tipe ke edit
                    $('#tipe').val('edit');

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
                                url: 'data/dosen_hapus.php',
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
                                        $('#table_dosen').DataTable().ajax.reload();
                                    } else {
                                        swal("Data gagal dihapus!", {
                                            icon: "error",
                                            msg: data.error
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
            //kosongkan input
            $('#nama').val('');
            $('#nip').val('');
            $('#alamat').val('');
            $('#no_telp').val('');
            $('#email').val('');
            $('#prodi').val('');
            $('#matkul').val('');

            //buka modal tambah
            $('#modal-tambah').modal('show');

        });
        //btn_submit_tambah click submit form_tambah
        $('#btn_submit_tambah').click(function() {
            //submit form_tambah
            $('#form_tambah').submit();
        });
        //btn_add click ajax
        $('#form_tambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'data/dosen_tambah.php',
                type: 'POST',
                data: $('#form_tambah').serialize(),
                success: function(data) {
                    $('#modal-tambah').modal('hide');
                    //jika data.status = success
                    if (data.status == 'success') {
                        //swal berhasil
                        swal("Data berhasil ditambahkan!", {
                            icon: "success",
                        });
                        //reload table
                        $('#table_dosen').DataTable().ajax.reload();
                    } else {
                        //swal gagal
                        swal("Data gagal ditambahkan!", {
                            icon: "error",
                            //rincian
                            text: data.error
                        });
                    }
                }
            });
        });
        //btn_submit_ubah klik form_ubah submit
        $('#btn_submit_ubah').click(function() {
            //submit form_ubah
            $('#form_ubah').submit();
        });
        //form update click ajax
        $('#form_ubah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'data/dosen_update.php',
                type: 'POST',
                data: $('#form_ubah').serialize(),
                success: function(data) {
                    //close modal
                    $('#modal-ubah').modal('hide');
                    //if data.status = success
                    if (data.status == 'success') {
                        //swal berhasil
                        swal("Data berhasil diubah!", {
                            icon: "success",
                        });
                        //reload table
                        $('#table_dosen').DataTable().ajax.reload();
                    } else {
                        //swal gagal
                        swal("Data gagal diubah!", {
                            icon: "error",
                            //rincian
                            text: data.error
                        });
                    }
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
<?php
include '../../include/footer.php';
?>
</html>




    
