<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/delete.php";

// ---------------------------------------------- INPUT
$in['contacto_id'] = is_null_id( clear_input( $_POST['contacto_id'] ) );

// -------------------------------------------- PROCESS
$ou = delete_contacto($in);
if ($ou != '0') {  
  echo 'DELETE';
} else {
  echo 'SIN PERMISO';
}


// ---------------------------------------------- TEST
/*
print_test('$_POST', $_POST);
print_test('$input', $in);
print_test('$output', $ou);
*/
