<?php
require_once '../../config.php';
require_once('../../modelo/estudio_vehiculo.php');

$vehiculo = new Vehiculo();

$in['nombre'] = trim($_POST['nombre']);

if ( count($vehiculo->existe_vehiculo_traccion($in)) == 0 )
    $vehiculo->guardar_vehiculo_traccion($in);
else
    echo 'Existe registro TRACCION';

// 
?>