<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
  // datatable column index  => database column name
  0 =>'2', 
  1 =>'3',
  2 =>'4', 
  3 =>'5',
);

// getting total number records without any search
$sql = "SELECT na.id, na.nombre, na.documento, na.telefono, na.correo
        FROM co_involucrado_natural na";

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT na.id , na.nombre, na.documento, na.telefono, na.correo
        FROM co_involucrado_natural na WHERE 1=1 ";

// $requestData["codigo_cotizacion"];
if( !empty($requestData['columns'][0]['search']['value']) ){
	$sql.=" AND na.nombre LIKE '%".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){
	$sql.=" AND na.documento LIKE '%".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){
	$sql.=" AND na.telefono LIKE '%".$requestData['columns'][2]['search']['value']."%' ";
}
if( !empty($requestData['columns'][3]['search']['value']) ){
	$sql.=" AND na.correo LIKE '%".$requestData['columns'][3]['search']['value']."%' ";
}


$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 3");

$data = array();

$sql = "SELECT na.id, na.nombre, na.documento, na.telefono, na.correo
        FROM co_involucrado_natural na";
while( $row=mysqli_fetch_array($query) ) {
  // preparing an array
  $nestedData=array();

  $nestedData[] =  utf8_encode($row["nombre"]);
  $nestedData[] = utf8_encode($row["documento"]);
  $nestedData[] = utf8_encode($row["telefono"]);
  $nestedData[] = utf8_encode($row["correo"]);
  $nestedData[] = '<a class="select close-reveal-modal button tiny" codigo="' . $row["id"] . '" style="position: static; font-size: 1em; color: white; margin:0">Seleccionar</a>';

  $data[] = $nestedData;
}

$json_data = array(
  "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval( $totalData ),  // total number of records
  "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data   // total data array
);


echo json_encode($json_data);  // send data as json format
