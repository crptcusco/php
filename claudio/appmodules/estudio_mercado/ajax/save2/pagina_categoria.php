<?php
require_once '../../config.php';
require_once('../../modelo/estudio_pagina.php');

$pagina = new Pagina();

$in['nombre'] = trim($_POST['nombre']);

if ( count($pagina->existe_pagina_categoria($in)) == 0 )
    $pagina->guardar_pagina_categoria($in);
else
    echo 'Existe Categoria';
?>