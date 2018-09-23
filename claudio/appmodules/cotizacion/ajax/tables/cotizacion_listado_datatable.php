<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

$cnn= new DBConnector_Alternative();
$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());


session_start();


$sql_ini = '
SELECT
  DISTINCT co.codigo
, st.nombre servicio_tipo
, lgu.full_name coordinador_nombre
, ve.nombre vendedor_nombre
, "vendedor_nombre_clds"
, "cliente_nombre_clds"
, pa.total_monto
, DATE_FORMAT(co.fecha_solicitud, "%d-%m-%Y") fecha_solicitud
, DATE_FORMAT(co.fecha_envio_cliente, "%d-%m-%Y") fecha_envio_cliente
, es.nombre estado_nombre
-- ocultos
, co_moneda.simbolo total_monto_moneda
, co.id cotizacion_id
, co.info_status
, co.servicio_tipo_id
, co.estado_id
, co.info_create_user coordinador_id
, co.vendedor_id
FROM co_cotizacion co

LEFT JOIN co_servicio_tipo st ON st.id=co.servicio_tipo_id 
LEFT JOIN co_pago pa ON pa.cotizacion_id=co.id
LEFT JOIN co_moneda ON co_moneda.id = pa.total_moneda_id
LEFT JOIN co_estado es ON es.id=co.estado_id
LEFT JOIN co_vendedor ve ON ve.id=co.vendedor_id
LEFT JOIN login_user lgu ON lgu.id=co.info_create_user

';

$sql_ini = '
SELECT unido.* FROM (' . $sql_ini . ') unido
WHERE info_status != 0 AND codigo!=0
';
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


// getting total number records without any search
$sql = $sql_ini;
// echo $sql;
$query=mysqli_query($conn, $sql) or die("01");


$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';

$i = -1;
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND codigo LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND servicio_tipo_id = "' . $requestData['columns'][$i]['search']['value'] . '"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND coordinador_id = "' . $requestData['columns'][$i]['search']['value'] . '"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND vendedor_id = "' . $requestData['columns'][$i]['search']['value'] . '"';
}

// ------------------------------------------------------- cliente y solicitante
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


if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND total_monto LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND fecha_solicitud LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND fecha_envio_cliente LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND estado_id LIKE "%' . Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']) . '%"';
}
++$i; // coordinaciones


$sql.= $sql_filter;
// print ($sql);

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";// print $sql;
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */


$query=mysqli_query($conn, $sql) or die("03");
// esto es para decir cuando no se puede $editar

$data = array();

while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    $tmp = null;
    $row['total_monto'] = sprintf('%s %.2f', $row['total_monto_moneda'], $row['total_monto']);
    if ($row['fecha_solicitud'] == '00-00-0000') $row['fecha_solicitud'] = '';
    if ($row['fecha_envio_cliente'] == '00-00-0000') $row['fecha_envio_cliente'] = '';
    $tmp['coordinacion'] = '';
    if ($row['estado_nombre'] == 'Aprobado')
    {
        $tmp['coordinacion'] = '
        <a href="../coordinacion/item.php?cotizacion=' . $row['codigo'] . '" 
           target="coordinacion_item" title="ver coordinaciones">
        Ver</a>';
    }
    $tmp['involucrado'] = get_involucrados($row['cotizacion_id']);
    
    $nestedData[] = '<a href="./editar.php?cotizacion=' . $row['codigo'] . '" 
                        target="cotizacion_item" title="ver cotización">' .
                  sprintf("%'010s", $row['codigo']) .'</a>';
    $nestedData[] = utf8_encode($row['servicio_tipo']);
    $nestedData[] = utf8_encode($row['coordinador_nombre']);
    $nestedData[] = utf8_encode($row['vendedor_nombre']);
    $nestedData[] = $tmp['involucrado']['cliente'];
    $nestedData[] = $tmp['involucrado']['solicitante'];
    $nestedData[] = utf8_encode($row['total_monto']);
    $nestedData[] = utf8_encode($row['fecha_solicitud']);
    $nestedData[] = utf8_encode($row['fecha_envio_cliente']);
    $nestedData[] = utf8_encode($row['estado_nombre']);
    $nestedData[] = $tmp['coordinacion'];

    $data[] = $nestedData;
}


$json_data = array(
    "draw"              => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format


function search_involucrados($nom)
{
    global $conn;
    $ou = '';
    
    $sql = '
    SELECT DISTINCT cotizacion_id FROM  (
    SELECT i.cotizacion_id FROM `co_involucrado` i 
    JOIN co_involucrado_juridica d ON d.id = i.persona_id
    WHERE ' . $nom . ' AND persona_tipo = "Juridica"
    UNION
    SELECT i.cotizacion_id FROM `co_involucrado` i
    JOIN co_involucrado_natural d ON d.id = i.persona_id
    WHERE ' . $nom . ' AND persona_tipo = "Natural"
    ) unido
    ';
    // print($sql);
    $query=mysqli_query($conn, $sql) or die("error search involucrado");
    while( $row=mysqli_fetch_array($query) )
    {
        if ($ou != '') $ou .= ', '; 
        $ou .= $row['cotizacion_id'];
    }
    return $ou;
}
function get_involucrados($id)
{
    global $conn;
    $ou['cliente'] = '';
    $ou['solicitante'] = '';
    $sql = '
    SELECT i.rol_id, d.nombre, d.telefono FROM `co_involucrado` i
    LEFT JOIN co_involucrado_juridica d ON d.id = i.persona_id
    WHERE i.cotizacion_id = ' . $id . ' AND i.info_status = 1 AND i.persona_tipo = "Juridica"
    UNION
    SELECT i.rol_id, d.nombre, d.telefono FROM `co_involucrado` i
    LEFT JOIN co_involucrado_natural d ON d.id = i.persona_id
    WHERE i.cotizacion_id = ' . $id . ' and i.info_status = 1 AND i.persona_tipo = "Natural"
    ';
    // print($sql);
    $query=mysqli_query($conn, $sql) or die("error involucrado");
    while( $row=mysqli_fetch_array($query) )
    {
        if ( '' != trim($row['telefono'])) {
            $row['telefono'] = ' <br> <strong>Teléfonos:</strong> ' . $row['telefono'] ;
        }
        
        if($row['rol_id'] == '1')
            $ou['cliente'] .= '<li>' . utf8_decode(strtoupper($row['nombre'])) . $row['telefono'] . '</li>';
        if($row['rol_id'] == '2')
            $ou['solicitante'] .= '<li>' . utf8_decode( strtoupper($row['nombre'])) . $row['telefono'] . '</li>';
    }
    $ou['cliente'] = '<ul class="no-margin">' . $ou['cliente'] . '</ul>';
    $ou['solicitante'] = '<ul class="no-margin">' . $ou['solicitante'] . '</ul>';
    return $ou;
}