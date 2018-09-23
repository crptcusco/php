<?php 
// formulario personas
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/table.php";
// ---------------------------------------------- PROCESS
$input['rol_id'] = table_rol_id_by_user();
if ($input['rol_id']=='2') {
    $juridico = table_modal_juridico_coordinador();    
} else {
    $juridico = table_modal_juridico_no_coordinador();    
}
// ---------------------------------------------- TEST
/* echo '<pre>'; */
/* print_r( $juridico ); */
/* echo '</pre>'; */
// ---------------------------------------------- OUT-PUT
?>
<table class="" id="lista_juridico_ajax" style="width: 100%;">
  <thead>
    <tr>
      <TH>RAZÓN</TH>
      <TH>DIRECCIÓN</TH>
      <TH WIDTH="10">OBSERVACIÓN</TH>
      <TH WIDTH="10">VENDEDOR</TH>
      <TH WIDTH="10">ESTADO</TH>
      <TH WIDTH="10"></TH>
    </TR>
  </THEAD>
  <tbody>
    <?php 
    if (is_array($juridico) ){
      foreach ($juridico as $row) {
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
 var tf_7= setFilterGrid( "lista_juridico_ajax", settings );
</script>
<?php
function imprimir_tr( $row ) {
  return '
         <tr class="item_' . $row['id'] . '" codigo="' . $row['id'] . '">
         ' . imprimir_td( $row ) . '
         </tr>
         ';
}
function imprimir_td( $row ) { 
  if (trim( $row['persona_estado_nombre'] ) == '')
      { $row['persona_estado_nombre'] = '[vacio]'; }
  if (trim( $row['vendedor'] ) == '')
      { $row['vendedor'] = '[vacio]'; }
  return '
             <td clasificacion_id="' . $row['clasificacion_id'] . '" 
                 actividad_id="' . $row['actividad_id'] . '" 
                 grupo_id="' . $row['grupo_id'] . '"                  
                 estado="' . utf8_encode( $row['status'] ) . '" 
                 importante="' . utf8_encode( $row['importante_id'] ) . '" 
                 referido="' . utf8_encode( $row['referido'] ) .
              '"><span>' . utf8_encode( strtoupper( $row['nombre'] ) ) . '</span> <br>
                 <u>RUC</u>: <span>' . utf8_encode( strtoupper( $row['ruc'] ) ) . '</span> <br>
                 <u>TELÉFONOS</u>: <span>' . utf8_encode( strtoupper( $row['telefono'] ) ) . '</span> <br>
             </td>
             <td>' . utf8_encode( strtoupper( $row['direccion'] ) ) . '</td>
             <td>' . utf8_encode( strtoupper( $row['observacion'] ) ) . '</td>
             <td vendedor_id="' . $row['vendedor_id'] . '" >' . utf8_encode( strtoupper( $row['vendedor'] ) ) . '</td>
             <td persona_estado_id="' . $row['persona_estado_id'] . '" >' . utf8_encode( strtoupper( $row['persona_estado_nombre'] ) ) . '</td>
             <td><a class="editar" codigo="' . $row['id'] . '">EDITAR</a></td>
       ';
}
?>