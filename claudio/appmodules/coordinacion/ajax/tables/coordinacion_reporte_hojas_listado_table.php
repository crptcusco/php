<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

function prefix($name) {
    global $group;
    return $group . '_field_' . $name;
}
$group = 'coor_reporte_coordinacion_hojas';

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$sql_columns= "
  coor.info_update
, soli.nombre solicitante_persona_nombre
, clie.nombre cliente_persona_nombre
, dina.full_name coordinador_nombre
, cons.full_name consultor_nombre
, peri.full_name perito_nombre
, coor.impreso entregado
, coor.cotizacion_correlativo cotizacion_codigo
-- sin orden
, coor.id
, insp.id inspeccion_id
, co.codigo cotizacion_codigo_simple
";


$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
-- 1
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
WHERE coor.solicitante_persona_tipo='Juridica' AND coor.cliente_persona_tipo='Juridica'
  AND coor.estado_id!=1 AND insp.estado_id=1 AND info.estado_id=1
--
UNION
-- 2
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
WHERE coor.solicitante_persona_tipo='Juridica' AND coor.cliente_persona_tipo='Natural'
  AND coor.estado_id!=1 AND insp.estado_id=1 AND info.estado_id=1
--
UNION
-- 3
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
WHERE coor.solicitante_persona_tipo='Natural' AND coor.cliente_persona_tipo='Juridica'
  AND coor.estado_id!=1 AND insp.estado_id=1 AND info.estado_id=1
--
UNION
-- 4
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
WHERE coor.solicitante_persona_tipo='Natural' AND coor.cliente_persona_tipo='Natural'
  AND coor.estado_id!=1 AND insp.estado_id=1 AND info.estado_id=1
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";

$entregado = array (0=>'No', 1=>'Si');

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array();
for ($i=1; $i<=20; $i++) {
    $columns[$i-1] = $i;
}

// getting total number records without any search
$sql = $sql_ini;

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
if( !empty($requestData['columns'][0]['search']['value']) ) {
    $sql_filter.=' AND info_create LIKE "%'.$requestData['columns'][0]['search']['value'].'%"';
}
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND solicitante_persona_nombre LIKE "%'.$requestData['columns'][1]['search']['value'].'%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND cliente_persona_nombre LIKE "%'.$requestData['columns'][2]['search']['value'].'%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND coordinador_nombre LIKE "%'.$requestData['columns'][3]['search']['value'].'%"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql_filter.=' AND consultor_nombre LIKE "%'.$requestData['columns'][4]['search']['value'].'%"';
}
if( !empty($requestData['columns'][5]['search']['value']) ) {
    $sql_filter.=' AND perito_nombre LIKE "%'.$requestData['columns'][5]['search']['value'].'%"';
}
// 6
if( !empty($requestData['columns'][7]['search']['value']) && $requestData['columns'][7]['search']['value'] != '-' ) {
    $sql_filter.=' AND entregado = "'.$requestData['columns'][7]['search']['value'].'"';
}
if( !empty($requestData['columns'][8]['search']['value']) ) {
    $sql_filter.=' AND cotizacion_codigo = "%'.$requestData['columns'][8]['search']['value'].'%"';
}

$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
    // esto es para recuperar la pagina (es muy importante)
    $sql_donde.= 'SELECT * FROM (' . $sql;
    $sql_donde.= ' ORDER BY '. $columns[$requestData['order'][0]['column']] . ' ' . $requestData['order'][0]['dir'];
    $sql_donde.= ') unido2 WHERE id=' . intval($requestData['search']['value']) ;
    $query=mysqli_query($conn, $sql_donde) or die("employee-grid-data.php: get employees 01.5");
    while( $row=mysqli_fetch_array($query) ) $pagina = $row['row_num'];
    $pagina -= 1;
    if ($pagina > 0) {
        $pagina-= ($pagina % $requestData['length']);
        if ($pagina > 0) {
            $pagina /= $requestData['length'];
        }        
    }
    $pagina *= $requestData['length'];
}



$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
if ($pagina != '')
    $requestData['start'] = $pagina;
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = $row['info_update'];
    $nestedData[] = utf8_encode($row['solicitante_persona_nombre']);
    $nestedData[] = utf8_encode($row['cliente_persona_nombre']);
    $nestedData[] = utf8_encode($row['coordinador_nombre']);
    $nestedData[] = utf8_encode($row['consultor_nombre']);
    $nestedData[] = utf8_encode($row['perito_nombre']);
    $nestedData[] = '<a class="info label round hoja" data-reveal-id="' . prefix('modal_preview') . '" coordinacion_id="'. $row['id'] .'" style="margin:0">Ver Hoja</a>';
    $nestedData[] = $entregado[$row['entregado']];
    $nestedData[] = '<a href="./item.php?cotizacion=' . $row['cotizacion_codigo_simple'] . '&coordinacion=' . $row['id'] . '&modo=edit" target="coordinacion_item">' . $row['cotizacion_codigo'] . '</a>';

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

