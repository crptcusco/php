<?php

$opcion = '';
if (isset($_POST['opcion'])) {
    $opcion = $_POST['opcion'];
} elseif (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];
} else {
    header('Location: ../vista/prohibido.php');
}

switch ($opcion) {
    case "ingresar":
        $usuario = new Usuario();
        break;
    case "salir":

        break;
    default:
        header('Location: ../vista/prohibido.php');
        break;
}
