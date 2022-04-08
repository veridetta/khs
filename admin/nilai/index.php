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
    <title>Nilai</title>
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
                        <h3 class="card-title">Data Nilai</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table_dosen" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id</th>
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Kode Prodi</th>
                                    <th>Kode MK</th>
                                    <th>TA</th>
                                    <th>Semester</th>
                                    <th>SKS</th>
                                    <th>NA</th>
                                    <th>NH</th>
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
<!-- membuat modal untuk ubah data nilai  -->
<div class="modal fade" id="modal_ubah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Data Nilai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_ubah" method="POST">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nim">Nim - Nama</label>
                        <!-- select nim from table mahasiswa -->
                        <select class="form-control" id="nim" name="nim">
                            <option value="">Pilih NIM</option>
                            <?php
                            //membuat query untuk menampilkan data dari table mahasiswa
                            $sql = "SELECT * FROM mahasiswa";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['nim']."-".$data['nama']."'>".$data['nim']."-".$data['nama']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select nim from table mahasiswa -->
                    </div>
                    <div class="form-group">
                        <label for="kode_prodi">Kode Prodi - Kode MK - Nama</label>
                        <!-- select kode_prodi - kode_mk - nama from table mata_kuliah -->
                        <select class="form-control" id="kode_prodi" name="kode_prodi">
                            <option value="">Pilih Kode Prodi - Kode MK - Nama</option>
                            <?php
                            //membuat query untuk menampilkan data dari table mata_kuliah
                            $sql = "SELECT * FROM mata_kuliah";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['kode_prodi']."-".$data['kode_mk']."'>".$data['kode_prodi']."-".$data['kode_mk']."-".$data['nama']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select kode_prodi - kode_mk - nama from table mata_kuliah -->
                    </div>
                    <div class="form-group">
                        <label for="ta">TA</label>
                        <!-- select tahun_ajaran from table tahun_ajaran -->
                        <select class="form-control" id="ta" name="ta">
                            <option value="">Pilih TA</option>
                            <?php
                            //membuat query untuk menampilkan data dari table tahun_ajaran
                            $sql = "SELECT * FROM tahun_ajaran";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['tahun_ajaran']."'>".$data['tahun_ajaran']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select tahun_ajaran from table tahun_ajaran -->
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <!-- Select semester from table semester -->
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <?php
                            //membuat query untuk menampilkan data dari table semester
                            $sql = "SELECT * FROM semester";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['semester']."'>".$data['semester']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select semester from table semester -->
                    </div>
                    <div class="form-group">
                        <label for="na">NA</label>
                        <!-- input type number min 0 max 4 and range 0.1-->
                        <input type="number" class="form-control" id="na" name="na" min="0" max="4" step="0.1">
                    </div>
                    <div class="form-group">
                        <label for="nh">NH</label>
                        <input type="text" class="form-control" id="nh" name="nh">
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
<!-- membuat modal untuk tambah data nilai -->
<div class="modal fade" id="modal_tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Nilai</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_tambah">
                    <div class="form-group">
                        <label for="nim">NIM - Nama</label>
                        <!-- select nim from table mahasiswa -->
                        <select class="form-control" id="nim" name="nim">
                            <option value="">Pilih NIM</option>
                            <?php
                            //membuat query untuk menampilkan data dari table mahasiswa
                            $sql = "SELECT * FROM mahasiswa";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['nim']."-".$data['nama']."'>".$data['nim']."-".$data['nama']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select nim from table mahasiswa -->
                    </div>
                    <div class="form-group">
                        <label for="kode_mk">Kode MK</label>
                        <!-- select kode_mk from table mata_kuliah -->
                        <select class="form-control" id="kode_mk" name="kode_mk">
                            <option value="">Pilih Kode MK - Kode Matkul</option>
                            <?php
                            //membuat query untuk menampilkan data dari table mata_kuliah
                            $sql = "SELECT * FROM mata_kuliah";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['kode_prodi']."-".$data['kode_mk']."'>".$data['kode_prodi']."-".$data['kode_mk']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select kode_mk from table mata_kuliah -->
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <!-- select tahun_ajaran from table tahun_ajaran -->
                        <select class="form-control" id="tahun_ajaran" name="tahun_ajaran">
                            <option value="">Pilih Tahun Ajaran</option>
                            <?php
                            //membuat query untuk menampilkan data dari table tahun_ajaran
                            $sql = "SELECT * FROM tahun_ajaran";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['tahun_ajaran']."'>".$data['tahun_ajaran']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select tahun_ajaran from table tahun_ajaran -->
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <!-- select semester from table semester -->
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <?php
                            //membuat query untuk menampilkan data dari table semester
                            $sql = "SELECT * FROM semester";
                            //menjalankan query
                            $query = mysqli_query($connect, $sql);
                            //menghitung jumlah data yang ditemukan
                            $count = mysqli_num_rows($query);
                            //jika data ditemukan
                            if($count > 0){
                                //maka akan menjalankan perintah dibawah
                                //mengambil data dari database
                                while($data = mysqli_fetch_assoc($query)){
                                    //menampilkan data dari database
                                    echo "<option value='".$data['semester']."'>".$data['semester']."</option>";
                                }
                            }
                            ?>
                        </select>   <!-- /.select semester from table semester -->
                    </div>
                    <div class="form-group">
                        <label for="nilai_huruf">Nilai Huruf</label>
                        <input type="text" class="form-control" id="nilai_huruf" name="nilai_huruf">
                    </div>
                    <div class="form-group">
                        <label for="nilai_angka">Nilai Angka</label>
                        <!-- min 0 max 4 step 0.1 -->
                        <input type="number" class="form-control" id="nilai_angka" name="nilai_angka" min="0" max="4" step="0.1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn_submit_tambah">Save changes</button>
            </div>
        </div>
    </div>
</div>
                    
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        //data tables editor
        var table = $('#table_dosen').DataTable({
            dom: "Bfrtip",
            "ajax": {
                "url": "data/get.php",
                "type": "POST"
            },
            "columns": [
                { "data": "nilai.is" },
                { "data": "nilai.id" },
                { "data": "nilai.nim" },
                { "data": "nilai.nama" },
                { "data": "nilai.kode_prodi" },
                { "data": "nilai.kode_mk" },
                { "data": "nilai.tahun_ajaran" },
                { "data": "nilai.semester" },
                { "data": "mata_kuliah.sks" },
                { "data": "nilai.nilai_angka" },
                { "data": "nilai.nilai_huruf" },
                { "data": "nilai.aksi" }
            ],
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 1 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 3 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 4 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 5 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 6 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 7 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 8 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 9 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 10 ],
                    "visible": true,
                    "searchable": false
                },
                {
                    "targets": [ 11 ],
                    "visible": true,
                    "searchable": false
                }
            ],
            //tambah tombol hapus dan edit dengan fungsi
            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                var index = iDisplayIndex +1;
                $('td:eq(0)',nRow).html(index);
                $('td:eq(11)',nRow).html(`
                    <a href="edit.php?id=${aData[0]}" class="btn btn-warning btn-sm editUser" data-toggle='modal' data-target='#modal_ubah' >Edit</a>
                    <a href="#" id="${aData[1]}" class="btn btn-danger btn-sm btn_hapus" >Hapus</a>
                `);
                //set id iinput
                $('#id').val(aData[1]);
                
                return nRow;
            },
            "order": [[ 0, "desc" ]],
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
                        var nim= dtrow.find('td:eq(2)').text();
                        var nama= dtrow.find('td:eq(3)').text();
                        var kode_prodi= dtrow.find('td:eq(4)').text();
                        var kode_mk= dtrow.find('td:eq(5)').text();
                        var tahun_ajaran= dtrow.find('td:eq(6)').text();
                        var semester= dtrow.find('td:eq(7)').text();
                        var sks= dtrow.find('td:eq(8)').text();
                        var nilai_angka= dtrow.find('td:eq(9)').text();
                        var nilai_huruf= dtrow.find('td:eq(10)').text();
                    
                        //set value
                        $('#id').val(ids);
                        $('#nim').val(nim+"-"+nama);
                        $('#kode_prodi').val(kode_prodi+"-"+kode_mk);
                        $('#ta').val(tahun_ajaran);
                        $('#semester').val(semester);
                        $('#na').val(nilai_angka);
                        $('#nh').val(nilai_huruf);

                       
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
                                    id: ids
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
            $('#nim').val('');
            $('#kode_prodi').val('');
            $('#ta').val('');
            $('#semester').val('');
            $('#na').val('');
            $('#nh').val('');

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




    
