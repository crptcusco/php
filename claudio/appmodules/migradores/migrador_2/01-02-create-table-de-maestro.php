<?php
$output = fopen('php://output', 'w');
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'crear fuente apartir de maestro';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body


$data = tabla_campos_data();
$data[] = array( 'idcampo'=>'', 'tabla'=>'', 'campo'=>'' );

$tabla = '';
$row_csv = array();
$first = TRUE;
$campos = '';
$values = '';
foreach ($data as $row) {
  if ($row['tabla']!=$tabla) {
    if ($first){
      $first=FALSE;
    } else {
      $campos = substr($campos, 0, -2); 
      $values = substr($values, 0, -2); 
      printf ('DROP TABLE IF EXISTS %s<br>;<br>',$tabla);
      printf ('CREATE TABLE %s(%s)<br>;<br>',$tabla,$campos);
      //printf ('INSERT INTO %s<br> VALUES(%s)<br>;<br>',$tabla,$values);
    }
    $campos = '';
    $values = '';
    $tabla = $row['tabla'];

  }
  $campos .= $row['campo'].' TEXT, ';
  $values .= '"", ';
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
EtiquetasHtml::footer();
