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

$tablas["t_casa"] = "t_casa";
/* $tablas["t_departamento"] = "t_departamento"; */
/* $tablas["t_local_comercial"] = "t_local_comercial"; */
/* $tablas["t_local_industrial"] = "t_local_industrial"; */

/* $tablas["em_casa"] = "em_casa"; */
/* $tablas["em_departamento"] = "em_departamento"; */
/* $tablas["em_local_comercial"] = "em_local_comercial"; */
/* $tablas["em_local_industrial"] = "em_local_industrial"; */


echo "<h2 style='background-color: #64A4F1;'>-- UBIGEO INTERNO </h2>";
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
  SELECT
  o.id      codigo
, ubi_departamento_id
, de.nombre ubi_departamento_nombre
, ubi_provincia_id
, pr.nombre ubi_provincia_nombre
, ubi_distrito_id
, di.nombre ubi_distrito_nombre
  FROM ' . $fuente . ' o
  LEFT JOIN diccionario_ubi_departamento de ON de.id=ubi_departamento_id
  LEFT JOIN diccionario_ubi_provincia pr ON pr.id=ubi_provincia_id
  LEFT JOIN diccionario_ubi_distrito di ON di.id=ubi_distrito_id
  ORDER BY 1
  ';  
  $result = $mysqli->query($sql);
  $bandera_existentes = true;

  echo "<h3 style='background-color: #96D4FB;'>-- $fuente </h3>";
  
  if ( is_object($result) ) {
    echo '<h1>Lista no existentes</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</TH><TH colspan="2">DEPARTAMENTO</TH><TH colspan="2">PROVINCIA</TH><TH colspan="2">DISTRITO</th><th></th>';
    echo '</tr>';
    while ( $row = $result->fetch_assoc() ) {      
      $bool['departamento'] =  verificar('departamento',$row['ubi_departamento_nombre']);
      $bool['provincia'] =  verificar('provincia',$row['ubi_provincia_nombre']);
      $bool['distrito'] =  verificar('distrito',$row['ubi_distrito_nombre']);
      
      if ( $bool['departamento']==0 or $bool['provincia']==0 or $bool['distrito']==0 ) {
	  //$bandera_existentes = false;
	echo '<tr>';
	echo '<td>'.$row['codigo'].'</td>';
	imprimir_td($row['ubi_departamento_id']    , $bool['departamento']);
	imprimir_td($row['ubi_departamento_nombre'], $bool['departamento']);
	imprimir_td($row['ubi_provincia_id']       , $bool['provincia']);
	imprimir_td($row['ubi_provincia_nombre']   , $bool['provincia']);
	imprimir_td($row['ubi_distrito_id']        , $bool['distrito']);
	imprimir_td($row['ubi_distrito_nombre']    , $bool['distrito']);
	echo '<td style="background-color: #5b5656;">';
	printf('UPDATE %s SET ubi_distrito_id =  WHERE ubi_departamento_id = %d AND ubi_provincia_id = %d AND ubi_distrito_id = %d;'
	       , $fuente
	       , $row['ubi_departamento_id']
	       , $row['ubi_provincia_id']
	       , $row['ubi_distrito_id']
	    );
	echo '</td>';
	echo '</tr>';
      }
    }
    echo '<table>';
    

    echo '<h1>Lista de inconcistencias</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</TH><TH colspan="2">DEPARTAMENTO</TH><TH colspan="2">PROVINCIA</TH><TH colspan="2">DISTRITO</th>';
    echo '</tr>';
    $result = $mysqli->query($sql);
    if ($bandera_existentes) {
      while ( $row = $result->fetch_assoc() ) {
	$consistencia = consistencia($row['ubi_departamento_nombre'], $row['ubi_provincia_nombre'], $row['ubi_distrito_nombre'] );
	if ( $consistencia!=0 ) {
          echo '<tr>';
          echo '<td>'.$row['codigo'].'</td>';
	  imprimir_td($row['ubi_departamento_id']    , 1);
	  imprimir_td($row['ubi_departamento_nombre'], 1);
	  imprimir_td($row['ubi_provincia_id']       , 1);
	  imprimir_td($row['ubi_provincia_nombre']   , 1);
	  imprimir_td($row['ubi_distrito_id']        , 1);
	  imprimir_td($row['ubi_distrito_nombre']    , 1);
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
