<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";
include '../../view/inspeccion_operaciones_coordinacion_item_view.php';
$button = new Coordinacion_Modelo_Eventos_Buttons();
$view = new Inspeccion_Operaciones_Coordinacion_Item_View();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id( $_POST['id']);
$in['rol_user'] = Utilidades::clear_input( $_POST['rol_user_id']);

$in['perito_id'] = Utilidades::clear_input_id($_POST['perito_id']);
$in['inspector_id'] = Utilidades::clear_input_id($_POST['inspector_id']);
$in['contactos'] = Utilidades::clear_input_text( $_POST['contactos']);
$in['fecha'] = str_to_timestamp($_POST['fecha']);

$in['hora_estimada'] = '';
$in['hora_estimada'].= Utilidades::fechas_de_meridiano_a_militar( array(
    'hora'        => Utilidades::clear_input_id($_POST['hora_estimada_ini_ho'])
    , 'minuto'    => Utilidades::clear_input_id($_POST['hora_estimada_ini_mi'])
    , 'meridiano' => Utilidades::clear_input($_POST['hora_estimada_ini_me'])
    , 'return'    => 'string'
));
$in['hora_estimada'].='-';
$in['hora_estimada'].= Utilidades::fechas_de_meridiano_a_militar( array(
    'hora'        => Utilidades::clear_input_id($_POST['hora_estimada_end_ho'])
    , 'minuto'    => Utilidades::clear_input_id($_POST['hora_estimada_end_mi'])
    , 'meridiano' => Utilidades::clear_input($_POST['hora_estimada_end_me'])
    , 'return'    => 'string'
));
$in['hora_estimada_mostrar'] = Utilidades::clear_input_bool($_POST['hora_estimada_mostrar']);    

$in['hora_real'] = Utilidades::fechas_de_meridiano_a_militar(array(
    'hora'        => Utilidades::clear_input_id($_POST['hora_real_ho'])
    , 'minuto'    => Utilidades::clear_input_id($_POST['hora_real_mi'])
    , 'meridiano' => Utilidades::clear_input($_POST['hora_real_me'])
    , 'return'    => 'string'
));
$in['hora_real_mostrar'] = Utilidades::clear_input_bool($_POST['hora_real_mostrar']);


$in['departamento_id'] = Utilidades::clear_input_id($_POST['departamento_id']);
$in['provincia_id'] = Utilidades::clear_input_id($_POST['provincia_id']);
$in['distrito_id'] = Utilidades::clear_input_id($_POST['distrito_id']);
$in['direccion'] = Utilidades::clear_input_text($_POST['direccion']);

$in['observacion'] = Utilidades::clear_input_text($_POST['observacion']);

// Utilidades::print_r('in',$in);
// -------------------------------------------------------- OUTPUT
$ou = $button->saveItemOperacionInspeccion($in);
// Utilidades::print_r('ou',$ou);
// print_r($ou1);
echo $view->imprimir($ou);

