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

echo "<h2 style='background-color: #64A4F1;'>-- DATE </h2>";

foreach ($tablas as $fuente => $destino) {
    date_process_table($fuente, $destino);
}


// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function date_data_field_ok( $tabla, $campo, $value ) {
    $value2 = substr($value, 6,4) . '-'. substr($value, 3,2) . '-' . substr($value, 0,2);
    echo 'UPDATE ' . $tabla . ' SET ' . $campo . '="' . $value2 . '" WHERE '.$campo .'="' . $value . '";<br>';
}
function date_data_field_error( $tabla, $campo, $value ) {
    echo '<span style="background-color:red; colo:white;"> UPDATE ' . $tabla . ' SET ' . $campo . '="' . $value . '" WHERE '.$campo .'="' . $value . '";-- error</span><br>';
}
function date_validate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function date_data_tabla( $tabla, $campo ) {
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
function date_process_field($tabla, $campo) {
    echo "<h4 style='background-color: #D2EDFE;'>-- $campo</h4>";
    $datos = date_data_tabla( $tabla, $campo );
    foreach ($datos as $row) {
    	$value = utf8_encode( $row['nombre'] );
	if( ! date_validate( $value, 'Y-m-d') ) {
	    if( ! date_validate( $value, 'd/m/Y') ) {
		date_data_field_error( $tabla, $campo, $value );
	    } else {
		date_data_field_ok( $tabla, $campo, $value );
	    }
	}

    }
}
function date_process_filter( $campos, $mapa) {
    $output= array();
    foreach ($campos as $campo) {
	if ( isset( $mapa[$campo] ) ) {
	    if ($mapa[$campo]['tipo']=='date' &&
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
function date_process_table($fuente, $destino) {
    global $mapa;
    $campos = mapeador_info_fields_data( $fuente );
    $campos = date_process_filter( $campos, $mapa[$destino] );
    echo "<h3 style='background-color: #96D4FB;'>-- $fuente - $destino </h3>";
    foreach ($campos as $campo ) {
    	date_process_field( $fuente, $campo);
    }
}

