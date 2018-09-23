<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include("../../librerias.v2/mysql/dbconnector.php");
include '../../librerias.v2/utilidades.php';
include ("./models/combos.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/filtergrid.css';
EtiquetasHtml::$title = 'Estudio de Mercado Inmuebles';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

// Utilidades::print_r('$POST', $_POST);
if ( ! isset($_POST['categoria']) ) {
  // $_POST['categoria'] ='casa';
  $_POST['categoria'] ='todo';
}

?>
<div class="off-canvas-wrap" data-offcanvas> 
  <div class="inner-wrap" style="min-height: 625px;">
    <nav class="tab-bar"> 
      <div class="left-small">
	<a href="#idOfLeftMenu" role="button" aria-controls="idOfLeftMenu" aria-expanded="false" class="left-off-canvas-toggle menu-icon" >
	  <span></span>
	</a>
      </div> 
      <div class="right">
	<a href="."><i class="step fi-arrow-right size-48"></i></a>
      </div>
    </nav>
    <!-- Off Canvas Menu -->
    <aside class="left-off-canvas-menu"> 
      <!-- whatever you want goes here -->
      <form method="POST">
	<input type="hidden" id="inm_tipo" value="<?php echo categorias( $_POST['categoria'] ) ?>"/>
	<fieldset>
	  <legend>Ubigeo</legend>
	  <div class="row">
	    <div class="small-12 columns" id="inm_departamento_conteiner">
	      <select id="inm_departamento" name="inm_departamento" data-placeholder="Departamento" class="chosen-select" >
		<?php get_options_departamentos( $_POST['inm_departamento'] ) ?>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-11 small-push-1 columns" id ="inm_provincia_conteiner">
	      <select id="inm_provincia" name="inm_provincia" data-placeholder="Provincia" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['inm_provincia'] ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-10 small-push-2 columns" id="inm_distrito_conteiner">
	      <select id="inm_distrito" name="inm_distrito" data-placeholder="Distrito" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['inm_distrito'] ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	</fieldset>
	<fieldset>
	  <legend>Fecha Tasación</legend>
	  <!-- <div class="row"> -->
	  <!--   <div class="small-6 columns"> -->
	  <!--     <a href="#" class="" id="data-picker-ini" data-date-language="es" data-date-format="dd-mm-yyyy" data-date="01-01-<?php echo date('Y') ?>">01-01-<?php echo date('Y') ?></a> -->
	  <!--   </div> -->
	  <!--   <div class="small-6 columns"> -->
	  <!--     <a href="#" class="" id="data-picker-end" data-date-language="es" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d-m-Y') ?>"><?php echo date('d-m-Y') ?></a> -->
	  <!--   </div> -->
	  <!-- </div> -->
	  <?php $anio = date('Y') ?>
	  <div class="row">
	    <div class="small-6 columns" style="padding: 0px;">
	      <select id="inm_fech_ini" name="inm_fech_ini" data-placeholder="Inicio" class="chosen-select">
		<?php get_options_anio_2($anio -1) ?>
	      </select>
	    </div>
	    <div class="small-6 columns" style="padding: 0px;">
	      <select id="inm_fech_end" name="inm_fech_end" data-placeholder="Fin" class="chosen-select">
		<?php get_options_anio_2($anio) ?>
	      </select>      
	    </div>
	  </div>
	</fieldset>
	<fieldset>
	  <legend>filtros</legend>
	  <div class="row">
	    <div class="small-12 columns">
	      <input type="text" id="inm-cliente" placeholder="Cliente"/>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-12 columns">
	      <input type="text" id="inm-direccion" placeholder="Dirección"/>
	    </div>
	  </div>
	</fieldset>
	
	<input type="hidden" name="categoria" value="<?php /* echo $_POST['categoria'] */  ?>" />
	  <input type="submit" id="search-button-ajax" class="button" value="Filtrar" />
      </form>
    </aside> 
    <!-- main content goes here -->
    <?php 
    //EtiquetasHtml::printr($_POST);
    ?>
    <a id="myModal-marker-trigger" href="#" data-reveal-id="myModal-marker" style="display:none;">Click Me For A Modal</a>
    <div id="myModal-marker" class="reveal-modal" data-reveal style="">
      <div class="ajax"></div>
      <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>
    <dl class="tabs" data-tab>
      <dd class="active"><a href="#panel1">Mapa</a></dd>
      <dd><a href="#panel2">Grilla</a></dd>
    </dl>
    <div class="tabs-content no-margin">
      <div class="content active no-padding" id="panel1">
	<div id="map_ajax" style="width: 100%; /*height: 600px;*/"></div>
      </div>
      <div class="content no-padding" id="panel2">
        <style>
         .menu-grilla {
             margin: 0 1em;
             clear: both;
             position: relative;
         }
         .menu-grilla .item {
             border-style: solid;
             border-width: 1px 0 1px 1px;
             float: left;
             padding: 0.5em;
             text-align: center;
         }
         .menu-grilla .item.last {
             border-width: 1px 1px 1px 0px;
             padding: 0.5em 0;
         }
        </style>
        <div class="menu-grilla" id="menu-grilla-datatable">
          <div class="item item_casa"  style="display:none">
            Casa (<a item="casa_t">Tas</a> | <a item="casa_em">Em</a>)
          </div>
          <div class="item item_departamento" style="display:none">
            Departamento (<a item="departamento_t">Tas</a> | <a item="departamento_em">Em</a>)
          </div>
          <div class="item item_local_comercial" style="display:none">
            Local Comercial (<a item="local_comercial_t">Tas</a> | <a item="local_comercial_em">Em</a>)
          </div>
          <div class="item item_local_industrial" style="display:none">
            Local Industrial (<a item="local_industrial_t">Tas</a> | <a item="local_industrial_em">Em</a>)
          </div>
          <div class="item item_terreno" style="display:none">
            Terreno (<a item="terreno_t">Tas</a> | <a item="terreno_em">Em</a>)
          </div>
          <div class="item item_oficina" style="display:none">
            Oficina (<a item="oficina_t">Tas</a> | <a item="oficina_em">Em</a>)
          </div>	  
          <div class="item item_casa last">
            &nbsp;
          </div>
          <div style="clear:both"></div>
        </div>
        <?php
	include './inmuebles-tables.php'
	?>
        <div id="grids_ajax" style="width: 100%;">
	</div>
      </div>
    </div>  
    <!-- close the off-canvas menu -->
    <a class="exit-off-canvas"></a>
  </div>
</div>


<!--<script src="https://maps.googleapis.com/maps/api/js"></script>-->


<?php
function categorias($arr) {
  $out='';
  foreach($arr as $row) {
    $out .= $row.'|!|';
  }
  $out= substr($out, 0, -3);
  return $out;
}
// ---------------------------------------------- ini-footer

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';

EtiquetasHtml::$files['footer']['js'][] = 'http://maps.google.com/maps/api/js?sensor=false';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/js-marker-clusterer-gh-pages/src/markerclusterer_compiled.js';

//EtiquetasHtml::$files['footer']['js'][] = 'http://maps.google.com/maps/api/js';
//EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/markerclusterer_compiled.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_pantalla02.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_combos.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_datapicker.js';

EtiquetasHtml::footer();
