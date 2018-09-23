<?php
require_once '../config.php';
require_once RUTA.'modelo/estudio_maquinaria.php';

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

	$nuevo_maquinaria_data = array(
		'estudio_tipo_id' => 1,
		'proyecto_id' => 1,
		'informe_id' => 1,
		'ubicacion' => "",
		'estudio_fecha' => $_POST['estudio_fecha'],
		'maquinaria_tipo_id' => $_POST['maquinaria_tipo_id'],
		'maquinaria_marca_id' => $_POST['maquinaria_marca_id'],
		'maquinaria_modelo_id' => $_POST['maquinaria_modelo_id'],
		'fabricacion_anio' => $_POST['fabricacion_anio'],
		'valor_similar_nuevo' => $_POST['valor_similar_nuevo'],
		'contacto' => $_POST['contacto'],
		'telefono' => $_POST['telefono'],
		'observacion' => $_POST['observacion'],
		'ruta_informe' => "ESTUDIO DE MERCADO"
		);
	//print_r($nuevo_vehiculo_data);
	//die();
	$maquinaria = new Maquinaria();
	$maquinaria->set($nuevo_maquinaria_data);
	header('Location: ../vista/estudio_maquinaria.php?mensaje="Insertado Exitosamente"');
	break;
	case "eliminar":
	$id = $_GET['id'];
	$maquinaria = new Maquinaria();
	$maquinaria->delete($id);
	header('Location: ../vista/estudio_maquinaria.php?mensaje="'.$maquinaria->mensaje.'"');
	break;
	default:
	break;
}