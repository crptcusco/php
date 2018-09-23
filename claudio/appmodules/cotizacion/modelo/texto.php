<?php 
function get_texto_mensaje() {
    global $q;
    $q->fields = array(
		       'mensaje'=>''
    		       );
    $q->sql = '
              SELECT DISTINCT mensaje
              FROM co_mensaje
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function get_monto_igv() {
    global $q;
    $q->fields = array(
		       'igv'=>''
    		       );
    $q->sql = '
              SELECT monto FROM co_igv
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ){
	return $data[0]['igv'];
    }   
}
function get_monto_moneda_monto($input) {
    global $q;
    $q->fields = array(
		       'monto'=>''
    		       );
    $q->sql = '
              SELECT monto FROM co_moneda
              WHERE id =' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ){
	return $data[0]['monto'];
    }   
}
function get_involucrado_juridico_contacto_datos($id) {
    global $q;
    $q->fields = array(
		         'cargo'=>''
		       , 'telefono'=>''
		       , 'correo'=>''
    		       );
    $q->sql = '
              SELECT cargo, telefono, correo 
              FROM co_involucrado_contacto
              WHERE id = ' . $id . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ){
	return $data[0];
    }else {
	return $q->sql;
    }
}
function get_involucrado_natural_datos($id) {
    global $q;
    $q->fields = array(
		         'direccion'=>''
		       , 'telefono'=>''
		       , 'correo'=>''
    		       );
    $q->sql = '
              SELECT direccion, telefono, correo
              FROM co_involucrado_natural
              WHERE id = ' . $id . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array($data) ){
	return $data[0];
    }else {
	return $q->sql;
    }
}
function get_monto_cargar($input) {
    global $q;
    $q->fields = array(
		       'igv'=>''
		       , 'de'=>''
		       , 'sin'=>''
		       , 'con'=>''
		       , 'cambio'=>''
		       , 'moneda_id'=>''

    		       );
    $q->sql = '
SELECT 
  total_igv
, total_igv_de
, total_monto
, total_monto_igv
, total_cambio
, total_moneda_id
FROM co_pago
WHERE cotizacion_id=' . $input['cotizacion_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function get_servicio_total($in) {
    global $q;
    $q->fields = array(
        'subtotal'=>''
    );
    $q->data = NULL;
    $q->sql = '
    SELECT subtotal FROM co_servicio
    WHERE 
        cotizacion_id="' . $in['cotizacion_id'] . '"
    AND info_status = "1"
    ';
    $data = $q->exe();
    return $data;
}
function get_servicio_total_pago($in) {
    global $q;
    $q->fields = array(
    );
    $q->data = NULL;
    $q->sql = '
    UPDATE co_pago SET 
    total_monto = "' . $in['total_monto'] . '",
    total_monto_igv = "' . $in['total_monto_igv'] . '"
    WHERE 
    cotizacion_id = "' . $in['cotizacion_id'] . '"
    ';
    // echo $q->sql;
    $q->exe();
}
