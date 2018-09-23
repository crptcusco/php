<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";
include "../../modelo/tables.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
$table = new Coordinacion_Modelo_Eventos_Tables();
// -------------------------------------------------------- INPUT
$in['coordinacion_id'] = Utilidades::clear_input_id( $_POST['coordinacion_id']);
$in['cotizacion_id'] = $button->setCotizacionId_by_coordinacionId($in['coordinacion_id']);
$in['modo'] = 'value';

// -------------------------------------------------------- OUTPUT
$ou = $table->bienListaCoordinacion($in);
$first = true;

if (is_array($ou)) {
    foreach ($ou as $row) {
        if (!$first) {
            echo '<hr>';
        }
        echo '<span>'. utf8_decode($row['descripcion']).'</span>';
        $first = false;
        
    }
}
