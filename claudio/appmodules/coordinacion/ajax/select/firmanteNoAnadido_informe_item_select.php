<?php
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/selects.php";

$select = new Coordinacion_Modelo_Eventos_Selects();
// -------------------------------------------------------- INPUT
$in['informe_id'] = Utilidades::clear_input_id( $_POST['informe_id'] );
$in['id'] = Utilidades::clear_input_id( $_POST['id'] );
// -------------------------------------------------------- OUTPUT
$select->firmanteIdNoAnadido($in);
