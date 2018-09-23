<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'guardar Final';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
foreach ($modelos as $row)
    {
	echo '-----------------------------------<br>';
	echo '-- '.$row['fuente'].' && '.$row['destino'].'<br>';
	echo '-----------------------------------<br>';
	guardar_data($row['fuente'],$row['destino']);
    }/*end foreach*/

function guardar_data($fuente,$destino) {
    global $mysqli;
    $tabla['fuente'] = $fuente;
    $tabla['destino'] = $destino;
    
    $fuente = desc_table($tabla['fuente']);
    $destino = info_table($tabla['destino']);

    $data = array();
    $sql['encabezado'] = '';
    foreach ($fuente as $field) {
	if ( is_array($destino[$field] ) ) {
	    $data[$field]=$destino[$field];
	    $sql['encabezado'] .= ', '.$destino[$field]['campo'];
	    if ($destino[$field]['categoria']=='diccionario') 
		$sql['encabezado'] .='_id ';
	}
    }
    $sql['encabezado'] = substr($sql['encabezado'], 1);
    $query='SELECT * FROM '.$tabla['fuente'];
    $result = $mysqli->query($query);
    $sql_cols ="";
    while ($row = $result->fetch_assoc()) {
	$sql='';
	$sql_values='';

	if ($sql_cols == "") {
	    foreach ($row as $key => $value) {
		if ( is_array($data[$key]) ) {
		    $sql_cols.=','.$key;
		    if ($data[$key]['categoria']=='diccionario') {
			$sql_cols.='_id';
		    }//end-if
		}//end-if
	    }//end-foreach
	    $sql_cols = substr($sql_cols, 1);
	} // end-if
	
	foreach ($row as $key => $value) {
	    $value = trim($value);
	    $value = str_replace('"', '\"', $value);
	    $value = str_replace('\\', '\\\\', $value);
	    //$value = utf8_encode($value);
	    
	    if ($data[$key]['tipo_dato'] == 'DATE') {
		$arr_tmp = explode("/", $value); 
		if (count($arr_tmp)==3) {
		    $value = $arr_tmp[2] . '-' . $arr_tmp[1] . '-' . $arr_tmp[0];
		}
	    }
	    
	    if ($data[$key]['categoria'] == 'diccionario') {
		$sql_values.= ', ';
		$sql_values.= '"' . busca_diccionario($key,'nombre',$value) .'"';
	    } elseif ($data[$key]['categoria'] == 'valor') {
		$sql_values.= ', ';
		$sql_values.= '"' . $value . '"';
	    }    
	} // end-foreach
	$sql_values = substr($sql_values, 1);
	$sql = sprintf('INSERT INTO %s (%s) VALUES(%s)',$tabla['destino'],$sql_cols,$sql_values);
	//$mysqli->query($sql);
	print utf8_encode($sql).';<br>';
	$sql='';
	$sql_values='';
    }//end-while
    
} //end-function


function busca_diccionario($tabla,$campo,$valor) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;

  $sql = 'SELECT id FROM diccionario_%s WHERE %s ="%s"';
  $sql = sprintf($sql,$tabla,$campo,$valor);
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  return $row['id'];
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
