<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tables.php";
 
// ----------------------------------------------- INPUT
$in['intervalo'] = clear_input( $_POST['intervalo'] );

if ( (int) $in['intervalo'] == 0 ) {
  $in['ini'] = date( 'Y-m-d' );
  $in['end'] = date( 'Y-m-d' );
}elseif ( (int) $in['intervalo'] < 0 ) {
  $in['ini'] = date( 'Y-m-d', strtotime($in['intervalo'].' day') );
  $in['end'] = date( 'Y-m-d', strtotime('-1 day') );  
}elseif ( (int) $in['intervalo'] > 0 ) {
    $in['ini'] = date( 'Y-m-d', strtotime('+1 day') );
  $in['end'] = date( 'Y-m-d', strtotime($in['intervalo'].' day') );
} 

// --------------------------------------------- PROCESS
$ou = get_tables_box_mensajes($in);

// ---------------------------------------------- OUTPUT
if ( is_array($ou) ) {
  foreach($ou as $row) {
    imprimir($row);
  }
}

// ------------------------------------------------ TEST
//echo '<tr><td colspan="4">';
//print_test('Post', $_POST);
//print_test('Input', $in);
//print_test('Output', $ou);
//echo '</td></tr>';

// -------------------------------------------- FUNCTION

function imprimir( $row ) {
  echo '
       <tr>
         <td><a target="cotizacion_item" href="./editar.php?cotizacion=' . $row['codigo'] . '">' . $row['codigo'] . '</a></td>
         <td>' . $row['fecha'] . '</td>
         <td>' . utf8_encode( $row['mensaje'] ) . '</td>
         <td>' . utf8_encode( $row['estado'] ) . '</td>
       </tr>'
  ;

}

 ?>