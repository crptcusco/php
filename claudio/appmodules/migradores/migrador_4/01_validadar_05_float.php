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

echo "<h2 style='background-color: #64A4F1;'>-- FLOAT </h2>";

foreach ($tablas as $fuente => $destino) {
    float_process_table($fuente, $destino);
}


// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function float_data_field( $tabla, $campo, $value ) {
    $value2 = trim($value);
    if ($value2 == '') {
	$value2 = 0;
    }    
    $value2 = str_replace(",", "", $value2);
    echo 'UPDATE ' . $tabla . ' SET ' . $campo . '="' . $value2 . '" WHERE '.$campo .'="' . $value . '";<br>';
}
function float_validate( $value ) {
    if ( strlen($value) > 1  ) {
	if ( $value[0] . $value[1] != '0x' ) {
	    if ( is_numeric($value) ) {
		return TRUE;
	    } else {
		return FALSE;
	    }
	} else {
	    return FALSE;
	}
    } else {
	if ( is_numeric($value) ) {
	    return TRUE;
	} else {
	    return FALSE;
	}
    }    

}
function float_data_tabla( $tabla, $campo ) {
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
function float_process_field($tabla, $campo) {
    echo "<h4 style='background-color: #D2EDFE;'>-- $campo</h4>";
    $datos = float_data_tabla( $tabla, $campo );
    foreach ($datos as $row) {
    	$value = utf8_encode( $row['nombre'] );
    	if( ! float_validate( $value ) ) {
    	    float_data_field( $tabla, $campo, $value );
    	}
    }
}
function float_process_filter( $campos, $mapa) {
    $output= array();
    foreach ($campos as $campo) {
	if ( isset( $mapa[$campo] ) ) {
	    if ($mapa[$campo]['tipo']=='float' &&
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
function float_process_table($fuente, $destino) {
    global $mapa;
    $campos = mapeador_info_fields_data( $fuente );
    $campos = float_process_filter( $campos, $mapa[$destino] );
    echo "<h3 style='background-color: #96D4FB;'>-- $fuente - $destino </h3>";
    foreach ($campos as $campo ) {
    	float_process_field( $fuente, $campo);
    }
}

