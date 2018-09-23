<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['persona_id'] = Utilidades::clear_input_id($_POST['persona_id']);
$in['cotizacion_id'] = Utilidades::clear_input_id($_POST['cotizacion_id']);
if (Utilidades::clear_input_bool($_POST['juridica'])=='1') {
    $in['persona_tipo']='Juridica';
}
if (Utilidades::clear_input_bool($_POST['natural'])=='1') {
    $in['persona_tipo']='Natural';
}

if ( Utilidades::clear_input( $_POST['persona_rol']) == 'cliente') {
    $in['persona_rol_id'] = '1';
} elseif ( Utilidades::clear_input( $_POST['persona_rol']) == 'solicitante') {
    $in['persona_rol_id'] = '2';
}
// print_r($in);
// -------------------------------------------------------- OUTPUT
$button->addPersonaToCoordinacion($in);
echo $in['persona_tipo'] . '-' . $in['persona_id'];