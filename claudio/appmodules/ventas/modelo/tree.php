<?php
function tree_servicio_tipo($input) {
    global $q;
    $q->fields = array(
		       "id" => ""
		       , "nombre" => ""
		       , "parentId" => ""
    		       );
    $q->sql = '
SELECT
  st.id
, IF(d.id IS NULL
    ,   CONCAT(st.nombre,"!-%|0")
    ,   CONCAT(st.nombre,"!-%|", d.id)
  ) nombre
, st.parent_id
FROM ve_servicio_tipo st
LEFT JOIN ve_propuesta_has_servicio_tipo d ON (d.servicio_tipo_id=st.id AND d.propuesta_id=' . $input['propuesta_id'] . ')
              ';
    $q->data = NULL;
    $data = $q->exe();
    $data= buildTree($data, $rootId=0);
    return $data;
}
function tree_is_user_by_vendedor( $vendedor_id ) {
    global $q;
    $q->fields = array(
		       "vendedor_id" => ""
    		       );
    $q->sql = '
              SELECT id FROM co_vendedor 
              WHERE user_id=' . $_SESSION['user_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    if ( $data[0]['vendedor_id']==$vendedor_id ) {
	return true;
    } else {
	return false;
    }
}
function tree_($input) {
    global $q;
    $q->fields = array(
		       "" => ""
    		       );
    $q->sql = '
' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}