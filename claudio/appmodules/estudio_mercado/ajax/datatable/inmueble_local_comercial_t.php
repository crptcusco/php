<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";
include "./inmueble_config.php";

$requestData = $_REQUEST;
$i = -1;
$sql_filter = '';


$cnn= new DBConnector_Alternative02();
$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

session_start();

$cols = columnas('local_comercial_t');

$sql_where = '';
if(!empty($requestData['columns'][++$i]['search']['value'])) {
    $sql_where = where($requestData['columns'][$i]['search']['value'], 't');
}

$sql_ini = '
SELECT 
  dc.nombre cliente
, dp.nombre propietario
, ds.nombre solicitante
, ubicacion
, tasacion_fecha
, zonificacion
, piso_cantidad nro_pisos
, dvl.nombre vista_local
, terreno_area
, terreno_valorunitario
, edificacion_area
, valor_comercial
, valor_ocupada
, ruta_informe
FROM t_local_comercial
LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id
LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id
LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id
LEFT JOIN diccionario_vista_local dvl ON dvl.id=vista_local_id 
' . $sql_where;

$sql_ini = '
SELECT unido.* FROM (' . $sql_ini . ') unido
WHERE 1=1 
';


$sql = $sql_ini;
$query=mysqli_query($conn, $sql) or die($sql);


$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

foreach($cols as $row)
{
    if( !empty($requestData['columns'][++$i]['search']['value']) ) {
        $sql_filter.=' AND ' . $row['name'] . ' LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
    }
}

$sql.= $sql_filter;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query);

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;

$query=mysqli_query($conn, $sql) or die("03");

$data = array();

while( $row=mysqli_fetch_array($query) ) {
    $data[] = imprimir($cols, $row);
}

$json_data = array(
    "draw"              => intval($requestData['draw'])
    , "recordsTotal"    => intval($totalData)
    , "recordsFiltered" => intval($totalFiltered)
    , "data"            => $data
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
