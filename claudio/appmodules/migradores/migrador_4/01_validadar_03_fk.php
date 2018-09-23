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
echo "<h2 style='background-color: #64A4F1;'>-- FK </h2>";
foreach ($tablas as $fuente => $destino) {    
    fk_process_table($fuente, $destino);
}

// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()

function fk_replace_by_diccionario( $tabla, $campo, $value, $id ) {
  global $q;
  $q->fields = array(
    'nombre'=>''
  );
  $q->sql = '
            UPDATE ' . $tabla . ' SET ' . $campo . ' = "' . $id . '" 
            WHERE ' . $campo . ' = "' . $value . '"
            ';
  $q->data = NULL;
  //$q->exe();
  echo $q->sql . ';<br>';
}
function fk_insert_diccionario( $tabla, $value ) {
  global $q;
  $q->fields = array();
  $q->sql = '
            INSERT INTO ' . $tabla . '(nombre)
            VALUES("' . $value . '")
            ';
  $q->data = NULL;
  $q->exe();
  
  $q->fields = array(
    'nombre'=>''
  );
  $q->sql = '
            SELECT id FROM ' . $tabla . '
            WHERE nombre="' . $value . '";
            ';
  $q->data = NULL;
  $data = $q->exe();
  return $data[0]['nombre'];
}
function fk_data_tabla( $tabla, $campo ) {
  global $q;
  $q->fields = array(
    'nombre'=>''
  );
  $q->sql = '
            SELECT DISTINCT ' . $campo . ' FROM ' . $tabla . '
            ';
  $q->data = NULL;
  $data = $q->exe();
  return $data;
}
function fk_data_diccionario( $nombre ) {
  global $q;
  $q->fields = array(
    'id'=>''
    , 'nombre'=>''
  );
  $q->sql = '
    SELECT id, nombre FROM ' . $nombre . ' 
            ';
  $q->data = NULL;
  $data = $q->exe();
  $i=0;
  $data_id = array();
  $data_nombre = array();
  foreach($data as $row) {
    $i++;
    $data_id[$i] = $row['id'];
    $data_nombre[$i] = $row['nombre'];
  }
  $output['id'] = $data_id;
  $output['nombre'] = $data_nombre;
  return $output;  
}
function fk_process_field($tabla, $campo, $diccionario) {
        echo "<h4 style='background-color: #D2EDFE;'>-- $campo</h4>";
    $search = fk_data_diccionario( $diccionario );
    $datos = fk_data_tabla( $tabla, $campo );
    foreach ($datos as $row) {
    	$value = utf8_encode( $row['nombre'] );
    	$id = array_search($value, $search['nombre'] );
    	if ( $id === False ) {
    	    echo '<div style="background-color: #A8F6A6">-- nuevo registro</div>';
    	    $id = fk_insert_diccionario( $diccionario, $value );
    	    $cnt = count( $search['id'] ) + 1;
    	    $search['id'][$cnt] = $id;
    	    $search['nombre'][$cnt] = $value;
    	} else {
    	    $id = $search['id'][$id];
    	}
    	fk_replace_by_diccionario( $tabla, $campo, $value, $id );
    }
}
function fk_process_filter( $campos, $mapa) {
    $output= array();
    foreach ($campos as $campo) {
	if ( isset( $mapa[$campo] ) ) {
	    if ($mapa[$campo]['table']!=''
		) {
		$output[$campo] = $mapa[$campo]['table'];
	    }
	}
    }
    return $output;
}
function fk_process_table($fuente, $destino) {
    global $mapa;
    $campos = mapeador_info_fields_data( $fuente );
    $campos = fk_process_filter( $campos, $mapa[$destino] );
    echo "<h3 style='background-color: #96D4FB;'>-- $fuente - $destino </h3>";
    foreach ($campos as $campo => $diccionario ) {
	fk_process_field( $fuente, $campo, $diccionario );
    }
}

