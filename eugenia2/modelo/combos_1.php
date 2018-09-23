<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once(RUTA.'sql/db_abstract_model.php');
require_once 'model_tasacion.php';

$tasacion = new Tasacion();
$respuesta='';
if ($_GET['opcion'] == 'provincias') {
    $resultado = $tasacion->listar_provincias($_POST['id_departamento']);
    foreach ($resultado as $arreglo) {
        $respuesta .= '<option value="' . $arreglo['provincia_id'] . '">' . utf8_encode($arreglo['nombre']) . '</option>';
    }
}
if ($_GET['opcion'] == 'distritos') {
    $resultado = $tasacion->listar_distritos($_POST['id_provincia']);
    foreach ($resultado as $arreglo) {
        $respuesta .= '<option value="' . $arreglo['distrito_id'] . '">' . utf8_encode($arreglo['nombre']) . '</option>';
    }
}
if ($_GET['opcion'] == 'cultivo') {
    $resultado = $tasacion->listar_cultivos();
    foreach ($resultado as $arreglo) {
        $respuesta .= '<option value="' . $arreglo['id'] . '">' . utf8_encode($arreglo['nombre']) . '</option>';
    }
}
echo $_GET['opcion'];
echo $respuesta;
?>