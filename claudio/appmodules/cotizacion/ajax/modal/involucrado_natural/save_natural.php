<?php 
// ---------------------------------------------- ini-libs
include "../../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../modelo/modals.php";

// ------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['nombre'] = utf8_decode ( clear_input( $_POST['nombre'] ) );
$input['documento_tipo'] = utf8_decode ( clear_input( $_POST['documento_tipo'] ) );
$input['documento_numero'] = utf8_decode ( clear_input( $_POST['documento_numero'] ) ) ;
$input['direccion'] = utf8_decode ( clear_input( $_POST['direccion'] ) );
$input['telefono'] = utf8_decode ( clear_input( $_POST['telefono'] ) );
$input['correo'] = utf8_decode ( clear_input( $_POST['correo'] ) );
$input['status'] = clear_input( $_POST['status'] );
if ($input['status'] == 'true') {
    $input['status'] = 1;
} elseif ($input['status'] == 'false') {
    $input['status'] = 0;
}
// ------------------------------------------------------- PROCESS
$ou = set_modals_involucrados_natural($input);

// ------------------------------------------------------- OUTPUT
echo $ou['id'];


// ------------------------------------------------------- FUNCTIONS
?>