<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$info_status = array(
    '0' => 'Desactivo'
    , '1' => 'Activo'
);

$columns = array();
for ($i=1; $i<=4; $i++) {
    $columns[$i-1] = $i;
}

$sql_ini='SELECT nombre, info_status, id FROM co_servicio_tipo WHERE 1=1';
// getting total number records without any search
$sql = $sql_ini;
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;
// $requestData["codigo_cotizacion"];
if( !empty($requestData['columns'][0]['search']['value']) ){
	$sql.=" AND nombre LIKE '%".$requestData['columns'][0]['search']['value']."%' ";
}


$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
if ( intval($requestData['order'][0]['column']) < 1 ) {
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir'];
}
$sql.=" LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
  // preparing an array
  $nestedData=array();
  $nestedData[] =  utf8_encode($row["nombre"]);
  $nestedData[] = $info_status[$row["info_status"]];
  $nestedData[] = '<a class="edit" codigo="' . $row["id"] . '">Editar</a>';
  $data[] = $nestedData;
}

$json_data = array(
  "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval( $totalData ),  // total number of records
  "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data,  // total data array
  "sql"             => $sql
);


echo json_encode($json_data);  // send data as json format
