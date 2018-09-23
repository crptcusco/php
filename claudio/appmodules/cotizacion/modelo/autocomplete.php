<?php
function autocomplete_mensajes($in) {
    global $q;
    $q->data = NULL;
    $q->fields = array(
        'termino'=>''
    );
    $q->sql = '
    SELECT DISTINCT mensaje FROM `co_mensaje`
    WHERE info_status = 1 AND mensaje LIKE "%' . $in['termino'] . '%"
    ORDER BY 1 LIMIT 8   
    ';
    // print $q->sql;
    $data = $q->exe();
   
    return $data;
}