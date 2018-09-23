<?php
require_once '../../config.php';
require_once('../../modelo/tasacion_informe.php');

$tasacion = new Tasacion();
$resultado = $tasacion->listar_tipo_cultivo();

foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['id'],
	    utf8_encode($arreglo['nombre'])
    );
}
?>