<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/deletes.php";

$delete = new Coordinacion_Modelo_Eventos_Deletes(); 

// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
// print_r($in);
// -------------------------------------------------------- OUTPUT
$delete->fechasDeEntregaInformeItem($in);
