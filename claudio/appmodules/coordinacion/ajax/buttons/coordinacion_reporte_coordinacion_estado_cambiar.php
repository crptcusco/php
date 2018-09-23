<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['coordinacion_id'] = Utilidades::clear_input_id( $_POST['coordinacion_id']);
$in['coordinacion_estado_id'] = Utilidades::clear_input_id($_POST['coordinacion_estado_id']);
if ( $in['coordinacion_estado_id'] == '1') {
    $in['coordinacion_estado_id'] = '2';
} elseif ( $in['coordinacion_estado_id'] == '2') {
    $in['coordinacion_estado_id'] = '1';
}
// print_r($in);

// -------------------------------------------------------- OUTPUT
$ou = $button->setReporteCoordinacionEstadoCambiar($in);
// print_r($ou);