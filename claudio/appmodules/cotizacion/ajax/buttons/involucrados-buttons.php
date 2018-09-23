<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

// -------------------------------------------------- IN-PUT
$input['id'] = clear_input( $_POST['id'] );
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
$input['cliente'] = clear_input( $_POST['cliente'] );
$input['solicitante'] = clear_input( $_POST['solicitante'] );
$input['propietario'] = clear_input( $_POST['propietario'] );
$input['persona_tipo'] = clear_input( $_POST['persona_tipo'] );
$input['persona_id'] = clear_input( $_POST['persona_id'] );
$input['contacto_id'] = clear_input( $_POST['contacto_id'] );
if ( trim( $input['contacto_id'] ) =='' )
    $input['contacto_id'] = 0;

// -------------------------------------------------- PROCESS
if ( $input['cliente'] == 'true' ) {
    $input['rol_id'] = 1;
    $output = process_buttons_involucrados( $input );
    if ($input['id']==0) {
	echo imprimir_tr( $output );
    } else {
	echo imprimir_td( $output );
    }
}
if ( $input['solicitante'] == 'true' ) {
    $input['rol_id'] = 2;
    $output = process_buttons_involucrados( $input );
    if ($input['id']==0) {
	echo imprimir_tr( $output );
    } else {
	echo imprimir_td( $output );
    }
}
if ( $input['propietario'] == 'true' ) {
    $input['rol_id'] = 3;
    $output = process_buttons_involucrados( $input );
    if ($input['id']==0) {
	echo imprimir_tr( $output );
    } else {
	echo imprimir_td( $output );
    }
}
// -------------------------------------------------- FUNCTION
function imprimir_td( $row ) {
    if ($row['persona_tipo'] == 'Juridica') {
	$l = explode("_--|", $row['persona_nombre'] ); 
	$row['persona_nombre'] = $l[0];
	$row['persona_nombre'].= '<br><o>Contacto:</o> ' . $l[1];
	$row['persona_nombre'].= '<br><o>Cargo:</o> ' . $l[2];
	$row['persona_tipo_id'] = 2;
	$row['persona_tipo'] = 'Jurídico';
    } elseif($row['persona_tipo'] == 'Natural') {
	$row['persona_tipo_id'] = 1;
    }
    return sprintf(
'
   <td>%s</td>
   <td>%s</td>
   <td>%s</td>
   <td>%s</td>
   <td>%s</td>
   <td>%s</td>
   <td>
      <a href="#" codigos="%s!!-!!%s!!-!!%s!!-!!%s!!-!!%s" class="edit">Editar</a> |
      <a href="#" codigo="%s" class="delete">Eliminar</a>
   </td>
'
, utf8_encode($row['rol_nombre'])
, $row['persona_tipo']
, utf8_encode($row['persona_nombre'])
, utf8_encode($row['persona_documento'])
, utf8_encode($row['persona_telefono'])
, utf8_encode($row['persona_correo'])
, $row['id']
, $row['rol_id']
, $row['persona_tipo_id']
, $row['persona_id']
, $row['contacto_id']
, $row['id']
		   );
}
function imprimir_tr( $row ) {
    return sprintf(
'
<tr class="item-%s">
  %s
</tr>
'
, $row['id']
, imprimir_td( $row ) 
		   );
}

// -------------------------------------------------- TESTING
/*
echo '<h1>POST</h1>';
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo '<h1>INPUT</h1>';
echo '<pre>';
print_r($input);
echo '</pre>';
echo '<h1>OUTPUT</h1>';
echo '<pre>';
print_r($output);
echo '</pre>';
*/

