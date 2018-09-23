<?php 

include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/checkbox.php";

// ---------------------------------------------- INPUT
$input['estado'] = clear_input( $_POST['estado'] );
$input['servicio_tipo_id'] = clear_input($_POST['servicio_tipo_id']);
$input['propuesta_id'] = clear_input($_POST['propuesta_id']);

// ---------------------------------------------- PROCESS
$output = checkbox_set_servicio_tipo_has_propuesta( $input );

// ---------------------------------------------- OUTPUT
/*
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
*/    
// ---------------------------------------------- OUTPUT

// ---------------------------------------------- FUNCTIONS