<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

if( $requestData['inspeccion_id'] == '' ) {
    $requestData['inspeccion_id'] = '0';
}
$sql_ini = '
SELECT obs.id, obs.info_create fecha, obs.user_id, u.full_name user_nombre, obs.observacion
FROM coor_inspeccion_observacion obs
JOIN login_user u ON u.id=obs.user_id
WHERE obs.inspeccion_id=' . $requestData['inspeccion_id'] . ' AND obs.info_status=1
';

// echo $sql_ini;
$columns = array(
  0 => '2'
  , 1 => '4'
  , 2 => '5'
);

// getting total number records without any search
$sql = $sql_ini;

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;
/* if( !empty($requestData['columns'][0]['search']['value']) ){   //correlativo */
/* 	$sql.=" AND coor.cotizacion_correlativo LIKE '".$requestData['columns'][0]['search']['value']."%' "; */
/* } */

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 2");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 3");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    // preparing an array
    //  obs.id, obs.info_create fecha, obs.user_id, u.full_name user_nombre, obs.observacion
    $f = Utilidades::fechas_de_MysqlTimeStamp_a_array($row['fecha']);
    $h = Utilidades::fechas_de_militar_a_meridiano(array(
        'hora'  => $f['hora']
      , 'minuto'=> $f['minuto']
      , 'return'=> 'string'
    ));
    $row['fecha'] = $f['dia'] . '-' . $f['mes'] . '-' . $f['anio'] . ' ';
    $row['fecha'].= $h;
    $nestedData = array();
    $nestedData[] = $row['fecha'];
    $nestedData[] = utf8_encode($row['user_nombre']);
    $nestedData[] = utf8_encode($row['observacion']);
  $data[] = $nestedData;
}


$json_data = array(
  "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
  "recordsTotal"    => intval( $totalData ),  // total number of records
  "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
  "data"            => $data,   // total data array
  "sql" => $sql,
);

echo json_encode($json_data);  // send data as json format
