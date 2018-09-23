<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/delete.php";

// ---------------------------------------------- INPUT
$in['propuesta_id'] = is_null_id( clear_input( $_POST['propuesta_id'] ) );
$in['visita_id'] = is_null_id( clear_input( $_POST['visita_id'] ) );
$in['permiso'] = delete_validar_usuario($in);

// -------------------------------------------- PROCESS
if ($in['permiso']) {
  $ou = delete_visita( $in );
  echo 'aqui';
} else {
  echo 'SIN PERMISO';
}


// ---------------------------------------------- TEST
/*
print_test('$_POST', $_POST);
print_test('$input', $in);
print_test('$output', $ou);
*/
