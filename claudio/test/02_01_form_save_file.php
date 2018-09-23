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
        <form action="02_02_form_save_file.php" method="post"
              enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="image" id="file"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
