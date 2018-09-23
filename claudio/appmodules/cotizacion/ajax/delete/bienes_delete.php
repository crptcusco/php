<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/delete.php";

// ------------------------------------------------------- INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
$input['categoria_id'] = clear_input( $_POST['categoria_id'] );
$input['sub_categoria_id'] = clear_input( $_POST['sub_categoria_id'] );
$input['id'] = clear_input( $_POST['id'] );

// ------------------------------------------------------- PROCESS

set_delete_bienes_peritos($input);

// ------------------------------------------------------- OUTPUT

// ------------------------------------------------------- test
/*
echo 'POST';
print_r($_POST);
echo 'INPUT';
print_r($input);
*/
// ------------------------------------------------------- FUNCTIONS
