<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modals.php";

// ------------------------------------------------ INPUT
$input['sub_categoria_id'] = is_null_id( clear_input( $_POST['sub_categoria_id'] ) );
$input['tipo_id'] = is_null_id( clear_input( $_POST['tipo_id'] ) );
$input['marca_id'] = is_null_id( clear_input( $_POST['marca_id'] ) );

/* $input[''] = clear_input( $_POST[''] ); */
/* $input[''] = utf8_decode( clear_input( $_POST[''] ); */
/* $input[''] = is_null_id( clear_input( $_POST[''] ) ); */

// ------------------------------------------------ PROCESS
/*
  probar primero las consultas (return $q->sql)
  probar despues con data consulta 
  desabilitar pruebas 
*/
$output = get_modals_bien_mueble_modelo_tabla($input);


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

// ------------------------------------------------ OUTPUT
$name = 'bienes-mueble-modelo-tabla-ajax';
?>
<table id="<?php echo $name ?>" style="width: 100%;">
  <thead>
    <tr>
      <th>Modelo</th>
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
 var tf_12 = setFilterGrid( "<?php echo $name ?>", settings );
</script>

<?php
// ------------------------------------------------ FUNCTIONS
function imprimir($row) {
  if ($row['status'] == '1') {
    $row['status'] = 'Activo';
  } elseif ($row['status'] == '0') {
    $row['status'] = 'Desactivo';
  }
  $row['codigos'] = $row['tipo_id'] . '-' . $row['marca_id'] . '-' . $row['modelo_id'];
  echo '
        <tr class="item item_' . $row['codigos'] . '" codigo="' . $row['codigos'] . '">
          <td>' . utf8_encode($row['nombre']) . '</td>
          <td>' . $row['status'] . '</td>
          <td><a href="" class="edit" >Editar</a></td>
        </tr>
        ';
}

