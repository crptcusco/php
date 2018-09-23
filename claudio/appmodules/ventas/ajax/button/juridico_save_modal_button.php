<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/button.php";
// ------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] ); 
$input['nombre'] = utf8_decode( clear_input( $_POST['razon'] ) ); 
$input['ruc'] = utf8_decode( clear_input( $_POST['ruc'] ) ); 
$input['telefono'] = utf8_decode( clear_input( $_POST['telefono'] ) ); 
$input['direccion'] = utf8_decode( clear_input( $_POST['direccion'] ) ); 
$input['clasificacion_id'] = is_null_id( clear_input( $_POST['clasificacion_id'] ) ); 
$input['actividad_id'] = is_null_id( clear_input( $_POST['actividad_id'] ) ); 
$input['grupo_id'] = is_null_id( clear_input( $_POST['grupo_id'] ) ); 
$input['info_status'] = clear_input( $_POST['status'] ); 
if ( $input['info_status'] == 'true' ) { $input['info_status'] = '1';}
elseif ( $input['info_status'] == 'false' ) { $input['info_status'] = '0'; }
$input['vendedor_id'] = is_null_id( clear_input( $_POST['vendedor'] ) );
$input['estado_id'] = is_null_id( clear_input( $_POST['persona_estado'] ) );
$input['observacion'] = utf8_decode( clear_input( $_POST['observacion'] ) );
$input['importante_id'] = clear_input( $_POST['importante_id'] ); 
$input['referido_id'] = is_null_id( clear_input( $_POST['referido'] ) );
$input['existe_ruc'] = button_existe_ruc( array( 'in_id'=>$input['id'],'in_ruc'=>$input['ruc']) );
print_r( $input['existe_ruc'] );
$input['rol_id'] = button_rol_id_by_user();
if ( $input['rol_id'] != 2 ){
    $input['vendedor_id'] = button_vendedor_id_by_user(); 
}
// ------------------------------------------------------- OUTPUT
if ( $input['existe_ruc']) {
  $output =  button_set_juridico($input);
  if (is_array( $output ) ) {
    if ($input['id']==0)
      echo imprimir_tr($output);
    else
      echo imprimir_td($output);
  }  
} else {
  echo 'Ya Existe Ruc';
}
// ------------------------------------------------------- TEST
/*
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
*/
// ------------------------------------------------------- FUNCTIONS
function imprimir_tr( $row ) {
  return '
         <tr class="item_' . $row['id'] . '" codigo="' . $row['id'] . '">
         ' . imprimir_td( $row ) . '
         </tr>
         ';
}
function imprimir_td( $row ) {
  
  if (trim( $row['persona_estado_nombre'] ) == '')
      { $row['persona_estado_nombre'] = '[vacio]'; }
  if (trim( $row['vendedor'] ) == '')
      { $row['vendedor'] = '[vacio]'; }
  return '
             <td clasificacion_id="' . $row['clasificacion_id'] . '" 
                 actividad_id="' . $row['actividad_id'] . '" 
                 grupo_id="' . $row['grupo_id'] . '"                  
                 estado="' . utf8_encode( $row['status'] ) . '" 
                 importante="' . utf8_encode( $row['importante_id'] ) . '" 
                 referido="' . utf8_encode( $row['referido'] ) .
              '"><span>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</span> <br>
                 <u>RUC</u>: <span>' . utf8_encode( strtoupper( $row['ruc'] ) ) . '</span> <br>
                 <u>TELÉFONOS</u>: <span>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</span> <br>
             </td>
             <td>' . utf8_encode( strtoupper( $row['direccion'] ) ) . '</td>
             <td>' . utf8_encode( strtoupper($row['observacion'] ) ) . '</td>
             <td vendedor_id="' . $row['vendedor_id'] . '" >' . utf8_encode( strtoupper( $row['vendedor'] ) ) . '</td>
             <td persona_estado_id="' . $row['persona_estado_id'] . '" >' . utf8_encode( strtoupper( $row['persona_estado_nombre'] ) ) . '</td>
             <td><a class="editar" codigo="' . $row['id'] . '">EDITAR</a></td>
       ';
}