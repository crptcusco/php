<?php 
function checkbox_set_servicio_tipo_has_propuesta( $input ) {
    global $q;
    $q->fields = array(
    		       );
    if ( $input['estado'] == 'true' ) {
	$q->sql = '
                  INSERT INTO ve_propuesta_has_servicio_tipo (propuesta_id, servicio_tipo_id) 
                  VALUES("' . $input['propuesta_id'] . '", "' . $input['servicio_tipo_id'] . '")
                  ';	
    }elseif ( $input['estado'] == 'false' ) {
	$q->sql = '
                  DELETE FROM ve_propuesta_has_servicio_tipo 
                  WHERE propuesta_id="' . $input['propuesta_id'] . '" 
                    AND servicio_tipo_id="' . $input['servicio_tipo_id'] . '";
                  ';	
    }
    $q->data = NULL;
    $data = $q->exe();
    echo $q->sql;
    return $data;
}
function checkbox_( $input ) {
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

