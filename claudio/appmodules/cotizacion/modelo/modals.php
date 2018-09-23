<?php 
function get_modals_tipo_servicios() {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"nombre"=>""
    			,"status"=>""
    		       );
    $q->sql = '
              SELECT id, nombre, info_status
              FROM co_servicio_tipo              
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data;
}
function set_modals_tipo_servicios($input) {
    global $q;
    $q->fields = array('id'=>'');    
    $q->data = NULL;
    if( $input['accion']=='Añadir' ) {
	$q->sql = '
                  SELECT co_tipo_servicio_insert(
                         "'. $input['nombre'] . '"
                       , ' . $input['info_status'] . '
                       , ' . $_SESSION["user_id"] . '
                  ) AS id
                  ';
    } elseif( $input['accion']=='Editar' ) {
	$q->sql = '
                  SELECT co_tipo_servicio_update(
                        ' . $input['id'] . '
                      , "' . $input['nombre'] . '"
                      , ' . $input['info_status'] . '
                      , ' . $_SESSION["user_id"] . '
                  ) AS id
                  ';
    } 
    //print_r($q->sql);
    $data = $q->exe();
    return $data[0]['id'];
}
function get_modals_involucrados_vendedor() {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"nombre"=>""
			,"telefono"=>""
			,"correo"=>""
    			,"status"=>""
    		       );
    $q->sql = '
              SELECT id, nombre, telefono, correo,info_status 
              FROM co_vendedor
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data;
}
function set_modals_involucrados_vendedor($input) {
    global $q;
    $q->fields = array('id'=>'');    
    $q->data = NULL;
    $q->sql = '
              SELECT co_vendedor_save (
                   "' . $input['accion'] . '"
                 , ' . $input['codigo'] . '
                 , "' . $input['nombre'] . '"
                 , "' . $input['telefono'] . '"
                 , "' . $input['correo'] . '"
                 , ' . $input['activo'] . '
                 , ' . $_SESSION["user_id"] . '
              ) AS id
              ';
    $data = $q->exe();

    $q->fields = array(
    		        "id" => ""
    			,"nombre"=>""
			,"telefono"=>""
			,"correo"=>""
    			,"status"=>""
    		       );
    $q->sql = '
              SELECT id, nombre, telefono, correo,info_status 
              FROM co_vendedor
              WHERE id = ' . $data[0]['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
//involucrados juridico
function get_modals_involucrados_juridico_tabla($input) {
    global $q;
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
    if ( $input['id']!= NULL ) {
	$filter = 'WHERE ju.id = ' . $input['id'];
    } else {
	$filter = '';
    }
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
               ' . $filter . '
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data;
}
function get_modals_option_involucrados_juridico_clasificacion($in) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre 
              FROM co_involucrado_clasificacion
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $in['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_modals_option_involucrados_juridico_actividad($in) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre 
              FROM co_involucrado_actividad
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $in['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_modals_option_involucrados_juridico_grupo() {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre 
              FROM co_involucrado_grupo
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();
    $combo = new OptionComboSimple_Upper();
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_modals_table_involucrados_juridico_clasificacion() {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
              SELECT id, nombre, info_status
              FROM co_involucrado_clasificacion
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_modals_table_involucrados_juridico_actividad() {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
              SELECT id, nombre, info_status
              FROM co_involucrado_actividad
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_modals_table_involucrados_juridico_grupo() {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"nombre" => ""
		       , "status" => ""
    		       );
    $q->sql = '
              SELECT id, nombre, info_status
              FROM co_involucrado_grupo
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
//involucrados juridico contacto
function get_modals_involucrados_juridico_contacto_tabla($input) {
    global $q;
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
              WHERE c.juridica_id = '.$input['juridico_id'] .' AND c.info_status
              ';
    /* return $q->sql; */
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
//involucrados natural
function get_modals_involucrados_natural_tabla() {
    global $q;
    $q->fields = array(
                          'id' => ''
		        , 'nombre' => ''
			, 'documento_id' => ''
    			, 'documento_tipo'=>''
			, 'documento_numero'=>''
			, 'direccion'=>''
    			, 'telefono'=>''
			, 'correo'=>''
			, 'info_status'=>''  
    		       );
    $q->sql = '
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data;
}
function get_modals_option_involucrados_natural_documento($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre 
              FROM co_involucrado_documento_tipo
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function set_modals_involucrados_natural($input) {
    global $q;
    $q->fields = array('id'=>'');    
    $q->data = NULL;
    $q->sql = '
              SELECT co_vendedor_involucrado_natural_save (
                  ' . $input['id'] . ',
                  "' . $input['nombre'] . '", 
                  ' . $input['documento_tipo'] . ',
                  "' . $input['documento_numero'] . '",
                  "' . $input['direccion'] . '", 
                  "' . $input['telefono'] . '", 
                  "' . $input['correo'] . '",
                  ' . $input['status'] . ',
                  ' . $_SESSION["user_id"] . ') AS id
              ';
    echo $q->sql;
    $data = $q->exe();

    $q->fields = array(
        'id' => ''
        , 'nombre' => ''
        , 'documento_id' => ''
        , 'documento_tipo'=>''
        , 'documento_numero'=>''
        , 'direccion'=>''
        , 'telefono'=>''
        , 'correo'=>''
        , 'info_status'=>''  
    );
    $q->sql = '
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               WHERE na.id='.$data[0]['id'].'
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data[0];
}
// --------------------------------- bienes:muebles
// tipo
function get_modals_bien_mueble_tipo_tabla($input) {
    global $q;
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
                    ti.marca_id = 0 
               AND ti.modelo_id = 0
               AND ti.sub_categoria_id = ' . $input['sub_categoria_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();

    return $data;
}
// marca
function get_modals_bien_mueble_marca_tabla($input) {
    global $q;
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
               AND mr.marca_id != 0 
               AND mr.modelo_id = 0
               AND mr.sub_categoria_id = ' . $input['sub_categoria_id'] . '
              ';
    $q->data = NULL;
    /* return $q->sql; */
    $data = $q->exe();
    return $data;

}
// modelo
function get_modals_bien_mueble_modelo_tabla($input) {
    global $q;
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
               AND mo.modelo_id != 0
               AND mo.sub_categoria_id = ' . $input['sub_categoria_id'] . '
              ';
    $q->data = NULL;
    /* return $q->sql; */
    $data = $q->exe();
    return $data;

}
// --------------------------------- bienes:inmuebles
function get_modals_bien_inmueble_tabla($input) {
    global $q;
    $q->fields = array(
		          'id' => ''
			, 'nombre' => ''
			, 'status' => ''
    		       );
    $q->sql = '
SELECT id, nombre, info_status
FROM co_bien_sub_categoria
WHERE categoria_id=2
              ';
    $q->data = NULL;
    /* return $q->sql; */
    $data = $q->exe();
    return $data;
}
// ------------------- bienes
// --- juridico
function get_modals_montos_juridicos_tabla($input) {
    global $q;
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
              ';
    $q->data = NULL;
    /* return $q->sql; */
    $data = $q->exe();
    return $data;

}