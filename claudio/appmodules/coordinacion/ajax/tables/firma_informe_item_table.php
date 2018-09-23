<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/tables.php";
include '../../view/firma_informe_coordinacion_item_view.php';
$table = new Coordinacion_Modelo_Eventos_Tables();
$view = new Firma_Informe_Coordinacion_Item_View();
// -------------------------------------------------------- INPUT
$in['informe_id'] = Utilidades::clear_input_id($_POST['informe_id']);

// -------------------------------------------------------- OUTPUT
$ou = $table->firmaTable($in);
$view->getRol(Utilidades::clear_input($_POST['rol_user']));
$view->getMode(Utilidades::clear_input($_POST['mode']));
$view->imprimirTbody($ou);

/* echo '<tr><td><pre>'; */
/* print_r($ou); */
/* echo '</pre></td></tr>'; */
