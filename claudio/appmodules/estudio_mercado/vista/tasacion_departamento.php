<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA.'sql/db_abstract_model.php';
require_once RUTA.'modelo/tasacion_informe.php';
require_once RUTA.'modelo/tasacion_terreno.php';

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
    <title>Registro Departamento</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">    
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
    <div class="row">
        <form action="../controlador/tasacion_departamento.php" method="POST" data-abide>
            <div data-abide-error class="alert callout" style="display: none;">
                <p><i class="fi-alert"></i> Hay Algunos Errores en tu Estudio.</p>
            </div>
            <div class="large-12 columns">
                <h3><a href="../index.php" class="button basic"> Volver al Inicio </a>
                    <a href="tasacion_informe.php" class="button success"> Volver al Listado de Tasaciones </a> 
                    Registro de Tasaciones de Departamentos</h3>
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
                    <div class="row">
                        <div class="small-4 columns">
                            <label>Departamento</label>
                            <select name="ubi_departamento_id" id="ubi_departamento_id" required>
                                <?php
                                $tasacion = new Tasacion();
                                $resultado = $tasacion->listar_departamentos();
                                foreach ($resultado as $arreglo) { ?>            
                                <option value="<?= $arreglo['departamento_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 columns">
                            <label>Provincia</label>
                            <select name="ubi_provincia_id" id="ubi_provincia_id" required>
                                <?php
                                $tasacion = new Tasacion();
                                $resultado = $tasacion->listar_provincias(1);
                                foreach ($resultado as $arreglo) { ?>            
                                <option value="<?= $arreglo['provincia_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 columns">
                            <label>Distrito</label>
                            <select name="ubi_distrito_id" id="ubi_distrito_id" required>
                                <?php
                                $tasacion = new Tasacion();
                                $resultado = $tasacion->listar_distritos(1);
                                foreach ($resultado as $arreglo) { ?>            
                                <option value="<?= $arreglo['distrito_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <div class="row">
                        <div id="combo_ta_terreno_zonificacion" class="medium-6 columns">
                            <label>Zonificacion : </label>
                            <select data-placeholder="Selecciona una Zonificacion ..." class="chosen-select" id="tasacion_zonificacion_id" name="tasacion_zonificacion_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                        <div class="medium-6 columns">
                            <label>Tipo de Cambio
                                <input type="number" step="any" id="tipo_cambio" name="tipo_cambio" required pattern="number" >
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Piso Ubicacion
                                <input type="number"  step="any" id="piso_ubicacion" name="piso_ubicacion" required pattern="number" >
                            </label>
                        </div>
                        <div id="combo_ta_departamento_tipo_departamento" class="medium-6 columns">
                            <label>Departamento Tipo :</label>
                            <select data-placeholder="Selecciona un Tipo  de Departamento ..." class="chosen-select" id="tasacion_departamento_tipo_id" name="tasacion_departamento_tipo_id" required>
                                <option value="0"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Area de Terreno (m2)
                                <input type="number" step="any" id="terreno_area" name="terreno_area" required pattern="number" >
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Cantidad de Pisos
                                <input type="number" step="any" id="piso_cantidad" name="piso_cantidad" required pattern="number" >
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Valor Unitario de Terreno ($)
                                <input type="number" step="any" id="terreno_valorunitario" name="terreno_valorunitario" required pattern="number">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Valor comercial ($)
                                <input type="number" step="any"  id="valor_comercial" name="valor_comercial" required pattern="number">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Area de Edificacion
                                <input type="number"  step="any" id="edificacion_area" name="edificacion_area" required pattern="number" >
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Valor de Area Ocupada
                                <input type="number"  step="any" id="valor_ocupada" name="valor_ocupada" required pattern="number" >
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Areas Complementarias
                                <select name="areas_complementarias" id="areas_complementarias" required>
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Cantidad de Estacionamientos
                                <input type="number"  step="any" id="estacionamiento_cantidad" name="estacionamiento_cantidad" required pattern="number" >
                            </label>
                        </div>
                    </div>
                    <!-- FORMULARIOS PARTICULARES  -->
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
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Latitud
                                <input type="number" step="any" name="mapa_latitud" id="mapa_latitud" required>
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Longitud
                                <input type="number" step="any" name="mapa_longitud" id="mapa_longitud" required>
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

    <script type="text/javascript" src="../js/tasacion_departamento.js"></script>

    <script type="text/javascript">
        $(".chosen-select").chosen();
        $(document).foundation();
    </script>
</body>
</html>