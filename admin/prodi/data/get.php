<?php
//include file connect.php
include "../../../config/connect.php";
//tables
$table = 'prodi';
//primary keys
$primaryKey='id';

$columns = array(
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'kode_prodi', 'dt' => 2 ),
    array( 'db' => 'nama', 'dt' => 3 ),
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