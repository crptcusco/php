<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'crear tablas';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

foreach($modelos as $row) {
    echo '<hr>';
    echo '<h1>"<u>'.$row['fuente'].'</u>" && "<u>'.$row['destino'].'</u>"</h1>';
    echo '<hr>';
    generar_estructura($row['fuente'],$row['destino']);
}

function generar_estructura($in_fuente, $in_destino) {
    $fuente = campos_fuente($in_fuente);
    $destino = campos_destino($in_destino);
  crear_tabla($in_destino);
  foreach ($fuente as $field) {
    if ( is_array($destino[$field] ) ) {
      crear_campos($in_destino, $destino[$field]);
    }
  }

}

function campos_fuente($input) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $result = $mysqli->query("DESC ".$input);
  $data = array();
  while ($row = $result->fetch_assoc()) {
      $data[] = $row['Field'];
  }
  return $data;
}

function campos_destino($input) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql ="
  SELECT 
    t.prefijo
  , c.nombre AS 'campo'
  , c.tipo_dato
  , c.categoria 
  FROM tabla_has_campo tc
  JOIN tabla t ON t.id=tc.tabla_id
  JOIN campo c ON c.id=tc.campo_id
  WHERE
  t.nombre='".$input."'
  ";
  $result = $mysqli->query($sql);
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[$row['campo']] = $row;
  }  
  return $data;
}

function crear_tabla($tabla) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql =
  "
  CREATE TABLE IF NOT EXISTS ".$tabla."(
         id BIGINT NOT NULL AUTO_INCREMENT
       , PRIMARY KEY (id)
   )
  ";
  $mysqli->query($sql); 
}
function crear_campos($tabla,$campo) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;

  if ($campo['categoria']=='valor'){
    $sql =
    "
    ALTER TABLE ".$tabla." ADD ".$campo['campo']." ".$campo['tipo_dato']."
    ";
    $mysqli->query($sql);
  } elseif($campo['categoria']=='diccionario'){
    $sql =
    "
CREATE TABLE IF NOT EXISTS diccionario_".$campo['campo']."(
         id BIGINT NOT NULL AUTO_INCREMENT
       , nombre ".$campo['tipo_dato']."
       , sinonimo BIGINT 
       , PRIMARY KEY (id)
)
    ";
    $mysqli->query($sql);
    $sql =
    "
    ALTER TABLE ".$tabla." ADD ".$campo['campo']."_id BIGINT
    ";
    $mysqli->query($sql);
  }

}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
