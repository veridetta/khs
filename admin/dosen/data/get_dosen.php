<?php
//type json
header('Content-Type: application/json');
//include file connect.php
include "../../../config/connect.php";
//tables
$table = 'dosen';
//primary keys
$primaryKey='id';

$columns = array(
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'nip', 'dt' => 3 ),
    array( 'db' => 'nama', 'dt' => 2 ),
    array( 'db' => 'alamat', 'dt' => 4 ),
    array( 'db' => 'no_telp', 'dt' => 5 ),
    array( 'db' => 'email', 'dt' => 6 ),
    array( 'db' => 'kode_prodi', 'dt' => 7 ),
    array( 'db' => 'kode_mk', 'dt' => 8 )
);
//sql details
$sql_details = array(
    'user' => $user,
    'pass' => $pass,
    'db'   => $db,
    'host' => $host
);
require( '../../../config/ssp.class.php' );

//echo json encode
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);