<?php
require_once('../../config.php');
require_once('../../modelo/estudio_pagina.php');

$pagina = new Pagina();
$resultado = $pagina->listar_categorias();

foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['id'],
	    utf8_encode($arreglo['nombre'])
    );
}