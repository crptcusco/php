<?php
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../librerias.v2/utilidades.php";
include "./logica.php";
$logica = new Coordinacion_Modelo_Logica();
// -------------------------------------------------------- INPUT
$in['cotizacion_codigo'] = Utilidades::clear_input_id($_GET['cotizacion']);
$in['solicitante_fecha'] = date('Y-m-d');
// print_r($in);
// -------------------------------------------------------- OUTPUT
$ou = $logica->newCoordinacion($in);
print_r($ou);

header(sprintf(
    "Location: ./item.php?cotizacion=%d&coordinacion=%d&modo=view"
    , $in['cotizacion_codigo']
    , $ou['coordinacion_id']
));





