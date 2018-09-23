<?php 
function set_delete_montos_peritos($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('id'=>'');
    $q->sql = '
              UPDATE co_pago_has_perito SET info_status=0
              WHERE id = ' . $input['id'] . '
              ';
    $q->exe();
}
function set_delete_bienes_peritos($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
    if ( $input['categoria_id']==1 ) { // muebles   
	$q->sql = '
                  UPDATE co_bien_mueble SET info_status=0
                  WHERE id = ' . $input['id'] . '
                  ';
    }
    elseif ( $input['categoria_id']==2 ) {// inmuebles
	$q->sql = '
                  UPDATE co_bien_inmueble SET info_status=0
                  WHERE id = ' . $input['id'] . '
                  ';
    }
    elseif ( $input['categoria_id']==3 ) { // masivos
	// eliminar archivo
	$q->sql = '
                  UPDATE co_bien_mazivo SET info_status=0
                  WHERE id = ' . $input['id'] . '
                  ';
    }
    $q->exe();
}
function set_delete_involucrados($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
    $q->sql = '
              DELETE FROM co_involucrado
              WHERE id = ' . $input['id'] . '
              ';
    $q->exe();
}
function set_delete_servicios($in) {
    global $q;
    $q->data = NULL;
    $q->fields = array();
	$q->sql = '
    UPDATE co_servicio SET info_status=0
    WHERE id = ' . $in['servicio_id'] . '
    ';
    // echo $q->sql;
    $q->exe();
}