<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA . 'sql/db_abstract_model.php';
require_once RUTA . 'modelo/tasacion_informe.php';

//# Importar modelo de abstracción de base de datos
//require_once('../../sql/db_abstract_model.php');
//require_once('model_tasacion.php');

$coordinacion=0;
if(isset($_POST['numero_coordinacion'])){
	if($_POST['numero_coordinacion'] !=""){
		$coordinacion=$_POST['numero_coordinacion'];
	}
	else{
		header('Location: '.RUTA.'vista/error.php');
	}
}
else{
	header('Location: '.RUTA.'vista/error.php');
}

//</div>
//<div class="reveal tiny" id="Modal<?= utf8_encode($arreglo['COORDINACION']) " data-reveal>
?>

<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
	<meta charset="utf-8">
	<!-- If you delete this meta tag World War Z will become a reality -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro de Tasaciones</title>
	<link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
	<div class="row">
		<div class="large-4 columns">
			<h3>¿Que Deseas Registrar?</h3>
			<ul class="menu vertical">
				<li><a href="../vista/tasacion_terreno.php?coordinacion=<?= $coordinacion ?>" class="button expand">Un Terreno</a></li>
				<li><a href="../vista/tasacion_casa.php?coordinacion=<?= $coordinacion ?>" class="button expand">Una Casa</a></li>
				<li><a href="../vista/tasacion_departamento.php?coordinacion=<?= $coordinacion ?>" class="button expand">Un Departamento</a></li>
				<li><a href="../vista/tasacion_local_comercial.php?coordinacion=<?= $coordinacion ?>" class="button expand">Un Local Comercial</a></li>
				<li><a href="../vista/tasacion_local_industrial.php?coordinacion=<?= $coordinacion ?>" class="button expand">Un Local Industrial</a></li>
				<li><a href="../vista/tasacion_oficina.php?coordinacion=<?= $coordinacion ?>" class="button expand">Una Oficina</a></li>
				<li><a href="../vista/tasacion_vehiculo.php?coordinacion=<?= $coordinacion ?>" class="button expand success">Un Vehiculo</a></li>
				<li><a href="../vista/tasacion_maquinaria.php?coordinacion=<?= $coordinacion ?>" class="button expand success">Maquinaria</a></li>
				<li><a href="../vista/tasacion_no_registrado.php?coordinacion=<?= $coordinacion ?>" class="button expand alert">No registro</a></li>
			</ul>
		</div>
		<div>
			<script type="text/javascript" language="javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
			<script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
			<script type="text/javascript" language="javascript" src="../vendor/data_table/datatables.min.js"></script>
			<script type="text/javascript" language="javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
			<script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
			<script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
			<script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>

			<script type="text/javascript">
				$(document).foundation();
			</script>
		</body>
		</html>