<?php
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/selects.php";

$select = new Coordinacion_Modelo_Eventos_Selects();
// -------------------------------------------------------- INPUT
$in['persona_rol_id'] = Utilidades::clear_input( $_POST['persona_rol_id'] );
$in['persona_id'] = Utilidades::clear_input( $_POST['persona_id'] );

// -------------------------------------------------------- OUTPUT
$select->peritoOinspectorId($in);