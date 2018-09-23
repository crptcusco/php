<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";

$button = new Coordinacion_Modelo_Eventos_Buttons();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id( $_POST['id'] );
$in['estado_id'] = Utilidades::clear_input_id( $_POST['estado_id'] );
$in['solicitante_id'] = Utilidades::clear_input( $_POST['solicitante_id'] );
$l = explode("-", $in['solicitante_id']);
$in['solicitante_tipo'] = $l[0];
$in['solicitante_id'] = $l[1];
$in['solicitante_contacto_id'] = Utilidades::clear_input_id( $_POST['solicitante_contacto_id'] );
$in['solicitante_fecha'] = Utilidades::clear_input_date( $_POST['solicitante_fecha'] );

$in['entrega_por_operaciones_fecha'] = Utilidades::clear_input_date( $_POST['entrega_por_operaciones_fecha'] );
$in['entrega_al_cliente_fecha'] = Utilidades::clear_input_date( $_POST['entrega_al_cliente_fecha'] );

$in['cliente_id'] = Utilidades::clear_input( $_POST['cliente_id'] );
$l = explode("-", $in['cliente_id']);
$in['cliente_tipo'] = $l[0];
$in['cliente_id'] = $l[1];
$in['sucursal'] = Utilidades::clear_input_text( $_POST['sucursal'] );
$in['modalidad_id'] = Utilidades::clear_input_id( $_POST['modalidad_id'] );
$in['tipo_id_1'] = Utilidades::clear_input( $_POST['tipo_id_1'] );
if ($in['tipo_id_1']=='true') $in['tipo_id'] = '1';
$in['tipo_id_2'] = Utilidades::clear_input( $_POST['tipo_id_2'] );
if ($in['tipo_id_2']=='true') $in['tipo_id'] = '2';
$in['tipo_id_3'] = Utilidades::clear_input( $_POST['tipo_id_3'] );
if ($in['tipo_id_3']=='true') $in['tipo_id'] = '3';

$in['tipo2_id'] = Utilidades::clear_input_id( $_POST['tipo2_id'] );
$in['tipo_cambio_id'] = Utilidades::clear_input_id( $_POST['cambio_id'] );
$in['observacion'] = Utilidades::clear_input_text( $_POST['observacion'] );

// Utilidades::print_r('IN', $in);
 
// -------------------------------------------------------- OUTPUT
$button->setCoordinacion($in);

