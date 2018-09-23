<?php
require_once '../config.php';
require_once RUTA .'modelo/estudio_vehiculo.php';
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
	<meta charset="utf-8">
	<!-- If you delete this meta tag World War Z will become a reality -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Estudio de Vehiculos</title>
	<link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
	<link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
	<div class="row">
		<div data-abide-error class="alert callout" style="display: none;">
			<p><i class="fi-alert"></i> Hay Algunos Errores en tu vehiculo.</p>
		</div>
		<div class="large-12 columns">
			<h3><a href="../index.php" class="button basic"> Volver al Inicio </a> Estudios de Vehiculos </h3>
			<?php
                    //Mensaje de Exitoso
			$mensaje = "";
			if (isset($_GET['mensaje'])) {
				?>     
				<div class="callout primary">
					<p><?= $_GET['mensaje'] ?></p>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<div class="row">
		<form action="../controlador/estudio_vehiculo.php" method="POST" data-abide>
			<div class="large-6 columns"><!-- ... -->
				<input type="hidden" name="opcion" value="nuevo">
				<div class="row">
					<div class="medium-6 columns">
						<label>Fecha de Estudio
							<input type="date" name="estudio_fecha" id="estudio_fecha" value="">
						</label>
					</div>
					<div class="medium-6 columns">
						<label>Año de Fabricacion
							<input type="number" class="division" step="any" id="fabricacion_anio"
							name="fabricacion_anio" required pattern="number" >
						</label>
					</div>
				</div>
				<div class="row">
					<div id="combo_es_vehiculo_tipo" class="small-12 columns">
						<label>Tipo: 
							<a data-open="modal_es_vehiculo_tipo" id="vehiculo_tipo_trigger_add">Nuevo Tipo</a>
						</label>
						<select data-placeholder="Selecciona un Tipo ..." class="chosen-select" id="vehiculo_tipo_id" name="vehiculo_tipo_id" required>
							<option value="0"></option>
						</select>
					</div>
					<div id="combo_es_vehiculo_marca" class="small-12 columns">
						<label>Marca : 
							<a data-open="modal_es_vehiculo_marca" id="vehiculo_marca_trigger_add">Nueva Marca</a>
						</label>
						<select data-placeholder="Selecciona una Marca ..." class="chosen-select" id="vehiculo_marca_id" name="vehiculo_marca_id" required>
							<option value="0"></option>
						</select>
					</div>
					<div id="combo_es_vehiculo_modelo" class="small-12 columns">
						<label>Modelo : 
							<a data-open="modal_es_vehiculo_modelo" id="vehiculo_modelo_trigger_add">Nuevo Modelo</a>
						</label>
						<select data-placeholder="Selecciona un Modelo ..." class="chosen-select" id="vehiculo_modelo_id" name="vehiculo_modelo_id" required>
							<option value="0"></option>
						</select>
					</div>
				</div>
			</div>
			<div class="large-6 columns">
				<div class="row">
					<div id="combo_es_vehiculo_traccion" class="medium-6 columns">
						<label>Traccion : 
							<a data-open="modal_es_vehiculo_traccion" id="vehiculo_traccion_trigger_add">Nueva Traccion</a>
						</label>
						<select data-placeholder="Selecciona un tipo de Traccion ..." class="chosen-select" id="vehiculo_traccion_id" name="vehiculo_traccion_id" required>
							<option value="0"></option>
						</select>
					</div>
					<div class="medium-6 columns">
						<label>Valor Similar nuevo
							<input type="number" class="division" step="any" id="valor_similar_nuevo" name="valor_similar_nuevo" required pattern="number" >
						</label>
					</div>
				</div>
				<div class="row">
					<div class="medium-6 columns">
						<label>Contacto
							<input type="text" name="contacto" required>
						</label>
					</div>
					<div class="medium-6 columns">
						<label>Telefono
							<input type="text" name="telefono" required>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="medium-12 columns">
						<label>
							Observacion
							<textarea name="observacion" placeholder="Ingrese aqui sus Obeservaciones" required></textarea>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="medium-12 columns">
						<input type="submit" class="button success button" name="Grabar" value="Grabar">
					</div>
				</div>
			</div> 
		</form>
	</div>

	<div class="row">
		<div class="large-12 columns"><!-- ... -->
			<table border="1" id="vehiculo_data_table" class="display" width="100%" cellspacing="0">
				<?php $vehiculo = new Vehiculo(); ?>
				<thead>
					<tr>
						<td>FECHA</td>
						<td>MARCA</td>
						<td>MODELO</td>
						<td>AÑO DE FABRICACION</td>
						<td>VALOR SIMILAR NUEVO</td>
						<td>ELIMINAR</td>
						<td>DETALLE</td>
					</tr>
				</thead>
				<?php
				$resultado = $vehiculo->listar_vehiculos();
				foreach ($resultado as $arreglo) { ?>
					<tr>
						<td><?= utf8_encode($arreglo['FECHA']) ?></td>
						<td><?= utf8_encode($arreglo['MARCA']) ?></td>
						<td><?= utf8_encode($arreglo['MODELO']) ?></td>
						<td><?= utf8_encode($arreglo['FABRICACION_ANIO']) ?></td>
						<td><?= utf8_encode($arreglo['VALOR_NUEVO']) ?></td>
						<td><a class="button alert" href="../controlador/estudio_vehiculo.php?opcion=eliminar&id=<?= $arreglo['id'] ?>">Eliminar</a> </td>
						<td><a class="button sucess" data-open="Modal<?= utf8_encode($arreglo['id']) ?>">Detalle</a></td>
					</tr>
					<div class="reveal" id="Modal<?= utf8_encode($arreglo['id']) ?>" data-reveal>
						<h3>
							Detalle de Coordinacion </br>
							Fecha: <?= utf8_encode($arreglo['FECHA']) ?>
						</h3>
						<p>
							<strong>Coordinacion : </strong><?= utf8_encode($arreglo['COORDINACION']) ?><br />
							<strong>Marca : </strong><?= utf8_encode($arreglo['MARCA']) ?><br />
							<strong>Modelo : </strong><?= utf8_encode($arreglo['MODELO']) ?><br />
							<strong>Año de Fabricacion : </strong><?= utf8_encode($arreglo['FABRICACION_ANIO']) ?><br />
							<strong>Velor Nuevo : </strong><?= utf8_encode($arreglo['VALOR_NUEVO']) ?><br />
							<strong>Traccion : </strong><?= utf8_encode($arreglo['TRACCION']) ?><br />
							<strong>Contacto : </strong><?= utf8_encode($arreglo['CONTACTO']) ?><br />
							<strong>Telefono : </strong><?= utf8_encode($arreglo['TELEFONO']) ?><br />
						</p>
						<button class="close-button" data-close aria-label="Close modal" type="button">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php }
					?>
			</table>
		</div>
	</div>

	<div class="reveal" id="modal_es_vehiculo_tipo" data-reveal>
		<br>
		<h3>Nuevo Tipo</h3>
		<input id="modal_es_vehiculo_tipo_nombre" type="text" value="">
		<button id="modal_es_vehiculo_tipo_save" class="button" data-close>Guardar</button>

		<button id="close_modal_es_vehiculo_tipo" class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="reveal" id="modal_es_vehiculo_marca" data-reveal>
		<br>
		<h3>Nueva Marca</h3>
		<input id="modal_es_vehiculo_marca_nombre" type="text" value="">
		<button id="modal_es_vehiculo_marca_save" class="button" data-close>Guardar</button>

		<button id="close_modal_es_vehiculo_marca" class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="reveal" id="modal_es_vehiculo_modelo" data-reveal>
		<br>
		<h3>Nuevo Modelo</h3>
		<input id="modal_es_vehiculo_modelo_nombre" type="text" value="">
		<button id="modal_es_vehiculo_modelo_save" class="button" data-close>Guardar</button>

		<button id="close_modal_es_vehiculo_modelo" class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>

	<div class="reveal" id="modal_es_vehiculo_traccion" data-reveal>
		<br>
		<h3>Nueva Traccion</h3>
		<input id="modal_es_vehiculo_traccion_nombre" type="text" value="">
		<button id="modal_es_vehiculo_traccion_save" class="button" data-close>Guardar</button>
		<button id="close_modal_es_vehiculo_traccion" class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>       

	<script type="text/javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
	<script type="text/javascript" src="../vendor/data_table/datatables.min.js"></script>
	<script type="text/javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
	<script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
	<script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="../js/estudio_vehiculo.js"></script>

	<script type="text/javascript">
		$(".chosen-select").chosen();
		$('#vehiculo_data_table').DataTable();
		$(document).foundation();
	</script>
</body>
</html>