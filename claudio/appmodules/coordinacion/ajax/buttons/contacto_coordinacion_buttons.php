<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['id']          = Utilidades::clear_input_id  ( $_POST['id']);
$in['persona_id'] = Utilidades::clear_input_id  ($_POST['persona_id']);
$l = explode("-", $in['persona_id']);
$in['persona_tipo'] = $l[0];
$in['persona_id'] = $l[1];
$in['nombre']      = Utilidades::clear_input_text( $_POST['nombre']);
$in['cargo']       = Utilidades::clear_input_text($_POST['cargo']);
$in['telefono']    = Utilidades::clear_input_text($_POST['telefono']);
$in['correo']      = Utilidades::clear_input_text($_POST['correo']);
$in['status']      = Utilidades::clear_input_bool($_POST['status']);
// -------------------------------------------------------- OUTPUT
$button->setContacto($in);
