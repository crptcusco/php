<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

function imprimir_hora($in) {
    $ou = '';
    if ($in['hora_estimada_mostrar'] == '1') {
        $l  = explode('-', $in['hora_estimada']);
        $l1 = explode(':', $l[0]);
        $ou.= 'Desde ';
        $ou.= Utilidades::fechas_de_militar_a_meridiano(array(
            'hora'    => $l1[0]
            , 'minuto'=> $l1[1]
            , 'return'=> 'string'
        ));
        $ou.= ' Hasta ';
        $l2 = explode(':', $l[1]);
        $ou.= Utilidades::fechas_de_militar_a_meridiano(array(
            'hora'    => $l2[0]
            , 'minuto'=> $l2[1]
            , 'return'=> 'string'
        ));
    } elseif ($in['hora_real_mostrar'] == '1') {
        $l1 = explode(':', $in['hora_real']);
        $ou.= Utilidades::fechas_de_militar_a_meridiano(array(
            'hora'    => $l1[0]
            , 'minuto'=> $l1[1]
            , 'return'=> 'string'
        ));
    } 
    return $ou;
    
}
function imprimir_mensaje($in) {
    return sprintf( '<strong>%s:</strong> %s'
    , utf8_encode($in['observacion_user_nombre']) 
    , utf8_encode($in['observacion']) 
    );
}
function imprimir_direccion($in) {
    $ou = '';
    $ou.= utf8_encode($in['departamento_nombre']);
    if ($in['departamento_id']!=0) {
        $ou.= ' <span style="color:red">&#9658;</span> ';
    }
    $ou.= utf8_encode($in['provincia_nombre']);
    if ($in['provincia_id']!=0) {
        $ou.= ' <span style="color:red">&#9658;</span> ';
    }
    $ou.= utf8_encode($in['distrito_nombre']);
    $ou.= ' <span style="color:red">&#9658;</span> ';
    $ou.= utf8_encode($in['direccion']);
    return $ou;
}
function imprimir_fecha($fecha) {
    if ($fecha != '') {
        return substr($fecha, 0, 10);
    } else {
        return '';
    }
}
/* ********************************************************* */
$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$sql_columns= "
  coor.info_create
, coor.solicitante_fecha
, fvir.fecha virtual_fecha
, fimp.fecha impreso_fecha
, insp.fecha inspecion_fecha
, 'hora'
, esta.nombre estado_nombre
, moda.nombre modalidad_nombre
, tip2.nombre tipo2_nombre
, soli.nombre solicitante_persona_nombre
, clie.nombre cliente_persona_nombre
, dina.full_name coordinador_nombre 
, cons.full_name consultor_nombre
, peri.full_name perito_nombre
, 'ubigeo'
, insp.observacion
, dep.nombre departamento_nombre
, pro.nombre provincia_nombre
, dis.nombre distrito_nombre
, insp.direccion
, mens.full_name observacion_user_nombre
, coor.id
, insp.estado_id
, coor.codigo coordinacion_codigo
, CONCAT(co.codigo, '(', coor.cotizacion_correlativo, ')') cotizacion_coordinacion_codigo
, co.codigo cotizacion_codigo
, insp.departamento_id
, insp.provincia_id
, insp.distrito_id
, insp.hora_estimada 
, insp.hora_estimada_mostrar
, insp.hora_real
, insp.hora_real_mostrar
";
$sql_ini = "
SELECT * FROM (
-- 1
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN coor_informe_entrega fvir ON fvir.informe_id=info.id and fvir.tipo_id=2
LEFT JOIN coor_informe_entrega fimp ON fimp.informe_id=info.id and fimp.tipo_id=1
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
LEFT JOIN coor_inspeccion_estado esta ON esta.id=insp.estado_id
LEFT JOIN login_user mens ON mens.id=insp.observacion_user_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=insp.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=insp.departamento_id AND pro.provincia_id=insp.provincia_id AND pro.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=insp.departamento_id AND dis.provincia_id=insp.provincia_id AND dis.distrito_id=insp.distrito_id
WHERE coor.solicitante_persona_tipo='Juridica' AND coor.cliente_persona_tipo='Juridica'
  AND coor.estado_id=2 AND insp.estado_id!=1 AND coor.tipo_id!=3 AND info.estado_id=1
--
UNION
-- 2
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN coor_informe_entrega fvir ON fvir.informe_id=info.id and fvir.tipo_id=2
LEFT JOIN coor_informe_entrega fimp ON fimp.informe_id=info.id and fimp.tipo_id=1
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
LEFT JOIN coor_inspeccion_estado esta ON esta.id=insp.estado_id
LEFT JOIN login_user mens ON mens.id=insp.observacion_user_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=insp.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=insp.departamento_id AND pro.provincia_id=insp.provincia_id AND pro.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=insp.departamento_id AND dis.provincia_id=insp.provincia_id AND dis.distrito_id=insp.distrito_id
WHERE coor.solicitante_persona_tipo='Juridica' AND coor.cliente_persona_tipo='Natural'
  AND coor.estado_id=2 AND insp.estado_id!=1 AND coor.tipo_id!=3 AND info.estado_id=1
--
UNION
-- 3
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN coor_informe_entrega fvir ON fvir.informe_id=info.id and fvir.tipo_id=2
LEFT JOIN coor_informe_entrega fimp ON fimp.informe_id=info.id and fimp.tipo_id=1
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
LEFT JOIN coor_inspeccion_estado esta ON esta.id=insp.estado_id
LEFT JOIN login_user mens ON mens.id=insp.observacion_user_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=insp.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=insp.departamento_id AND pro.provincia_id=insp.provincia_id AND pro.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=insp.departamento_id AND dis.provincia_id=insp.provincia_id AND dis.distrito_id=insp.distrito_id
WHERE coor.solicitante_persona_tipo='Natural' AND coor.cliente_persona_tipo='Juridica'
  AND coor.estado_id=2 AND insp.estado_id!=1 AND coor.tipo_id!=3 AND info.estado_id=1
--
UNION
-- 4
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
LEFT JOIN coor_informe info ON info.coordinacion_id=coor.id
LEFT JOIN coor_inspeccion insp ON insp.informe_id=info.id
LEFT JOIN coor_informe_entrega fvir ON fvir.informe_id=info.id and fvir.tipo_id=2
LEFT JOIN coor_informe_entrega fimp ON fimp.informe_id=info.id and fimp.tipo_id=1
LEFT JOIN login_user cons ON cons.id=info.consultor_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
LEFT JOIN coor_inspeccion_estado esta ON esta.id=insp.estado_id
LEFT JOIN login_user mens ON mens.id=insp.observacion_user_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=insp.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=insp.departamento_id AND pro.provincia_id=insp.provincia_id AND pro.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=insp.departamento_id AND dis.provincia_id=insp.provincia_id AND dis.distrito_id=insp.distrito_id
WHERE coor.solicitante_persona_tipo='Natural' AND coor.cliente_persona_tipo='Natural'
  AND coor.estado_id=2 AND insp.estado_id!=1 AND coor.tipo_id!=3 AND info.estado_id=1
) unido WHERE 1=1
";

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

if( !empty($requestData['columns'][0]['search']['value']) ) {
    $sql.=' AND info_create LIKE "%'.$requestData['columns'][0]['search']['value'].'%"';
}
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql.=' AND solicitante_fecha  LIKE "%'.$requestData['columns'][1]['search']['value'].'%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql.=' AND virtual_fecha LIKE "%'.$requestData['columns'][2]['search']['value'].'%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql.=' AND impreso_fecha LIKE "%'.$requestData['columns'][3]['search']['value'].'%"';
}
if( !empty($requestData['columns'][4]['search']['value']) ) {
    $sql.=' AND inspecion_fecha LIKE "%'.$requestData['columns'][4]['search']['value'].'%"';
}
// 5
if( !empty($requestData['columns'][6]['search']['value']) &&
    $requestData['columns'][6]['search']['value']!='0' ) {
    $sql.=' AND estado_id LIKE "%'.$requestData['columns'][6]['search']['value'].'%"';
}
if( !empty($requestData['columns'][7]['search']['value']) ) {
    $sql.=' AND modalidad_nombre LIKE "%'.$requestData['columns'][7]['search']['value'].'%"';
}
if( !empty($requestData['columns'][8]['search']['value']) ) {
    $sql.=' AND tipo2_nombre LIKE "%'.$requestData['columns'][8]['search']['value'].'%"';
}
if( !empty($requestData['columns'][9]['search']['value']) ) {
    $sql.=' AND solicitante_persona_nombre LIKE "%'.$requestData['columns'][9]['search']['value'].'%"';
}
if( !empty($requestData['columns'][10]['search']['value']) ) {
    $sql.=' AND cliente_persona_nombre LIKE "%'.$requestData['columns'][10]['search']['value'].'%"';
}
if( !empty($requestData['columns'][11]['search']['value']) ) {
    $sql.=' AND coordinador_nombre LIKE "%'.$requestData['columns'][11]['search']['value'].'%"';
}
if( !empty($requestData['columns'][12]['search']['value']) ) {
    $sql.=' AND consultor_nombre LIKE "%'.$requestData['columns'][12]['search']['value'].'%"';
}
if( !empty($requestData['columns'][13]['search']['value']) ) {
    $sql.=' AND perito_nombre LIKE "%'.$requestData['columns'][13]['search']['value'].'%"';
}
// 14
// 15
if( !empty($requestData['columns'][16]['search']['value']) ) {
    $sql.=' AND cotizacion_coordinacion_codigo LIKE "%'.$requestData['columns'][16]['search']['value'].'%"';
}
/* ********** campos **********
   
 * ****************************
 */

$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    // preparing an array
    $nestedData = array();
    
    $nestedData[] = $row['info_create'];
    $nestedData[] = imprimir_fecha($row['solicitante_fecha']);
    $nestedData[] = imprimir_fecha($row['virtual_fecha']);
    $nestedData[] = imprimir_fecha($row['impreso_fecha']);
    $nestedData[] = imprimir_fecha($row['inspecion_fecha']);
    $nestedData[] = imprimir_hora($row);  
    $nestedData[] = utf8_encode($row['estado_nombre']);
    $nestedData[] = utf8_encode($row['modalidad_nombre']);
    $nestedData[] = utf8_encode($row['tipo2_nombre']);
    $nestedData[] = utf8_encode($row['solicitante_persona_nombre']);
    $nestedData[] = utf8_encode($row['cliente_persona_nombre']);
    $nestedData[] = utf8_encode($row['coordinador_nombre']);
    $nestedData[] = utf8_encode($row['consultor_nombre']);
    $nestedData[] = utf8_encode($row['perito_nombre']);
    $nestedData[] = imprimir_direccion($row);
    $nestedData[] = imprimir_mensaje($row);
    $nestedData[] = '<a href="./item.php?cotizacion=' . $row['cotizacion_codigo'] . '&coordinacion=' . $row['id'] . '&modo=edit" target="coordinacion_item">' . $row['cotizacion_coordinacion_codigo'] . '</a>';
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

