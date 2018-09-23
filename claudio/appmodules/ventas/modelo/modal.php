<?php 
function modal_vendedor($in) {
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
SELECT v.id, v.nombre, v.telefono, v.correo, v.info_status, u.login
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.user_id=' . $_SESSION['user_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function modal_($id) {
    global $q;
    $q->fields = array(
		       "" => ""
    		       );
    $q->sql = '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}