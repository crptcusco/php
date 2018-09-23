<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/table.php";
// ------------------------------------------------ INPUT
$input['propuesta_id'] = clear_input( $_POST['propuesta_id'] );

// ---------------------------------------------- PROCESS
$output= table_visitas_propuesta($input);

// ------------------------------------------------- TEST
/*
echo '<tr><td>';
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
echo '</td></tr>';
*/
// ----------------------------------------------- OUTPUT
if (is_array($output) ) {
    foreach ($output as $row) {
	echo imprimir_tr($row);
    }
}
function imprimir_tr($row) {
  return '
          <tr class="item item_' . $row['id'] . '" codigo="' . $row['id'] . '">
          ' . imprimir_td($row) . '
          </tr>
      ';
}
function imprimir_td($row) {
    $row['fecha'] = timestamp_to_str2( $row['fecha'] );
    $row['hora-minuto'] =  de_militar_a_meridiano( $row['hora'], $row['minuto'] );
    $row['h-m-array'] =  de_militar_a_meridiano_array( $row['hora'], $row['minuto'] );
    
    $row['ubigeo_str'] = utf8_encode( $row['departamento_nombre'] );
    if ($row['provincia_id']!=0) { 
	$row['ubigeo_str'].= ' <span style="color:red">&#9658;</span> ';
    }
    $row['ubigeo_str'].= utf8_encode( $row['provincia_nombre'] );
    if ($row['distrito_id']!=0) { 
	$row['ubigeo_str'].= ' <span style="color:red">&#9658;</span> ';
    }
    $row['ubigeo_str'].= utf8_encode( $row['distrito_nombre'] );
    $row['ubigeo_id'] = $row['departamento_id'] . '-' . $row['provincia_id'] . '-' . $row['distrito_id'];
    
    return '
             <td estado_id="' . $row['estado_id'] . '" >' . utf8_encode( strtoupper( $row['estado_nombre'] ) ) . '</td>
             <td contacto_id="' . $row['contacto_id'] . '" >' . utf8_encode( strtoupper( $row['contacto_nombre'] ) ) . '</td>
             <td>' . $row['fecha'] . '</td>
             <td hora="' . $row['h-m-array']['hora'] . '" minuto="' . $row['h-m-array']['minuto'] . '" meridiano="' . $row['h-m-array']['meridiano'] . '">' . strtoupper( $row['hora-minuto'] ) . '</td>
             <td departamento_id="' . $row['departamento_id'] . '" provincia_id="' . $row['provincia_id'] . '" distrito_id="' . $row['distrito_id'] . '"> ' . strtoupper( $row['ubigeo_str'] ) . '</td>
             <td>' . utf8_decode( strtoupper( $row['direccion'] ) ) . '</td>
             <td>' . utf8_decode( strtoupper( $row['observacion'] ) ) . '</td>
             <td><a class="edit" style="font-size: 0.7em;" data-reveal-id="ve_propuesta_field_visita_modal">EDITAR</a> | <a class="delete" style="font-size: 0.7em;color:red">ELIMINAR</a>
             </td>
           ';
}
 
