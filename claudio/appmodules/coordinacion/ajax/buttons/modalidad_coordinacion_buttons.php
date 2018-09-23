<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['id']          = Utilidades::clear_input_id  ( $_POST['id']);
$in['nombre']      = Utilidades::clear_input_text( $_POST['nombre']);
$in['status']      = Utilidades::clear_input_bool($_POST['status']);
// -------------------------------------------------------- OUTPUT
// print_r($in);
$button->setModalidadCoordinacion($in);
