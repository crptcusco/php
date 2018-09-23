<?php
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
function retornar_cliente_solicitante($cotizacion_id)
{
    global $conn;
    $out = array('cliente'=>'', 'solicitante'=>'');
    $sql = "
SELECT * FROM
(
SELECT d.nombre persona_nombre, i.persona_tipo, i.rol_id 
FROM co_involucrado i
JOIN co_involucrado_juridica d ON d.id=i.persona_id AND i.persona_tipo='Juridica'
WHERE i.cotizacion_id='" . $cotizacion_id . "'
UNION
SELECT d.nombre persona_nombre, i.persona_tipo, i.rol_id 
FROM co_involucrado i
JOIN co_involucrado_natural d ON d.id=i.persona_id AND i.persona_tipo='Natural'
WHERE i.cotizacion_id='" . $cotizacion_id . "'
) AS unido
ORDER BY 1
;
";
    $query=mysqli_query($conn, $sql) or die("ERROR retornar_cliente_solicitante");
    while( $row=mysqli_fetch_array($query) ) {
        if ( $row['rol_id'] == '1') {
            $out['cliente'].= '<li>'. utf8_encode($row['persona_nombre']) .'</li>';
        }elseif ( $row['rol_id'] == '2') {
            $out['solicitante'] .= '<li>'. utf8_encode($row['persona_nombre']) .'</li>';
        }
    }
    $out['cliente'] = '<ul>'. $out['cliente'] . '</ul>';
    $out['solicitante'] = '<ul>' . $out['solicitante'] . '</ul>';
    return $out;
}

// ------------------------------------------------ 00
$sql_columns_00 = "
  DISTINCT cot.id cotizacion_id
, cot.info_create
, cot.fecha_finalizacion
, tip.nombre servicio_tipo_nombre
, cor.full_name coordinador_nombre
, 'vacio1'
, 'vacio2'
, cot.codigo
-- sin orden
";
$sql_00 = "
SELECT * FROM (
SELECT " . $sql_columns_00 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio sss ON sss.cotizacion_id = cot.id
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
WHERE sss.info_status= '1' AND cot.codigo!=0 AND cot.estado_id=3
  AND NOT EXISTS (SELECT 1 FROM `coor_coordinacion_servicio` ddd where ddd.servicio_id = sss.id and ddd.info_status='1')
) unido WHERE 1=1
";

// ------------------------------------------------ 10
$sql_columns_10 = "cot.info_create
, cot.fecha_finalizacion
, tip.nombre servicio_tipo_nombre
, cor.full_name coordinador_nombre
, cli.nombre cliente_nombre
, 'vacio02'
, cot.codigo
-- sin orden
, cot.id cotizacion_id
";

$sql_10 = "
SELECT * FROM (
SELECT
" . $sql_columns_10 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Juridica'
JOIN co_involucrado_juridica cli ON cli.id=cli1.persona_id
WHERE cot.codigo!=0 
AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
UNION
SELECT
" . $sql_columns_10 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Natural'
JOIN co_involucrado_natural cli ON cli.id=cli1.persona_id
WHERE cot.codigo!=0 
AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
) unido WHERE 1=1
";

// ------------------------------------------------ 01
$sql_columns_01 = "cot.info_create
, cot.fecha_finalizacion
, tip.nombre servicio_tipo_nombre
, cor.full_name coordinador_nombre
, 'vacio01'
, sol.nombre solicitante_nombre
, cot.codigo
-- sin orden
, cot.id cotizacion_id
";
$sql_01 = "
SELECT * FROM (
SELECT
" . $sql_columns_01 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Juridica'
JOIN co_involucrado_juridica sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
UNION
SELECT
" . $sql_columns_01 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Natural'
JOIN co_involucrado_natural sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
-- AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
) unido WHERE 1=1
";

// ------------------------------------------------ 11
$sql_columns_11 = "cot.info_create
, cot.fecha_finalizacion
, tip.nombre servicio_tipo_nombre
, cor.full_name coordinador_nombre
, cli.nombre cliente_nombre
, sol.nombre solicitante_nombre
, cot.codigo
-- sin orden
, cot.id cotizacion_id
";
    $sql_11 = "
SELECT * FROM (
SELECT
" . $sql_columns_11 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Juridica'
JOIN co_involucrado_juridica cli ON cli.id=cli1.persona_id
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Juridica'
JOIN co_involucrado_juridica sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
UNION
SELECT
" . $sql_columns_11 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Juridica'
JOIN co_involucrado_juridica cli ON cli.id=cli1.persona_id
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Natural'
JOIN co_involucrado_natural sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
-- AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
UNION
SELECT
" . $sql_columns_11 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Natural'
JOIN co_involucrado_natural cli ON cli.id=cli1.persona_id
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Juridica'
JOIN co_involucrado_juridica sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
-- AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
UNION
SELECT
" . $sql_columns_11 . "
FROM co_cotizacion cot
LEFT JOIN co_servicio_tipo tip ON tip.id=cot.servicio_tipo_id
LEFT JOIN login_user cor ON cor.id=cot.info_create_user
JOIN co_involucrado cli1 ON cli1.cotizacion_id=cot.id AND cli1.rol_id=1 AND cli1.persona_tipo='Natural'
JOIN co_involucrado_natural cli ON cli.id=cli1.persona_id
JOIN co_involucrado sol1 ON sol1.cotizacion_id=cot.id AND sol1.rol_id=2 AND sol1.persona_tipo='Natural'
JOIN co_involucrado_natural sol ON sol.id=sol1.persona_id
WHERE cot.codigo!=0 
AND NOT EXISTS (SELECT 1 FROM coor_coordinacion tmp WHERE tmp.cotizacion_id=cot.id)
) unido WHERE 1=1
";