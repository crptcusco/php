<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include("../../librerias.v2/mysql/dbconnector.php");

include ("./models/combos.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/filtergrid.css';
EtiquetasHtml::$title = 'Estudio de Mercado No - Inmuebles';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
if ( ! isset($_POST['categoria']) ) {
  // $_POST['categoria'] ='maquinaria';
  $_POST['categoria'] ='todo';
}
?>
<div class="off-canvas-wrap" data-offcanvas> 
  <div class="inner-wrap">
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
      <?php if ($_POST['categoria'][0]=='maquinaria') {?>
	<fieldset>
	  <legend>Maquinaria</legend>
	  <div class="row">
	    <div class="small-12 columns" id="nin_tipo_maquinaria_conteiner">
	      <select id="nin_tipo_maquinaria" name="nin_tipo_maquinaria" data-placeholder="Tipo (Maquinaria)" class="chosen-select" >
		<?php get_options_tipo_maquinaria($_POST['nin_tipo_maquinaria']) ?>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-11 small-push-1 columns" id ="nin_marca_maquinaria_conteiner">                                                   
	      <select id="nin_marca_maquinaria" name="nin_marca_maquinaria" data-placeholder="Marca (Maquinaria)" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['nin_marca_maquinaria']; ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-10 small-push-2 columns" id ="nin_modelo_maquinaria_conteiner">
	      <select id="nin_modelo_maquinaria" name="nin_modelo_maquinaria" data-placeholder="Modelo (Maquinaria)" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['nin_modelo_maquinaria']; ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	</fieldset>
	<?php }/*end-if*/ ?>
	<?php if ($_POST['categoria'][0]=='vehiculo') {?>
	<fieldset>
	  <legend>Vehiculo</legend>
	  <div class="row">
	    <div class="small-12 columns" id="nin_tipo_vehiculo_conteiner">
	      <select id="nin_tipo_vehiculo" name="nin_tipo_vehiculo" data-placeholder="Tipo (Vehiculo)" class="chosen-select" >
                <?php get_options_tipo_vehiculo( $_POST['nin_tipo_vehiculo'] ) ?>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-11 small-push-1 columns" id="nin_marca_vehiculo_conteiner">
	      <select id="nin_marca_vehiculo" name="nin_marca_vehiculo" data-placeholder="Marca (Vehiculo)" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['nin_marca_vehiculo']; ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-10 small-push-2 columns" id="nin_modelo_vehiculo_conteiner">
	      <select id="nin_modelo_vehiculo" name="nin_modelo_vehiculo" data-placeholder="Modelo (Vehiculo)" class="chosen-select" >
		<option value=""></option>
		<option value="<?php echo $_POST['nin_modelo_vehiculo']; ?>" selected>Ajax</option>
	      </select>
	    </div>
	  </div>
	</fieldset>
	<?php }/*end-if*/ ?>
	<!--<fieldset>
	  <legend>Fecha Tasación</legend>
	  <div class="row">
	    <div class="small-6 columns">
	      <a href="#" class="" id="data-picker-ini" data-date-language="es" data-date-format="dd-mm-yyyy" data-date="01-01-<?php echo date('Y') ?>">01-01-<?php //echo date('Y') ?></a>
	    </div>
	    <div class="small-6 columns">
	     <a href="#" class="" id="data-picker-end" data-date-language="es" data-date-format="dd-mm-yyyy" data-date="<?php echo date('d-m-Y') ?>"><?php //echo date('d-m-Y') ?></a>
	    </div>
	  </div>
	</fieldset>--!>
	<fieldset>
	  <legend>filtros</legend>
	  <div class="row">
	    <div class="small-12 columns">
	      <input type="text" id="inm-cliente" placeholder="Cliente"/>
	    </div>
	  </div>
	  <div class="row">
	    <div class="small-12 columns" id="nin_anio_conteiner">
	      <select id="nin_anio" name="nin_anio" data-placeholder="A&ntilde;o de fabricación" class="chosen-select" >
	    	<?php  get_options_anio($_POST['nin_anio']) ?>
	      </select>
	    </div>
	  </div>
	</fieldset>
	<input type="hidden" id="nin_categoria" value="<?php echo $_POST['categoria'][0] ?>"/>
	<input type="submit" id="search-button-ajax" class="button" value="Filtrar" />
    </aside> 
    <!-- main content goes here -->
    <?php // EtiquetasHtml::printr($_POST);
    ?>
    <div id="grid_ajax" style="width: 100%;min-height: 650px;">aa</div>
    <!-- close the off-canvas menu -->
    <a class="exit-off-canvas"></a>
  </div>
</div>
<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_pantalla03.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_datapicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/estudio_de_mercado_combos.js';
EtiquetasHtml::footer();
