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
    <title>Semester</title>
    <?php
    //include file assets/.php
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
                        <h3 class="card-title">Data Semester</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table_dosen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Semester</th>
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
<!-- membuat modal untuk ubah data semester-->
<div class="modal fade" id="modal_ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Semester</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_ubah">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_submit_ubah">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- membuat modal untuk tambah data semester-->
<div class="modal fade" id="modal_tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Semester</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_tambah">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" class="form-control" id="semester" name="semester">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn_submit_tambah">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog --> 
</div>
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        //datatables with server side processing
        $('#table_dosen').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "data/get.php",
                "data":function(d){
                    
                }
            },
            //tambah tombol hapus dan edit dengan fungsi
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                $('td:eq(3)',nRow).html(`
                    <a href="edit.php?id=${aData[1]}" class="btn btn-warning btn-sm editUser" data-toggle='modal' data-target='#modal_ubah' >Edit</a>
                    <a href="#" id="${aData[1]}" class="btn btn-danger btn-sm btn_hapus" >Hapus</a>
                `);
                //set id iinput
                $('#id').val(aData[1]);
                $('#semester').val(aData[2]);
                
                return nRow;
            },
            //menambahkan tombol visibility, copy, csv, excel, pdf, print
            columnDefs: [
                {
                    targets: [0,3],
                    className: 'text-center'
                }
            ],
            //set column yang dapat di sort
            "columns": [
                {"orderable": false},
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
                
                    var semester = dtrow.find('td:eq(2)').text();
                    
                        //set value
                        $('#id').val(ids);

                        $('#semester').val(semester);

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
                                url: 'data/hapus.php',
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
            $('#semester').val('');

            //buka modal tambah
            $('#modal_tambah').modal('show');

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
                url: 'data/tambah.php',
                type: 'POST',
                data: $('#form_tambah').serialize(),
                success: function(data) {
                    $('#modal_tambah').modal('hide');
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
                url: 'data/update.php',
                type: 'POST',
                data: $('#form_ubah').serialize(),
                success: function(data) {
                    //close modal
                    $('#modal_ubah').modal('hide');
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




    
