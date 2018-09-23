<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

$input['co_id'] = clear_input( $_POST['co_id'] );
$input['texto'] = $_POST['texto'];
$input['texto'] = utf8_decode( $input['texto'] );
$input['fecha'] = clear_input( $_POST['fecha'] );
$input['fecha-creacion'] = date('d-m-Y');
if ( trim( $input['fecha'] ) == '' ) {
    $input['fecha'] = date('Y-m-d 00:00:00');
    $input['proxima'] = 0;
} else {
    $input['fecha'] = substr($input['fecha'],6,10) . '-' . substr($input['fecha'],3,2) . '-' . substr($input['fecha'],0,2) . ' 00:00:00';
    $input['proxima'] = 1;
}
$input['estado_cotizacion'] = clear_input( $_POST['estado_cotizacion'] );

$output = set_buttons_mensaje($input);
$output['fecha'] = $output['fecha'] = substr($output['fecha'],8,2) . '-' . substr($output['fecha'],5,2) . '-' . substr($output['fecha'],0,4);

echo '
      <tr class="mensaje-lista-item item-' . $output['id'] . '">
        <td>' . utf8_encode( $output['usuario'] ) . '</td>
        <td>' . $input['fecha-creacion'] . '</td>
        <td>' . $output['fecha'] . '</td>
        <td>' . utf8_encode( $output['estado'] ) . '</td>
        <td>' . utf8_encode( $output['mensaje'] ) . '</td>
      </tr>
      ';
