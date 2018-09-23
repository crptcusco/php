<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id  ($_POST['id']);
$in['consultor_id'] = Utilidades::clear_input_id  ($_POST['persona_id']);
// -------------------------------------------------------- OUTPUT
$button->saveItemOperacionJefe($in);
