<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modals.php";
$lista= get_modals_involucrados_vendedor();

function id(){
echo 'modal_co_vendedor';
}
?>
<div class="row">
  <div class="small-12 columns">
    <form>
      <div class="row">
	<div class="small-2 columns">
	  <label for="<?php id() ?>_nombre" class="right inline">Nombre:</label>
	</div>
	<div class="small-10 columns">
	  <input type="hidden" id="<?php id() ?>_codigo" value="0" class="">
	  <input type="text" id="<?php id() ?>_nombre" class="">
	</div>
      </div>

      <div class="row">
	<div class="small-6 columns">
	  <div class="row">
	    <div class="small-3 columns">
	      <label for="<?php id() ?>_telefono" class="right inline">Telefono:</label>
	    </div>
	    <div class="small-9 columns">
	      <input type="text" id="<?php id() ?>_telefono" class="">
	    </div>
	  </div>
	</div>
	<div class="small-6 columns">
	  <div class="row">
	    <div class="small-3 columns">
	      <label for="<?php id() ?>_correo" class="right inline">Correo:</label>
	    </div>
	    <div class="small-9 columns">
	      <input type="text" id="<?php id() ?>_correo" class="">
	    </div>
	  </div>
	</div>
      </div>

      <div class="row">
	<div class="small-2 columns">
	  <label for="<?php id() ?>_activo" class="right">Activo:</label>
	</div>
	<div class="small-1 columns">
	  <input id="<?php id() ?>_activo" class="" type="checkbox" checked>
	</div>
	<div class="small-9 columns">
          <button id="<?php id() ?>_save" class="right button tiny">Añadir</button>
	  <button id="<?php id() ?>_cancel" class="right secondary  button tiny">Cancelar</button>
	</div>	
      </div>
    </form>
  </div>
  <div class="small-12 columns">
    <table class="" id="lista_vendedores" style="width: 100%;">
      <tr>
	<th>Nombre</th>
	<th>Telefono</th>
	<th>Correo</th>
	<th>Status</th>
	<th></th>
      </tr>
      <?php
      foreach ($lista as $row)
      {
	if($row['status']==0) {
	  $row['status'] = 'Desactivado';
	} elseif($row['status']==1) {
	  $row['status'] = 'Activado';
	}
	echo '<tr class="lista_vendedores_item item-'.$row['id'].'">';
	printf('<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a class="editar" href="#" codigo="%s">Editar</a></td>'
	       , utf8_encode($row['nombre'])
	       , utf8_encode($row['telefono'])
	       , utf8_encode($row['correo'])
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
     var tf_5= setFilterGrid( "lista_vendedores", settings );
    </script>
  </div>
</div>
