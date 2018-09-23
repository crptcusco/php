<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../logica.php";
include ("../../../../librerias.v2/html/tabla.php");

// ------------------------------------------------------- INPUT
// general
$input['general_actualizacion_si'] = is_true_false_str( $_POST['general_actualizacion_si'] );
$input['general_actualizacion_no'] = is_true_false_str( $_POST['general_actualizacion_no'] );
$input['general_tipo_servicio'] = is_nulo_id( $_POST['general_tipo_servicio'] );
$input['general_estado_cotizacion'] = is_nulo_id( $_POST['general_estado_cotizacion'] );
// involucrados
$input['involucrados_coordinador_id'] = is_nulo_id( $_POST['involucrados_coordinador_id'] );
$input['involucrados_rol_cliente'] = is_true_false_str( $_POST['involucrados_rol_cliente'] );
$input['involucrados_rol_solicitante'] = is_true_false_str( $_POST['involucrados_rol_solicitante'] );
$input['involucrados_rol_propietario'] = is_true_false_str( $_POST['involucrados_rol_propietario'] );
$input['involucrados_rol'] = 
       $input['involucrados_rol_cliente'] 
    + $input['involucrados_rol_solicitante']
    + $input['involucrados_rol_propietario'] ;

if ($input['involucrados_rol'] > 0) {
  $input['involucrados_tipo_juridico'] = is_true_false_str( $_POST['involucrados_tipo_juridico'] );
  $input['involucrados_tipo_natural'] = is_true_false_str( $_POST['involucrados_tipo_natural'] );
  if ($input['involucrados_tipo_juridico']) {
    $input['involucrados_tipo'] = 'jurudico';
    $input['involucrados_juridico_id'] = is_nulo_id( $_POST['involucrados_juridico_id'] );
    $input['involucrados_juridico_contacto_id'] = is_nulo_id( $_POST['involucrados_juridico_contacto_id'] );
  } elseif ($input['involucrados_tipo_natural']) {
    $input['involucrados_tipo'] = 'natural';
    $input['involucrados_natural_id'] = is_nulo_id( $_POST['involucrados_natural_id'] );
  }
  unset( $input['involucrados_tipo_juridico'] );
  unset( $input['involucrados_tipo_natural'] );
}
//unset( $input['involucrados_rol'] );
$input['involucrados_vendedor_id'] = is_nulo_id( $_POST['involucrados_vendedor_id'] );
//bienes
$input['bienes_cateroria_ninguno'] = is_true_false_str( $_POST['bienes_cateroria_ninguno'] );
$input['bienes_cateroria_mueble'] = is_true_false_str( $_POST['bienes_cateroria_mueble'] );
$input['bienes_cateroria_inmueble'] = is_true_false_str( $_POST['bienes_cateroria_inmueble'] );
if ( $input['bienes_cateroria_mueble'] ) {
    $input['bienes_sub_cateroria_mueble'] = is_nulo_id( $_POST['bienes_sub_cateroria_mueble'] );
    $input['bienes_sub_mueble_tipo'] = is_nulo_id( $_POST['bienes_sub_mueble_tipo'] );
    $input['bienes_sub_mueble_marca'] = is_nulo_id( $_POST['bienes_sub_mueble_marca'] );
    $input['bienes_sub_mueble_modelo'] = is_nulo_id( $_POST['bienes_sub_mueble_modelo'] );
    $input['bienes_sub_mueble_descripcion'] = validate_str( $_POST['bienes_sub_mueble_descripcion'] );
}
if ($input['bienes_cateroria_inmueble']) {
    $input['bienes_sub_cateroria_inmueble'] = is_nulo_id( $_POST['bienes_sub_cateroria_inmueble'] );
    $input['bienes_sub_inmueble_departamento'] = is_nulo_id( $_POST['bienes_sub_inmueble_departamento'] );
    $input['bienes_sub_inmueble_provincia'] = is_nulo_id( $_POST['bienes_sub_inmueble_provincia'] );
    $input['bienes_sub_inmueble_distrito'] = is_nulo_id( $_POST['bienes_sub_inmueble_distrito'] );
    $input['bienes_sub_inmueble_direccion'] = validate_str( $_POST['bienes_sub_inmueble_direccion'] );
}
// $input[''] = is_true_false_str( $_POST[''] );
// $input[''] = is_nulo_id( $_POST[''] );
//$input['direccion'] = utf8_encode( $input['direccion'] );

// ------------------------------------------------------- PROCESS
$output = find_cotizacion( $input );
if( is_array($output) ) {
  $code = 'codigo'; //con esto comparara
  $output[] = array( $code => 0 );
  $count = count( $output ) - 1;
  // necesario
  $cliente = '';
  $propietario = '';
  $cliente_l = array();
  $propietario_l = array();  
}


$involucrados = find_involucrados( );
$monedas = find_monedas( );
// ------------------------------------------------------- OUTPUT
?>
<table border="1">
  <thead>
    <tr>
      <th class="text-center">Cotización</th>
      <th class="text-center">Servicio Tipo</th>
      <th class="text-center">Coordinador</th>
      <th class="text-center">Vendedor</th>
      <th class="text-center">Cliente</th>
      <th class="text-center">Solicitate</th>
      <th class="text-center">Monto inc. IGV</th>
      <th class="text-center">Fecha solicitud</th>
      <th class="text-center">Fecha envio</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Coordinación</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if( is_array($output) ) {
      for ($i=0;$i<=$count;$i++) {
	if ( $output[$i][$code] != 0 ) {
	  if ( array_search($output[$i]['1_persona_tipo'] . '-' . $output[$i]['1_persona_id'] , $cliente_l) === False ) {
	    $cliente_l[] = $output[$i]['1_persona_tipo'] . '-' . $output[$i]['1_persona_id'];
	    $cliente .= get_name( $output[$i]['1_persona_tipo'], $output[$i]['1_persona_id'] );
	  }
	  if ( array_search($output[$i]['2_persona_tipo'] . '-' . $output[$i]['2_persona_id'] , $propietario_l) === False ) {
	    $propietario_l[] = $output[$i]['2_persona_tipo'] . '-' . $output[$i]['2_persona_id'];
	    $propietario .= get_name( $output[$i]['2_persona_tipo'], $output[$i]['2_persona_id']);
	  }  
	  if ( $output[$i][$code] != $output[$i+1][$code] ) {
	    $output[$i]['cliente']     = '<ul>' . $cliente . '</ul>';
	    $output[$i]['solicitante'] = '<ul>' . $propietario . '</ul>';
	    imprimir( $output[$i] );
	    $cliente = '';
	    $propietario = '';
	    $cliente_l = array();
	    $propietario_l = array();
	  }
	}
      } //endfor
    }
    ?>
  </tbody>
</table>


<?php
// ------------------------------------------------------- test
// print_test('$_POST', $_POST);
// print_test('$input', $input);
// print_test('$output', $output);
// print_test('$involucrados', $involucrados);
// print_test('$monedas', $monedas);

// ------------------------------------------------------- FUNCTIONS
function imprimir( $row ) {
  // Tipo de servicio / Cliente / Contacto / Monto / Fecha de envío al cliente / Estado de cotización
  global $monedas;
  if ($row['fecha_solicitud'] == '00-00-0000')
    $row['fecha_solicitud'] = '';
  if ($row['fecha_envio'] == '00-00-0000')
    $row['fecha_envio'] = '';
  $row['str_aprobado'] = '';
  if ($row['estado'] == 'Aprobado') {
      $row['str_aprobado'] = '<a href="../coordinacion/item.php?cotizacion=' . $row['codigo'] . '" target="coordinacion_item" title="ver coordinaciones">Ver</a>';
  }
  echo '
          <tr>
              <td class="text-center"><a href="./editar.php?cotizacion=' . $row['codigo'] . '" target="cotizacion_item" title="ver cotización">' . sprintf("%'010s", $row['codigo'])  . '</a></td>
              <td class="text-center">' . utf8_encode( $row['servicio_tipo'] ) . '</td>
              <td class="text-center">' . utf8_encode( $row['coordinador'] ) . '</td>
              <td class="text-center">' . utf8_encode( $row['vendedor'] ) . '</td>
              <td>' . $row['cliente'] . '</td>
              <td>' . $row['solicitante'] . '</td>
              <td class="text-right">' . $monedas[ $row['total_moneda'] ] . ' ' . sprintf('%.2f', $row['total_con_igv'] ) . '</td>
              <td>' . $row['fecha_solicitud'] . '</td>
              <td>' . $row['fecha_envio'] . '</td>
              <td>' . $row['estado'] . '</td>
              <td class="text-center">' . $row['str_aprobado'] . '</td>
          </tr>
     ';    
  
}
function get_name($tipo, $id) {
  global $involucrados;
  if ( $tipo != '' && $id != '' ) {
    return '<li>' . $involucrados[ $tipo . '-' . $id ] . '</li>';
  } else {
    return '';
  }  
}
