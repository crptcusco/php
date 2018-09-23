<?php 
function get_options_tipo_servicios($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre
              FROM co_servicio_tipo
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_tipo_cotizacion($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre
              FROM  co_cotizacion_tipo
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_desglose($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre
              FROM co_desglose
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_estado_cotizacion($id) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre
              FROM co_estado
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_monto_moneda_str($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, simbolo FROM co_moneda
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_involucrados_vendedores($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id,nombre FROM co_vendedor
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_involucrados_juridico_razon_social($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, CONCAT(nombre," ( ", ruc," )")
              FROM co_involucrado_juridica
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_involucrados_juridico_contacto($id, $juridico_id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre
              FROM co_involucrado_contacto
              WHERE info_status=1 AND juridica_id='. $juridico_id . '
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_involucrados_natural_nombre($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, CONCAT(nombre," ( ",documento," )")
              FROM co_involucrado_natural
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_involucrados_coordinador_id($id) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
SELECT u.id, u.full_name
FROM login_user_has_profile up
JOIN login_user u ON u.id=up.user_id
WHERE up.profile_id=2 AND up.info_status=1 
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_monto_perito_id($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre FROM co_perito
              WHERE info_status=1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id']);
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);    
}
function get_options_bienes_mueble_tipo($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
               SELECT tipo_id, nombre
               FROM co_bien_muebles_clasificacion
               WHERE 
                    marca_id = 0 
               AND modelo_id = 0
               AND sub_categoria_id = ' . $input['mueble_tipo_id'] . '
               AND info_status = 1 
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    if ($input['tipo_id'] != '' ) {
	$combo->set_option( $input['tipo_id'] );
    }   
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);    
}
function get_options_bienes_mueble_marca($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
               SELECT marca_id, nombre
               FROM co_bien_muebles_clasificacion
               WHERE
                    marca_id != 0
               AND  modelo_id = 0
               AND sub_categoria_id = ' . $input['mueble_tipo_id'] . '
               AND tipo_id = ' . $input['tipo_id'] . '
               AND info_status = 1 
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    if ($input['marca_id'] != '' ) {
	$combo->set_option( $input['marca_id'] );
    }
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);    
}
function get_options_bienes_mueble_modelo($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
               SELECT modelo_id, nombre
               FROM co_bien_muebles_clasificacion
               WHERE
                    marca_id != 0
               AND  modelo_id != 0
               AND sub_categoria_id = ' . $input['mueble_tipo_id'] . '
               AND tipo_id = ' . $input['tipo_id'] . '
               AND marca_id = ' . $input['marca_id'] . '
               AND info_status = 1 
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    if ($input['modelo_id'] != '' ) {
	$combo->set_option( $input['modelo_id'] );
    }
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);    
}
function get_options_bienes_inmueble($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre
              FROM co_bien_sub_categoria
              WHERE categoria_id=2 AND info_status=1 
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_format( array('id','value') );
    $combo->set_option( $input['sub_categoria_id'] );
    $combo->imprimir($data);    
}
function get_options_bienes_inmueble_departamento($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT departamento_id, nombre
              FROM co_bien_inmuebles_ubigeo
              WHERE 
                   provincia_id=0
              AND  distrito_id=0
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_format( array('id','value') );
    $combo->set_option( $input['depatamento_id'] );
    $combo->imprimir($data);    
}
function get_options_bienes_inmueble_provincia($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT provincia_id, nombre
              FROM co_bien_inmuebles_ubigeo
              WHERE
                   departamento_id= ' . $input['depatamento_id'] . '
              AND  provincia_id!=0
              AND  distrito_id=0
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_format( array('id','value') );
    $combo->set_option( $input['provincia_id'] );
    $combo->imprimir($data);
}
function get_options_bienes_inmueble_distrito($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT distrito_id, nombre
              FROM co_bien_inmuebles_ubigeo
              WHERE
                   departamento_id= ' . $input['depatamento_id'] . '
              AND  provincia_id= ' . $input['provincia_id'] . '
              AND  provincia_id!=0
              AND  distrito_id!=0
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_format( array('id','value') );
    $combo->set_option( $input['distrito_id'] );
    $combo->imprimir($data);
}
