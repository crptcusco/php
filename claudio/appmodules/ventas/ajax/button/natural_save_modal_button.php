<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/button.php";

// ------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['nombre'] = utf8_decode ( clear_input( $_POST['nombre'] ) );
$input['documento_tipo_id'] = utf8_decode ( clear_input( $_POST['documento_tipo'] ) );
$input['documento'] = utf8_decode ( clear_input( $_POST['documento_numero'] ) ) ;
$input['direccion'] = utf8_decode ( clear_input( $_POST['direccion'] ) );
$input['telefono'] = utf8_decode ( clear_input( $_POST['telefono'] ) );
$input['correo'] = utf8_decode ( clear_input( $_POST['correo'] ) );
$input['info_status'] = clear_input( $_POST['status'] );

if     ($input['info_status'] == 'true') { $input['info_status'] = 1; }
elseif ($input['info_status'] == 'false') { $input['info_status'] = 0; }

$input['vendedor_id'] = is_null_id( clear_input( $_POST['vendedor'] ) );
$input['estado_id'] = is_null_id( clear_input( $_POST['persona_estado'] ) );
$input['observacion'] = utf8_decode( clear_input( $_POST['observacion'] ) );

$input['importante_id'] = clear_input( $_POST['importante_id'] ); 

$input['referido_id'] = is_null_id( clear_input( $_POST['referido'] ) );

// $input['existe_documento'] = button_existe_documento( array( 'in_id'=>$input['id'], 'in_documento'=>$input['documento'], 'in_documento_tipo_id' => $input['documento_tipo_id'] ) );


$input['rol_id'] = button_rol_id_by_user();
if ( $input['rol_id'] != 2 ){
    $input['vendedor_id'] = button_vendedor_id_by_user(); 
}

// ------------------------------------------------------- PROCESS
$output = button_set_natural($input);

// ------------------------------------------------------- OUTPUT
if ( is_array( $output ) ) {
    if ($input['id']==0) 
	echo imprimir_tr($output);
    else
	echo imprimir_td($output);
}

// ------------------------------------------------------- TEST
/*
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
*/

// ------------------------------------------------------- FUNCTIONS
function imprimir_tr($row) {
  return '
          <tr class="lista_natural_ajax_item item_' . $row['id'] . '">
          ' . imprimir_td($row) . '
          </tr>
      ';
}
function imprimir_td($row) {
  if (trim( $row['persona_estado_nombre'] ) == '') {
      $row['persona_estado_nombre'] = '[vacio]';
      $row['persona_estado_id'] = '0';
  }
  if (trim( $row['vendedor'] ) == '') {
      $row['vendedor'] = '[vacio]';
      $row['vendedor_id'] = '0';
  }
  return '
             <td documento_tipo_id="' . $row['documento_id'] . '"
                 estado="' . utf8_encode( $row['info_status'] ) . '"  
                 importante="' . utf8_encode( $row['importante_id'] ) . '" 
                 referido="' . utf8_encode( $row['referido'] ) .'"
             >
               <span>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</span><br>
               ' . utf8_encode( strtoupper( $row['documento_tipo'] ) ) . ':<span>' . utf8_encode( strtoupper( $row['documento_numero'] ) ) . '</span><br>
               <u>TELÉFONO</u>: <span>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</span><br>
               <u>CORREO</u>: <span>' . utf8_encode( $row['correo'] ) . '</span>
             </td>
             <td>' . utf8_encode( strtoupper( $row['direccion'] ) ) . '</td>
             <td>' . utf8_encode( strtoupper( $row['observacion'] ) ) . '</td>
             <td vendedor_id="' . $row['vendedor_id'] . '" >' . utf8_encode( strtoupper( $row['vendedor'] ) ) . '</td>
             <td persona_estado_id="' . $row['persona_estado_id'] . '" >' . utf8_encode( strtoupper( $row['persona_estado_nombre'] ) ) . '</td>
             <td><a class="editar" codigo="' . $row['id'] . '">EDITAR</a></td>
      ';
}

