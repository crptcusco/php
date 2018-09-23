<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modals.php";
$lista= get_modals_tipo_servicios();
?>
<div class="row">
  <div class="small-12 columns">
    <form>
      <div class="row">
	<div class="small-3 columns">
	  <label for="co_tipo_servicio_nombre" class="right inline">Nombre:</label>
	</div>
	<div class="small-9 columns">
	  <input type="hidden" id="co_tipo_servicio_codigo" class="">
	  <input type="text" id="co_tipo_servicio_nombre" class="">
	</div>
      </div>
      <div class="row">
	<div class="small-3 columns">
	  <label for="co_tipo_servicio_activo" class="right">Activo:</label>
	</div>
	<div class="small-1 columns">
	  <input id="co_tipo_servicio_activo" class="" type="checkbox" checked>
	</div>
	<div class="small-8 columns">
          <button id="co_tipo_servicio_button" class="right button tiny">Añadir</button>
	  <button id="co_tipo_servicio_cancelar" class="right secondary  button tiny">Cancelar</button>
	</div>	
      </div>
    </form>
  </div>
  <div class="small-12 columns">
    <table class="" id="lista_tipo_servicio" style="width: 100%;">
      <tr>
	<th>Nombre</th>
	<th width="100">Status</th>
	<th width="80"></th>
      </tr>
      <?php
      foreach ($lista as $row)
      {
	if($row['status']==0) {
	  $row['status'] = 'Desactivado';
	} elseif($row['status']==1) {
	  $row['status'] = 'Activado';
	}
	echo '<tr class="lista_tipo_servicio item-'.$row['id'].'">';
	printf('<td>%s</td><td>%s</td><td><a class="editar" href="#" codigo="%s">Editar</a></td>'
	       , utf8_encode($row['nombre'])
	       , $row['status']
	       , $row['id']
	       );
	echo '</tr>';
      }/*end foreach*/
      ?>
    </table>
    <script>
     var settings =  {                     
       display_all_text: " [ Mostrar todos ] ",  
       paging: true,
       paging_length: 10,
     };  
     var tf_2= setFilterGrid( "lista_tipo_servicio", settings );
    </script>
  </div>
</div>



