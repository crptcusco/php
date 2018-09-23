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
EtiquetasHtml::$path = '../../../../librerias.v2';
EtiquetasHtml::header();
// ------------------------------------------------- ini-body

$mapa = mapeador1();
include ("./input.php");

echo "<h2 style='background-color: #64A4F1;'>-- UBIGEO </h2>";
echo '<pre>';
echo
'UPDATE t_input_local_comercial 
SET ubi_distrito_id ="" 
WHERE 
    ubi_departamento_id ="" 
AND ubi_provincia_id =""
AND ubi_distrito_id =""
;
UPDATE t_input_local_comercial 
SET ubi_distrito_id ="" 
WHERE
    id = ""
;
SELECT * FROM ubi_departamento WHERE nombre LIKE "%%";
SELECT * FROM ubi_provincia WHERE nombre LIKE "%%";
SELECT * FROM ubi_provincia WHERE departamento_id="";
SELECT * FROM ubi_distrito WHERE nombre LIKE "%%";
SELECT * FROM ubi_distrito WHERE provincia_id="";
';
echo '</pre>';

$mysqli = new mysqli('localhost', 'root', 'allemant', 'claudio');
foreach ($tablas as $fuente => $destino) {
    recorrer_datos( $fuente );
}


// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function recorrer_datos($fuente) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT id,ubi_departamento_id, ubi_provincia_id, ubi_distrito_id
  FROM ' . $fuente . '
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);
  $bandera_existentes = true;

  echo "<h3 style='background-color: #96D4FB;'>-- $fuente </h3>";
  
  if ( is_object($result) ) {
    echo '<h1>Lista no existentes</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</TH><TH>DEPARTAMENTO</TH><TH>PROVINCIA</TH><TH>DISTRITO</th><th></th>';
    echo '</tr>';
    while ( $row = $result->fetch_assoc() ) {
      $bandera_existentes = false;
      $bool['departamento'] =  verificar('departamento',$row['ubi_departamento_id']);
      $bool['provincia'] =  verificar('provincia',$row['ubi_provincia_id']);
      $bool['distrito'] =  verificar('distrito',$row['ubi_distrito_id']);
      
      if ( $bool['departamento']==0 or $bool['provincia']==0 or $bool['distrito']==0 ) {
	echo '<tr>';
	echo '<td>'.$row['id'].'</td>';
	imprimir_td($row['ubi_departamento_id'],$bool['departamento']);
	imprimir_td($row['ubi_provincia_id'],$bool['provincia']);
	imprimir_td($row['ubi_distrito_id'],$bool['distrito']);
	echo '</tr>';
      }
    }
    echo '<table>';
    

    echo '<h1>Lista de inconcistencias</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</TH><TH>DEPARTAMENTO</TH><TH>PROVINCIA</TH><TH>DISTRITO</th>';
    echo '</tr>';
    $result = $mysqli->query($sql);
    if ($bandera_existentes == false) {
      while ( $row = $result->fetch_assoc() ) {
	$consistencia = consistencia($row['ubi_departamento_id'], $row['ubi_provincia_id'], $row['ubi_distrito_id'] );
	if ( $consistencia!=0 ) {
          echo '<tr>';
          echo '<td>'.$row['id'].'</td>';
          imprimir_td($row['ubi_departamento_id'], 0 );
          imprimir_td($row['ubi_provincia_id'], 0 );
          imprimir_td($row['ubi_distrito_id'], 0 );
          echo '</tr>';
	}
      }      
    }

    echo '<table>';
  } // end-if
}
function imprimir_td($val,$count) {
  echo '<td>';
  if ($count==0){
    print '<b style="color:red">'.utf8_encode($val).'<b>';
  } else {
    print '<b style="color:blue">'.utf8_encode($val).'<b>';
  }
  echo '</td>';
}
function verificar($tipo, $name) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $tabla='';
  if ($tipo =='departamento'){
    $tabla='ubi_departamento';
  } elseif ($tipo =='provincia'){
    $tabla='ubi_provincia';
  } elseif ($tipo =='distrito'){
    $tabla='ubi_distrito';
  }
  
  $sql = '
          SELECT *
          FROM '.$tabla.'
          WHERE nombre = "'.$name.'"
    ';
  $result = $mysqli->query($sql);
  $i=0;
  if ( is_object($result) ) {
    while ( $row = $result->fetch_assoc() ) {
      $i++;
    }
  }
  return $i;
}
function consistencia($departamento, $provincia, $distrito) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;


  $id = get_departamento_id( $departamento );
  if ($id!=0) {
    $id = get_provincia_id( $provincia, $id );
    if ($id!=0) {
      $id = get_distrito_id( $distrito, $id );
    }
  }
  
  if ($id!=0) {
    return false;
  } else{
    return true;
  }

}
function get_departamento_id($name) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $tabla='';
  
  $sql = '
          SELECT departamento_id as "id"
          FROM ubi_departamento
          WHERE nombre = "'.$name.'"
    ';
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  if ($row != null){
    return $row['id'];
  } else {
    return 0;
  }
}
function get_provincia_id($name,$departamento_id) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $tabla='';
  
  $sql = '
          SELECT provincia_id as "id"
          FROM ubi_provincia
          WHERE nombre = "'.$name.'" AND departamento_id='.$departamento_id.'
  ';
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  if ($row != null){
    return $row['id'];
  } else {
    return 0;
  }
  
}
function get_distrito_id($name,$provincia_id) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $tabla='';
  
  $sql = '
          SELECT distrito_id as "id"
          FROM ubi_distrito
          WHERE nombre = "'.$name.'" AND provincia_id='.$provincia_id.'
  ';
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  if ($row != null){
    return $row['id'];
  } else {
    return 0;
  }
  
}
