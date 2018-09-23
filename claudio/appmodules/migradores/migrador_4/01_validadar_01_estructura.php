<?php
// ---------------------------------------------- ini-libs
include ("../../../librerias.v2/html/etiquetas.php");
include ("../../../librerias.v2/html/tabla.php");
include ("../../../librerias.v2/mysql/dbconnector.php");
include ("./libs/conexion.php");
include ("./libs/info.php");
include ("./libs/mapeador.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['footer']['css'][] = '../../css/.css?v=1.0.0';
EtiquetasHtml::$title = 'Validar enteros'; 
EtiquetasHtml::$path = '../../../librerias.v2';
EtiquetasHtml::header();
// ------------------------------------------------- ini-body
include ("./input.php");

$data1 = mapeador1();
$data2 = mapeador2();
$data3 = array();
foreach ($tablas as $fuente => $destino) {
    $data3[$destino] = mapeador_info_fields_data( $fuente );
}

$tipos = mapeador_tipos_listar_distintos( $data1 );
$verificar1 = mapeador_info_fields1( $data1 );
$verificar2 = mapeador_info_fields2( $data1 );
$verificar3 = mapeador_info_fields3( $data1, $data3 );
$diferencias_tipos = mapeador_comparar_mapa($data1, $data2);
?>
<div class="row">
  <div class="large-4 columns">
    Mapa1: resumen de las tablas relacionadas
  </div>
  <div class="large-4 columns">
    Mapa2: tablas relacionada
  </div>
  <div class="large-4 columns">
    Entrada:
  </div>    
</div>
<div class="row">
  <div class="large-4 columns">
    <?php info_data( 'Mapa1', $data1 ); ?>
  </div>
  <div class="large-4 columns">
    <?php info_data( 'Mapa2', $data2 ); ?>
  </div>
  <div class="large-4 columns">
    <?php info_data( 'Mapa3', $data3 ); ?>
  </div>    
</div>

<div class="row">
  <div class="large-12 columns">
    <?php info_data( 'Tipos', $tipos ); ?>
  </div>
</div>

<div class="row">
  <div class="large-4 columns">
    <?php info_data( 'Mapa1 - Mapa2', $verificar1 ); ?>
  </div>
  <div class="large-4 columns">
    <?php info_data( 'Mapa2 - Mapa1', $verificar2 ); ?>
  </div>
  <div class="large-4 columns">
    <?php info_data( 'Mapa1 - Mapa3', $verificar3 ); ?>
  </div>    
</div>

<div class="row">
  <div class="large-12 columns">
    <?php info_data( 'Diferencia de Tipos', $diferencias_tipos ); ?>
  </div>
</div>

<?php
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
