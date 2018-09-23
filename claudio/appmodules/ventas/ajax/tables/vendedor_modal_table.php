<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/table.php";


// -------------------------------------------------------- INPUT
// $in[''] = clear_input( $_POST[''] );

// ------------------------------------------------------- PROCESS
$ou = table_modal_vendedor();

// ---------------------------------------------------------- TEST
// print_test('in', $in);
// print_test('ou', $ou);
// -------------------------------------------------------- OUTPUT
foreach ($ou as $row) {
    echo imprimir_tr($row);    
}

// -------------------------------------------------------- OUTPUT
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
