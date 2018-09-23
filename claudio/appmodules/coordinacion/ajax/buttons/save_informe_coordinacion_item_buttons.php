<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();

// -------------------------------------------------------- INPUT
$in['informe_id'] = Utilidades::clear_input_id($_POST['informe_id']);
$in['ruta'] = Utilidades::clear_input_ruta($_POST['ruta']);
// -------------------------------------------------------- OUTPUT
$button->saveItemInforme($in);
