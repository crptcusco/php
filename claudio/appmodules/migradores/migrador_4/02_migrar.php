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

echo "<h2 style='background-color: #64A4F1;'>-- MIGRAR </h2>";
$data1 = mapeador1();
$data3 = array();
foreach ($tablas as $fuente => $destino) {
    $data3[$destino] = mapeador_info_fields_data( $fuente );
}
$validos = mapeador_info_fields3_b( $data1, $data3 );
// info_data( '-- Campos validados', $validos );
$resumen_html = '-- ------------------------------------ TOTAL<br>';
echo '<pre>';
foreach ($tablas as $fuente => $destino) {
    migrar_process_table($fuente, $destino);
}
echo '</pre>';
echo $resumen_html;
// info_data( 'Mapa1', $mapa );
// ----------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../js/.js?v=1.0.0';
EtiquetasHtml::footer();

// ----------------------------------------------- function()
function migrar_corregir_str($sql) {
    $sql = trim($sql);
    $sql = str_replace('\\', '\\\\', $sql);
    $sql = str_replace('"', '\"', $sql);

    return utf8_encode($sql);
}

function migrar_datos($array, $campos, $fuente) {
    global $q;
    $q->fields = $array;
    $q->sql = '
SELECT ' . $campos . ' FROM ' . $fuente . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
    echo $q->sql;
}
function migrar_encabezados_array($data) {
    $output = array();
    foreach ($data as $value) {
	$output[$value] = '';
    }
    return $output;    
}
function migrar_encabezados_sql($data) {
    $output = '';
    foreach ($data as $value) {
	$output .= $value . ', ';
    }
    $output = substr($output, 0, -2);
    return $output;
}
function migrar_process_table($fuente, $destino) {
    global $validos;
    global $resumen_html;
    $encabezado_sql = migrar_encabezados_sql( $validos[$destino] );
    $encabezado_array = migrar_encabezados_array( $validos[$destino] );

    $datos = migrar_datos($encabezado_array, $encabezado_sql, $fuente);
    $i = 0;
    foreach ($datos as $row) {
	$i++;
	$values = '';
	foreach ($row as $field) {
	    $values .= '"' . migrar_corregir_str($field) . '", ';
	}
	$values = substr($values, 0, -2);
	echo 'INSERT INTO ' . $destino . '(' . $encabezado_sql . ') VALUES(' .$values . ');<br>';
    }
    $resumen_html.= '-- <u>' . $destino . ':</u> ' . $i . '<br>';
}

