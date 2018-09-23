<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/button.php";
include "../../logica.php";

// -------------------------------------------------------- INPUT
$in['id'] = clear_input( $_POST['vendedor_id'] );
$in['rol_id'] = clear_input( $_POST['vendedor_rol_id'] );
$in['nombre'] = utf8_decode( clear_input( $_POST['nombre'] ) );
$in['telefono'] = utf8_decode( clear_input( $_POST['telefono'] ) );
$in['correo'] = utf8_decode( clear_input( $_POST['correo'] ) );
$in['estado'] = utf8_decode( clear_input( $_POST['estado'] ) );

if ($in['estado']=='true') {
    $in['estado'] = 1;
}elseif ($in['estado']=='false') {
    $in['estado'] = 0;
}
$in['login'] = utf8_decode( clear_input( $_POST['login'] ) );
$in['pass'] = md5( clear_input( $_POST['password'] ) );
$in['pass_pregunta'] = clear_input( $_POST['password_save'] );

// ------------------------------------------------------- PROCESS

if ( button_exite_process($in['login'], $in['id']) == 0 ) {
    $ou = button_vendedor_save_and_view( $in );
    if ( $in['id']==0 )
	echo imprimir_tr( $ou );
    else
	echo imprimir_td( $ou );
} else {
    echo 'LoginExistente';
}
// ------------------------------------------------------- TEST
/* 
print_test('$in',$in); 
print_test('$ou',$ou);
*/
// -------------------------------------------------- FUNSTIONS
function imprimir_tr($row) {
    return
'
<tr class="item item_' . $row['id'] . '" vendedor_id="' . $row['id'] . '">
' . imprimir_td($row) . '
</tr>
';
}
function imprimir_td($row) {
    if ($row['estado'] == '0') {
	$row['estado'] = 'Desactivo';
    } elseif ($row['estado'] == '1') {
	$row['estado'] = 'Activo';
    } 
    return
'
<td>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</td>
<td>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</td>
<td>' . utf8_encode( $row['correo'] ) . '</td>
<td>' . utf8_encode( $row['login'] ) . '</td>
<td>' . utf8_encode( $row['estado'] ) . '</td>
<td><a href="#" class="edit">EDITAR</a></td>
';
}
