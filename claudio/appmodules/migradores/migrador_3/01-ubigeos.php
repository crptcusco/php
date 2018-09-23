<?php
// ---------------------------------------------- ini-libs
include ("../../../librerias.v2/html/etiquetas.php");
include ("../../../librerias.v2/html/tabla.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
/* EtiquetasHtml::$files['header']['css'][] = './style01.css'; */
/* EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css'; */
/* EtiquetasHtml::$title = 'procesar definiciones de diccionarios-redundantes'; */
EtiquetasHtml::$path = '../../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

// recorrer_datos
// -- verificar dep RETURN bool
// -- verificar pro RETURN bool
// -- verificar dis RETURN bool 
// -- si es false imprimir data

recorrer_datos();
// --------------------------------- function()

function recorrer_datos() {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT id,departamento, provincia, distrito 
  FROM em_input_inmuebles
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);
  $bandera_existentes = true;
  if ( is_object($result) ) {
    echo '<h1>Lista no existentes</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</TH><TH>DEPARTAMENTO</TH><TH>PROVINCIA</TH><TH>DISTRITO</th>';
    echo '</tr>';
    while ( $row = $result->fetch_assoc() ) {
      $bandera_existentes = false;
      $bool['departamento'] =  verificar('departamento',$row['departamento']);
      $bool['provincia'] =  verificar('provincia',$row['provincia']);
      $bool['distrito'] =  verificar('distrito',$row['distrito']);
      
      if ( $bool['departamento']==0 or $bool['provincia']==0 or $bool['distrito']==0 ) {
	echo '<tr>';
	echo '<td>'.$row['id'].'</td>';
	imprimir_td($row['departamento'],$bool['departamento']);
	imprimir_td($row['provincia'],$bool['provincia']);
	imprimir_td($row['distrito'],$bool['distrito']);
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
	$consistencia = consistencia($row['departamento'], $row['provincia'], $row['distrito'] );
	if ( $consistencia!=0 ) {
          echo '<tr>';
          echo '<td>'.$row['id'].'</td>';
          imprimir_td($row['departamento'], 0 );
          imprimir_td($row['provincia'], 0 );
          imprimir_td($row['distrito'], 0 );
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
function sql_test() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);

}


// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = './js/identificar-definiciones.js?v=2';
EtiquetasHtml::footer();

