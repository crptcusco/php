<?php 
function get_venta_nuevo() {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       "id" => ""
		       , "vendedor_id" => ""
		       , "vendedor_nombre" => ""
		       , "vendedor_rol_id" => ""
    		       );
    $q->sql = '
              CALL ve_nuevo("' . $_SESSION['user_id'] . '")
              ';
    $data = $q->exe();
    return $data[0];
}
function get_venta( $codigo ) {
    global $q;
    $q->data = NULL;
    $q->fields = array( 'id' => ''
			, 'codigo' => ''
			, 'vendedor_rol_id' => ''
			, 'vendedor_id' => ''
			, 'vendedor_nombre' => ''
			, 'persona_tipo' => ''
			, 'persona_id' => ''
		      );
    $q->sql = '
              SELECT 
                pr.id
              , pr.codigo
              , ve.rol_id
              , ve.id vendedor_id
              , ve.nombre             
              , pr.persona_tipo
              , pr.persona_id
              FROM ve_propuesta pr
	      JOIN co_vendedor ve ON ve.id=pr.vendedor_id
              WHERE pr.codigo= ' . $codigo . '
              LIMIT 1
              ';
    $data = $q->exe();    
    return $data[0];
}
function logica_verificar_usuario( $tabla, $id ) {
    global $q;
    $q->data = NULL;
    $q->fields = array( 'user_id' => '' );
    $q->sql = '
              SELECT info_create_user
              FROM ' . $tabla . '
              WHERE id= ' . $id . '
              ';
    $data = $q->exe();    
    if ( $data[0]['user_id'] == $_SESSION['user_id'] ) {
	return True;
    } else {
	return False;
    }
}
function get_rol_id( ) {
    global $q;
    $q->data = NULL;
    $q->fields = array( 'rol_id' => ''
		      );
    $q->sql = '
SELECT rol_id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . '
              ';
    $data = $q->exe();
    return $data[0]['rol_id'];
}
function get_vendedor_actual_id( ) {
    global $q;
    $q->data = NULL;
    $q->fields = array( 'id' => ''
		      );
    $q->sql = '
SELECT id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . '
              ';
    $data = $q->exe();
    return $data[0]['id'];
}
function get_vendedorIdNombre_by_userid() {
    global $q;
    $q->data = NULL;
    $q->fields = array(
		       'id' => ''
		       , 'nombre' => ''
		       , 'rol_id' => ''
		      );
    $q->sql = '
SELECT id, nombre, rol_id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . ';
              ';
    $data = $q->exe();
    return $data[0];
}