<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/delete.php";

// ------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );

// ------------------------------------------------------- PROCESS
set_delete_involucrados($input);

// ------------------------------------------------------- OUTPUT

// ------------------------------------------------------- test
/*
echo 'POST';
print_r($_POST);
echo 'INPUT';
print_r($input);
*/
// ------------------------------------------------------- FUNCTIONS
