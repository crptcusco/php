<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$title = 'procesar definiciones de diccionarios-redundantes';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

listar_tablas_y_campos();

// --------------------------------- function()
function listar_tablas_y_campos() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;

  $sql = '
  SELECT
    t.nombre AS "tabla"
  , c.nombre AS "campo"
  FROM tabla_has_campo tc
  JOIN tabla t ON t.id = tc.tabla_id
  JOIN campo c ON c.id = tc.campo_id AND C.CATEGORIA="DICCIONARIO"
  ';
  //$sql = sprintf($sql);
  $result = $mysqli->query($sql);

  $data = array();
  $i=0;
  while ( $row = $result->fetch_assoc() ) {
      if (verificar_existencia_tabla($row['tabla']) &&
	  verificar_existencia_tabla('diccionario_'.$row['campo']) 
	  ) {
	  $data[] =$row;
	  printf('-- - - - - - - - - - - - - - - - - - - - - - - - - tabla: %s && Campo: %s - - - - - - - - - - - - - - - - - - - - - - - -<br>',$row['tabla'],$row['campo']);
	  listar_ids($row['tabla'],$row['campo']);
	  $i++;
      }
  }
  unset( $data[$i] );
}// end-function


function listar_ids($tabla,$campo) {
    global $mysqli;
    
    if ($mysqli->connect_errno) 
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    
    $sql = '
    SELECT 
      di.sinonimo  AS "good_id"
    , di.id AS "bad_id"
    , da.id AS "data_id"
    FROM %1$s da
    JOIN diccionario_%2$s di ON di.id=da.%2$s_id and di.sinonimo!=0
    ORDER BY 1,2
    ';
    $sql = sprintf($sql,$tabla,$campo);
    $result = $mysqli->query($sql); 
    if ( is_object($result) ) {	
	while ( $row = $result->fetch_assoc() ) {
	    hacer_backup($tabla, $campo, $row['data_id'], $row['bad_id']);
	    hacer_cambios($tabla, $campo, $row['good_id'], $row['bad_id']);
	}
    } // end-if
}/*end function: -- set_sql -- */

function hacer_backup($tabla, $campo, $data_id, $bad_id) {
    global $mysqli;
    
    if ($mysqli->connect_errno) 
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    
    $sql = '
    INSERT INTO backup_diccionarios_duplicados (tabla, diccionario, bad_id, data_id)
    VALUES("%s", "%s", "%s", "%s")
    ';
    $sql = sprintf($sql, $tabla, $campo, $bad_id, $data_id);
    printf('%s ;<br>',$sql);
    $mysqli->query($sql); 
}/*end function: -- hacer_backup -- */


function hacer_cambios($tabla, $campo, $good_id, $bad_id) {
    global $mysqli;
    
    if ($mysqli->connect_errno) 
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    
    $sql = '
    UPDATE %s SET %s_id="%s" WHERE %s_id="%s"
    ';
    $sql = sprintf($sql, $tabla, $campo, $good_id, $campo, $bad_id);
    printf('%s ;<br>',$sql);
    $mysqli->query($sql); 
}/*end function: -- hacer_cambios -- */

function verificar_existencia_tabla($name) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = '
  DESC %s
  ';
  $sql = sprintf($sql, $name);
  $result = $mysqli->query($sql);

  if (is_object($result) ) {
      return TRUE;
  } else {
      return FALSE;
  }
}// end-function


function sql_test() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);

}// end-function


// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = './js/identificar-definiciones.js?v=2';
EtiquetasHtml::footer();

