<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modal.php";
include "../../logica.php";

// -------------------------------------------------------- INPUT
$in = array();

// ------------------------------------------------------- PROCESS
$ou = modal_vendedor( $in );

// ------------------------------------------------------- PROCESS
if ($ou['estado'] == 0) {
    $ou['estado'] = 'false';
} elseif($ou['estado'] == 1) {
    $ou['estado'] = 'true';
}

echo
'
{
  "nombre":"'   . $ou['nombre']   . '"
, "telefono":"' . $ou['telefono'] . '"
, "correo":"'   . $ou['correo']   . '"
, "estado":'    . $ou['estado']   . '
}
';

// ------------------------------------------------------- TEST
/* 
print_test('$in',$in); 
print_test('$ou',$ou);
*/
// -------------------------------------------------- FUNSTIONS
