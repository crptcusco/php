<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";
include "../../view/documentacion_informe_coordinacion_item_view.php";
$button = new Coordinacion_Modelo_Eventos_Buttons();
$view = new Documentacion_Informe_Coordinacion_Item_View();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
$in['informe_id'] = Utilidades::clear_input_id($_POST['informe_id']);
$in['enlace'] = Utilidades::clear_input_ruta($_POST['ruta']);
$in['descripcion'] = Utilidades::clear_input_text($_POST['descripcion']);
// print_r($in);
// -------------------------------------------------------- OUTPUT
$ou = $button->saveDocumentacionItemInforme($in);
// print_r($ou);
$view->getRol(Utilidades::clear_input($_POST['rol_user']));
$view->getMode(Utilidades::clear_input($_POST['mode']));
if ($in['id'] == '0') {
    $view->imprimirTr($ou);
} else {
    $view->imprimirTds($ou);
}

