<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/selects.php";

$select = new Coordinacion_Modelo_Eventos_Selects();
// -------------------------------------------------------- INPUT
$in['cotizacion_id'] = Utilidades::clear_input( $_POST['cotizacion_id'] );
$in['solicitante_id'] = Utilidades::clear_input( $_POST['solicitante_id'] );
$in['id'] = Utilidades::clear_input( $_POST['id'] );
$l = explode("-", $in['solicitante_id']);
$in['tipo_persona'] = $l[0];
$in['solicitante_id'] = $l[1];

// -------------------------------------------------------- OUTPUT
$select->solicitanteContactoId($in);