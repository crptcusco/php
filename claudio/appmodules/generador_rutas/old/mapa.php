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
<div class="fixed"> 
  <nav class="top-bar" data-topbar role="navigation"> 
    <section class="top-bar-section">
      <ul class="right">
	<li class="active"><a href=".">Volver</a></li>
      </ul>
    </section>
  </nav>
</div>
<style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;
     border: 2px solid black;
     white-space: nowrap;
   }
 </style>
<?php 
include 'load.php';

if (is_array($data) ){
  include 'html.php';
  //EtiquetasHtml::$files['footer']['js'][] = 'http://maps.google.com/maps/api/js?sensor=false';
    EtiquetasHtml::$files['footer']['js'][] = 'http://maps.googleapis.com/maps/api/js?v=3&sensor=false';

  EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/markerwithlabel.js';
  EtiquetasHtml::$files['footer']['js'][] = './map.js?v=1.0.3';
}

// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::footer();
?>
