<?php
// ---------------------------------------------- ini-libs
include ("../librerias.v2/html/etiquetas.php");
include ("../librerias.v2/html/file.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

File::save_image('./', $_FILES["image"], '0001');
// mejorar poner  entradas por separado, path, file,  name
// para poder guardar un tipo de dato diferencite

?>
<div class="row">
    <div class="large-12 columns">
        <?php
            EtiquetasHtml::printr($_FILES["image"]);
        ?>         
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
