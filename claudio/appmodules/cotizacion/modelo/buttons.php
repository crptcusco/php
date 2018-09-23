<?php 

function set_buttons_mensaje($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
              SELECT co_mensaje_nuevo(
                    ' . $input['co_id'] . '
                  , ' . $input['estado_cotizacion'] . '
                  , "' . $input['texto'] . '"
                  , "' . $input['fecha'] . '"
                  , "' . $input['proxima'] . '"
                  , ' . $_SESSION['user_id'] . '
                  ) AS id
              ';
    $data = $q->exe();

    $q->data = NULL;
    $q->fields = array(
                          'id' => '' 
		        , 'usuario' => ''
    			, 'fecha'=>''
    			, 'estado'=>''
			, 'mensaje'=>''
    		       );
    $q->sql = '
              SELECT 
                       me.id
                     , us.full_name as "usuario"
                     , me.fecha_proxima as "fecha"
                     , es.nombre as "estado"
                     , me.mensaje
              FROM co_mensaje me
              JOIN login_user us ON us.id = me.info_create_user
              JOIN co_estado es ON es.id=me.estado_id
              WHERE me.id=' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    // echo '<h2>MySql</h2>';
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    return $data[0];
}
function set_buttons_montos($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('moneda_id' => '', 'cambio' => '');
    $q->sql = '
    SELECT total_moneda_id, total_cambio FROM co_pago 
    WHERE cotizacion_id = ' . $input['cotizacion_id'] . '
    ';
    
    // print $q->sql . '<br>';
    $data = $q->exe();
    $input['cambio'] = floatval($input['cambio']);
    $data[0]['cambio'] = floatval($data[0]['cambio']);
    // var_dump($data);
    // print '<br>';
    // var_dump(array('moneda_id' => $input['moneda_id'], 'cambio' => $input['cambio']));
    if ($data[0]['moneda_id'] == $input['moneda_id'] && $data[0]['cambio'] !=  $input['cambio']) {
        $q->data = NULL;
        $q->fields = array();
        $q->sql = '
        UPDATE co_moneda
        SET monto = "' . $input['cambio'] . '"
        WHERE id = ' . $input['moneda_id'] . '
        ';
        // print $q->sql;
        $q->exe();
                        
    }    
    // -----------------------------------------
    $q->data = NULL;
    $q->fields = array();
    $q->sql = '
    UPDATE co_pago
    SET 
    fecha = "' . $input['fecha'] . '"
    , total_igv = ' . $input['igv'] . '
    , total_igv_de = "' . $input['de'] . '"
    , total_monto = ' . $input['sin'] . '
    , total_monto_igv = ' . $input['con'] . '
    , total_cambio = ' . $input['cambio'] . '
    , total_moneda_id = ' . $input['moneda_id'] . '
    , info_update_user = ' . $_SESSION['user_id'] . '
    WHERE cotizacion_id= ' . $input['cotizacion_id'] . '
    ';
    $q->exe();
    // -------------------------------------    

}
function process_buttons_involucrados($input) {
    global $q;
    $q->data = NULL;
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
CALL co_involucrado_save (
      "' . $input['id'] . '"
    , "' . $input['cotizacion_id'] . '"
    , "' . $input['rol_id'] . '"
    , "' . $input['persona_tipo'] . '"
    , "' . $input['persona_id'] . '"
    , "' . $input['contacto_id'] . '"
    , "' . 1 . '"
    , "' . $_SESSION['user_id'] . '"
)              
              ';
    $data = $q->exe();
    return $data[0];
}
function process_buttons_monto_moneda_cambio($input) {
    global $q;
    // cambiando moneda
    $q->data = NULL;
    $q->fields = array();
    $q->sql = '
              UPDATE co_moneda SET monto=' . $input['valor'] . '
              WHERE id=' . $input['id'] . '
              ';
    $q->exe();
    // --------- cambiando moneda_pago cambio total
    /* $q->data = NULL; */
    /* $q->fields = array(); */
    /* $q->sql = ' */
    /*            UPDATE co_pago  */
    /*            SET  total_cambio=' . $input['valor'] . ', total_moneda_id=' . $input['id'] . ' */
    /*            WHERE cotizacion_id=' . $input['cotizacion_id'] . ' */
    /*           '; */
    /* $q->exe();     */
    // --------- cambiando peritos_has_pago
    /* $q->data = NULL; */
    /* $q->fields = array(); */
    /* $q->sql = ' */
    /*            UPDATE co_pago_has_perito pp  */
    /*            LEFT JOIN co_pago pa ON pa.id=pp.pago_id */
    /*            SET  pp.cambio= ' . $input['valor'] . ' */
    /*            WHERE pa.cotizacion_id=' . $input['cotizacion_id'] . ' AND pp.moneda_id=' . $input['id'] . ' AND pp.info_status=1 */
    /*           '; */
    /* $q->exe();     */
    // return '<pre>' . $q->sql . '</pre>';
}
function process_buttons_monto_peritos_igv($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
    /* $q->sql = ' */
    /*           CALL co_igv_update_pp( */
    /*               ' . $input['cotizacion_id'] . ' */
    /*             , ' . $input['igv'] . ' */
    /*           ) */
    /*           '; */
    $q->sql = '
UPDATE co_igv SET monto = ' . $input['igv'] . '
              ';
    $q->exe();
}
function get_buttons_montos_peritos_cotizacion($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('peritos_total'=>'');
    $q->sql = '
              SELECT SUM( pp.total *( pp.cambio/' . $input['total_moneda_cambio'] . ') )
              FROM co_pago_has_perito pp
              JOIN co_pago p ON p.id=pp.pago_id
              WHERE p.cotizacion_id=' . $input['cotizacion_id'] . ' AND pp.info_status=1
              ';
    $data = $q->exe();
    return $data[0]['peritos_total'];
}
function set_buttons_montos_modal_peritos($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('id'=>'');
    $q->sql = '
SELECT co_montos_perito_modal_save (
       ' . $input['id'] . '
     , "' . $input['nombre'] . '"
     , "' . $input['telefono'] . '"
     , "' . $input['correo'] . '"
     , ' . $input['status'] . '
     , ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    $q->data = NULL;
    $q->fields = array(
		          'id' => ''
		        , 'nombre' => ''
		        , 'telefono' => ''
		        , 'correo' => ''
		        , 'status' => ''

    		       );
    $q->sql = '
SELECT id, nombre, telefono, correo, info_status
FROM co_perito
WHERE id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    // return $q->sql;
    $data = $q->exe();
    return $data[0];
}
function process_buttons_bien_muebles_save($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('id'=>'');
    $q->sql = '
              SELECT co_bien_mueble_save (
                  ' . $input['id'] . '
                 ,' . $input['cotizacion_id'] . '
                 ,' . $input['sub_categoria_id'] . '
                 ,' . $input['tipo_id'] . '
                 ,' . $input['marca_id'] . '
                 ,' . $input['modelo_id'] . '
                 ,"' . $input['descripcion'] . '"
                 ,' . $_SESSION['user_id'] . '
              ) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    $q->fields = array( 'codigos' => ''
			, 'contexto' => ''
			, 'valor' => ''
			, 'orden' => ''
    		       );
    $q->sql = '
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
WHERE mu.info_status =1 AND mu.id=' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function process_buttons_bien_inmuebles_save($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('id'=>'');
    $q->sql = '
              SELECT co_bien_inmueble_save (
                  ' . $input['id'] . '
                 ,' . $input['cotizacion_id'] . '
                 ,' . $input['sub_categoria_id'] . '
                 ,' . $input['departamento_id'] . '
                 ,' . $input['provincia_id'] . '
                 ,' . $input['distrito_id'] . '
                 ,"' . $input['direccion'] . '"
                 ,"' . $input['descripcion'] . '"
                 ,' . $_SESSION['user_id'] . '
              ) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    $q->fields = array( 'codigos' => ''
			, 'contexto' => ''
			, 'valor' => ''
			, 'orden' => ''
    		       );
    $q->sql = '
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
WHERE inm.info_status =1 AND inm.id=' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function process_buttons_bien_mazivo_save($input) {
    global $q;
    // eliminando archivo antiguo
    if ( $input['id'] != 0) {
	$q->data = NULL;
	$q->fields = array('adjunto'=>'');
	$q->sql = '
SELECT direccion FROM co_bien_mazivo
WHERE id=' . $input['id'] . '
              ';
	$data = $q->exe();
	$file = '../../../../../files/cotizacion/bienes/'.$data[0]['adjunto'];
	if (file_exists($file)) {
	    unlink( $file );
	}

    }
    $q->data = NULL;
    $q->fields = array('id'=>'');
    $q->sql = '
              SELECT co_bien_mazivo_save (
                   ' . $input['cotizacion_id'] . '
                 , ' . $input['sub_categoria_id'] . '
                 , ' . $input['id'] . '
                 , "' . $input['descripcion'] . '"
                 , "' . $input['archivo'] . '"
                 , ' . $_SESSION['user_id'] . '
              ) AS id
              ';
    $data = $q->exe();
    return $data[0]['id'];

}
function process_buttons_bien_mazivo_save_no_file($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
    $q->sql = '
UPDATE co_bien_mazivo 
SET descripcion = "' . $input['descripcion'] . '"
WHERE id=' . $input['id'] . '
              ';
    $q->exe();
    return $input['id'];
}
function process_buttons_bien_mazivo_save_view($id) {
    global $q;
    $q->data = NULL;
    $q->fields = array( 'codigos' => ''
    			, 'contexto' => ''
    			, 'valor' => ''
    			, 'orden' => ''
    		       );
    $q->sql = '
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
WHERE ma.info_status =1 AND ma.id=' . $id . '
              ';
    $data = $q->exe();
    return $data[0];    
}
function process_buttons_general_adjunto_save($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('adjunto'=>'');
    $q->sql = '
              SELECT adjunto FROM co_cotizacion 
              WHERE id = ' . $input['cotizacion_id'] . '
              ';
    $data = $q->exe();
    if ($data[0]['adjunto'] != '') {
	$file = '../../../../../files/cotizacion/adjuntos/'.$data[0]['adjunto'];
	unlink( $file );
    }
    $q->data = NULL;
    $q->fields = array();
    $q->sql = '
              UPDATE co_cotizacion SET adjunto= "' . $input['archivo'] . '"
              WHERE id = ' . $input['cotizacion_id'] . '
              ';
    $q->exe();
}
function set_buttons_involucrados_juridico($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_juridico_modal_save (
     ' . $input['id'] . ',
     ' . $input['clasificacion_id'] . ',
     ' . $input['actividad_id'] . ',
     ' . $input['grupo_id'] . ',
     "' . $input['nombre'] . '",
     "' . $input['ruc'] . '",
     "' . $input['direccion'] . '",
     "' . $input['telefono'] . '",
     ' . $input['info_status'] . ',
     ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql; 
    $data = $q->exe();
    // return $data[0]['id']; // pruebas de la funcion

    $q->data = NULL;
    $q->fields = array(
		       'id' => ''
		       , 'clasificacion_id' => ''
		       , 'clasificacion_nombre' => ''
		       , 'actividad_id' => ''
		       , 'actividad_nombre' => ''
		       , 'grupo_id' => ''
		       , 'grupo_nombre' => ''
		       , 'nombre' => ''
		       , 'ruc' => ''
		       , 'direccion' => ''
		       , 'telefono' => ''
		       , 'status' =>''
    		       );
    $q->sql = '
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
               WHERE ju.id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_involucrados_juridico_contacto($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_juridico_contacto_modal_save (
     ' . $input['id'] . ',
     ' . $input['juridico_id'] . ', 
     "' . $input['nombre'] . '", 
     "' . $input['cargo'] . '",
     "' . $input['telefono'] . '", 
     "' . $input['correo'] . '",
     ' . $input['status'] . ',
     ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    // return $data[0]['id']; // pruebas de la funcion
    $q->data = NULL;
    $q->fields = array(
                          'id' => ''
		        , 'juridico_id' => ''
		        , 'nombre' => ''
		        , 'cargo' => ''
			, 'telefono' =>''
			, 'correo' =>''
			, 'status' =>''
    		       );

    $q->sql = '
              SELECT  c.id, c.juridica_id, c.nombre, c.cargo, c.telefono, c.correo, c.info_status
              FROM co_involucrado_contacto c
              WHERE c.id = '. $data[0]['id'] .'
              ';
    /* return $q->sql; */
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_bien_mueble_tipo($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_bien_tipo_save (
     ' . $input['tipo_id'] . ',
     ' . $input['sub_categoria_id'] . ',
     "' . $input['nombre'] . '",
     ' . $input['status'] . ',
     ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    // return $data[0]['id']; // pruebas de la funcion
    $q->fields = array(
                          'tipo_id' => ''
		        , 'nombre' => ''
		        , 'status' => ''
    		       );
    $q->sql = '
               SELECT ti.tipo_id, 
                      ti.nombre,
                      ti.info_status
               FROM co_bien_muebles_clasificacion ti
               WHERE 
                   ti.tipo_id = '. $data[0]['id'] .'
               AND ti.marca_id = 0 
               AND ti.modelo_id = 0
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_bien_mueble_marca($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_bien_marca_save (
     ' . $input['tipo_id'] . ',
     ' . $input['marca_id'] . ',
     ' . $input['sub_categoria_id'] . ',
     "' . $input['nombre'] . '",
     ' . $input['status'] . ',
     ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    // return $data[0]['id']; // pruebas de la funcion
    $q->fields = array(
		          'tipo_id' => ''
		        , 'marca_id' => ''
		        , 'nombre' => ''
		        , 'status' => ''
    		       );
    $q->sql = '
               SELECT mr.tipo_id, 
                      mr.marca_id, 
                      mr.nombre, 
                      mr.info_status
               FROM co_bien_muebles_clasificacion mr
               WHERE 
                   mr.tipo_id = ' . $input['tipo_id'] . '
               AND mr.marca_id = ' . $data[0]['id'] . '
               AND mr.modelo_id = 0

              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_bien_mueble_modelo($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_bien_modelo_save (
     ' . $input['tipo_id'] . ',
     ' . $input['marca_id'] . ',
     ' . $input['modelo_id'] . ',
     ' . $input['sub_categoria_id'] . ',
     "' . $input['nombre'] . '",
     ' . $input['status'] . ',
     ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;
    $data = $q->exe();
    // return $data[0]['id']; // pruebas de la funcion
    $q->fields = array(
		          'tipo_id' => ''
			, 'marca_id' => ''
			, 'modelo_id' => ''
		        , 'nombre' => ''
		        , 'status' => ''

    		       );
    $q->sql = '
               SELECT 
               mo.tipo_id, 
               mo.marca_id, 
               mo.modelo_id, 
               mo.nombre, 
               mo.info_status
               FROM co_bien_muebles_clasificacion mo
               WHERE 
                   mo.tipo_id = ' . $input['tipo_id'] . '
               AND mo.marca_id = ' . $input['marca_id'] . '
               AND mo.modelo_id = ' . $data[0]['id'] . ' 
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_modal_bien_inmueble($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
		       , 'nombre'=>''
		       , 'status'=>''
    		       );
    $q->sql = '
CALL co_bien_inmueble_modal (
      ' . $input['id'] . '
    , "' . $input['nombre'] . '"
    , ' . $input['status'] . '
    , ' . $_SESSION['user_id'] . '
)
              ';
    // return $q->sql;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_involucrados_juridico_clasificacion($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_involucrado_juridico_clasificacion_save (
       ' . $input['id'] . '
     , "' . $input['nombre'] . '"
     , ' . $input['status'] . '
     , ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;    
    $data = $q->exe();
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
SELECT id, nombre, info_status
FROM co_involucrado_clasificacion
WHERE id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_involucrados_juridico_actividad($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_involucrado_juridico_actividad_save (
       ' . $input['id'] . '
     , "' . $input['nombre'] . '"
     , ' . $input['status'] . '
     , ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;    
    $data = $q->exe();
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
SELECT id, nombre, info_status
FROM co_involucrado_actividad
WHERE id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_involucrados_juridico_grupo($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id'=>''
    		       );
    $q->sql = '
SELECT co_involucrado_juridico_grupo_save (
       ' . $input['id'] . '
     , "' . $input['nombre'] . '"
     , ' . $input['status'] . '
     , ' . $_SESSION['user_id'] . '
) AS id
              ';
    // return $q->sql;    
    $data = $q->exe();
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
SELECT id, nombre, info_status
FROM co_involucrado_grupo
WHERE id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function set_buttons_involucrados_juridico_modal_juridico($in) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
        'id'=>'',
        'razon'=>'',
        'ruc'=>'',
        'telefono'=>'',
        'direccion'=>'',
        'clasificacion'=>'',
        'actividad'=>'',
        'grupo'=>'',
        'status'=>'',        
    );
    $q->sql = '
    SELECT  
      ju.id
    , ju.nombre
    , ju.ruc
    , ju.telefono
    , ju.direccion
    , ju.clasificacion_id
    , ju.actividad_id
    , ju.grupo_id
    , ju.info_status
    FROM co_involucrado_juridica ju
    WHERE ju.id = ' . $in['id'] . '
    ';
    $data = $q->exe();
    $ou = array(
        'id'=>utf8_encode($data[0]['id']),
        'razon'=>utf8_encode($data[0]['razon']),
        'ruc'=>utf8_encode($data[0]['ruc']),
        'telefono'=>utf8_encode($data[0]['telefono']),
        'direccion'=>utf8_encode($data[0]['direccion']),
        'clasificacion_id'=>utf8_encode($data[0]['clasificacion']),
        'actividad_id'=>utf8_encode($data[0]['actividad']),
        'grupo_id'=>utf8_encode($data[0]['grupo']),
        'status'=>utf8_encode($data[0]['status']),        
    );
    return $ou;
}

function set_buttons_servicios($in) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
    if ($in['servicio_id'] == '0') {
        $q->sql = '
        INSERT INTO co_servicio
        (descripcion, subtotal, cotizacion_id, info_create, info_create_user) 
        VALUES("' . $in['descripcion'] . '", 
               "' . $in['subtotal'] . '", 
               "' . $in['cotizacion_id'] . '", 
               "' . $in['fecha'] . '", 
               "' . $in['usuario'] . '")
        ';
    } else {
        $q->sql = '
        UPDATE co_servicio SET
        descripcion = "' . $in['descripcion'] . '", 
        subtotal = "' . $in['subtotal'] . '", 
        info_update = "' . $in['fecha'] . '", 
        info_update_user = "' . $in['usuario'] . '"
        WHERE id = "' . $in['servicio_id'] . '"
        ';
    }
    // print $q->sql;    
    $q->exe();
}



