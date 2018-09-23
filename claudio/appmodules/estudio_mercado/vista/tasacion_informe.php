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
    <title>Registro de Tasaciones</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
    <div class="row">
        <div class="large-12 columns">
            <h3><a href="../index.php" class="button basic"> Volver al Inicio </a>  Registro de Tasaciones</h3>
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
      <div class="large-12 columns">
        <form action="../controlador/tasacion_informe.php" method="POST">
            <div class="row">
                <div class="small-4 columns">
                    <label for="numero_coordinacion" class="text-right middle">Adicionar Tasación en la misma Coordinacion</label>
                </div>
                <div class="small-4 columns">
                  <input type="number" id="numero_coordinacion" name="numero_coordinacion" required placeholder="Numero de Coordinacion">
              </div>
              <div class="small-4 columns">
                <input type="submit" class="button success button" name="adicionar" id="adicionar" value="Adicionar">
            </div>
        </div>
    </form>
</div>
<div class="large-12 columns">
    <table role="grid"  border="1" id="tasacion_data_table" class="display" width="100%" cellspacing="0" >
        <?php $tasacion = new Tasacion(); ?>
        <thead>
            <tr>
                <td>COORDINACION</td>
                <td>FECHA</td>
                <td>SOLICITANTE</td>
                <td>CLIENTE</td>
                <td>PERITO</td>
                <td>CONTROL DE CALIDAD</td>
                <td>ACCIONES</td>
            </tr>
        </thead>
        <?php
        $resultado = $tasacion->listar_tasaciones_pendientes();
        foreach ($resultado as $arreglo) { ?>
        <div class="reveal tiny" id="Modal<?= utf8_encode($arreglo['COORDINACION']) ?>" data-reveal>
            <h3>¿Que Deseas Registrar?</h3>
            <ul class="menu vertical">
                <li><a href="tasacion_terreno.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Un Terreno</a></li>
                <li><a href="tasacion_casa.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Una Casa</a></li>
                <li><a href="tasacion_departamento.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Un Departamento</a></li>
                <li><a href="tasacion_local_comercial.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Un Local Comercial</a></li>
                <li><a href="tasacion_local_industrial.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Un Local Industrial</a></li>
                <li><a href="tasacion_oficina.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand">Una Oficina</a></li>
                <li><a href="tasacion_vehiculo.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand success">Un Vehiculo</a></li>
                <li><a href="tasacion_maquinaria.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand success">Maquinaria</a></li>
                <li><a href="tasacion_no_registrado.php?coordinacion=<?= utf8_encode($arreglo['COORDINACION']) ?>" class="button expand alert">Esta Tasacion no se Registra</a></li>
            </ul>
        </div>
        <tr>
            <td><?= utf8_encode($arreglo['COORDINACION']) ?></td>
            <td><?= utf8_encode($arreglo['FECHA']) ?></td>
            <td><?= utf8_encode($arreglo['SOLICITANTE']) ?></td>
            <td><?= utf8_encode($arreglo['CLIENTE']) ?></td>
            <td><?= utf8_encode($arreglo['PERITO']) ?></td>
            <td><?= utf8_encode($arreglo['CONTROL_CALIDAD']) ?></td>
            <td><p><a class="button" data-open="Modal<?= utf8_encode($arreglo['COORDINACION']) ?>">REGISTRAR TASACION</a></p></td>
        </tr>
        <?php }
        ?>
    </table>
</div>

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