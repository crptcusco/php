<?php 
function file_general_adjunto_show($input) {
    global $q;
    $q->data = NULL;
    $q->fields = array('adjunto'=>'');
    $q->sql = '
              SELECT adjunto FROM co_cotizacion 
              WHERE id = ' . $input['cotizacion_id'] . '
              ';
    $data = $q->exe();
    return $data[0];
}

