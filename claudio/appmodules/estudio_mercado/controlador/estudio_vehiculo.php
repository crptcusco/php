<?php
require_once '../config.php';
require_once RUTA.'modelo/estudio_vehiculo.php';

$opcion="";
if (isset($_POST['opcion']))
    $opcion = $_POST['opcion'];
elseif (isset($_GET['opcion']))
    $opcion = $_GET['opcion'];
else {
    header('Location: '.RUTA.'vista/error.php');
}

switch ($opcion) {
	case "nuevo":
	$nuevo_vehiculo_data = array(
		'estudio_tipo_id' => 1,
		'proyecto_id' => 1,
		'informe_id' => 1,
		'ubicacion' => "",
		'estudio_fecha' => $_POST['estudio_fecha'],
		'vehiculo_tipo_id' => $_POST['vehiculo_tipo_id'],
		'vehiculo_marca_id' => $_POST['vehiculo_marca_id'],
		'vehiculo_modelo_id' => $_POST['vehiculo_modelo_id'],
		'fabricacion_anio' => $_POST['fabricacion_anio'],
		'vehiculo_traccion_id' => $_POST['vehiculo_traccion_id'],
		'valor_similar_nuevo' => $_POST['valor_similar_nuevo'],
		'contacto' => $_POST['contacto'],
		'telefono' => $_POST['telefono'],
		'observacion' => $_POST['observacion'],
		'ruta_informe' => "ESTUDIO DE MERCADO"
		);
	//print_r($nuevo_vehiculo_data);
	//die();

	$vehiculo = new Vehiculo();
	$vehiculo->set($nuevo_vehiculo_data);
	header('Location: ../vista/estudio_vehiculo.php?mensaje="'.$vehiculo->mensaje.'"');
	break;
	case "eliminar":
	$id = $_GET['id'];
	$vehiculo = new Vehiculo();
	$vehiculo->delete($id);
	header('Location: ../vista/estudio_vehiculo.php?mensaje="'.$vehiculo->mensaje.'"');
	break;
	default:
	break;
}