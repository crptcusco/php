<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tables.php";
// ------------------------------------------------ INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );

// ------------------------------------------------ PROCESS
$output = get_tables_bienes( $input );

// ------------------------------------------------ OUTPUT
?>


<table id="bienes-table-ajax" style="width: 100%;">
  <thead>
    <tr>
      <th>Detalle</th>
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
   paging_length: 15,
 };  
 var tf_7 = setFilterGrid( "bienes-table-ajax", settings );
</script>

<?php
// ------------------------------------------------ FUNCTIONS
function imprimir($row) {
  $co = explode('-', $row['codigos'] );
  if ($co[0] == 1 ) {// mueble
      $de = explode('|---|-', utf8_encode( $row['contexto'] ) );
      $de_str = $de[0] . ' &#9658; ' . $de[1] . ' &#9658; ';
      if ($co[3] != 0) {
	  $de_str .= $de[2] . ' &#9658; ';
      }
      if ($co[4] != 0) {
	  $de_str .= $de[3] . ' &#9658; ';
      }
      if ($co[5] != 0) {
	  $de_str .= $de[4] . ' &#9658; ';
      }
      $output = '
                <td>' . $de_str . ' <span>' . utf8_decode($row['valor']) . '</span></td>
                <td> <a href="#" class="edit">Editar</a> | <a href="#" class="delete">Eliminar</a></td>
                '; 
  } 
  if ($co[0] == 2 ) { // inmueble
      $de = explode('|---|-', utf8_encode( $row['contexto'] ) );
      $de_str = $de[0] . ' &#9658; ' . $de[1] . ' &#9658; ';
      if ($co[3] != 0) {
	  $de_str .= $de[2] . ' &#9658; ';
      }
      if ($co[4] != 0) {
	  $de_str .= $de[3] . ' &#9658; ';
      }
      if ($co[5] != 0) {
	  $de_str .= $de[4] . ' &#9658; ';
      }
      $va = explode('|---|-', utf8_decode( $row['valor'] ) );
      $va_str = '<span>'.$va[0].'</span>';
      if ($va[1] != '') {
	  $va_str.= ' <u>Descripción:</u> <span>'.$va[1].'</span>';
      }
      $output = '
                <td>' . $de_str . '' . $va_str . '</td>
                <td> <a href="#" class="edit">Editar</a> | <a href="#" class="delete">Eliminar</a></td>
                '; 
  } 
  if ($co[0] == 3 ) { // masivos
    $row['valor'] = utf8_decode($row['valor']);
    $l = explode("|-|-|", $row['valor']);
    $output = '
                 <td>' . utf8_decode($row['contexto']) . ' &#9658; <span>'.$l[1].'</span> <a href="../../../files/cotizacion/bienes/' . $l[0] . '" class="view" target="_blank">Ver</a></td>
                 <td> <a href="#" class="edit">Editar</a> | <a href="#" class="delete">Eliminar</a></td>
                '; 
  }
  echo '
        <tr class="item_bien item_' . $co[0] . '-' . $co[2] . '" codigos="' . $row['codigos'] . '">
        ' . $output . '
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

