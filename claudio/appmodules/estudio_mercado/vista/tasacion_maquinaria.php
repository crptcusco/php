<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA.'sql/db_abstract_model.php';
require_once RUTA.'modelo/tasacion_informe.php';
//require_once RUTA.'modelo/tasacion_terreno.php';

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
    <title>Registro de MAQUINARIAS</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">    
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
    <div class="row">
        <form action="../controlador/tasacion_maquinaria.php" method="POST" data-abide>
            <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> Hay Algunos Errores en tu Estudio.</p>
            </div>
            <div class="large-12 columns">
                <h3><a href="../index.php" class="button basic"> Volver al Inicio </a>
                    <a href="tasacion_informe.php" class="button success"> Volver al Listado de Tasaciones </a> 
                    Registro de Tasaciones de MAQUINARIAS</h3>
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
                        <div class="medium-12 columns" id="ubicacion">
                            <label>Ubicacion
                                <input type="text" name="ubicacion"  placeholder="Ubicacion del Terreno" required>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <!-- FORMULARIOS PARTICULARES  -->
                    <div class="row">
                        <div id="combo_ta_vechiculo_tipo" class="medium-6 columns">
                            <label>Tipo de la Maquinaria : 
                                <a data-open="modal_ta_maquinaria_tipo" id="maquinaria_tipo_trigger_add">Nuevo Tipo</a>
                            </label>
                            <select data-placeholder="Selecciona un tipo de Maquinaria ..." class="chosen-select" id="tasacion_maquinaria_tipo_id" name="tasacion_maquinaria_tipo_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                        <div id="combo_ta_maquinaria_marca" class="medium-6 columns">
                            <label>Marca de la Maquinaria: 
                                <a data-open="modal_ta_maquinaria_marca" id="maquinaria_marca_trigger_add">Nueva Marca</a>
                            </label>
                            <select data-placeholder="Selecciona una Marca de Vechiculo ..." class="chosen-select" id="tasacion_maquinaria_marca_id" name="tasacion_maquinaria_marca_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div id="combo_ta_vechiculo_modelo" class="medium-6 columns">
                            <label>Modelo del maquinaria : 
                                <a data-open="modal_ta_maquinaria_modelo" id="maquinaria_modelo_trigger_add">Nuevo Modelo</a>
                            </label>
                            <select data-placeholder="Selecciona un modelo de Vechiculo ..." class="chosen-select" id="tasacion_maquinaria_modelo_id" name="tasacion_maquinaria_modelo_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Año de Fabricacion ($)
                                <input type="number" step="any" id="fabricacion_anio" name="fabricacion_anio" required pattern="number">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Valor Similar Nuevo ($)
                                <input type="number" step="any" id="valor_similar_nuevo" name="valor_similar_nuevo" required pattern="number">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Valor comercial ($)
                                <input type="number" step="any" id="valor_comercial" name="valor_comercial" required pattern="number">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Tipo de Cambio
                                <input type="number" step="any" id="tipo_cambio" name="tipo_cambio" required pattern="number">
                            </label>
                        </div>
                    </div>
                    <!--  FORMULARIOS GENERALES  -->
                    <div class="row">
                        <div class="medium-12 columns" id="ruta_informe">
                            <label>Ruta del Informe
                                <input type="text" name="ruta_informe" id="ruta_informe"  placeholder="Ruta de la Carpeta" required>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                Observacion
                                <textarea name="observacion" id="observacion" placeholder="Ingrese aqui sus Obeservaciones" required></textarea>
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

    <div class="reveal" id="modal_ta_maquinaria_tipo" data-reveal>
        <br>
        <h3>Nuevo Tipo de maquinaria</h3>
        <input id="modal_ta_maquinaria_tipo_nombre" name="modal_ta_maquinaria_tipo_nombre" type="text" value="">
        <button id="modal_ta_maquinaria_tipo_save" class="button" data-close>Guardar</button>

        <button id="close_modal_ta_maquinaria_tipo" class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="reveal" id="modal_ta_maquinaria_marca" data-reveal>
        <br>
        <h3>Nueva Marca de maquinaria</h3>
        <input id="modal_ta_maquinaria_marca_nombre" name="modal_ta_maquinaria_marca_nombre" type="text" value="">
        <button id="modal_ta_maquinaria_marca_save" class="button" data-close>Guardar</button>

        <button id="close_modal_ta_maquinaria_marca" class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <div class="reveal" id="modal_ta_maquinaria_modelo" data-reveal>
        <br>
        <h3>Nuevo Modelo maquinaria</h3>
        <input id="modal_ta_maquinaria_modelo_nombre" type="text" value="">
        <button id="modal_ta_maquinaria_modelo_save" class="button" data-close>Guardar</button>

        <button id="close_modal_ta_maquinaria_modelo" class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="reveal" id="modal_ta_maquinaria_traccion" data-reveal>
        <br>
        <h3>Nuevo Traccion de maquinaria</h3>
        <input id="modal_ta_maquinaria_traccion_nombre" type="text" value="">
        <button id="modal_ta_maquinaria_traccion_save" class="button" data-close>Guardar</button>

        <button id="close_modal_ta_maquinaria_traccion" class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script type="text/javascript" language="javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>

    <script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
    <script type="text/javascript" src="../vendor/data_table/datatables.min.js"></script>
    <script type="text/javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
    <script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
    <script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>

    <script type="text/javascript" src="../js/tasacion_maquinaria.js"></script>

    <script type="text/javascript">
        $(".chosen-select").chosen();
        $(document).foundation();
    </script>
</body>
</html>