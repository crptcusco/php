<?php
require_once '../config.php';
require_once(RUTA . 'modelo/estudio_pagina.php');

if (! isset($_POST['opcion'])) {
    header('Location: error.php');
}

$opcion = $_POST['opcion'];
switch ($opcion) {
    case "nuevo":
        $nueva_pagina_data = array(
            'id' => '',
            'nombre' => $_POST['nombre'],
            'url' => $_POST['url'],
            'categoria' => $_POST['categoria']
        );
        $pagina1 = new Pagina();
        $pagina1->set($nueva_pagina_data);
        header('Location: ../vista/estudio_pagina.php');
        break;
    case "editar":
        break;
    case "eliminar":
        break;
    default:
        break;
}