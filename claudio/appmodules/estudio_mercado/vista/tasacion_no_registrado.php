<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA.'sql/db_abstract_model.php';
require_once RUTA.'modelo/tasacion_informe.php';

//JALANDO LOS DATOS DE LA COORDINACION
$tasacion = new Tasacion();
$coordinacion ="";
$fecha_tasacion ="";
$solicitante ="";
$cliente ="";
$propietario ="";

if(isset($_GET['coordinacion'])){
    $coordinacion = $_GET['coordinacion'];
    $data = $tasacion->get($coordinacion);
    $coordinacion = $data[0]['COORDINACION'];
    $fecha_tasacion = $data[0]['FECHA'];
    $solicitante = $data[0]['SOLICITANTE'];
    $cliente = $data[0]['CLIENTE'];
    $propietario = $data[0]['CLIENTE'];
}

?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
    <meta charset="utf-8">
    <!-- If you delete this meta tag World War Z will become a reality -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasacion no Registrada</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">    
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
    <div class="row">
        <form action="../controlador/tasacion_no_registrado.php" method="POST" data-abide>
            <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> Hay Algunos Errores en tu Estudio.</p>
            </div>
            <div class="large-12 columns">
                <h3><a href="../index.php" class="button basic"> Volver al Inicio </a>
                    <a href="tasacion_informe.php" class="button success"> Volver al Listado de Tasaciones </a> 
                    Tasacion que no se Registrara</h3>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <input type="hidden" name="opcion" value="nuevo">
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Codigo de Coordinacion
                                <input type="number" step="any" name="informe_id" id="informe_id" required pattern="number" value="<?= $coordinacion ?>" readonly>
                            </label>
                        </div>
                        <div class="medium-6 columns" id="tasacion_fecha">
                            <label>Fecha de Tasacion
                                <input type="date" id="tasacion_fecha" name="tasacion_fecha" value="" required>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns" id="cliente">
                            <label>Cliente
                                <input type="text" name="cliente_id" id="cliente_id" placeholder="Nombre del Cliente" value="<?= $cliente ?>" readonly>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns" id="propietario">
                            <label>Propietario
                                <input type="text" name="propietario_id" id="propietario_id"  placeholder="Nombre del Propietario" value="<?= $propietario ?>" readonly>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns" id="solicitante">
                            <label>Solicitante
                                <input type="text" name="solicitante_id" id="solicitante_id"  placeholder="Nombre del Solitante" value="<?= $solicitante ?>" readonly>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns" id="observacion">
                            <label>¿Por que no se deberia registrar esta tasación?
                                <input type="text" name="observacion"  placeholder="Tipo de Tasacion" required>
                            </label>
                        </div>
                    </div>
                    <div class ="row">
                        <div id="combo_ta_usuario_registro" class="medium-12 columns">
                            <label>USUARIO QUE REGISTRA : </label>
                            <select data-placeholder="Selecciona un Ususario..." class="chosen-select" id="ta_usuario_registro_id" name="usuario_registro_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <br />
                            <input type="submit" class="button success button" name="Grabar" value="Grabar">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" language="javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>

    <script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
    <script type="text/javascript" src="../vendor/data_table/datatables.min.js"></script>
    <script type="text/javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
    <script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
    <script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="../js/tasacion_no_registrado.js"></script>

    <script type="text/javascript">
        $(".chosen-select").chosen();
        $(document).foundation();
    </script>
</body>
</html>