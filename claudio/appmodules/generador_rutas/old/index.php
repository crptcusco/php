<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Generador de rutas';
EtiquetasHtml::$path = '../../librerias.v2';
// EtiquetasHtml::$files['header']['css'][] = '../../static/css/';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<div class="row">
</div>
<div class="row">
  <div class="small-9 columns small-centered">
    <div class="panel callout radius">
      <form action="mapa.php" method="post" enctype="multipart/form-data">
	<div class="row">
	  <div class="small-12 columns text-center">
	    <h2>Cargar archivo (CSV):</h2>
	    <hr>
	  </div>
	</div>


	<div class="row">
	  <div class="small-8 columns">
	    <input type="file" name="fileToUpload" id="fileToUpload">
	  </div>
	  <div class="small-4 columns">
	    <input type="submit" class="button" value="Cargar" name="submit">
	  </div>
	</div>	

      </form>
    </div>
  </div>
</div>

<?php
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::footer();
