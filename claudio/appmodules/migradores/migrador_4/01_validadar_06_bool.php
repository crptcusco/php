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

echo "<h2 style='background-color: #64A4F1;'>-- BOOL </h2>";

foreach ($tablas as $fuente => $destino) {
    bool_process_table($fuente, $destino);
}


// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function bool_data_field( $tabla, $campo, $value ) {
    if ( strtoupper( trim($value) ) =='SI' ) {
	$value2 = 1;
    } elseif ( strtoupper(trim($value) ) =='NO' ) {
	$value2 = 0;
    } elseif ( strtoupper(trim($value) ) =='TRUE' ) {
	$value2 = 1;
    } elseif ( strtoupper(trim($value) ) =='FALSE' ) {
	$value2 = 0;
    } elseif ( strtoupper(trim($value) ) =='VERDADERO' ) {
	$value2 = 1;
    } elseif ( strtoupper(trim($value) ) =='FALSO' ) {
	$value2 = 0;
    } elseif ( trim($value) == '' ) {
	$value2 = 0;
    } else {
	$value2 = 1;
    }
    
    echo 'UPDATE ' . $tabla . ' SET ' . $campo . '="' . $value2 . '" WHERE '.$campo .'="' . $value . '";<br>';
}
function bool_validate( $value ) {
    if ( is_numeric($value) ){
	if ( $value == 0 || $value == 1) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    } else {
	return FALSE;
    }

}
function bool_data_tabla( $tabla, $campo ) {
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
function bool_process_field($tabla, $campo) {
    echo "<h4 style='background-color: #D2EDFE;'>-- $campo</h4>";
    $datos = bool_data_tabla( $tabla, $campo );
    foreach ($datos as $row) {
    	$value = utf8_encode( $row['nombre'] );
    	if( ! bool_validate( $value ) ) {
    	    bool_data_field( $tabla, $campo, $value );
    	}
    }
}
function bool_process_filter( $campos, $mapa) {
    $output= array();
    foreach ($campos as $campo) {
	if ( isset( $mapa[$campo] ) ) {
	    if ($mapa[$campo]['tipo']=='bool' &&
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
function bool_process_table($fuente, $destino) {
    global $mapa;
    $campos = mapeador_info_fields_data( $fuente );
    $campos = bool_process_filter( $campos, $mapa[$destino] );
    echo "<h3 style='background-color: #96D4FB;'>-- $fuente - $destino </h3>";
    foreach ($campos as $campo ) {
    	bool_process_field( $fuente, $campo);
    }
}

