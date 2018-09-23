<?php
// ---------------------------------------------- ini-libs
include ("../librerias.v2/html/etiquetas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = './04_01_recargar_divs_con_ajax.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<div class="row">
    <div class="large-12 columns">
<div id="demo1" class="dd"></div>
<div id="demo2" class="dd"></div>
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = './04_01_recargar_divs_con_ajax.js';
EtiquetasHtml::footer();


