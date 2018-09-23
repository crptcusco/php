<?php 
function get_options_juridico($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, CONCAT(nombre, " ( ", ruc, " ) ")
              FROM co_involucrado_juridica 
              WHERE info_status=1
              ORDER BY 2
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_natural($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, CONCAT(nombre, " ( ", documento, " ) ")
              FROM co_involucrado_natural
              WHERE info_status=1
              ORDER BY 2
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_persona_tipo($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
              SELECT id, nombre FROM ve_persona_estado
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_vendedor_por_coordinador($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
SELECT v.id, v.nombre
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.user_id=' . $_SESSION['user_id'] . '
UNION
SELECT v.id, v.nombre
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.parent_id=' . $_SESSION['user_id'] . '
ORDER BY 2
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_vendedor_por_coordinador2($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
SELECT v.id, v.nombre
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.user_id=' . $_SESSION['user_id'] . '
UNION
SELECT v.id, v.nombre
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.parent_id=' . $_SESSION['user_id'] . ' AND v.info_status=1
UNION
SELECT v.id, v.nombre
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.rol_id=1 AND v.info_status=1
ORDER BY 2

              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_estado_visita($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
SELECT id, nombre FROM ve_estado WHERE info_status=1;
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_contacto_visita($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    if ( $input['persona_tipo'] == 'Juridica' ) {
	$q->sql = '
SELECT id, nombre FROM co_involucrado_contacto WHERE juridica_id=' . $input['persona_id'] . ' AND info_status!=0
                  ';	
    } elseif ( $input['persona_tipo'] == 'Natural' ) {
	$q->sql = '
SELECT id, nombre FROM co_involucrado_contacto WHERE natural_id=' . $input['persona_id'] . ' AND info_status!=0
                  ';
    }

    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_importante($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '
SELECT id,nombre FROM ve_importante ORDER BY 1
              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}
function get_options_($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       ,"value"=>""
    		       );
    $q->sql = '

              ';
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple_Upper();
    $combo->set_option( $input['id'] );
    $combo->set_format( array('id','value') );
    $combo->imprimir( $data );
}