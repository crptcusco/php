<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tables.php";

// -------------------------------------------------------- INPUT
$in['cotizacion_id'] = clear_input( $_POST['cid'] );

// ----------------------------------------------------- PROCCESS
$ou = get_tables_td_involucrado($in);

// ------------------------------------------------------- OUTPUT
if (is_array($ou) ) {
    foreach ($ou as $row) {
	imprimir( $row );
    }
}

// --------------------------------------------------------- TEST
/*
echo '<tr><td colspan="7">';
print_test("POST", $_POST);
print_test("INPUT", $in);
print_test("OUTPUT", $ou);
echo '</td></tr>';
*/
// ---------------------------------------------------- FUNCTIONS
function imprimir( $row ) {
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
    printf(
'
<tr class="item-%s">
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
</tr>
'
, $row['id']
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

?>
