<?php
// ---------------------------------------------- ini-libs
include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../autentificacion/logica.php";
usuario_logeado('Cotizacion', '../autentificacion');

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Test Login user';
EtiquetasHtml::$path = '../../librerias.v2';
// EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

include ("../autentificacion/menu.php");

for($i=0;$i<100;$i++) {
  printf('%s<br>',$i);
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::footer();
