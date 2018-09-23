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
        <div id="miDisparador">
            <a href="#">Add</a>
        </div>
        <table class="table" id="miTabla">
            <thead><tr><th>Campo</th><th></th></tr></thead>
            <tbody>                
            </tbody>
        </table> 

    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = './03_tabla_dinamica_anadir_eliminar_items.js';
EtiquetasHtml::footer();