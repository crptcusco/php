<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";
// --------------------------------------------- INPUT
$input['igv'] = clear_input( $_POST['igv'] );
$input['cotizacion_id'] = clear_input( $_POST['co_id'] );

// --------------------------------------------- PROCCESS
process_buttons_monto_peritos_igv( $input );

// --------------------------------------------- test
echo '<h2>POST</h2>';
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '<h2>INPUT</h2>';
echo '<pre>';
print_r($input);
echo '</pre>';
