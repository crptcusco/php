<?php
// ---------------------------------------------- ini-libs
include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../autentificacion/logica.php";
usuario_logeado('Cotizacion', '../autentificacion');

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Cotización';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/filtergrid.css';
EtiquetasHtml::$files['header']['css'][] = '../../static/css/admin/admin.css?v=2.0.4';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../static/css/cotizacion_box_mensajes.css?v=1.0.0';
EtiquetasHtml::header();

$test = false;
$group = 'cotizacion_listado';
// ---------------------------------------------- ini-body
include ("../autentificacion/url.php");
include ("../autentificacion/menu.php");
?>

<form>
  <div class="row">
    <div class="large-12 columns">
      <a href="./nuevo.php" class="button success" style="margin:0" target="cotizacion_item">Nueva Cotización</a>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <dl id="myAccordionGroup" class="accordion" data-accordion>
	<dd class="accordion-navigation">
	  <a href="#panel1b">Filtros</a>
	  <div id="panel1b" class="content" style="background-color: rgb(189, 219, 248);">
	    <div class="row">
	      <div class="large-12 columns">
		<?php include('./tabs-search/general.php') ?>
	      </div>
	    </div>
	    <div class="row">
	      <div class="large-12 columns">
		<?php include('./tabs-search/involucrados.php') ?>
	      </div>
	    </div>
	    <div class="row">
	      <div class="large-12 columns">
		<?php include('./tabs-search/bienes.php') ?>
	      </div>
	    </div>
	  </div>
	</dd>
      </dl>
    </div>
  </div>
  <?php include('./tabs-search/result.php') ?>

  <div id="co_box_mensajes">
    <a hrfe="#" class="caja" estado="close">
      <div class="left box box1" >
	Ver Mensajes
      </div>
      <div class="right box box2">
	+
      </div>
      <div style="clear:both;"></div>
    </a>
    <div class="right box box3" style="display:none">
      <u>
	<li><a href="#" data-reveal-id="modalBoxMensajes" class="linkBoxMensajes" intervalo="-30">Anterior a 30 días</a></li>
	<li><a href="#" data-reveal-id="modalBoxMensajes" class="linkBoxMensajes" intervalo="0">Hoy</a></li>
	<li><a href="#" data-reveal-id="modalBoxMensajes" class="linkBoxMensajes" intervalo="+30">Próximos a 30 días</a></li>
      </u>
    </div>
  </div>
  <div id="modalBoxMensajes" class="reveal-modal" data-reveal role="dialog">
    <h2 id="modalTitle">Mensajes</h2>
    <table style="width:100%">
      <thead>
	<tr>
	  <th width="100">Codigo</th>
	  <th width="100">Fechas</th>
	  <th>Mensaje</th>
	  <th width="100">Estado</th>
	</tr>
      </thead>
      <tbody class="ajax">
      </tbody>
    </table>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>

</form>
<style>
 #cotizacion_listado_tabla th {
     padding: 0;
 }
 #cotizacion_listado_tabla td {
     text-align: center;
     /*padding: 0;*/
 }
 #cotizacion_listado_tabla li {
     font-size: 0.7em;
     text-align: left;
 }
 #cotizacion_listado_tabla input.active,
 #cotizacion_listado_tabla select.active
 {
     background-color: #ACFFAB;
 }
</style>
<table id="cotizacion_listado_tabla">
  <thead>
    <?php if($test): ?>
      <tr>
        <?php
        for ($i=0; $i<=10; $i++) echo '<td>' .$i .'</td>';
        ?>
      </tr>
    <?php endif ?>      
    
    <tr>
      <?php $i = -1 ?>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td>
        <select class="no-margin  search-input-select"
                id="tipo_servicio2"
                data-column="<?php echo ++$i ?>">
        </select>
      </td>
      <td>
        <select class="no-margin  search-input-select"
                id="involucrados_coordinador2"
                data-column="<?php echo ++$i ?>">
        </select>
      </td>
      <td>
        <select class="no-margin  search-input-select"
                id="involucrados_vendedor2"
                data-column="<?php echo ++$i ?>">
        </select>
      </td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>" type="text"></td>
      <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
      <td>
        <select class="no-margin  search-input-select"
                id="estado_cotizacion2"
                data-column="<?php echo ++$i ?>">
        </select>        
      </td>
      <td></td>
      
    </tr>
    <tr>
      <th><span class="text-center" style="display: block; width: 90px;">Cotización</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Tipo Servicio</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Coordinador</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Vendedor</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Cliente</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Solicitate</span></th>
      <th><span class="text-center" style="display: block; width: 150px;">Monto</span></th>
      <th><span class="text-center" style="display: block; width: 90px;">Fecha solicitud</span></th>
      <th><span class="text-center" style="display: block; width: 90px;">Fecha envio</span></th>
      <th><span class="text-center" style="display: block; width: 80px;">Estado</span></th>
      <th><span class="text-center" style="display: block; width: 100px;">Coordinación</span></th>
    </tr>
  </thead>
</table>

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_chosen.js?v=1.0.1';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_search_listado.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_search_general.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_search_involucrados.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_search_bienes.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_search_find.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/cotizacion_box_mensajes.js?v=1.0.1';
EtiquetasHtml::footer();

// ---------------------------------------------- ini-footer
function prefix($name) {
  global $group;
  echo $group . '_field_' . $name;
}
