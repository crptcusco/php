<?php
// ---------------------------------------------- ini-libs
include ("../librerias.v2/html/etiquetas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<div class="row">
    <div class="large-12 columns">
        <?php
        echo 'aqui';
        ?>         
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();