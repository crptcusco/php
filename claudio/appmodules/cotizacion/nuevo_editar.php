<?php
// ---------------------------------------------- ini-libs

include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "./logica.php";

include "../autentificacion/logica.php";
usuario_logeado('Cotizacion', '../autentificacion');


$correcto = true;
if ($input['accion']=='nuevo') {
  // general
  $input['id'] = get_cotizacion_generar_id();
  $input['codigo_cotizacion_str'] = '[Nuevo]';
  $input['codigo_cotizacion'] = '0';
  $input['actualizacion'] = '0';
  $input['tipo_cotizacion'] = '1';
  $input['tipo_servicio'] = '3';
  $input['estado_cotizacion'] = '1';
  $input['adjunto'] = '[...]';
  $input['desglose'] = '1';
  //fechas
  $input['fecha_solicitud'] = date('Y-m-d');
  $input['fecha_envio_cliente'] = '';
  $input['fecha_finalizacion'] = '';
  // involucrados
  $input['coordinador'] = '';
  $input['vendedor'] = '';

} elseif ($input['accion']=='editar') {
  $input['codigo_cotizacion'] = clear_input( $input['codigo_cotizacion'] );
  $input['codigo_cotizacion'] = (int) $input['codigo_cotizacion'];
  $input =  get_cotizacion( $input['codigo_cotizacion'] );

  if ( !is_array($input) ) {
      $correcto = false;
  }
  $input['codigo_cotizacion_str'] =  sprintf('%010s',$input['codigo_cotizacion']);
    /*
       echo '<h2>Input</h2>'; 
       echo '<pre>'; 
       print_r( $input ); 
       echo '</pre>';   
     */
}

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Cotización';
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
// echo '<pre>';
// print_r($input);
// echo '</pre>';
?>
<?php if ($correcto) { ?>

  <div class="row">
    <div class="large-12 columns">
      <dl id="pestanas_cotizacion" class="tabs" data-tab style="background-color: #efefef"> 
	<dd class="active"> <a href="#panel1">General</a> </dd>
	<dd><a href="#panel2">Involucrados</a></dd> 
	<!-- <dd><a href="#panel3">Bienes</a></dd> -->
	<dd><a href="#panel4">Servicios</a></dd> 
	<dd><a href="#panel6">Mensajes</a></dd> 
      </dl>
    </div>
  </div>

  <form action="save.php" method="POST" >
    <div class="row">
      <div class="large-12 columns text-right">
	<button type="submit" id="co_cotizacion_save" class="no-margin button">Guardar</button>
        <?php if($input['codigo_cotizacion'] != 0): ?>
          <a href="../coordinacion/item.php?cotizacion=<?php echo $input['codigo_cotizacion']  ?>" class="no-margin button info">Coordinaciones</a>
        <?php endif; ?>
      </div>
    </div>
    <div class="tabs-content no-margin">
	  
	  <div class="content active" id="panel1"> 
	      <div class="row">
		  <div class="large-7 columns">
		      <?php include './tabs/general.php' ?>
		  </div>
		  <div class="large-5 columns">
                    <h3 class="text-center">Fechas</h3>
		    <?php include './tabs/fechas.php' ?>
		  </div>
	      </div>
	  </div>
	  <div class="content" id="panel2">
	      <div class="row">
		  <div class="large-12 columns">
		      <?php include './tabs/involucrados.php' ?>
		  </div>
	      </div>
	  </div>
	  <div class="content" id="panel3">
	      <div class="row">
		  <div class="large-12 columns">
		      <?php include './tabs/bienes.php' ?>
		  </div>
	      </div>
	  </div>
	  <div class="content" id="panel4"> 
	      <div class="row">
		<div class="large-12 columns">
                  <h3 class="text-center">Total</h3>
		  <?php include './tabs/montos.php' ?>
		</div>
	      </div>
	  </div>
	  <div class="content" id="panel5"> 
	      <div class="row">

	      </div>
	  </div>
	  <div class="content" id="panel6"> 
	      <div class="row">
		  <div class="large-12 columns">
		      <?php include './tabs/mensajes.php' ?>
		  </div>
	      </div>
	  </div>
      </div>
  </form>

  <?php include './modals/general_tipo_servicio.php' ?>
  <?php include './modals/involucrados_vendedor.php' ?>
  <?php include './modals/involucrados_juridico.php' ?>
  <?php include './modals/involucrados_juridico_contacto.php' ?>
  <?php include './modals/involucrados_natural.php' ?>
  <?php include './modals/bienes_muebles_tipo.php' ?>
  <?php include './modals/bienes_muebles_marca.php' ?>
  <?php include './modals/bienes_muebles_modelo.php' ?>
  <?php include './modals/bienes_inmuebles.php' ?>
  <?php include './modals/montos_peritos.php' ?>
  <?php include './modals/finalizar_cotizacion.php' ?>

  
<?php }else {  ?>
  <div class="panel">
    <div class="row">
      <div class="large-6 columns">
	<div data-alert class="alert-box alert">
	  Codigo No existente
	  <a href="#" class="close">&times;</a>
	</div>      
      </div>
      <div class="row">
	<div class="large-6 columns">
	  <a href="./" class="button">Ir a Listado</a>
	</div>
      </div>
    </div>
  </div>

<?php }/*end else*/  ?>
<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/ui/1.10.3/jquery-ui.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/real_ajax_upload/examples/js/ajaxupload-min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_chosen.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_datapicker.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_general.js?v=2.5.7';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_involucrados.js?v=2.5.1';
// EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_bienes.js?v=1.0.4';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_montos.js?v=1.0.9';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_fechas.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_mensajes.js?v=1.0.4';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_finalizar_cotizacion.js?v=1.0.7';
EtiquetasHtml::footer();

function prefix($name) {
    global $group;
    echo $group . '_field_' . $name;
}
