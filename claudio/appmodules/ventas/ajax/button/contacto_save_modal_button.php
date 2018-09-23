<?php
// 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/button.php";

// ------------------------------------------------------- INPUT
$input['id'] = is_null_id( clear_input( $_POST['id'] ) );
$input['persona_id'] = is_null_id( clear_input( $_POST['persona_id'] ) );
$input['persona_tipo'] = clear_input( $_POST['persona_tipo'] );
$input['nombre'] = utf8_decode( clear_input( $_POST['nombre'] ) );
$input['cargo'] = utf8_decode( clear_input( $_POST['cargo'] ) );
$input['telefono'] = utf8_decode( clear_input( $_POST['telefono'] ) );
$input['correo'] = utf8_decode( clear_input( $_POST['correo'] ) );
$input['info_status'] = clear_input( $_POST['status'] );
if ( $input['info_status'] == 'true' ) {
    $input['info_status'] = '1';
} elseif ( $input['info_status'] == 'false' ) {
    $input['info_status'] = '0';
}

// ------------------------------------------------------- PROCESS
$output =  button_set_contacto( $input );

// ------------------------------------------------------- OUTPUT
if ( is_array( $output ) ) {
    if ($input['id']==0) {
	echo imprimir_tr($output);
    } elseif ($input['id']!=0) {
	echo imprimir_td($output);
    }
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
        <tr class="item item_' . $row['id'] . '" codigo="' . $row['id'] . '" persona_id="' . $row['persona_id'] . '">
         ' . imprimir_td($row) . '
        </tr>
         ';
}
function imprimir_td( $row ) {
    if ($row['status'] == '1') {
	$row['status'] = 'Activo';
    } elseif ($row['status'] == '0') {
	$row['status'] = 'Desactivo';
    }
    return '
          <td>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</td>
          <td>' . utf8_encode( strtoupper( $row['cargo'] ) ) . '</td>
          <td>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</td>
          <td>' . utf8_encode( $row['correo'] ) . '</td>
          <td>' . $row['status'] . '</td>
          <td><a class="editar" style="font-size: 0.8em">EDITAR</a> | <a class="delete" style="font-size: 0.8em;color:red;">ELIMINAR</a></td>
         ';
}
