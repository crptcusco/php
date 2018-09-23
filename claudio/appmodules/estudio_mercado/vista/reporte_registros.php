<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA . 'sql/db_abstract_model.php';
require_once RUTA . 'modelo/tasacion_informe.php';

//# Importar modelo de abstracción de base de datos
//require_once('../../sql/db_abstract_model.php');
//require_once('model_tasacion.php');
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
	<meta charset="utf-8">
	<!-- If you delete this meta tag World War Z will become a reality -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reporte de Registro de Tasaciones</title>
	<link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
	<div class="row">
		<div class="large-12 columns">
			<h3><a href="../index.php" class="button basic"> Volver al Inicio </a> Reportes de Registro de Tasaciones</h3>
			<?php
            //Mensaje de Exitoso
			$mensaje= "";
			if( isset($_GET['mensaje'])){ 
				?>     
				<div class="callout primary">
					<p><?=$_GET['mensaje']?></p>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<h3>Tasaciones registradas esta SEMANA</h3>
			<table role="grid"  border="1" id="tabla_reporte" class="display" width="100%" cellspacing="0" >
				<?php $tasacion = new Tasacion(); ?>
				<thead>
					<tr>
						<td>PERITO</td>
						<td>CANTIDAD</td>
					</tr>
				</thead>
				<?php
				$resultado = $tasacion->listar_cantidad_tasaciones_semanal();
				foreach ($resultado as $arreglo) { ?>
				<tr>
					<td><?= utf8_encode($arreglo['nombre']) ?></td>
					<td><?= utf8_encode($arreglo['cantidad']) ?></td>
				</tr>
				<?php }
				?>
			</table>
		</div>
		<div class="large-6 columns">
			<h3>Tasaciones registradas TOTAL</h3>
			<table role="grid"  border="1" id="tabla_reporte" class="display" width="100%" cellspacing="0" >
				<?php $tasacion = new Tasacion(); ?>
				<thead>
					<tr>
						<td>PERITO</td>
						<td>CANTIDAD</td>
					</tr>
				</thead>
				<?php
				$resultado = $tasacion->listar_cantidad_tasaciones_perito();
				foreach ($resultado as $arreglo) { ?>
				<tr>
					<td><?= utf8_encode($arreglo['nombre']) ?></td>
					<td><?= utf8_encode($arreglo['cantidad']) ?></td>
				</tr>
				<?php }
				?>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="large-6 columns">
			<h3>Tasaciones registradas HOY</h3>
			<table role="grid"  border="1" id="tabla_reporte" class="display" width="100%" cellspacing="0" >
				<?php $tasacion = new Tasacion(); ?>
				<thead>
					<tr>
						<td>PERITO</td>
						<td>CANTIDAD</td>
					</tr>
				</thead>
				<?php
				$resultado = $tasacion->listar_cantidad_tasaciones_hoy();
				foreach ($resultado as $arreglo) { ?>
				<tr>
					<td><?= utf8_encode($arreglo['nombre']) ?></td>
					<td><?= utf8_encode($arreglo['cantidad']) ?></td>
				</tr>
				<?php }
				?>
			</table>
		</div>
	</div>
	<script type="text/javascript" language="javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="../vendor/data_table/datatables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
	<script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>

	<script type="text/javascript">
		$(".chosen-select").chosen();
		$('#tasacion_data_table').DataTable();
		$(document).foundation();
	</script>
</body>
</html>