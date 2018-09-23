<?php 
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "./logica.php";
include "./modelo/buttons.php";

// ------------------------ general ---------------------
if ( isset($_POST) ) {
  // codigo
  $input['codigo'] = clear_input($_POST['co_codigo']);
  // nuevo
  $input['id'] = clear_input($_POST['id']);
  // estado
  if ( empty( $_POST['co_actualizacion'] ) ) {
    $input['actualizacion'] = 0;
  } else {
    $input['actualizacion'] = 1;
  }
  // tipo_cotizacion y desgloce
  if ( empty( $_POST['co_tipo_cotizacion'] ) ) {
      $input['tipo_cotizacion'] = 0;
  } else {
      $input['tipo_cotizacion'] = clear_input($_POST['co_tipo_cotizacion']);
  }
  if ( empty( $_POST['co_desglose'] ) ) {
      $input['desglose'] = 0;
  } else {
      $input['desglose'] = clear_input($_POST['co_desglose']);
  }
  

  // tipo de servicio
  $input['tipo_servicio'] = clear_input($_POST['co_tipo_servicio']);
  // estado de cotizacion
  $input['estado_cotizacion'] = clear_input($_POST['co_estado_cotizacion']);
  // fechas solicitud
  $input['co_fecha_solicitud'] = str_to_timestamp( clear_input($_POST['co_fecha_solicitud']) );
  // fechas  envio al cliente
  $input['co_fecha_envio_cliente'] = str_to_timestamp( clear_input($_POST['co_fecha_envio_cliente']) );
  // fechas fianlizado
  $input['co_fecha_finalizado'] = clear_input($_POST['co_fecha_finalizado']);
  if ($input['estado_cotizacion'] != 1 && $input['co_fecha_finalizado'] =='') {
      $input['co_fecha_finalizado'] = date('Y-m-d');
  } else {
      $input['co_fecha_finalizado'] = str_to_timestamp( $input['co_fecha_finalizado'] );
  }
  

  $input['co_involucrados_vendedor'] = clear_input( $_POST['co_involucrados_vendedor'] );

  $codigo = set_cotizacion($input);

  // ------------------------------------------------ montos!!
  $input = null;
  $input['cotizacion_id'] = clear_input( $_POST['id'] );

  $input['sin'] = clear_input( $_POST['montos_sin'] );
  $input['sin'] = str_num_null( $input['sin'] );

  if (isset($_POST['montos_igv_si']) && $_POST['montos_igv_si'] == 'on') {
      $input['igv_si'] = 'true';
  } else {
      $input['igv_si'] = 'false';
  }

  $input['igv_monto'] = clear_input( $_POST['montos_igv_monto'] );
  if ($input['igv_si'] == 'false') {
      $input['igv'] = 0;
  } elseif($input['igv_si'] == 'true') {
      $input['igv'] = $input['igv_monto'];
  }
  unset($input['igv_si']);
  unset($input['igv_monto']);

  $input['con'] = clear_input( $_POST['montos_con'] );
  $input['con'] = str_num_null( $input['con'] );

  $input['moneda_id'] = clear_input( $_POST['montos_moneda_id'] );
  $input['cambio'] = clear_input( $_POST['montos_cambio'] );
  $input['cambio'] = str_num_null( $input['cambio'] );

  $input['de'] = clear_input( $_POST['montos_de'] );
  $input['fecha'] = date('Y-m-d');

  $son_numeros = true;
  if ( is_numeric( $input['sin'] )
       and is_numeric( $input['igv'] )
       and is_numeric( $input['con'] )
       and is_numeric( $input['cambio'] )
  ) {
      $son_numeros = true;
  } else {
      $son_numeros = false;
  }

  if ($son_numeros) {
      $output = set_buttons_montos($input);
  }

  
  // echo '<h2>Codigo</h2>';
  // echo '<pre>' . $codigo . '</pre>';
  // echo '<h2>POST</h2>';
  // echo '<pre>';
  // print_r($_POST);
  // echo '</pre>';
  // echo '<h2>INPUT</h2>';
  // echo '<pre>';
  // print_r($input);
  // echo '</pre>';
  
  if ( empty( $_POST['co_finalizada'] ) ) {
      header('Location: ./editar.php?cotizacion='.$codigo);
  }

  
}



