<?php
require_once '../../config.php';
require_once('../../modelo/estudio_vehiculo.php');

$vehiculo = new Vehiculo();
$resultado = $vehiculo->listar_vehiculo_tipo();
foreach ($resultado as $arreglo) {
    printf( '<option value="%s">%s</option>',
	    $arreglo['id'],
	    utf8_encode($arreglo['nombre'])
    );
}
?>