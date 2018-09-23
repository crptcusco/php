<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
 EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'verificar consitencias de diccionarios: fuente y destino';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
foreach ($modelos as $row)
    {
	echo '<hr>';
	echo '<h1>"<u>'.$row['fuente'].'</u>" && "<u>'.$row['destino'].'</u>"</h1>';
	echo '<hr>';
	verificar_data($row['fuente'],$row['destino']);
    }/*end foreach*/

function verificar_data($fuente,$destino) {
    $data = campos($fuente,$destino);

    print '<table>';
    foreach($data as $row) {
	print '<tr>';
	print '<td colspan="2"><center>';
	print $row;
	print '</center></td>';
	print '</tr>';
	
	print '<tr>';
	print '<td>';
	print 'fuente';
	print '</td>';
	print '<td>';
	print 'destino';
	print '</td>';
	print '</tr>';
	
	print '<tr>';
	print '<td>';
	totales_fuente($row, $fuente);
	print '</td>';
	print '<td>';
	totales_destino($row, $destino);
	print '</td>';
	print '</tr>';
    } //end-foreach
    print '</table>';
    
}//end-function

function totales_destino($campo, $destino) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT 
    COUNT(t.%1$s_id) AS "count"
  , d.nombre AS "diccionario"
  FROM %2$s t
  JOIN diccionario_%1$s d ON d.id=t.%1$s_id
  GROUP BY t.%1$s_id
  ORDER BY 2
  ';
  $sql = sprintf($sql, $campo,$destino);
  $result = $mysqli->query($sql);
  print '<table>';
  while ($row = $result->fetch_assoc()) {
    print '<tr>';
    printf( '<td>%s</td><td>%s</td>',$row['count'],utf8_encode($row['diccionario']) );
    print '</tr>';
  }  
  print '</table>';
}

function totales_fuente($campo, $fuente) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '

  SELECT 
    COUNT(%1$s) AS "count"
  , %1$s AS "diccionario"
  FROM %2$s
  GROUP BY %1$s
  ORDER BY 2
  ';
  $sql = sprintf($sql, $campo,$fuente);
  $result = $mysqli->query($sql);
  print '<table>';
  while ($row = $result->fetch_assoc()) {
    print '<tr>';
    printf( '<td>%s</td><td>%s</td>',$row['count'],utf8_encode($row['diccionario']) );
    print '</tr>';
  }  
  print '</table>';
}


function campos($fuente,$destino) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT 
    t.nombre as tabla
  , c.nombre as campo
  , c.categoria
  FROM tabla_has_campo tc
  JOIN tabla t ON t.id=tc.tabla_id
  JOIN campo c ON c.id=tc.campo_id
  WHERE
      t.nombre ="'.$destino.'"
  AND c.categoria="diccionario"
  ORDER BY tc.id
  ';
  $result = $mysqli->query($sql);
  $data = array();
  $data[] = '';
  while ($row = $result->fetch_assoc()) {
    $data[] = $row['campo'];
  }  

  $sql = 'DESC '.$fuente;
  $result = $mysqli->query($sql);
  $data2 = array();
  while ($row = $result->fetch_array()) {
    if (array_search($row[0], $data)) {
      $data2[] = $row[0];
    }
    
  }  
  return $data2;
}

// ---------------------------------------------- ini-footer
//EtiquetasHtml::$files['footer']['js'][] = './04-limpiar-data.js';
EtiquetasHtml::footer();
