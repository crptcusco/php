<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/utilidades.php";

function prefix($name) {
    global $group;
    return $group . '_field_' . $name;
}
$group = 'coor_reporte_coordinacion_coordinacion';

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$sql_columns= "
  coor.cotizacion_correlativo coordinacion_codigo
, esta.nombre estado_nombre
, 'solicitante'
, 'cliente'
, peri.full_name perito_nombre
, tip2.nombre tipo2_nombre
, 'ubicacion'
, IF( coor.solicitante_fecha = '0000-00-00 00:00:00', '', DATE_FORMAT(coor.solicitante_fecha ,'%Y-%m-%d')) solicitante_fecha 
, IF(insp.fecha = '0000-00-00 00:00:00', '', DATE_FORMAT(insp.fecha,'%Y-%m-%d')) inspeccion_fecha
, 'inspecion-hora-clds'
, IF(coor.entrega_al_cliente_fecha = '0000-00-00 00:00:00', '', DATE_FORMAT(coor.entrega_al_cliente_fecha,'%Y-%m-%d')) entrega_al_cliente_fecha
, IF(coor.entrega_por_operaciones_fecha = '0000-00-00 00:00:00', '', DATE_FORMAT(coor.entrega_por_operaciones_fecha,'%Y-%m-%d')) entrega_por_operaciones
, coor.observacion
, cont.full_name control_nombre
, dina.full_name coordinador_nombre
, 'ultima observacion'
, 'inspeccion_modal'
, tip.nombre tipo_nombre
, moda.nombre modalidad_nombre
, co.codigo cotizacion_codigo
-- sin orden
, coor.id
, coor.estado_id
, coor.modalidad_id
, coor.tipo_id
, coor.solicitante_persona_tipo
, coor.solicitante_persona_id
, coor.cliente_persona_tipo
, coor.cliente_persona_id
, coor.coordinador_id
, insp.id inspeccion_id
, insp.hora_estimada
, insp.hora_estimada_mostrar
, insp.hora_real
, insp.hora_real_mostrar

, insp.departamento_id
, depa.nombre departamento_nombre
, insp.provincia_id
, prov.nombre provincia_nombre
, insp.distrito_id
, dist.nombre distrito_nombre
";


$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
SELECT
" . $sql_columns . "
FROM coor_coordinacion coor
LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
LEFT JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN coor_coordinacion_tipo tip ON tip.id=coor.tipo_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id

LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
LEFT JOIN coor_inspeccion insp ON insp.coordinacion_id=coor.id
LEFT JOIN login_user cont ON cont.id=insp.inspector_id
LEFT JOIN login_user peri ON peri.id=insp.perito_id
LEFT JOIN co_bien_inmuebles_ubigeo depa ON 
          depa.departamento_id=insp.departamento_id and 
          depa.provincia_id=0 and 
          depa.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo prov ON 
          prov.departamento_id=insp.departamento_id and
          prov.provincia_id=insp.provincia_id and 
          prov.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dist ON 
          dist.departamento_id=insp.departamento_id and
          dist.provincia_id=insp.provincia_id and 
          dist.distrito_id=insp.distrito_id
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array();
for ($i=1; $i<=23; $i++) {
    $columns[$i-1] = $i;
}

// getting total number records without any search
$sql = $sql_ini;

// print $sql;
$query=mysqli_query($conn, $sql) or die("ERROR 01 ". $sql);

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
$i = -1;
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND coordinacion_codigo LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) &&
    $requestData['columns'][2]['search']['value']!='0' ) {
    $sql_filter.=' AND estado_id LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
// ----------------  solicitante cliente
$tmp0 = '';
$tmp1 = null;
$tmp2 = null;
if( !empty($requestData['columns'][++$i]['search']['value'])) {
    $tmp1 = Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']);
}
if( !empty($requestData['columns'][++$i]['search']['value'])) {
    $tmp2 = Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']);
}

if( !empty($requestData['columns'][$i-1]['search']['value']) || 
    !empty($requestData['columns'][$i]['search']['value'])) {
    $tmp0 = search_involucrados($tmp1, $tmp2);
    // var_dump($tmp);
    if ('' == trim($tmp0))
        $tmp0 = '0';
    $sql_filter.=' AND id in (' . $tmp0 . ')';
}
// -------------------------

if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND perito_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND tipo2_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}

if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $tmp = Utilidades::sanear_complete_string($requestData['columns'][$i]['search']['value']);
    
    $sql_filter.= 'AND (';
    $sql_filter.='    departamento_nombre LIKE "%'.$tmp.'%"';
    $sql_filter.=' OR provincia_nombre LIKE "%'.$tmp.'%"';
    $sql_filter.=' OR distrito_nombre LIKE "%'.$tmp.'%"';
    $sql_filter.= ')';
    
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND solicitante_fecha  LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND inspeccion_fecha LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
++$i; // hora
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND entrega_al_cliente_fecha LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND entrega_por_operaciones LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
++$i; // observacion
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND control_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND coordinador_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
++$i; // ultima observacion
++$i; // funciones
if( !empty($requestData['columns'][++$i]['search']['value']) &&
    $requestData['columns'][8]['search']['value']!='0' ) {
    $sql_filter.=' AND tipo_id LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND modalidad_nombre LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
}
if( !empty($requestData['columns'][++$i]['search']['value']) ) {
    $sql_filter.=' AND cotizacion_codigo LIKE "%'.$requestData['columns'][$i]['search']['value'].'%"';
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



$query=mysqli_query($conn, $sql) or die("error 02: ". $sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
if ($pagina != '')
    $requestData['start'] = $pagina;
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees 03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $tmp = get_involucrados($row['id']);
    $mensaje = ultima_incidencia($row['id']);
    $hora = imprimir_hora($row);

    $nestedData = array();
    $nestedData[] = '<a href="./item.php?cotizacion=' . $row['cotizacion_codigo'] . '&coordinacion=' . $row['id'] . '&modo=edit" target="coordinacion_item"><center>' . $row['coordinacion_codigo'] . '</center></a>';
    $nestedData[] = utf8_encode($row['estado_nombre']) ;
    $nestedData[] = utf8_encode($tmp['solicitante']);
    $nestedData[] = utf8_encode($tmp['cliente']);
    $nestedData[] = utf8_encode($row['perito_nombre']);
    $nestedData[] = utf8_encode($row['tipo2_nombre']);
    $nestedData[] = utf8_encode(
        $row['distrito_nombre'] . '<br> <span style="color:red"> -> </span>'.
        $row['provincia_nombre'] . '<br><span style="color:red"> -> </span>'.
        $row['departamento_nombre'] 
    );
    $nestedData[] = $row['solicitante_fecha'];
    $nestedData[] = $row['inspeccion_fecha'];
    $nestedData[] = $hora;
    $nestedData[] = $row['entrega_al_cliente_fecha'];
    $nestedData[] = $row['entrega_por_operaciones'];
    $nestedData[] = utf8_encode($row['observacion']);
    $nestedData[] = utf8_encode($row['control_nombre']);
    $nestedData[] = utf8_encode($row['coordinador_nombre']);

    $nestedData[] = utf8_encode($mensaje);
    $nestedData[] = '<a class="info label round hoja" data-reveal-id="' . prefix('modal_preview') . '" coordinacion_id="'. $row['id'] .'" style="margin:0">Ver Hoja</a>';
    $nestedData[] = utf8_encode($row['tipo_nombre']); // formato
    $nestedData[] = utf8_encode($row['modalidad_nombre']);// formato
    $nestedData[] = $row['cotizacion_codigo'];
    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
    , "tmp" => $tmp0
);

echo json_encode($json_data);  // send data as json format


function search_involucrados($sol, $cli)
{
    global $conn;
    $ou = '';

    $sql_sol= '';
    if ($sol)
        $sql_sol = '
        SELECT c.id FROM `coor_coordinacion` c
        JOIN co_involucrado_juridica d ON d.id=c.solicitante_persona_id AND c.solicitante_persona_tipo="Juridica"
        WHERE d.nombre LIKE "%' . $sol . '%"
        UNION
        SELECT c.id FROM `coor_coordinacion` c
        JOIN co_involucrado_natural d  ON d.id=c.solicitante_persona_id AND c.solicitante_persona_tipo="Natural"
        WHERE d.nombre LIKE "%' . $sol . '%"
        ';

    $sql_cli= '';
    if ($cli)
        $sql_cli = '
        SELECT c.id FROM `coor_coordinacion` c
        JOIN co_involucrado_juridica d ON d.id=c.cliente_persona_id AND c.cliente_persona_tipo="Juridica"
        WHERE d.nombre LIKE "%' . $cli . '%"
        UNION
        SELECT c.id FROM `coor_coordinacion` c
        JOIN co_involucrado_natural d  ON d.id=c.cliente_persona_id AND c.cliente_persona_tipo="Natural"
        WHERE d.nombre LIKE "%' . $cli . '%"
        ';

    $sql_u= '';
    if ($sol and $cli)
        $sql_u= ' UNION ';

    $sql = '
    SELECT DISTINCT id FROM (' . $sql_sol . $sql_u . $sql_cli .') AS unido ORDER BY 1
    ';
    // print($sql);
    $query=mysqli_query($conn, $sql) or die("error search involucrado");
    while( $row=mysqli_fetch_array($query) )
    {
        if ($ou != '') $ou .= ', '; 
        $ou .= $row['id'];
    }
    return $ou;
}

function get_involucrados($id)
{
    global $conn;
    $out = array('cliente'=>'', 'solicitante'=>'');
    $sql = "
    SELECT d.nombre, 'solicitantante' as 'rol'  FROM `coor_coordinacion` c
    JOIN co_involucrado_juridica d ON d.id=c.solicitante_persona_id AND c.solicitante_persona_tipo='Juridica'
    WHERE c.id = " . $id . "
    UNION
    SELECT d.nombre, 'solicitantante' as 'rol' FROM `coor_coordinacion` c
    JOIN co_involucrado_natural d  ON d.id=c.solicitante_persona_id AND c.solicitante_persona_tipo='Natural'
    WHERE c.id = " . $id . "
    UNION
    SELECT d.nombre, 'cliente' as 'rol' FROM `coor_coordinacion` c
    JOIN co_involucrado_juridica d ON d.id=c.cliente_persona_id AND c.cliente_persona_tipo='Juridica'
    WHERE c.id = " . $id . "
    UNION
    SELECT d.nombre, 'cliente' as 'rol' FROM `coor_coordinacion` c
    JOIN co_involucrado_natural d  ON d.id=c.cliente_persona_id AND c.cliente_persona_tipo='Natural'
    WHERE c.id = " . $id . "
    ";
    $query=mysqli_query($conn, $sql) or die("ERROR retornar_cliente_solicitante");
    while( $row=mysqli_fetch_array($query) ) {
        if ( $row['rol'] == 'cliente') {
            $out['cliente'].= '<li>'. utf8_encode($row['nombre']) .'</li>';
        }elseif ( $row['rol'] == 'solicitantante') {
            $out['solicitante'] .= '<li>'. utf8_encode($row['nombre']) .'</li>';
        }
    }
    $out['cliente'] = '<ul>'. $out['cliente'] . '</ul>';
    $out['solicitante'] = '<ul>' . $out['solicitante'] . '</ul>';
    return $out;
}
function imprimir_hora($in)
{
        // hora aproximada
        $h = explode("-", $in['hora_estimada']);
        $h1 = explode(":",$h[0]);
        $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
        $h2 = explode(":",$h[1]);
        $h2 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h2[0], 'minuto'=>(int)$h2[1], 'return'=>'array'));
        $in['hora_estimada_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
        $in['hora_estimada_str'].= ' ';
        $in['hora_estimada_str'].= sprintf("%02d:%02d %s" , $h2['hora'] , $h2['minuto'], $h2['meridiano']);
        if ($in['hora_estimada_mostrar']=='0') {
            $in['hora_estimada_str']='<strong>Exacta</strong><br>';
        } else {
            $in['hora_estimada_str'] = '<strong>Entre</strong><br>' . $in['hora_estimada_str'];
        }
        $in['hora_estimada_ini'] = $h1;
        $in['hora_estimada_end'] = $h2;
        // hora exacta
        $h1 = explode(":", $in['hora_real']);
        $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
        $in['hora_real'] = $h1;
        $in['hora_real_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
        if ($in['hora_real_mostrar'] == '0') {
            $in['hora_real_str'] = '';
        } else {
            $in['hora_real_str'] = $in['hora_real_str'];
        }
        return $in['hora_estimada_str'] . $in['hora_real_str'];
}
function ultima_incidencia($id)
{
    global $conn;
    $out = '';
    $sql = '
    SELECT obs.id, 
           IF( obs.info_create = "0000-00-00 00:00:00", "", DATE_FORMAT(obs.info_create ,"%Y-%m-%d")) fecha, 
           obs.user_id, 
           u.full_name user_nombre, 
           obs.observacion observ
    FROM coor_inspeccion_observacion obs
    JOIN login_user u ON u.id=obs.user_id
    WHERE obs.inspeccion_id=' . $id . ' AND obs.info_status=1
    ORDER BY 1 DESC
    LIMIT 1
    ';
    $query = mysqli_query($conn, $sql) or die("ERROR ultimo menza");
    $out = mysqli_fetch_array($query);
    return $out['observ'] . '<br>' . $out['user_nombre'] . '<br>' . $out['fecha'] ;
}