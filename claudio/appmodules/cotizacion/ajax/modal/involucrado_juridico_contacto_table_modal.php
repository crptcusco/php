<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modals.php";
// ------------------------------------------------ INPUT
$input['juridico_id'] = clear_input( $_POST['juridico_id'] );

// ------------------------------------------------ PROCESS
if ( $input['juridico_id'] != '' ) {
  $output = get_modals_involucrados_juridico_contacto_tabla($input);
} else{
    $output= null;
} 


// ------------------------------------------------ OUTPUT
?>


<table id="involucrados-juridico-contacto-table-ajax" style="width: 100%;">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Cargo</th>
      <th>Teléfono</th>
      <th>Correo</th>
      <th>Estado</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
    <?php if( is_array($output) ) { ?>
      <?php 
      foreach($output as $row) {
	imprimir($row);
      }
      ?>
    <?php }/*end-if*/ ?>
  </tbody>
</table>
<script>
 var settings =  {                     
   display_all_text: " [ Mostrar todos ] ",  
   paging: true,
   paging_length: 5,
 };  
 var tf_9 = setFilterGrid( "involucrados-juridico-contacto-table-ajax", settings );
</script>

<?php
// ------------------------------------------------ FUNCTIONS
function imprimir($row) {
  if ($row['status'] == '1') {
    $row['status'] = 'Activo';
  } elseif ($row['status'] == '0') {
    $row['status'] = 'Desactivo';
  }
  echo '
        <tr class="item item_' . $row['id'] . '" codigo="' . $row['id'] . '" juridico_id="' . $row['juridico_id'] . '">
          <td>' . utf8_decode($row['nombre']) . '</td>
          <td>' . utf8_decode($row['cargo']) . '</td>
          <td>' . utf8_decode($row['telefono']) . '</td>
          <td>' . utf8_decode($row['correo']) . '</td>
          <td>' . $row['status'] . '</td>
          <td><a href="" class="edit" >Editar</a></td>
        </tr>
        ';
}

// ------------------------------------------------ TEST
/*
echo '<h2>POST</h2>';
echo '<pre>';
print_r($_POST);
echo '</pre>';

echo '<h2>Input</h2>';
echo '<pre>';
print_r($input);
echo '</pre>';

echo '<h2>Output</h2>';
echo '<pre>';
print_r($output);
echo '</pre>';
*/
