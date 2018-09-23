<?php 
function hidden_juridico_vendedor_cliente($input) {
    global $q;
    $q->fields = array(
		       "vendedor_id" => ""
    		       );
    $q->sql = '
SELECT ju.vendedor_id
FROM co_involucrado_juridica ju
WHERE ju.id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}
function hidden_natural_vendedor_cliente($input) {
    global $q;
    $q->fields = array(
		       "vendedor_id" => ""
    		       );
    $q->sql = '
SELECT na.vendedor_id
FROM co_involucrado_natural na
WHERE na.id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}