<?php
//include file connect.php
include "../../../config/connect.php";
require( '../../../config/DataTables.php' );
//tables
use
    DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Options,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate,
    DataTables\Editor\ValidateOptions;
 
 
/*
 * Example PHP implementation used for the join.html example
 */
$table = 'nilai';
//primary keys
$primaryKey='id';
$user="root";
$sql_details = array(
    'user' => $user,
    'pass' => $pass,
    'db'   => $db,
    'host' => $host
);
Editor::inst( $db, 'nilai' )
    ->field(
        Field::inst( 'nilai.id' ),
        Field::inst( 'nilai.kode_prodi' ),
        Field::inst( 'nilai.kode_mk' ),
        Field::inst( 'nilai.tahun_ajaran' ),
        Field::inst( 'nilai.semester' ),
        Field::inst( 'nilai.nim' ),
        Field::inst( 'nilai.nama' ),
        Field::inst( 'nilai.nilai_angka' ),
        Field::inst( 'nilai.nilai_huruf' )
            ->options( Options::inst()
                ->table( 'mata_kuliah' )
                ->value( 'id' )
                ->label( 'sks' )
            )
            ->validator( Validate::dbValues() ),
        Field::inst( 'mata_kuliah.sks' )
    )
    ->leftJoin( 'mata_kuliah', 'mata_kuliah.kode_mk', '=', 'nilai.kode_mk' )
    ->process($_POST)
    ->json();