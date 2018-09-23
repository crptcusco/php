<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";
include "../../view/fechasDeEntrega_informe_coordinacion_item_view.php";
$button = new Coordinacion_Modelo_Eventos_Buttons();
$view = new Fechasdeentrega_Informe_Coordinacion_Item_View();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
$in['informe_id'] = Utilidades::clear_input_id($_POST['informe_id']);
$in['fecha'] = Utilidades::clear_input_date($_POST['fecha']);
$in['tipo_id'] = Utilidades::clear_input_id($_POST['informe_tipo_id']);
// print_r($in);
// -------------------------------------------------------- OUTPUT
$ou = $button->saveFechasDeEntregaItemInforme($in);
$view->getRol(Utilidades::clear_input($_POST['rol_user']));
$view->getMode(Utilidades::clear_input($_POST['mode']));
if ($in['id'] == '0') {
    $view->imprimirTr($ou);
} else {
    $view->imprimirTds($ou);
}
//print_r($ou);
