<?php
require_once '../../config.php';
require_once('../../modelo/tasacion_informe.php');

$tasacion = new Tasacion();
$resultado = $tasacion->listar_usuario_registra();

foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['id'],
	    utf8_encode($arreglo['full_name'])
    );
}
?>