<?php
// ---------------------------------------------- ini-libs

include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "./logica.php";

include "../autentificacion/logica.php";
usuario_logeado('Ventas', '../autentificacion');
$group = 've_propuesta';
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Ventas';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/ui/1.10.3/themes/smoothness/jquery-ui.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/filtergrid.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/real_ajax_upload/examples/css/base2Theme/style.css';
EtiquetasHtml::$files['header']['css'][] = '../../static/css/admin/admin.css?v=2.0.4';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
include ("../autentificacion/url.php");
include ("../autentificacion/menu.php");

$correcto = true;
if ($input['accion'] == 'nuevo') {
  unset($input['accion']);
  $l = get_venta_nuevo();
  $input['id'] = $l['id'];
  $input['codigo'] = '0';
  $input['vendedor_rol_id'] = $l['vendedor_rol_id'];
  $input['vendedor_id'] = $l['vendedor_id'];
  $input['vendedor_nombre'] = $l['vendedor_nombre'];
  $input['vendedor_actual_id'] = get_vendedor_actual_id();
  $input['persona_tipo'] = 'Juridica';
  $input['persona_id'] = 0;
  if ( $input['persona_tipo'] == 'Juridica' ) {
    $input['juridico_id'] = $input['persona_id'];
    $input['natural_id'] = 0;
  } else {
    $input['juridico_id'] = 0;
    $input['natural_id'] = $input['persona_id'];
  }
  $input['codigo_str'] = '[Nuevo]';
  $input['accion'] = 'nuevo';
  echo '
<style>
body
{
    background-color: #b1ff9c;
}
</style>
       ';
} elseif ($input['accion'] == 'editar') {
  $input['codigo'] = clear_input( $input['codigo'] );
  $input['codigo'] = (int) $input['codigo'];
  $input = get_venta( $input['codigo'] );
  if ( $input['persona_tipo'] == 'Juridica' ) {
    $input['juridico_id'] = $input['persona_id'];
    $input['natural_id'] = 0;
  } else {
    $input['juridico_id'] = 0;
    $input['natural_id'] = $input['persona_id'];
  }  
  $input['codigo_str'] =  $input['codigo'];
  $input['accion'] = 'editar';
  $input['vendedor_rol_id'] = get_rol_id();
  $input['vendedor_actual_id'] = get_vendedor_actual_id();
}
// print_test('$input', $input);
?>

<style>
 .mini .column, .mini .columns {
   padding: 0 0.5rem;
 }
 .no-margin .chosen-container {
    margin: 0;
}
</style>
<div class="mini">
  <div class="row">
    <div class="small-3 columns text-right">
      <label class="inline">CODIGO DE SEGUIMIENTO:</label>
    </div>
    <div class="small-9 columns">
      <button id="<?php prefix('guardar') ?>" class="button tiny">
	<span id="<?php prefix('propuesta_id') ?>">
	  <?php echo strtoupper( $input['codigo_str'] ) ?>
	</span>
      </button>      
    </div>
  </div>
  <div class="row">
    <div class="small-3 columns text-right">
      <label>VENDEDOR:</label>
    </div>
    <div class="small-7 columns">
      <div class="row">
	<input type="hidden" id="<?php prefix('id') ?>" value="<?php echo $input['id'] ?>">
	<input type="hidden" id="<?php prefix('codigo') ?>" value="<?php echo $input['codigo'] ?>">
	<input type="hidden" id="<?php prefix('vendedor_id') ?>" value="<?php echo $input['vendedor_id'] ?>">
	<input type="hidden" id="<?php prefix('vendedor_cliente_id') ?>" value="">		
	<input type="hidden" id="<?php prefix('vendedor_actual_id') ?>" value="<?php echo $input['vendedor_actual_id'] ?>">
	<input type="hidden" id="<?php prefix('vendedor_rol_id') ?>" value="<?php echo $input['vendedor_rol_id'] ?>">
	<input type="hidden" id="<?php prefix('persona_tipo') ?>" value="<?php echo $input['persona_tipo'] ?>">
	<div class="small-1 columns text-right">	
	  <a id="<?php prefix('vendedor_link') ?>" data-reveal-id="<?php prefix('vendedor_modal') ?>" class="cld-icon-search right"></a>
	</div>
	<div class="small-11 columns">
	  <?php echo strtoupper( $input['vendedor_nombre'] ) ?>
	</div>
      </div>
    </div>
    <div class="small-2 columns">
    </div>
  </div>
  <div class="row">
    <div class="small-2 columns text-right">
      <label>PERSONA:</label>
    </div>
    <div class="small-10 columns">
      <div class="panel callout">
	<div class="row">
	  <div class="small-2 columns">
	    <div class="row">
	      <div class="small-2 columns">
		<input id="<?php prefix('persona_tipo_juridico') ?>" name="<?php prefix('persona_tipo') ?>" value="Juridica" class="<?php prefix('persona_tipo') ?>" type="radio" checked>
	      </div>
	      <div class="small-10 columns">
		<label for="<?php prefix('persona_tipo_juridico') ?>">JURIDICO</label>
	      </div>	  
	    </div>
	    <div class="row">
	      <div class="small-2 columns">
		<input id="<?php prefix('persona_tipo_natural') ?>" name="<?php prefix('persona_tipo') ?>" value="Natural" class="<?php prefix('persona_tipo') ?>" type="radio">
	      </div>
	      <div class="small-10 columns">
		<label for="<?php prefix('persona_tipo_natural') ?>">NATURAL</label>
	      </div>	  
	    </div>	    
	  </div>
	  <div class="small-10 columns">
	    <div id="<?php prefix('persona_contenido_juridico') ?>">
	      <div class="row">
		<div class="small-2 columns">
	    	  <label class="right" for="<?php prefix('persona_juridico_id') ?>">RAZON.SOCIAL:</label>
		</div>
		<div class="small-1 columns text-right">	
	       	  <a id="<?php prefix('persona_juridico_link') ?>" data-reveal-id="<?php prefix('persona_juridico_modal') ?>" class="cld-icon-search right"></a>
		</div>
		<div class="small-9 columns no-margin">
	      	  <select id="<?php prefix('persona_juridico_id') ?>"  class="chosen-select">
	      	    <option value="<?php echo $input['juridico_id']  ?>"></option>
	      	  </select>
		</div>
	      </div>
	      <div class="row">
		<div class="small-3 columns"></div>
		<div class="small-9 columns">
		  <div id="<?php prefix('persona_juridico_info') ?>">
		  </div>
		</div>
	      </div>
	      <div class="row">
		<div class="small-2 columns">
	    	  <label class="right" for="<?php prefix('persona_juridico_contacto_id') ?>">CONTACTO:</label>
		</div>
		<div class="small-1 columns text-right">	
	       	  <a id="<?php prefix('persona_juridico_contacto_link') ?>" data-reveal-id="<?php prefix('persona_contacto_modal') ?>" class="cld-icon-search right"></a>
		</div>
		<div class="small-9 columns">
		</div>
	      </div>
	    </div> <!-- end -->

	    <div id="<?php prefix('persona_contenido_natural') ?>" style="display:none;">
	      <div class="row">
		<div class="small-2 columns">
	    	  <label class="right" for="<?php prefix('persona_natural_id') ?>">NOMBRE:</label>
		</div>
		<div class="small-1 columns text-right">	
	       	  <a id="<?php prefix('persona_natural_link') ?>" data-reveal-id="<?php prefix('persona_natural_modal') ?>" class="cld-icon-search right"></a>
		</div>
		<div class="small-9 columns no-margin">
	      	  <select id="<?php prefix('persona_natural_id') ?>"  class="chosen-select">
	      	    <option value="<?php echo $input['natural_id']  ?>"></option>
	      	  </select>
		</div>
	      </div>
	      <div class="row">
		<div class="small-3 columns"></div>
		<div class="small-9 columns">
		  <div id="<?php prefix('persona_natural_info') ?>">
		  </div>
		</div>
	      </div>
	      <div class="row">
		<div class="small-2 columns">
	    	  <label class="right" for="<?php prefix('persona_natural_contacto_id') ?>">CONTACTO:</label>
		</div>
		<div class="small-1 columns text-right">	
	       	  <a id="<?php prefix('persona_natural_contacto_link') ?>" data-reveal-id="<?php prefix('persona_contacto_modal') ?>" class="cld-icon-search right"></a>
		</div>
		<div class="small-9 columns"></div>
	      </div>
	    </div> <!-- end -->
	    
	  </div>
	  
	</div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-3 columns text-right">
      <label for="">TIPO DE SERVICIO:</label>
    </div>
    <div class="small-1 columns">	
      <a id="<?php prefix('servicio_tipo_link') ?>" data-reveal-id="<?php prefix('servicio_tipo_modal') ?>" class="cld-icon-search"></a>
    </div>    
    <div class="small-8 columns">
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="small-11 columns">
      <h3><center>Seguimientos</center></h3>
    </div>
    <div class="small-1 columns">
      <button id="<?php prefix('visita_add') ?>" class="button tiny success right" style="margin: 0" data-reveal-id="<?php prefix('visita_modal') ?>">AÑADIR</button>
    </div>
  </div>
  <div class="row">
    <div class="small-12 columns" id="<?php prefix('visita_table') ?>">
      <table style="width: 100%;">
	<thead>
	  <tr>
	    <TH WIDTH="135">ESTADO</TH>
	    <TH WIDTH="135">CONTACTO</TH>
	    <TH WIDTH="95">FECHA</TH>
	    <TH WIDTH="80">HORA</TH>
	    <TH WIDTH="135">UBIGEO</TH>
	    <TH WIDTH="135">DIRECCIÓN</TH>
	    <TH WIDTH="135">OBSERVACIÓN</TH>
            <TH>ACCIONES</th>
	  </tr>
	</thead>
	<tbody>	  
	</tbody>
      </table>
    </div>
  </div>
  <?php
  // modales
  include ('./modals/propuesta/vendedor_modal.php');
  include ('./modals/propuesta/juridico_modal.php');
  include ('./modals/propuesta/natural_modal.php');
  include ('./modals/propuesta/contacto_modal.php');
  include ('./modals/propuesta/servicio_tipo_modal.php');
  include ('./modals/propuesta/visita_modal.php');
  ?>
  
  
</div><!-- mini -->
<?php 
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/ui/1.10.3/jquery-ui.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/real_ajax_upload/examples/js/ajaxupload-min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_chosen.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_datapicker.js?v=1.0.0';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_propuesta.js?v=1.0.2';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_visita.js?v=1.0.1';

EtiquetasHtml::footer();

function prefix($name) {
    global $group;
    echo $group . '_field_' . $name;
}
