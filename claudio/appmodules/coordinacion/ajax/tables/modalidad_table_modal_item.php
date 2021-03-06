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

$columns = array( 
  // datatable column index  => database column name
  0 =>'2', 
  1 =>'3',
  2 =>'4', 
  3 =>'5',
  4 =>'6',
);

// getting total number records without any search
$sql = "SELECT id, nombre, info_status FROM coor_coordinacion_modalidad ";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT id, nombre, info_status FROM coor_coordinacion_modalidad WHERE 1=1 ";
// $requestData["codigo_cotizacion"];
if( !empty($requestData['columns'][0]['search']['value']) ){
	$sql.=" AND nombre LIKE '%".$requestData['columns'][0]['search']['value']."%' ";
}

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
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
  "data"            => $data   // total data array
);


echo json_encode($json_data);  // send data as json format
