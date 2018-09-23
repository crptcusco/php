<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$cnn= new DBConnector_Alternative();
$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

session_start();

$sql_ini = '
SELECT  

 ju.nombre
, cl.nombre clasificacion_nombre
, ac.nombre actividad_nombre
, gr.nombre grupo_nombre
, ju.ruc
, ju.direccion
, ju.telefono
, ju.info_status
-- no ordenables
, ju.id
FROM co_involucrado_juridica ju
LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
';

$sql_donde = '
SELECT unido.id FROM (' . $sql_ini . ' ORDER BY ' . (intval($requestData['order'][0]['column'])+1) . ') unido
WHERE 1=1
';

$sql_ini = '
SELECT unido.* FROM (' . $sql_ini . ') unido
WHERE 1=1 
';

$sql = $sql_ini;
// echo $sql;
// getting total number records without any search
$query=mysqli_query($conn, $sql) or die("01");


$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;


$i = -1;
$sql_filter = '';
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND clasificacion_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND actividad_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value'])  . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND grupo_nombre LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND ruc LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND direccion LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND telefono LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND info_status = "' . intval($requestData['columns'][$i]['search']['value']) . '"';
}
++$i; // coordinaciones

$sql .= $sql_filter;
$sql_donde .= $sql_filter;
// print ($sql);

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' ) {    
    $query=mysqli_query($conn, $sql_donde) or die("02.5");
    $pagina = 0;
    while( $row=mysqli_fetch_array($query) ) {
        $pagina +=1;
        if ($requestData['search']['value'] == $row['id']) break;
    }
    if ($pagina > 1) {
        $pagina -=1;
    }
    $pagina = $pagina - ($pagina % $requestData['length']);

    $requestData['start'] = $pagina;
} else {
    $pagina = 0;
}

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");
// esto es para decir cuando no se puede $editar

$status = array(
    1 => 'Activo',
    0 => 'Desactivo',
);

$data = array();

while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    $nestedData[] = utf8_encode($row['nombre']);
    $nestedData[] = utf8_encode($row['clasificacion_nombre']);    
    $nestedData[] = utf8_encode($row['actividad_nombre']);
    $nestedData[] = utf8_encode($row['grupo_nombre']);
    $nestedData[] = utf8_encode($row['ruc']);
    $nestedData[] = utf8_encode($row['direccion']);
    $nestedData[] = utf8_encode($row['telefono']);
    $nestedData[] = $status[$row['info_status']];
    $nestedData[] = '<a class="editar" codigo="' . $row['id'] . '">Editar</a>';

    $data[] = $nestedData;
}


$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
    // , "pagina"          => $pagina
);

echo json_encode($json_data);  // send data as json format


