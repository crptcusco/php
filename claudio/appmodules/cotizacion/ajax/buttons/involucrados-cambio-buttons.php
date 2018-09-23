<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

$input['id'] = clear_input( $_POST['id'] );
$input['valor'] = clear_input( $_POST['valor'] );
$input['cotizacion_id'] = clear_input( $_POST['co_id'] );

if ( $input['id'] != 1) {
    process_buttons_monto_moneda_cambio( $input );
}