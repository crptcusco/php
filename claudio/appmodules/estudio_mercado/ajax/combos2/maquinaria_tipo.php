<?php
require_once '../../config.php';
require_once('../../modelo/estudio_maquinaria.php');

$maquinaria = new Maquinaria();
$resultado = $maquinaria->listar_maquinaria_tipo();
foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['id'],
	    utf8_encode($arreglo['nombre'])
    );
}
?>