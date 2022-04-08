<?php
//include file connect.php
include "../../../config/connect.php";
//tables
$table = 'semester';
//primary keys
$primaryKey='id';

$columns = array(
    array( 'db' => 'id', 'dt' => 1 ),
    array( 'db' => 'semester', 'dt' => 2 )
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