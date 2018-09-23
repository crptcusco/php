<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['coordinacion_id'] = Utilidades::clear_input_id($_POST['coordinacion_id']);
$in['impreso']      = Utilidades::clear_input($_POST['impreso']);
// -------------------------------------------------------- OUTPUT
// print_r($in);
$button->getImpresoCoordinacion($in);
