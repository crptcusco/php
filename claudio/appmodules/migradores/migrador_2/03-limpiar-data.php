<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'limpiar data';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
foreach ($modelos as $row)
    {
	echo '<hr>';
	echo '<h1>"<u>'.$row['fuente'].'</u>" && "<u>'.$row['destino'].'</u>"</h1>';
	echo '<hr>';
	limpiar_data($row['fuente'],$row['destino']);
    }/*end foreach*/

function limpiar_data($fuente,$destino) {

    $tabla['fuente'] = $fuente;
    $tabla['destino'] = $destino;
    
    $fuente = desc_table($tabla['fuente']);
    $destino = info_table($tabla['destino']);
    
    foreach ($fuente as $field) {	
	if ( is_array($destino[$field] ) ) {
	    // $tot = count_filter ($tabla['fuente'], $field, $destino[$field]['tipo_dato']);
	    EtiquetasHtml::h(3,$field.'('.$destino[$field]['tipo_dato'].')');
	    print_filter ($tabla['fuente'], $field, $destino[$field]['tipo_dato']);
	}
    }//end-foreach
}//end-function

function check_date($str) { 
  trim($str);
  $trozos = explode ("/", $str);
  if (count($trozos)==3){
    $dia=$trozos[0];
    $mes=$trozos[1];
    $anio=$trozos[2];
    if( checkdate ($mes,$dia,$anio) ){
      return true;
    }
    else{
      return false;
    }
  }
}

function verificar_tipo($table, $field, $in_tipo, $in_valor) {
  $tipo ['BIGINT'] ='entero';
  $tipo ['INT'] ='entero';
  $tipo ['VARCHAR'] ='cadena';
  $tipo ['TEXT'] ='cadena';
  $tipo ['DATE'] ='fecha';
  $tipo ['DECIMAL'] ='flotante';
  $tipo ['Bool'] ='booleano';
  $in_valor_3 = $in_valor;
  $in_valor = trim($in_valor);
  switch ($tipo[$in_tipo]){
    case 'entero':
      $val2 = (int)$in_valor;
      $val2 = (string) $val2;     
      if ($in_valor===$val2) {
	$a='';
    }else{
	print("<div class='row'><div class='large-6 columns'>");
	var_dump($in_valor);
	var_dump($val2);
	printf ("    <input type='text' value='%s'>
                   </div>
                   <div class='large-6 columns'>
                     <a class='button yazan' table='%s' field='%s' value='%s' href='#'>Modificar</a>
                    </div>
                 </div>"
		, $in_valor_3
		, $table
		, $field
		, $in_valor_3
		);
      }
	
      break;
    case 'flotante':
      $val2 = (float)$in_valor;
      $val2 = (string) $val2;
      if ($in_valor==$val2)
	$a='';
      else {
	print("<div class='row'><div class='large-6 columns'>");
	var_dump($in_valor);
	var_dump($val2);
	printf ("
                    <input type='text' value='%s'>
                   </div>
                   <div class='large-6 columns'>
                     <a class='button yazan' table='%s' field='%s' value='%s' href='#'>Modificar</a>
                    </div>
                 </div>"
		, $in_valor_3
		, $table
		, $field
		, $in_valor_3
		);
    }
      break;
    case 'fecha':
      if ( check_date($in_valor)==FALSE){
	print("<div class='row'><div class='large-6 columns'>");
	var_dump($in_valor);
	printf ("
                    <input type='text' value='%s'>
                   </div>
                   <div class='large-6 columns'>
                     <a class='button yazan' table='%s' field='%s' value='%s' href='#'>Modificar</a>
                    </div>
                 </div>"
		, $in_valor_3
		, $table
		, $field
		, $in_valor_3
		);
    }      
      break;
    case 'booleano':      
      if ($in_valor!=0 || $in_valor!=1)
	$a='';
      else {
	print("<div class='row'><div class='large-6 columns'>");
	printf ("
                    <input type='text' value='%s'>
                   </div>
                   <div class='large-6 columns'>
                     <a class='button yazan' table='%s' field='%s' value='%s' href='#'>Modificar</a>
                    </div>
                 </div>"
		, $in_valor_3
		, $table
		, $field
		, $in_valor_3
		);
    }
      break;
    default:
      return 0;
  }
}

function print_filter ($table, $campo, $tipo) {
  $tipo = explode("(", $tipo);
  $tipo = $tipo[0];

  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql ="SELECT DISTINCT ".$campo." FROM ".$table;
  $result = $mysqli->query($sql);
  $data = array();
  $tot=0;
  while ($row = $result->fetch_array()) { 
    verificar_tipo($table,$campo,$tipo,$row[0]);
  }  
  return $tot;

}

function count_filter ($table, $campo, $tipo) {
  $tipo = explode("(", $tipo);
  $tipo = $tipo[0];

  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql ="SELECT DISTINCT ".$campo." FROM ".$table;
  $result = $mysqli->query($sql);
  $data = array();
  $tot=0;
  while ($row = $result->fetch_array()) { 
    if ( verificar_tipo($tipo,$row[0]) == 1 )
      $tot++;
  }  
  return $tot;

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
EtiquetasHtml::$files['footer']['js'][] = './js/limpiar-data.js';
EtiquetasHtml::footer();
