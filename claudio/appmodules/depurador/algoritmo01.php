<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("./reutilizables.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode();
EtiquetasHtml::$title = 'Depurador';
EtiquetasHtml::$path = '../../librerias.v2';
// EtiquetasHtml::$files['header']['css'][] = '../../static/css/.css?v=1.0.0';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
if ( isset( $_POST['algoritmo01_field_columna_indice'] ) ) {
    $indice = $_POST['algoritmo01_field_columna_indice'];
} else {
    $indice = '';
}
if ( isset( $_POST['algoritmo01_field_columnas_a_cambiar'] ) ) {
    $cambiar = $_POST['algoritmo01_field_columnas_a_cambiar'];
} else {
    $cambiar = '';
}
?>
<?php $group = 'algoritmo01'  ?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="small-12 columns text-center">
      <u>A consultar</u>: <a href="./algoritmo01/test/01.csv">01</a> , <u>A modificar</u>: <a href="./algoritmo01/test/02.csv">02</a>; 
      <u>Columna Indice</u>: "COL0 COL1", <u>Columna a Cambiar</u>: "COL5 COL6"
      <hr>
    </div>
  </div>  
  <div class="row"> 
    <div class="small-2 columns text-right">
      <label for="<?php prefix('a_consultar') ?>" class="">A consultar</label>
    </div>
    <div class="small-3 columns">
      <input type="file" name="<?php prefix('a_consultar') ?>" id="<?php prefix('a_consultar') ?>">
    </div>   

    <div class="small-2 columns  text-right">
      <label for="<?php prefix('columna_indice') ?>" class="inline">Columna Indice</label>
    </div>
    <div class="small-5 columns">
      <input type="text" name="<?php prefix('columna_indice') ?>" id="<?php prefix('columna_indice') ?>" value="<?php echo $indice ?>">
    </div>  
  </div>
  <div class="row"> 
    <div class="small-2 columns text-right">
      <label for="<?php prefix('a_modificar') ?>" class="">A Modificar</label>
    </div>
    <div class="small-3 columns">
      <input type="file" name="<?php prefix('a_modificar') ?>" id="<?php prefix('a_modificar') ?>">
    </div>

    <div class="small-2 columns  text-right">
      <label for="<?php prefix('columnas_a_cambiar') ?>" class="inline">Columnas a cambiar</label>
    </div>
    <div class="small-5 columns">
      <input type="text" name="<?php prefix('columnas_a_cambiar') ?>" id="<?php prefix('columnas_a_cambiar') ?>" value="<?php echo $cambiar ?>">
    </div> 
  </div>

  <div class="row">
    <div class="small-12 columns text-right">
      <input type="submit" name="<?php prefix('save') ?>" class="button tiny success">
    </div>
  </div>
</form>

<?php
// info_clds_print('Global', $GLOBALS);

if (
    isset ($_FILES['algoritmo01_field_a_consultar'])
    && $_FILES['algoritmo01_field_a_consultar']['size'] != 0
    && isset ($_FILES['algoritmo01_field_a_modificar'])
    && $_FILES['algoritmo01_field_a_modificar']['size'] !=0
    && isset ($_POST['algoritmo01_field_columna_indice'])
    && $_POST['algoritmo01_field_columna_indice'] != ''
)
{
    include './algoritmo01/load.php';
}


// ---------------------------------------------- ini-footer
//EtiquetasHtml::$files['footer']['js'][] = '../../static/js/.js?v=1.0.0';
EtiquetasHtml::footer();

function prefix( $name ) {
  global $group;
  echo $group . '_field_'. $name;
}
