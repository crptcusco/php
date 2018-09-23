<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

$output = fopen('php://output', 'w');
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
//EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
//EtiquetasHtml::$title = 'mi titulo';
//EtiquetasHtml::$path = '../../librerias.v2';
//EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$data = tabla_campos_data();
$data[] = array('idcampo'=>'', 'tabla'=>'', 'campo'=>'' );
$tabla = '';
$row_csv = array();
$first = TRUE;

foreach ($data as $row) {
  if ($row['tabla']!=$tabla) {
    if ($first){
      $first=FALSE;
    } else {
      fputcsv( $output, array( $tabla ) );
      fputcsv( $output, $row_csv);
      fputcsv( $output, array() );
      fputcsv( $output, array() );
    }
    $tabla = $row['tabla'];
    $row_csv = array();
  }
  $row_csv[] = $row['campo'];
}

function tabla_campos_data() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT 
    c.id as idcampo
  , t.nombre as tabla
  , c.nombre as campo
  FROM tabla_has_campo tc
  JOIN tabla t ON t.id=tc.tabla_id
  JOIN campo c ON c.id=tc.campo_id
  ORDER BY t.id,tc.id
  ';
  $result = $mysqli->query($sql);
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }  
  return $data;
}

// ---------------------------------------------- ini-footer
//EtiquetasHtml::$files['footer']['js'][] = './04-limpiar-data.js';
//EtiquetasHtml::footer();
