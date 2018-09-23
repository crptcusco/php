<?php
// ---------------------------------------------- ini-libs
include ("../html/etiquetas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 

EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$files['header']['css'][] = './style02.css';
EtiquetasHtml::$files['header']['css'][] = './style03.css';
EtiquetasHtml::$files['header']['js'][] = './scripts01.js';
EtiquetasHtml::$files['header']['js'][] = './scripts02.js';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '..';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<div class="row">
    <div class="large-5 columns">
        <?php
        EtiquetasHtml::h(3, 'Testing');
        EtiquetasHtml::printr( array('aaa', 'bbb') );
        ?>         
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['css'][] = './style01.css';
EtiquetasHtml::$files['footer']['css'][] = './style02.css';
EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::$files['footer']['js'][] = './scripts02.js';
EtiquetasHtml::$files['footer']['js'][] = './scripts03.js';
EtiquetasHtml::footer();