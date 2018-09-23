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
  0 =>'8', 
  1 =>'9',
  2 =>'3', 
  3 =>'5',
  4 =>'7',
);

// getting total number records without any search
$sql = "SELECT ju.id, ju.clasificacion_id, cl.nombre clasificacion_nombre, ju.actividad_id, 
        ac.nombre actividad_nombre, ju.grupo_id, gr.nombre grupo_nombre, ju.nombre, ju.ruc
        FROM co_involucrado_juridica ju
        LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
        LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
        LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id";

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = "SELECT ju.id, ju.clasificacion_id, cl.nombre clasificacion_nombre, ju.actividad_id, 
        ac.nombre actividad_nombre, ju.grupo_id, gr.nombre grupo_nombre, ju.nombre, ju.ruc
        FROM co_involucrado_juridica ju
        LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
        LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
        LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id WHERE 1=1 ";


// $requestData["codigo_cotizacion"];
if( !empty($requestData['columns'][0]['search']['value']) ){
	$sql.=" AND ju.nombre LIKE '%".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){
	$sql.=" AND ju.ruc LIKE '%".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){
	$sql.=" AND cl.nombre LIKE '%".$requestData['columns'][2]['search']['value']."%' ";
}
if( !empty($requestData['columns'][3]['search']['value']) ){
	$sql.=" AND ac.nombre LIKE '%".$requestData['columns'][3]['search']['value']."%' ";
}
if( !empty($requestData['columns'][4]['search']['value']) ){
	$sql.=" AND gr.nombre LIKE '%".$requestData['columns'][4]['search']['value']."%' ";
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
  $nestedData[] = utf8_encode($row["ruc"]);
  $nestedData[] = utf8_encode($row["clasificacion_nombre"]);
  $nestedData[] = utf8_encode($row["actividad_nombre"]);
  $nestedData[] = utf8_encode($row["grupo_nombre"]);
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
