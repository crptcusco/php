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
  0 =>'1', 
  1 => '2'
);

if ( $requestData["codigo_cotizacion"] == Null ) {
    $requestData["codigo_cotizacion"] = 0;
}

// getting total number records without any search
$sql = '
SELECT 
coor.cotizacion_correlativo, 
esta.nombre estado_nombre,
coor.codigo, 
coor.id
FROM coor_coordinacion coor 
LEFT JOIN co_cotizacion coti ON coti.id=coor.cotizacion_id 
LEFT JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
WHERE coti.codigo=' . $requestData["codigo_cotizacion"] . '
';

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.



$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
  // preparing an array
  $nestedData=array();
  if ($row["codigo"] == 0) {
      $row["codigo"] = 'No';
  }
  $style='';
  if (isset($requestData['coordinacion_id']) and $requestData['coordinacion_id'] == $row["id"]) {
      $style = 'style="color:black" ';
  }
  $nestedData[] = '<a title="ver" href="./item.php?cotizacion=' . $requestData['codigo_cotizacion'] . '&startDataTable=' . $requestData['start'] . '&coordinacion=' . $row["id"] . '&modo=view" ' . $style . '  >' .  $row["cotizacion_correlativo"]. '</a>' ;
  $nestedData[] = substr(utf8_encode($row["estado_nombre"]), 0, 8) . '...';
  $data[] = $nestedData;
}


$json_data = array(
  "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval( $totalData ),  // total number of records
  "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

