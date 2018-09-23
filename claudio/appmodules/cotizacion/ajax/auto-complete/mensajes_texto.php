<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/autocomplete.php";

$in['termino'] = clear_input( Utilidades::sanear_complete_string($_REQUEST['term']) );


// --------------------------------------------------------- DATA
$ou = autocomplete_mensajes($in);
// var_dump($ou);

// --------------------------------------------------------- TEST


$json = array();
if (is_array($ou)) {
    foreach ($ou as $row) {
        $tmp = array();
        $tmp['value'] = utf8_encode($row['termino']);
        $tmp['label'] = utf8_encode($row['termino']);
        $json[]=$tmp;        
    }
}
echo json_encode($json);
