<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tables.php";

// echo '<h2>POST</h2>';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$id = clear_input( $_POST['id'] );

$lista = get_tables_mensajes( $id );

?>


<table id="menajes-table-ajax" style="width: 100%;">
  <thead>
    <tr>
      <th>Usuario</th>
      <th>Fecha Creación</th>
      <th>Próxima Acción</th>
      <th>Estado</th>
      <th>Mensaje</th>
    </tr>
  </thead>

  <tbody>
    <?php if( is_array($lista) ) { ?>
      <?php 
      foreach($lista as $row) {
	  echo '<tr class="mensaje-lista-item item-' . $row['id'] . '">';
	  echo '<td>' . $row['usuario'] . '</td>';
	  echo '<td>' . $row['fecha_creacion'] . '</td>';
          echo '<td>' . $row['fecha_proxima'] . '</td>';
	  echo '<td>' . $row['estado'] . '</td>';
	  echo '<td>' . utf8_encode( $row['mensaje'] ) . '</td>';
	  echo '</tr>';
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
 var tf_1 = setFilterGrid( "menajes-table-ajax", settings );
</script>

