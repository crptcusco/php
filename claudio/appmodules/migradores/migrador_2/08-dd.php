<?php 
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("./listados/definiciones-diccionario-redundantes.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$title = 'verificar consitencias de diccionarios: fuente y destino';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body



// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = './js/identificar-definiciones.js?v=2';
EtiquetasHtml::footer();
?>