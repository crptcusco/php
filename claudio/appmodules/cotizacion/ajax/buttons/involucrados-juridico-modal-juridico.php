<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";


// -------------------------------------------------- INPUT
$in['id'] = clear_input($_POST['id']);


// -------------------------------------------------- TEST
/*
echo '<h1>POST</h1>';
print_r( $_POST );
echo '<h1>INPUT</h1>';
print_r( $input );
echo '<h1>OUTPUT</h1>';
print_r( $output );
*/


// -------------------------------------------------- OUTPUT
$ou = set_buttons_involucrados_juridico_modal_juridico($in);
echo json_encode($ou);

