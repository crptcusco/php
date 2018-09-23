<?php
function delete_validar_usuario( $in ) {
    global $q;
    $q->fields = array(
		       "cnt" => ""
    		       );
    $q->sql = '
SELECT COUNT(p.id) AS total FROM ve_propuesta p
LEFT JOIN co_vendedor v ON v.id=p.vendedor_id
WHERE
    p.id = ' . $in['propuesta_id'] . '
AND v.user_id = ' . $_SESSION['user_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( $data[0]['cnt'] > 0 ) {
	return true;
    } else {
	return false;
    }
}
function delete_propuesta($in) {
    global $q;
    $q->fields = array();
    $q->sql = '
UPDATE ve_propuesta SET info_status = 0
WHERE id = ' . $in['propuesta_id'] . '
              ';
    $q->data = NULL;
    $q->exe();
}
function delete_visita($in) {
    global $q;
    // verificando si es la ultima propuesta
    $q->fields = array();
    $q->sql = '
CALL ve_visita_delete (
  "' . $in['propuesta_id'] . '"
, "' . $in['visita_id'] . '"
)
              ';
    $q->exe();
}
function delete_contacto($in) {
    global $q;
    $q->fields = array(
		       "delete" => ""
    		       );
    $q->sql = '
SELECT ve_contacto_delete (
  ' . $in['contacto_id'] . '
, ' . $_SESSION['user_id'] . '
) AS "estado"
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0]['delete'];
}
function delete_($in) {
    global $q;
    $q->fields = array(
		       "" => ""
    		       );
    $q->sql = '
SELECT 
FROM 
WHERE .id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}