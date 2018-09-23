<?php 
// ----------------- por defecto
// commentar entradas (mostrar tipo)
// commentar primero process
// commentar primero output
// descomentar test
// ------------------ pendientes
// mejoar print_tr, print_td

// ---------------------------------------------- ini-libs
include "../../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../modelo/buttons.php";

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
if ( $input['info_status'] == 'true' ) {
    $input['info_status'] = '1';
} elseif ( $input['info_status'] == 'false' ) {
    $input['info_status'] = '0';
}

/* $input[''] = clear_input( $_POST[''] );  */
/* $input[''] = utf8_encode( clear_input( $_POST[''] ) );  */
/* if ( $input['status'] == 'true' ) { */
/*     $input['status'] = '1'; */
/* } elseif ( $input['status'] == 'false' ) { */
/*     $input['status'] = '0'; */
/* } */
// ------------------------------------------------------- PROCESS
// mostrar primero sql
// mostrar resultado primario
// mostrar resultado secundario (copiar del listado general)
$output = set_buttons_involucrados_juridico( $input );

// ------------------------------------------------------- OUTPUT
echo $output['id'];
// if ( $input['id']==0 )
//     echo imprimir_tr( $output );
// else
//     echo imprimir_td( $output );

// ------------------------------------------------------- test
/* echo '<h3>POST</h3>'; */
/* echo '<pre>'; */
/* print_r($_POST); */
/* echo '</pre>'; */

/* echo '<h3>INPUT</h3>'; */
/* echo '<pre>'; */
/* print_r($input); */
/* echo '</pre>'; */

/* echo '<h3>OUTPUT</h3>'; */
/* echo '<pre>'; */
/* print_r($output); */
/* echo '</pre>'; */

// ------------------------------------------------------- FUNCTIONS
function imprimir_td( $row ) {
    if ( $row['status']==1 ){
    	$row['status'] = 'Activo';
    }else {
	$row['status'] = 'Desactivo';
    }
    $output = '
             <td>' . utf8_encode( $row['nombre'] ) . '</td>
             <td clasificacion_id="' . $row['clasificacion_id'] . '" >' . utf8_encode( $row['clasificacion_nombre'] ) . '</td>
             <td actividad_id="' . $row['actividad_id'] . '" >' . utf8_encode( $row['actividad_nombre'] ) . '</td>
             <td grupo_id="' . $row['grupo_id'] . '" >' . utf8_encode( $row['grupo_nombre'] ) . '</td>
             <td>' . utf8_encode( $row['ruc'] ) . '</td>
             <td>' . utf8_encode( $row['direccion'] ) . '</td>
             <td>' . utf8_encode( $row['telefono'] ) . '</td>
             <td>' . utf8_encode( $row['status'] ) . '</td>
             <td><a class="editar" codigo="' . $row['id'] . '">Editar</a></td>
          ';
    return $output;
}
function imprimir_tr( $row ) {
    $output = '
          <tr class="item_' . $row['id'] . '" codigo="' . $row['id'] . '">
          ' . imprimir_td( $row ) . '
          </tr>
          ';
    return $output;
}
