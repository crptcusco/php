<?php
require_once '../../config.php';
require_once('../../modelo/estudio_maquinaria.php');

$maquinaria = new maquinaria();

$in['nombre'] = trim($_POST['nombre']);

if ( count($maquinaria->existe_maquinaria_marca($in)) == 0 )
    $maquinaria->guardar_maquinaria_marca($in);
else
    echo 'Existe registro marca';
?>