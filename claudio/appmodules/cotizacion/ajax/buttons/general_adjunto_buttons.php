<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

// ------------------------------------------------------- INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
$input['archivo'] = clear_input( $_POST['archivo'] );
$input['archivo'] = utf8_encode( $input['archivo'] );

// ------------------------------------------------------- PROCESS
process_buttons_general_adjunto_save($input);

// ------------------------------------------------------- OUTPUT

// ------------------------------------------------------- TEST
/* echo 'POST'; */
/* print_r($_POST); */
/* echo 'INPUT'; */
/* print_r($input); */

// ------------------------------------------------------- FUNCTIONS
