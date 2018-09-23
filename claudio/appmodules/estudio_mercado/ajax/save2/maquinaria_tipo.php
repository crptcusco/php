<?php
require_once '../../config.php';
require_once('../../modelo/estudio_maquinaria.php');

$maquinaria = new maquinaria();

$in['nombre'] = trim($_POST['nombre']);

if ( count($maquinaria->existe_maquinaria_tipo($in)) == 0 )
    $maquinaria->guardar_maquinaria_tipo($in);
else
    echo 'Existe registro tipo';

//
?>