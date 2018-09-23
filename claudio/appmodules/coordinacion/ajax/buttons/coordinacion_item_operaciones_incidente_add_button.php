<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";
$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['inspeccion_id'] = Utilidades::clear_input_id($_POST['inspeccion_id']);
$in['observacion'] = Utilidades::clear_input_text($_POST['texto']);
// print_r($in);
// -------------------------------------------------------- OUTPUT
$ou = $button->itemInspeccionObservacionAdd($in);
// print_r($ou);