<?php
function button_set_propuesta($input) {
    global $q;
    $q->fields = array(
		       "codigo" => ""
    		       );
    $q->sql = '
SELECT ve_propuesta_save(
      ' . $input['id'] . '
    , "' . $input['persona_tipo'] . '"
    , ' . $input['persona_id'] . '
    , ' . $_SESSION['user_id'] . '
) AS codigo
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
    
}
function button_vendedor_save_and_view($in) {
    global $q;
    $q->fields = array(
		       "id"         => ""
		       , "nombre"   => ""
		       , "telefono" => ""
		       , "correo"   => ""
		       , "estado"   => ""
		       , "login"    => ""
    		       );    
    $q->sql = '
CALL ve_vendedor_modal_save (
  '  . $in['id'] . '
, "' . $in['nombre'] . '"
, "' . $in['telefono'] . '"
, "' . $in['correo'] . '"
, '  . $in['rol_id'] . '
, '  . $in['estado'] . '
, '  . $_SESSION['user_id'] . '
, "'  . $in['login'] . '"
, "'  . $in['pass'] . '"
, "'  . $in['pass_pregunta'] . '"
)
              ';
    // return $q->sql;
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function button_exite_login_en_id($login) {
    global $q;
    $q->fields = array(
		       "id" => ""
    		       );
    $q->sql = '
SELECT id FROM login_user 
WHERE login="' . $login . '" 
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	return $data[0]['id'];
    } else {
	return 0;
    }
}
function button_exite_id_en_login($id) {
    global $q;
    $q->fields = array(
		       "login" => ""
    		       );
    $q->sql = '
SELECT login FROM login_user 
JOIN co_vendedor ON login_user.id= co_vendedor.user_id
WHERE co_vendedor.id="' . $id . '" 
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	return $data[0]['login'];
    } else {
	return '';
    }
}
function button_exite_process($in_login, $in_id) {
    if ($in_id==0) {
	$id = button_exite_login_en_id($in_login);
    } else {
	$login = button_exite_id_en_login($in_id);
	if ($login == $in_login) {
	    $id = 0;
	} else {
	    $id = button_exite_login_en_id($in_login);
	}
    }
    return $id;
}
function button_rol_id_by_user() {
    global $q;
    $q->fields = array(
		       "id" => ""
    		       );
    $q->sql = '
SELECT rol_id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . ';
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0]['id'];
}
function button_vendedor_id_by_user() {
    global $q;
    $q->fields = array(
		       "id" => ""
    		       );
    $q->sql = '
SELECT id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . ';
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0]['id'];
}
function button_set_juridico($input) {
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
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''		       
    		       );    
    $q->sql = '
CALL ve_juridico_modal_save (
     "' . $input['id'] . '"
   , "' . $input['clasificacion_id'] . '"
   , "' . $input['actividad_id'] . '"
   , "' . $input['grupo_id'] . '"
   , "' . $input['nombre'] . '"
   , "' . $input['ruc'] . '"
   , "' . $input['direccion'] . '"
   , "' . $input['telefono'] . '"
   , "' . $input['vendedor_id'] . '"
   , "' . $input['estado_id'] . '"
   , "' . $input['observacion'] . '"
   , "' . $input['importante_id'] . '"
   , "' . $input['referido_id'] . '"
   , "' . $input['info_status'] . '"
   , "' . $_SESSION['user_id'] . '"
)
              ';
    /* return $q->sql; */
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
    
}
function button_set_natural($input) {
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
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''
    		       );
    $q->sql = '
CALL ve_natural_modal_save (
  "' . $input['id'] . '"
, "' . $input['nombre'] . '"
, "' . $input['documento_tipo_id'] . '"
, "' . $input['documento'] . '"
, "' . $input['direccion'] . '"
, "' . $input['telefono'] . '"
, "' . $input['correo'] . '"
, "' . $input['vendedor_id'] . '"
, "' . $input['estado_id'] . '"
, "' . $input['observacion'] . '"
, "' . $input['importante_id'] . '"
, "' . $input['referido_id'] . '"
, "' . $input['info_status'] . '"
, "' . $_SESSION['user_id'] . '"
)
              ';
    /* return $q->sql; */
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
    
}
function button_set_contacto($input) {
    global $q;
    $q->fields = array(
		       'id' => ''
		       , 'persona_id' => ''
		       , 'nombre' => ''
		       , 'cargo' => ''
		       , 'telefono' =>''
		       , 'correo' =>''
		       , 'status' =>''
    		       );
    $q->sql = '
CALL ve_contacto_modal_save (
     "' . $input['id'] . '"
   , "' . $input['persona_id'] . '"
   , "' . $input['persona_tipo'] . '"
   , "' . $input['nombre'] . '"
   , "' . $input['cargo'] . '"
   , "' . $input['telefono'] . '"
   , "' . $input['correo'] . '"
   , "' . $input['info_status'] . '"
   , "' . $_SESSION['user_id'] . '"
)
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function button_set_visita( $input ) {
    global $q;
    $q->fields = array(
		       'id' =>''
		       , 'estado_id' =>''
		       , 'estado_nombre' =>''
		       , 'contacto_id' =>''
		       , 'contacto_nombre' =>''
		       , 'fecha' =>''
		       , 'hora' =>''
		       , 'minuto' =>''
		       , 'departamento_id' =>''
		       , 'departamento_nombre' =>''
		       , 'provincia_id' =>''
		       , 'provincia_nombre' =>''
		       , 'distrito_id' =>''
		       , 'distrito_nombre' =>''
		       , 'direccion' =>''
		       , 'observacion' =>''
    		       );
    $q->sql = '
CALL ve_visita_modal_save (
  "' . $input['id'] . '"
, "' . $input['propuesta_id'] . '"
, "' . $input['estado_id'] . '"
, "' . $input['contacto_id'] . '"
, "' . $input['fecha'] . '"
, "' . $input['hora'] . '"
, "' . $input['minuto'] . '"
, "' . $input['departamento_id'] . '"
, "' . $input['provincia_id'] . '"
, "' . $input['distrito_id'] . '"
, "' . $input['direccion'] . '"
, "' . $input['observacion'] . '"
, "' . $_SESSION['user_id'] . '"
)
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function button_existe_ruc( $input ) {
    $input['id'] = button_existe_ruc_buscar_id( $input['in_ruc'] );
    $input['ruc'] = button_existe_ruc_buscar_ruc( $input['in_id'] );

    if ($input['id'] == $input['in_id'] && $input['ruc']==$input['ruc']) {
	return true;
    } elseif($input['id'] == -1 ) {  // no existe ruc
	return true;
    } elseif($input['id'] != $input['in_id'] ) {  // duplicado
	return false;
    }
}
function button_existe_ruc_buscar_id( $ruc ) {
    global $q;
    $q->fields = array(
		       "id" => ""
    		       );
    $q->sql = '
SELECT id FROM co_involucrado_juridica WHERE ruc="' . $ruc . '"
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	return $data[0]['id'];
    } else {
	return -1;
    }
}
function button_existe_ruc_buscar_ruc( $id ) {
    global $q;
    $q->fields = array(
		       "ruc" => ""
    		       );
    $q->sql = '
SELECT ruc FROM co_involucrado_juridica WHERE id="' . $id . '"
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ) {
	return $data[0]['ruc'];
    } else {
	return '';
    }
}
function button_existe_documento( $input ) {
    // $input['id'] = button_existe_ruc_buscar_id( $input['in_ruc'] );
    // $input['ruc'] = button_existe_ruc_buscar_ruc( $input['in_id'] );
    return $input;
    /* if ($input['id'] == $input['in_id'] && $input['ruc']==$input['ruc']) { */
    /* 	return true; */
    /* } elseif($input['id'] == -1 ) {  // no existe ruc */
    /* 	return true; */
    /* } elseif($input['id'] != $input['in_id'] ) {  // duplicado */
    /* 	return false; */
    /* } */
}
function button_( $input ) {
    global $q;
    $q->fields = array(
		       "" => ""
		       , "" => ""
		       
    		       );
    $q->sql = '

              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
