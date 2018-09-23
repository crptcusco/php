<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
/* EtiquetasHtml::$files['header']['css'][] = './style01.css'; */
/* EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css'; */
/* EtiquetasHtml::$title = 'procesar definiciones de diccionarios-redundantes'; */
EtiquetasHtml::$path = '../../librerias.v2';
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
  SELECT tipo, fecha, departamento, provincia, distrito, latitud, longitud, ruta
  FROM em_input_inmuebles
  ';
  $result = $mysqli->query($sql);
  $bandera_existentes = true;
  if ( is_object($result) ) {
    echo '<h1>LLenar los diccionarios</h1>';
    while ( $row = $result->fetch_assoc() ) {
	exportar($row);
    }
  } // end-if
}// end-function



function exportar($row) 
{
    global $mysqli;
    if ($mysqli->connect_errno) 
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;    
    switch ($row['tipo'] ){
    case 'CASA': 
	$tabla='t_casa'; 
	break;
    case 'DEPARTAMENTO': 
	$tabla='t_departamento';
	break;
    case 'LOCAL COMERCIAL': 
	$tabla='t_local_comercial';
	break;
    case 'LOCAL INDUSTRIAL': 
	$tabla='t_local_industrial'; 
	break;
    case 'TERRENO': 
	$tabla='t_terreno'; 
	break;

    }/*end switch*/ 
    $sql = 'INSERT INTO %s(tasacion_fecha, ubi_departamento_id, ubi_provincia_id, ubi_distrito_id, mapa_latitud, mapa_longitud, ruta_informe) 
            VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s")';

    $sql = sprintf($sql
		   , $tabla
		   , $row['fecha']
		   , inserta_diccionario( 'diccionario_ubi_departamento','nombre',$row['departamento'] )
		   , inserta_diccionario( 'diccionario_ubi_provincia','nombre',$row['provincia'] )
		   , inserta_diccionario( 'diccionario_ubi_distrito','nombre',$row['distrito'] )
		   , $row['latitud']
		   , $row['longitud']
		   , corregir( $row['ruta'] )
		   );
    $mysqli->query($sql);
    echo $sql.'<br>';
}

function corregir($sql) {
    $sql = trim($sql);
    $sql = str_replace('\\', '\\\\', $sql);
    $sql = str_replace('"', '\"', $sql);

    return $sql;
}

function inserta_diccionario($tabla,$campo,$valor) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;

  $sql = 'SELECT * FROM %s WHERE %s ="%s"';
  $sql = sprintf($sql,$tabla,$campo,$valor);
  $result = $mysqli->query($sql);
  if ($result->num_rows==0) {
    $sql = 'INSERT INTO diccionario_%s(nombre,sinonimo) VALUES("%s",0)';
    $sql = sprintf( $sql, $tabla, $valor );
    $mysqli->query($sql);
  }
  $sql = 'SELECT id FROM %s WHERE %s ="%s"';
  $sql = sprintf($sql,$tabla,$campo,$valor);
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  return $row['id'];
}

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

