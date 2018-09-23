<?php
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../librerias.v2/utilidades.php";
include "./logica.php";
$logica = new Coordinacion_Modelo_Logica();
// -------------------------------------------------------- INPUT
$in['cotizacion_codigo'] = Utilidades::clear_input_id($_GET['cotizacion']);
$in['coordinacion_id'] = Utilidades::clear_input_id($_GET['coordinacion']);

// -------------------------------------------------------- OUTPUT
$logica->deleteCoordinacion($in);

header(sprintf(
    "Location: ./item.php?cotizacion=%d"
    , $in['cotizacion_codigo']
));