<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/table.php";

// ---------------------------------------------- INPUT
$input['persona_id'] = clear_input($_POST['parent_id']);
$input['tipo'] = clear_input($_POST['tipo']);

$validar = table_modal_contacto_verificar( $input['persona_id'], $input['tipo'] );
// ---------------------------------------------- OUTPUT

if ($validar) {
    if ($input['tipo'] == 'juridica') {
	$output = table_modal_contacto_j($input);
    }elseif ($input['tipo'] == 'natural') {
	$output = table_modal_contacto_n($input);
    }
}

// ---------------------------------------------- TEST
/*
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
*/
// ---------------------------------------------- OUT-PUT
?>

<?php if ($validar) { ?>
<table class="" id="lista_contacto_ajax" style="width: 100%;">
  <thead>
    <tr>
      <TH>NOMBRE</TH>
      <TH>CARGO</TH>
      <TH>TELÉFONO</TH>
      <TH>CORREO</TH>
      <TH>ESTADO</TH>
      <TH width="130"></TH>
    </tr>
  </thead>
  <tbody>
    <?php 
    if (is_array($output) ){
      foreach ($output as $row) {
    	echo imprimir_tr($row);
      }
    }
    ?>
  </tbody>
</table>

<script>
 var settings =  {                     
   display_all_text: " [ Mostrar todos ] ",  
   paging: true,
   paging_length: 5,
 };  
var tf_7= setFilterGrid( "lista_contacto_ajax", settings );
</script>

<?php } else { /* end validar*/
    echo 'Sin Permiso';
}
?>

<?php
function imprimir_tr($row) {
  return '
        <tr class="item item_' . $row['id'] . '" codigo="' . $row['id'] . '" persona_id="' . $row['persona_id'] . '">
         ' . imprimir_td($row) . '
        </tr>
        ';
}

function imprimir_td($row) {
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

?>
