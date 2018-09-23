<?php
require_once '../config.php';

require_once(RUTA . 'modelo/estudio_externo.php');
require_once(RUTA . 'modelo/estudio_vehiculo.php');

$opcion="";
if (isset($_POST['opcion']))
    $opcion = $_POST['opcion'];
elseif (isset($_GET['opcion']))
    $opcion = $_GET['opcion'];
else {
    header('Location: '.RUTA.'vista/error.php');
}

//print_r($opcion);
//die();
switch ($opcion) {
    case "nuevo":
        $nuevo_estudio_data = array(
            'estudio_tipo_id' => $_POST['estudio_tipo_id'],
            'consultor_id' => $_POST['consultor_id'],
            'categoria' => $_POST['categoria'],
            'ubicacion' => $_POST['ubicacion'],
            'ubi_departamento_id' => $_POST['ubi_departamento_id'],
            'ubi_provincia_id' => $_POST['ubi_provincia_id'],
            'ubi_distrito_id' => $_POST['ubi_distrito_id'],
            'estudio_fecha' => $_POST['estudio_fecha'],
            'terreno_area' => $_POST['terreno_area'],
            'terreno_valorunitario' => $_POST['terreno_valorunitario'],
            'valor_comercial' => $_POST['valor_comercial'],
            'contacto' => $_POST['contacto'],
            'telefono' => $_POST['telefono'],
            'mapa_latitud' => $_POST['mapa_latitud'],
            'mapa_longitud' => $_POST['mapa_longitud'],
            'zonificacion' => $_POST['zonificacion'],
            'observacion' => $_POST['observacion'],
            'edificacion_area' => $_POST['edificacion_area'],
            'piso_cantidad' => $_POST['piso_cantidad'],
            'estacionamiento_cantidad' => $_POST['estacionamiento_cantidad'],
            'departamento_tipo_id' => $_POST['departamento_tipo_id'],
            'areas_complementarias' => $_POST['areas_complementarias'],
            'proyecto_id' => $_POST['proyecto_id'],
            'informe_id' => $_POST['informe_id'],
            'piso_ubicacion' => $_POST['piso_ubicacion'],
            'vista_local_id' => $_POST['vista_local_id'],
            'tipo_propiedad' => $_POST['tipo_propiedad']
        );
        $estudio = new Estudio();
        $estudio->set($nuevo_estudio_data);
        header('Location: ../vista/estudio_externo.php?mensaje="Estudio de inmueble registrado satisfactoriamente"');
        break;
    case "nuevo_vehiculo":
        $nuevo_vehiculo_data = array(
            'informe_id' => $_POST['informe_id'],
            'estudio_fecha' => $_POST['estudio_fecha'],
            'fabricacion_anio' => $_POST['fabricacion_anio'],
            'vehiculo_tipo_id' => $_POST['vehiculo_tipo_id'],
            'vehiculo_marca_id' => $_POST['vehiculo_marca_id'],
            'vehiculo_modelo_id' => $_POST['vehiculo_modelo_id'],
            'vehiculo_modelo_id' => $_POST['vehiculo_modelo_id'],
            'vehiculo_traccion_id' => $_POST['vehiculo_traccion_id'],
            'valor_similar_nuevo' => $_POST['valor_similar_nuevo'],
            'contacto' => $_POST['contacto'],
            'telefono' => $_POST['telefono'],
            'observacion' => $_POST['observacion'],
            'ruta_informe' => $_POST['ruta_informe'],
            'proyecto_id' => $_POST['informe_id'],
            'ubicacion' => " ",
            'estudio_tipo_id' => 1
        );
        $vehiculo = new Vehiculo();
        $vehiculo->set($nuevo_vehiculo_data);
        header('Location: ../vista/estudio_vehiculo.php?mensaje="Estudio de vehiculo regitrado satisfactoriamente"');
        break;
    case "nueva_maquinaria":
        $nuevo_vehiculo_data = array(
            'informe_id' => $_POST['informe_id'],
            'estudio_fecha' => $_POST['estudio_fecha'],
            'fabricacion_anio' => $_POST['fabricacion_anio'],
            'vehiculo_tipo_id' => $_POST['vehiculo_tipo_id'],
            'vehiculo_marca_id' => $_POST['vehiculo_marca_id'],
            'vehiculo_modelo_id' => $_POST['vehiculo_modelo_id'],
            'vehiculo_modelo_id' => $_POST['vehiculo_modelo_id'],
            'vehiculo_traccion_id' => $_POST['vehiculo_traccion_id'],
            'valor_similar_nuevo' => $_POST['valor_similar_nuevo'],
            'contacto' => $_POST['contacto'],
            'telefono' => $_POST['telefono'],
            'observacion' => $_POST['observacion'],
            'ruta_informe' => $_POST['ruta_informe'],
            'proyecto_id' => $_POST['informe_id'],
            'ubicacion' => " ",
            'estudio_tipo_id' => 1
        );
        $maquinaria = new Maquinaria();
        $maquinaria->set($nuevo_maquinaria_data);
        header('Location: ../vista/estudio_maquinaria.php?mensaje="Estudio de Maquinaria registrado satisfactoriamente"');
        break;
    case "eliminar":
        $id = $_GET['id'];
        $tipo = $_GET['tipo'];
        $estudio = new Estudio();
        $estudio->delete($id, $tipo);
        header('Location: ../vista/estudio_externo.php?mensaje="Estudio Eliminado Satisfactoriamente"');
        break;
    default:
        break;
}