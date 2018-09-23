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

echo "<h2 style='background-color: #64A4F1;'>-- INT </h2>";
foreach ($tablas as $fuente => $destino) {    
    int_process_table($fuente, $destino);
}


/* echo $cadena='000089'; */
/* echo '<br>'; */
/* echo $cadena=(string)(int)$cadena; */

// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function int_data_field( $tabla, $campo, $value ) {
    $value2 = $value;
    $value2 = $bodytag = str_replace(",", "", $value2);
    $value2 = (int) $value2;
    echo 'UPDATE ' . $tabla . ' SET ' . $campo . '="' . $value2 . '" WHERE '.$campo .'="' . $value . '";<br>';
}
function int_validate( $value ) {
    $value = trim($value);
    if ($value != '') {
	if ( $value == (int)$value ) {
	    if ( strpos($value, ',') === FALSE ) {
		return TRUE;	    
	    } else {
		return FALSE;
	    }
	} else {
	    return FALSE;
	}
    } else {
	return FALSE;
    }
}
function int_data_tabla( $tabla, $campo ) {
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
function int_process_field($tabla, $campo) {
    echo "<h4 style='background-color: #D2EDFE;'>-- $campo</h4>";
    $datos = int_data_tabla( $tabla, $campo );    
    foreach ($datos as $row) {
    	$value = utf8_encode( $row['nombre'] );
	if( ! int_validate( $value ) ) {
	    int_data_field( $tabla, $campo, $value );
	}
    }
}
function int_process_filter( $campos, $mapa) {
    $output= array();
    foreach ($campos as $campo) {
	if ( isset( $mapa[$campo] ) ) {
	    if ($mapa[$campo]['tipo']=='int' &&
		$mapa[$campo]['table']=='' &&
		$campo!='ubi_departamento_id' &&
		$campo!='ubi_provincia_id' &&
		$campo!='ubi_distrito_id'
		) {
		$output[] = $campo;
	    }
	}
    }
    return $output;
}
function int_process_table($fuente, $destino) {
    global $mapa;
    $campos = mapeador_info_fields_data( $fuente );
    $campos = int_process_filter( $campos, $mapa[$destino] );
    echo "<h3 style='background-color: #96D4FB;'>-- $fuente - $destino </h3>";
    foreach ($campos as $campo ) {
    	int_process_field( $fuente, $campo);
    }
}

