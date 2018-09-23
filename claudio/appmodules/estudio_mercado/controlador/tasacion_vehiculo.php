<?php
################# LIBRERIAS #####################
require_once '../config.php';
require_once RUTA.'modelo/tasacion_vehiculo.php';

################ OPCIONES ####################
if (!isset($_POST['opcion'])) {
    header('Location: '.RUTA.'vista/error.php');
}
$opcion = $_POST['opcion'];

switch ($opcion) {
    case "nuevo":
    $nuevo_vehiculo_data = array(
        'id' => "",
        'proyecto_id' => $_POST['informe_id'],
        'informe_id' => $_POST['informe_id'],
        'cliente_id' => $_POST['cliente_id'],
        'propietario_id' => $_POST['propietario_id'],
        'solicitante_id' => $_POST['solicitante_id'],
        'ubicacion' => $_POST['ubicacion'],
        'tasacion_fecha' => $_POST['tasacion_fecha'],
        'vehiculo_tipo_id' => $_POST['tasacion_vehiculo_tipo_id'],
        'vehiculo_marca_id' => $_POST['tasacion_vehiculo_marca_id'],
        'vehiculo_modelo_id' => $_POST['tasacion_vehiculo_modelo_id'],
        'fabricacion_anio' => $_POST['fabricacion_anio'],
        'vehiculo_traccion_id' => $_POST['tasacion_vehiculo_traccion_id'],
        'valor_similar_nuevo' => $_POST['valor_similar_nuevo'],
        'valor_comercial' => $_POST['valor_comercial'],
        'tipo_cambio' => $_POST['tipo_cambio'],
        'observacion' => $_POST['observacion'],
        'usuario_registro_id' => $_POST['usuario_registro_id'],
        'ruta_informe' => str_replace("\\","\\\\",$_POST['ruta_informe']));
$Vehiculo = new Vehiculo();
$Vehiculo->set($nuevo_vehiculo_data);
header('Location:../vista/tasacion_informe.php?mensaje="Tasacion ingresada correctamente"');
break; 
default:
break;
}
?>