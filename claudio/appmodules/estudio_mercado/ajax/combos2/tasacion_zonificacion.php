<?php
require_once '../../config.php';
require_once('../../modelo/tasacion_informe.php');

$tasacion = new Tasacion();
$resultado = $tasacion->listar_zonificacion();

foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['nombre'],
	    utf8_encode($arreglo['detalle'])
    );
}
?>