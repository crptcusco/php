<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'diccionarios (guardar)';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
foreach ($modelos as $row)
    {
	echo '---------------------------------<br>';
	echo '-- '.$row['fuente'].' &&'.$row['destino'].'<br>';
	echo '---------------------------------<br>';
	diccionarios($row['fuente'],$row['destino']);
    }/*end foreach*/

function diccionarios($fuente_in,$destino_in) {
    global $mysqli;

    $fuente = desc_table($fuente_in);
    $destino = info_table($destino_in);
    $mapa = mapear($fuente,$destino);

    $query='SELECT * FROM '.$fuente_in;
    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {
    	foreach ($row as $key => $value) {
	    if ($key!='id') {
		$value = trim($value);
		$value = str_replace('"', '\"', $value);
		$value = str_replace('\\', '\\\\', $value);
		//$value = utf8_encode($value);
		if ($mapa[$key]['categoria'] == 'diccionario') {
		    inserta_diccionario($key,'nombre',$value);
		} // end-if
	    } // end-if
    	} // end-foreach
    } // end-while
} //end-function


function inserta_diccionario($tabla,$campo,$valor) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;

  $sql = 'SELECT * FROM diccionario_%s WHERE %s ="%s"';
  $sql = sprintf($sql,$tabla,$campo,$valor);
  $result = $mysqli->query($sql);
  if ($result->num_rows==0) {
    $sql = 'INSERT INTO diccionario_%s(nombre,sinonimo) VALUES("%s",0)';
    $sql = sprintf( $sql, $tabla, $valor );
    $mysqli->query($sql);
    echo utf8_encode($sql).';<br>';
  } 
}


function mapear($fuente,$destino) {
    $out=array();
    foreach ($fuente as $field) {
	if ($field!='id'){
	    if ( is_array($destino[$field] ) ) {
		$out[$field]=$destino[$field];
	    } //end if    
	} // end if
    }
    return $out;
}


function desc_table($input) {
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


function info_table($input) {
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


// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = './04-limpiar-data.js';
EtiquetasHtml::footer();
