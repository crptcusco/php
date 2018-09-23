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
$in['id'] = Utilidades::clear_input( $_POST['id'] );
$in['modo'] = 'value';
// -------------------------------------------------------- OUTPUT
$select->bienListaCoordinacion($in);
/* echo '<pre>'; */
/* print_r($ou); */
/* echo '</pre>'; */
