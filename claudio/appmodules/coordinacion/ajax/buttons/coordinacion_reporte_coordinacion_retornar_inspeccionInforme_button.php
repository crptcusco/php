<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['inspecion_id'] = Utilidades::clear_input_id($_POST['inspecion_id']);

// -------------------------------------------------------- OUTPUT
$ou = $button->setReporteCoordinacionInspeccionInforme($in);

$ou['contactos'] = utf8_encode($ou['contactos']);
$ou['direccion'] = utf8_encode($ou['direccion']);
$h = explode("-", $ou['hora_estimada']);
unset($ou['hora_estimada']);
$h1 = explode(":",$h[0]);
$h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
$ou['hora_estimada_ini_ho'] = $h1['hora'];
$ou['hora_estimada_ini_mi'] = $h1['minuto'];
$ou['hora_estimada_ini_me'] = $h1['meridiano'];
$h2 = explode(":",$h[1]);
$h2 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h2[0], 'minuto'=>(int)$h2[1], 'return'=>'array'));
$ou['hora_estimada_end_ho'] = $h2['hora'];
$ou['hora_estimada_end_mi'] = $h2['minuto'];
$ou['hora_estimada_end_me'] = $h2['meridiano'];

$h1= explode(":", $ou['hora_real']);
unset($ou['hora_real']);
$h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
$ou['hora_real_ho'] = $h1['hora'];
$ou['hora_real_mi'] = $h1['minuto'];
$ou['hora_real_me'] = $h1['meridiano'];

$ou['hora_mostrar'] = 'nada';
if ($ou['hora_estimada_mostrar'] == '1') {
    $ou['hora_mostrar'] = 'estimada';
}
if ($ou['hora_real_mostrar'] == '1') {
    $ou['hora_mostrar'] = 'real';
}
unset($ou['hora_estimada_mostrar']);
unset($ou['hora_real_mostrar']);

/* $f = Utilidades::fechas_de_MysqlTimeStamp_a_array($ou['inspeccion_fecha']); */
/* $ou['inspeccion_fecha'] =  $f['dia'] . '-' . $f['mes'] . '-' . $f['anio']; */
/* if ($ou['inspeccion_fecha'] == '00-00-0000') { */
/*     $ou['inspeccion_fecha'] = ''; */
/* } */
// print_r($ou);
echo json_encode($ou);