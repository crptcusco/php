<?php
require_once '../../config.php';
require_once('../../modelo/estudio_maquinaria.php');

$maquinaria = new maquinaria();

$in['nombre'] = trim($_POST['nombre']);

if ( count($maquinaria->existe_maquinaria_modelo($in)) == 0 )
    $maquinaria->guardar_maquinaria_modelo($in);
else
    echo 'Existe registro modelo';
?>