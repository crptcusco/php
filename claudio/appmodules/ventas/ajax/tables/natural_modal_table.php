<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/table.php";
// ---------------------------------------------- PROCESS
$input['rol_id'] = table_rol_id_by_user();
if ($input['rol_id']=='2') {
    $natural = table_modal_natural_coordinador();    
} else {
    $natural = table_modal_natural_no_coordinador();
}

// ---------------------------------------------- OUT-PUT
?>
<table class="" id="lista_natural_ajax" style="width: 100%;">
  <thead>
    <tr>
      <TH>NOMBRE</TH>
      <TH>DIRECCIÓN</TH>
      <TH>OBSERVACIÓN</TH>
      <TH WIDTH="10">VENDEDOR</TH>
      <TH WIDTH="10">ESTADO</TH>
      <TH WIDTH="10"></TH>
    </tr>
  </thead>
  <tbody>
    <?php 
    if (is_array($natural) ) {
      foreach ($natural as $row) { 
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
   paging_length: 3,
 };  
 var tf_7= setFilterGrid( "lista_natural_ajax", settings );
</script>
<?php 
function imprimir_tr($row) {
  return '
          <tr class="lista_natural_ajax_item item_' . $row['id'] . '">
          ' . imprimir_td($row) . '
          </tr>
      ';
}
function imprimir_td($row) {
  if (trim( $row['persona_estado_nombre'] ) == '') {
      $row['persona_estado_nombre'] = '[vacio]';
      $row['persona_estado_id'] = '0';
  }
  if (trim( $row['vendedor'] ) == '') {
      $row['vendedor'] = '[vacio]';
      $row['vendedor_id'] = '0';
  }
  return '
             <td documento_tipo_id="' . $row['documento_id'] . '"
                 estado="' . utf8_encode( $row['info_status'] ) . '"  
                 importante="' . utf8_encode( $row['importante_id'] ) . '" 
                 referido="' . utf8_encode( $row['referido'] ) .'"
             >
               <span>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</span><br>
               ' . utf8_encode( strtoupper( $row['documento_tipo'] ) ) . ':<span>' . utf8_encode( strtoupper( $row['documento_numero'] ) ) . '</span><br>
               <u>TELÉFONO</u>: <span>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</span><br>
               <u>CORREO</u>: <span>' . utf8_encode( $row['correo'] ) . '</span>
             </td>
             <td>' . utf8_encode( strtoupper( $row['direccion'] ) ) . '</td>
             <td>' . utf8_encode( strtoupper( $row['observacion'] ) ) . '</td>
             <td vendedor_id="' . $row['vendedor_id'] . '" >' . utf8_encode( strtoupper( $row['vendedor'] ) ) . '</td>
             <td persona_estado_id="' . $row['persona_estado_id'] . '" >' . utf8_encode( strtoupper( $row['persona_estado_nombre'] ) ) . '</td>
             <td><a class="editar" codigo="' . $row['id'] . '">EDITAR</a></td>
      ';
}
?> 
