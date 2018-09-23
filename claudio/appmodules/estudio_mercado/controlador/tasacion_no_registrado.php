<?php
################# LIBRERIAS #####################
require_once '../config.php';
require_once RUTA.'modelo/tasacion_no_registrado.php';

################ OPCIONES ####################
if (!isset($_POST['opcion'])) {
    header('Location: '.RUTA.'vista/error.php');
}
$opcion = $_POST['opcion'];

switch ($opcion) {
    case "nuevo":
    $nuevo_no_registrado_data = array(
        'id' => "",
        'proyecto_id' => $_POST['informe_id'],
        'informe_id' => $_POST['informe_id'],
        'tasacion_fecha' => $_POST['tasacion_fecha'],
        'usuario_registro_id' => $_POST['usuario_registro_id'],
        'observacion' => $_POST['observacion']);
$NoRegistrado = new NoRegistrado();
$NoRegistrado->set($nuevo_no_registrado_data);
header('Location:../vista/tasacion_informe.php?mensaje="Tasacion ingresada correctamente"');
break; 
default:
break;
}
?>