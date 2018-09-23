<?php 
function info_juridico($input) {
    global $q;
    $q->fields = array(
		       "vendedor_nombre" => ""
		       ,"estado_nombre"=>""
    		       );
    $q->sql = '
SELECT ve.nombre, es.nombre
FROM co_involucrado_juridica ju
LEFT JOIN co_vendedor ve ON ve.id=ju.vendedor_id
LEFT JOIN ve_persona_estado es ON es.id=ju.estado_id
WHERE ju.id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function info_natural($input) {
    global $q;
    $q->fields = array(
		       "vendedor_nombre" => ""
		       ,"estado_nombre"=>""
    		       );
    $q->sql = '
SELECT ve.nombre, es.nombre
FROM co_involucrado_natural na
LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
LEFT JOIN ve_persona_estado es ON es.id=na.estado_id
WHERE na.id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function info_es_propuesta_de_usuario($input) {
    global $q;
    $q->fields = array(
                       'cnt' =>''
    		       );
    $q->sql = '
SELECT COUNT(id) FROM co_vendedor
WHERE user_id=' . $_SESSION['user_id'] . ' and id=' . $input['vendedor_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ($data[0]['cnt']==0) {
	return 'no';
    } else {
	return 'si';
    }

}
function info_($input) {
    global $q;
    $q->fields = array(
    		       );
    $q->sql = '
WHERE id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}