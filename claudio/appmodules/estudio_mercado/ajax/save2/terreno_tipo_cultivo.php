<?php
require_once '../../config.php';
require_once('../../modelo/tasacion_informe.php');

$tasacion = new Tasacion();

$in['nombre'] = trim($_POST['nombre']);

if ( count($tasacion->existe_tipo_cultivo($in)) == 0 )
    $tasacion->guardar_tipo_cultivo($in);
else
    echo 'Existe Tipo de Cultivo';
// 
?>