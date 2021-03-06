<?php
//include file connect.php
include "../../../config/connect.php";
//tables
$table = 'mata_kuliah';
//primary keys
$primaryKey='id';

$columns = array(
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'kode_mk', 'dt' => 3 ),
    array( 'db' => 'nama', 'dt' => 4 ),
    array( 'db' => 'sks', 'dt' => 6 ),
    array( 'db' => 'semester', 'dt' => 5 ),
    array( 'db' => 'kode_prodi', 'dt' => 2 ),
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