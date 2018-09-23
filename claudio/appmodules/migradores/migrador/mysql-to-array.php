<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$mysqli = new mysqli("localhost", "root", "allemant", "allemant02");
// $mysqli = new mysqli("localhost", "root", "admin", "ella");


/*
$sql = "
SELECT
  id AS 'distrito_id'
, idProvincia AS 'provincia_id'
, Nombre AS 'nombre'
FROM distrito 
";
$name = 'ubi_distrito';
*/


/*
$sql = "
SELECT
  id AS 'provincia_id'
, idDepartamento AS 'departamento_id'
, Nombre AS 'nombre'
FROM provincia 
";
$name = 'ubi_provincia';
*/


/*
$sql = "
SELECT
  id AS 'departamento_id'
, Nombre AS 'nombre'
FROM departamento 
";
$name = 'ubi_departamento';
*/


/*
$sql = "
SELECT 
  DISTINCT em.tipoautomovil AS 'nombre'
FROM estudiomercadoauto em
";
$name = 'em_vehiculo_tipo';
*/


/*
$sql = "
SELECT 
  DISTINCT clasificacion 
FROM estudiomercadomaquinaria
";
$name = 'em_maquinaria_tipo';
*/


/*
$sql = "
SELECT 
  DISTINCT em.marca as 'nombre'
FROM estudiomercadoauto em
";
$name = 'em_vehiculo_marca';
*/


/*
$sql = "
SELECT 
  DISTINCT em.modelo AS 'nombre'
FROM estudiomercadoauto em
ORDER BY 1
";
$name = 'em_vehiculo_modelo';
*/


/*
$sql = "
SELECT 
  DISTINCT em.marca as 'nombre'
FROM estudiomercadomaquinaria em
ORDER BY 1
";
$name = 'em_maquinaria_marca';
*/


/*
$sql = "
SELECT 
  DISTINCT em.modelo AS 'nombre'
FROM estudiomercadomaquinaria em
ORDER BY 1
";
$name = 'em_maquinaria_modelo';
*/


/*

*/

$sql = "
SELECT 
  DISTINCT em.zonificacion  AS 'nombre'
FROM estudiomercadoinmueble em
ORDER BY 1
";
$name = 'em_zonificacion';

/*
$sql = "
";
$name = '';
*/

?>
<div class="row">
  <div class="large-12 columns">
    <textarea rows="10" cols="500"><?php mysql_sql($sql, $name); ?>
    </textarea>
  </div>
</div>

<?php
function mysql_sql($sql, $name) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $result = $mysqli->query($sql);
  $data = array();
  while ($row = $result->fetch_assoc()) {    
    $sql_keys = '';
    $sql_values = '';

    foreach ($row as $key => $value) {
      $sql_keys .= $key .', ';
      // $value = utf8_decode( $value );
      $sql_values .= "'". trim($value) ."', ";
    }

    $sql_keys = substr($sql_keys, 0, -2);
    $sql_values = substr($sql_values, 0, -2);
    
    $sql ='INSERT INTO '.$name.'('.$sql_keys.') VALUES('.$sql_values.');';
    echo $sql ."\n";
  }  
  return $data;
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
