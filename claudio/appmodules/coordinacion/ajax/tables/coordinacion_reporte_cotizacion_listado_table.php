<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";
$cnn= new DBConnector_Alternative();
include "./coordinacion_reporte_cotizacion_listado_table_lib.php";

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array();
for ($i=1; $i<=20; $i++) {
    $columns[$i-1] = $i;
}

// getting total number records without any search
$sql = $sql_00;

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_00;
$sql_filter = '';
$i = -1;
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND info_create LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND fecha_finalizacion LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND servicio_tipo_nombre LIKE "%'. utf8_encode($requestData['columns'][$i]['search']['value']).'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND coordinador_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}

// ----------------  solicitante cliente
$tmp1 = '(';
$tmp2 = '(';
if( !empty($requestData['columns'][++$i]['search']['value'])) {
    $tmp1 .= ' d.nombre LIKE "%'. Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
    $tmp2 .= ' i.rol_id = 1'; 
}
if( !empty($requestData['columns'][$i]['search']['value']) &&
    !empty($requestData['columns'][$i+1]['search']['value'])) {
    $tmp1 .= ' OR';
    $tmp2 .= ' OR';
}
if( !empty($requestData['columns'][++$i]['search']['value'])) {
    $tmp1 .= ' d.nombre LIKE "%'. Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
    $tmp2 .= ' i.rol_id = 2';
}
$tmp1 .= ')';
$tmp2 .= ')';

if( !empty($requestData['columns'][$i-1]['search']['value']) || 
    !empty($requestData['columns'][$i]['search']['value'])) {
    $tmp = search_involucrados($tmp1 . ' AND ' . $tmp2);
    // var_dump($tmp);
    if ('' == trim($tmp))
        $tmp = '0';
    $sql_filter.=' AND cotizacion_id in (' . $tmp . ')';
}
// -------------------------

if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND codigo LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}

$sql .= $sql_filter;

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column'] + 1 ]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 03");

$data = array();
$old = '';
while( $row=mysqli_fetch_array($query) ) {

    $tmp = retornar_cliente_solicitante($row['cotizacion_id']);
        
    $nestedData = array();   
    $nestedData[] = $row['info_create'];
    $nestedData[] = substr($row['fecha_finalizacion'], 0, 10);
    $nestedData[] = utf8_encode($row['servicio_tipo_nombre']);
    $nestedData[] = utf8_encode($row['coordinador_nombre']);
        
    $nestedData[] = $tmp['cliente'];
    $nestedData[] = $tmp['solicitante'];
    $nestedData[] = '<a href="./item.php?cotizacion=' . $row['codigo'] . '" target="coordinacion_item">' . $row['codigo'] . '</a>';
    $data[] = $nestedData;

}


$json_data = array(
    "draw"            => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format

