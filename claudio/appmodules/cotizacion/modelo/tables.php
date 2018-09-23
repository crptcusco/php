<?php 
function get_tables_mensajes($in_co_id) {
    global $q;
    $q->fields = array(
        'id'=>''
        ,'usuario'=>''
        ,'fecha_creacion'=>''
        ,'fecha_proxima'=>''
        ,'estado'=>''
        ,'mensaje'=>''
    );
    $q->sql = '
    SELECT 
    me.id
    , us.full_name as "usuario"
    , DATE_FORMAT(me.info_create,"%d-%m-%Y")
    , DATE_FORMAT(me.fecha_proxima,"%d-%m-%Y")
    , es.nombre as "estado"
    , mensaje
    FROM co_mensaje me
    JOIN login_user us ON us.id = me.info_create_user
    JOIN co_estado es ON es.id=me.estado_id
    WHERE me.cotizacion_id=' . $in_co_id . '
    ORDER BY me.id DESC
    ';
    $q->data = NULL;
    $data = $q->exe();
    // echo '<h2>MySql</h2>';
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    return $data;
}
function get_tables_montos($in_co_id) {
    global $q;
    $q->fields = array(  'id'=>''
			 , 'cotizacion_id'=>''
			 , 'monto'=>''
			 , 'igv'=>''
			 , 'total'=>''
			 , 'simbolo'=>''
			 , 'cambio'=>''
			 , 'fecha'=>''
    		       );
    $q->sql = '
              SELECT
              	pa.id
              	, pa.cotizacion_id
              	, pa.monto
              	, pa.igv
              	, pa.total
                , mo.simbolo
                , pa.cambio
                , pa.fecha 
              FROM co_pago pa
              JOIN co_moneda mo ON mo.id=pa.moneda_id
              WHERE pa.cotizacion_id=' . $in_co_id . '

              ORDER BY pa.fecha,pa.id DESC
              ';
    $q->data = NULL;
    /* echo '<h2>MySql</h2>'; */
    /* echo '<pre>'; */
    /* print_r($q->sql); */
    /* echo '</pre>'; */
    $data = $q->exe();
    return $data;
}
function get_tables_td_involucrado($input) {
    global $q;
    $q->fields = array( 'id'=>''
			, 'rol_id'=>''
			, 'rol_nombre'=>''
			, 'persona_tipo'=>''
			, 'persona_id'=>''
			, 'contacto_id'=>''
			, 'persona_nombre'=>''
			, 'persona_documento'=>''
			, 'persona_telefono'=>''
			, 'persona_correo'=>''
			);
    $q->sql = '
SELECT * FROM
(
SELECT 
co_involucrado.id
, co_involucrado.rol_id
, co_involucrado_rol.nombre rol_nombre
, co_involucrado.persona_tipo
, co_involucrado.persona_id
, co_involucrado.contacto_id
, co_involucrado_natural.nombre persona_nombre
, co_involucrado_natural.documento persona_documento
, co_involucrado_natural.telefono persona_telefono
, co_involucrado_natural.correo persona_correo
FROM co_involucrado
JOIN co_involucrado_rol ON co_involucrado_rol.id=co_involucrado.rol_id
JOIN co_involucrado_natural on co_involucrado_natural.id= co_involucrado.persona_id
WHERE
    co_involucrado.cotizacion_id = ' . $input['cotizacion_id'] . '
AND co_involucrado.persona_tipo = "Natural"
AND co_involucrado.info_status = 1
UNION
SELECT 
co_involucrado.id
, co_involucrado.rol_id 
, co_involucrado_rol.nombre rol_nombre
, co_involucrado.persona_tipo
, co_involucrado.persona_id
, co_involucrado.contacto_id
, IF(co_involucrado.contacto_id=0
  , CONCAT( co_involucrado_juridica.nombre, "_--| _--| _--|")
  , CONCAT( co_involucrado_juridica.nombre, "_--|", co_involucrado_contacto.nombre, "_--|", co_involucrado_contacto.cargo, "_--|")
) persona_nombre
, co_involucrado_juridica.ruc persona_documento
, co_involucrado_contacto.telefono persona_documento
, co_involucrado_contacto.correo persona_documento
FROM co_involucrado
JOIN co_involucrado_rol ON co_involucrado_rol.id = co_involucrado.rol_id
JOIN co_involucrado_juridica ON co_involucrado_juridica.id = co_involucrado.persona_id
LEFT JOIN co_involucrado_contacto ON co_involucrado_contacto.id = co_involucrado.contacto_id
WHERE
    co_involucrado.cotizacion_id = ' . $input['cotizacion_id'] . '
AND co_involucrado.persona_tipo = "Juridica"
AND co_involucrado.info_status = 1
) AS unica01
ORDER BY 1
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_tables_trs_peritos_cargar($input) {
    global $q;
    $q->fields = array(  'id'=>''
		       , 'perito_id'=>''
		       , 'perito_nombre'=>''
		       , 'monto'=>''
		       , 'igv'=>''
		       , 'subtotal'=>''
		       , 'moneda_id'=>''
		       , 'moneda_simbolo'=>''
		       , 'moneda_cambio'=>''
    		       );
    $q->sql = '
               SELECT 
                    cp.id
                  , cp.perito_id
                  , pe.nombre "perito_nombre"
                  , cp.monto
                  , cp.igv 
                  , cp.total
                  , cp.moneda_id
                  , mo.simbolo "moneda_simbolo"
                  , cp.cambio
               FROM co_pago_has_perito cp
               LEFT JOIN co_pago pa ON pa.id=cp.pago_id
               LEFT JOIN co_perito pe ON pe.id=cp.perito_id
               LEFT JOIN co_moneda mo ON mo.id=cp.moneda_id
               WHERE pa.cotizacion_id= '. $input['cotizacion_id'] .' AND cp.info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_tables_trs_peritos_cambio($input) {
    global $q;
    $q->fields = array(  'cambio'=>'' );
    $q->sql = '
               SELECT total_cambio
               FROM co_pago
               WHERE cotizacion_id= '. $input['cotizacion_id'] .'
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0]['cambio'];
}
function get_tables_bienes($input) {
    global $q;
    $q->fields = array( 'codigos' => ''
			, 'contexto' => ''
			, 'valor' => ''
			, 'orden' => ''
    		       );
    $q->sql = '
SELECT unido.codigos, unido.contexto, unido.valor, unido.orden FROM (
SELECT    
   CONCAT(
   sca.categoria_id, "-",
   mu.sub_categoria_id, "-",
   mu.id, "-",
   mu.tipo_id, "-",
   mu.marca_id, "-",
   mu.modelo_id
   ) AS codigos,
   CONCAT(
   "", ca.nombre,
   "|---|-", sca.nombre,
   "|---|-", ti.nombre,
   "|---|-", ma.nombre,
   "|---|-", mo.nombre
   ) AS contexto,
   mu.descripcion AS valor,
   mu.orden
FROM co_bien_mueble mu
JOIN co_bien_sub_categoria sca ON sca.id=mu.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
JOIN co_bien_muebles_clasificacion ti ON ti.tipo_id=mu.tipo_id AND ti.marca_id=0 AND ti.modelo_id=0
JOIN co_bien_muebles_clasificacion ma ON ma.tipo_id=mu.tipo_id AND ma.marca_id=mu.marca_id AND ma.modelo_id=0
JOIN co_bien_muebles_clasificacion mo ON mo.tipo_id=mu.tipo_id AND mo.marca_id=mu.marca_id AND mo.modelo_id=mu.modelo_id
WHERE mu.info_status =1 AND mu.cotizacion_id=' . $input['cotizacion_id'] . '
UNION
SELECT     
   CONCAT(
   sca.categoria_id, "-",
   inm.sub_categoria_id, "-",
   inm.id, "-",
   inm.departamento_id, "-",
   inm.provincia_id, "-",
   inm.distrito_id
   ) AS codigos,
   CONCAT( 
   "", ca.nombre,
   "|---|-", sca.nombre,
   "|---|-", de.nombre,
   "|---|-", pr.nombre,
   "|---|-", di.nombre
   ) AS contexto, 
   CONCAT(
     "", inm.direccion
   , "|---|-", inm.descripcion
   ) as valor, 
   inm.orden
FROM co_bien_inmueble inm
JOIN co_bien_sub_categoria sca ON sca.id=inm.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
JOIN co_bien_inmuebles_ubigeo de ON de.departamento_id=inm.departamento_id AND de.provincia_id = 0 AND de.distrito_id = 0
JOIN co_bien_inmuebles_ubigeo pr ON pr.departamento_id=inm.departamento_id AND pr.provincia_id = inm.provincia_id AND pr.distrito_id = 0
JOIN co_bien_inmuebles_ubigeo di ON di.departamento_id=inm.departamento_id AND di.provincia_id = inm.provincia_id AND di.distrito_id = inm.distrito_id
WHERE inm.info_status =1 AND inm.cotizacion_id=' . $input['cotizacion_id'] . '
UNION
SELECT
   CONCAT(
   sca.categoria_id, "-",
   ma.sub_categoria_id, "-",
   ma.id
   ) AS codigo,
   CONCAT(
   ca.nombre
   ) AS contexto,
   CONCAT(
   ma.direccion,
   "|-|-|",
    ma.descripcion
   )as valor, 
   ma.orden	
FROM co_bien_mazivo ma
JOIN co_bien_sub_categoria sca ON sca.id=ma.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
WHERE ma.info_status = 1 AND ma.cotizacion_id = ' . $input['cotizacion_id'] . '
) AS unido
ORDER BY unido.orden ASC
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_tables_box_mensajes($in) {
    global $q;
    $q->fields = array( 'codigo' => ''
			, 'fecha' => ''
			, 'mensaje' => ''
			, 'estado' => ''
    		       );
    $q->sql = '
SELECT
  co_mensaje3.codigo
, DATE_FORMAT(co_mensaje3.fecha_proxima,"%d-%m-%Y") fecha
, co_mensaje3.mensaje
, co_mensaje3.estado
FROM ( 
       SELECT
       co_cotizacion.codigo
       , co_mensaje2.id
       , co_mensaje2.fecha_proxima
       , co_mensaje2.mensaje
       , co_estado.nombre estado
       FROM(
              SELECT
       	      co_mensaje.cotizacion_id
	    , co_mensaje.id
       	    , co_mensaje.mensaje
       	    , co_mensaje.fecha_proxima
       	    , co_mensaje.estado_id
       	    FROM co_mensaje
       	    WHERE co_mensaje.estado_id=1 AND co_mensaje.info_create_user = ' . $_SESSION['user_id'] . '
       	    ORDER BY co_mensaje.id DESC
       ) AS co_mensaje2
       JOIN co_cotizacion ON co_cotizacion.id=co_mensaje2.cotizacion_id AND co_cotizacion.estado_id=1
       JOIN co_estado ON co_estado.id = co_mensaje2.estado_id
       WHERE 
       co_cotizacion.codigo != "0"
       GROUP BY co_mensaje2.cotizacion_id
       ORDER BY co_mensaje2.fecha_proxima DESC
) as co_mensaje3
WHERE
    co_mensaje3.fecha_proxima >= "' . $in['ini'] . '"
AND co_mensaje3.fecha_proxima <= "' . $in['end'] . '"
              '
	;
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_tables_servicios($in) {
    global $q;
    $q->fields = array(
        'id'          => '',
        'descripcion' => '',
        'subtotal'    => '',
    );
    $q->sql = "
    SELECT id, descripcion, subtotal 
    FROM `co_servicio` WHERE
        cotizacion_id = '" . $in['cotizacion_id'] . "'
    AND info_status= '1'
    ";
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
