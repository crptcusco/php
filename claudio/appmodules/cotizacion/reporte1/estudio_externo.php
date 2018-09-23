<?php
require_once('model.php');
?>
<!doctype html>
<html class="no-js" lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Paginas de Consulta</title>
        <link rel="stylesheet" href="../../librerias.v2/vendor/foundation6/css/foundation.css" />
        <script src="../../librerias.v2/vendor/jquery.js"></script>

        <style>
            a.accordion-title:link {
                text-decoration:none;
                color:#000;
            }          
            /*            a.accordion-title:hover {
                            text-decoration:none;
                            color:#2199e8;
                        }*/
        </style>
    </head>
    <body>
        <div class="row">
            <form action="controlador.php" method="POST">
                <div class="large-6 columns"><!-- ... -->
                    <h3>Estudios de Mercado Externo</h3>
                    <input type="hidden" name="opcion" value="nuevo">
                    <div class="row">
                        <div class="small-6 columns" >
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria">
                                <option value="em_departamento">DEPARTAMENTO</option>
                                <option value="em_local_comercial">LOCAL COMERCIAL</option>
                                <option value="em_local_industrial">LOCAL INDUSTRIAL </option>
                                <option value="em_terreno">TERRENO</option>
                                <option value="em_casa">CASA</option>
                            </select>
                        </div>
                        <div class="medium-6 columns">
                            <label>Fecha de Estudio
                                <input type="date" name="estudio_fecha" placeholder="dd/mm/aaaa">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns" id="ubicacion">
                            <label>Ubicacion
                                <input type="text" name="ubicacion"  placeholder="Nombre de la Pagina">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-4 columns">
                            <label>Departamento</label>
                            <select name="ubi_departamento_id" id="departamentos" name="departamentos">
                                <?php
                                $estudio = new Estudio();
                                $resultado = $estudio->listar_departamentos();
                                foreach ($resultado as $arreglo) {
                                    ?>            
                                <option value="<?= $arreglo['departamento_id'] ?>"><?= $arreglo['nombre'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 columns">
                            <label>Provincia</label>
                            <select name="ubi_provincia_id" id="provincias" name="provincias">
                                <?php
                                $estudio = new Estudio();
                                $resultado = $estudio->listar_provincias();
                                foreach ($resultado as $arreglo) {
                                    ?>            
                                <option value="<?= $arreglo['provincia_id'] ?>"><?= $arreglo['nombre'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 columns">
                            <label>Distrito</label>
                            <select name="ubi_distrito_id" id="distritos" name="distritos">
                                <?php
                                $estudio = new Estudio();
                                $resultado = $estudio->listar_distritos();
                                foreach ($resultado as $arreglo) {
                                    ?>            
                                <option value="<?= $arreglo['distrito_id'] ?>"><?= $arreglo['nombre'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Zonificación</label>
                            <select name="zonificacion">
                                <?php
                                $estudio = new Estudio();
                                $resultado = $estudio->listar_zonificacion();
                                foreach ($resultado as $arreglo) {
                                    ?>            
                                <option value="<?= $arreglo['nombre'] ?>"><?= $arreglo['detalle'] ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="medium-6 columns">
                            <label>Area de Terreno (m2)
                                <input type="number" step="any" name="terreno_area">
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Valor Unitario de Terreno ($)
                                <input type="number" step="any" name="terreno_valorunitario" >
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Valor comercial ($)
                                <input type="number" step="any" name="valor_comercial" >
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Contacto
                                <input type="text" name="contacto">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Telefono
                                <input type="text" name="telefono">
                            </label>
                        </div>
                    </div>

                </div>
                <div class="large-6 columns">
                    
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Latitud
                                <input type="text" name="mapa_latitud">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label>Longitud
                                <input type="text" name="mapa_longitud">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <!-- FORMULARIOS PARTICULARES  -->
                        <div class="medium-6 columns" id="vista_local_id">
                            <label>Vista Local
                                <select name="vista_local_id" >
                                    <?php
                                    $estudio = new Estudio();
                                    $resultado = $estudio->listar_vista();
                                    foreach ($resultado as $arreglo) {
                                        ?>            
                                        <option value="<?= $arreglo['id'] ?>"><?= $arreglo['nombre'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns" id="edificacion_area">
                            <label>Area de Edificacion
                                <input type="number" step="any" name="edificacion_area">
                            </label>
                        </div>
                        <div class="medium-6 columns" id="piso_cantidad">
                            <label>Cantidad de Pisos
                                <input type="number" name="piso_cantidad">
                            </label>
                        </div>
                    </div>                   
                    <div class="row">
                        <div class="medium-6 columns" id="estacionamiento_cantidad">
                            <label>Cantidad de Estacionamientos
                                <input type="number" name="estacionamiento_cantidad">
                            </label>
                        </div>
                        <div class="medium-6 columns" id="departamento_tipo_id">
                            <label>Tipo de Departamento
                                <select name="departamento_tipo_id">

                                    <?php
                                    $estudio = new Estudio();
                                    $resultado = $estudio->listar_tipo_departamento();
                                    foreach ($resultado as $arreglo) {
                                        ?>            
                                        <option value="<?= $arreglo['id'] ?>"><?= $arreglo['nombre'] ?></option>
                                    <?php }
                                    ?>
                            </label>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-6 columns" id="areas_complementarias">
                            <label>Areas Complementarias
                                <select name="areas_complementarias">
                                    <option value="0">NO</option>
                                    <option value="1">SI</option>
                                </select>
                            </label>
                        </div>
                        <div class="medium-6 columns" id="piso_ubicacion">
                            <label>Numero de Piso
                                <input type="number"name="piso_ubicacion">
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                Observacion
                                <textarea name="observacion" placeholder="Ingrese aqui sus Obeservaciones"></textarea>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="medium-12 columns">
                            <input type="submit" class="button success button" name="Grabar" value="Grabar">
                        </div>
                    </div>

                </div>
                <div id="row">
            </form>

                <div class="row">
                    <div class="large-12 columns"><!-- ... -->
                        <table border="1" >
                            <?php $estudio = new Estudio(); ?>
                            <thead>
                            <td>TIPO</td>
                            <td>FECHA</td>
                            <td>UBICACION</td>
                            <td>AREA</td>
                            <td>V.UNITARIO</td>
                            <td>V.COMERCIAL</td>
                            <td>ZONIFICACION</td>
                            </thead>
                            <?php
                            $resultado = $estudio->listar_estudios();
                            foreach ($resultado as $arreglo) {
                                ?>
                                <tr>
                                    <td><?= $arreglo['tipo'] ?></td>
                                    <td><?= $arreglo['estudio_fecha'] ?></td>
                                    <td><?= $arreglo['ubicacion'] ?></td>
                                    <td><?= $arreglo['terreno_area'] ?></td>
                                    <td><?= $arreglo['terreno_valorunitario'] ?></td>
                                    <td><?= $arreglo['valor_comercial'] ?></td>
                                    <td><?= $arreglo['zonificacion'] ?></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </div>
                </div>

        </div>
    </div>
    <script src="../../librerias.v2/vendor/foundation6/js/vendor/jquery.js"></script>
    <script src="../../librerias.v2/vendor/foundation6/js/vendor/what-input.js"></script>
    <script src="../../librerias.v2/vendor/foundation6/js/vendor/foundation.js"></script>
    <script>
        //Funciones javascript de Foundation
        $(document).foundation();

        $(document).ready(function () {
            $('#vista_local_id').hide();
        });

        //Mostrar elementos de formulario propio de cada estudio
        $("#categoria").change(function () {
            switch ($("#categoria").val()) {
                case("em_departamento"):
                    $('#edificacion_area').show();
                    $('#piso_cantidad').show();
                    $('#estacionamiento_cantidad').show();
                    $('#departamento_tipo_id').show();
                    $('#areas_complementarias').show();
                    $('#piso_ubicacion').show();
                    $('#vista_local_id').show();
                    break;
                case("em_local_comercial"):
                    $('#edificacion_area').show();
                    $('#piso_cantidad').show();
                    $('#estacionamiento_cantidad').hide();
                    $('#departamento_tipo_id').hide();
                    $('#areas_complementarias').hide();
                    $('#piso_ubicacion').hide();
                    $('#vista_local_id').show();
                    break;
                case("em_local_industrial"):
                    $('#edificacion_area').show();
                    $('#piso_cantidad').show();
                    $('#estacionamiento_cantidad').hide();
                    $('#departamento_tipo_id').hide();
                    $('#areas_complementarias').hide();
                    $('#piso_ubicacion').hide();
                    $('#vista_local_id').hide();
                    break;
                case("em_terreno"):
                    $('#edificacion_area').hide();
                    $('#piso_cantidad').hide();
                    $('#estacionamiento_cantidad').hide();
                    $('#departamento_tipo_id').hide();
                    $('#areas_complementarias').hide();
                    $('#piso_ubicacion').hide();
                    $('#vista_local_id').hide();
                    break;
                case("em_casa"):
                    $('#edificacion_area').show();
                    $('#piso_cantidad').show();
                    $('#estacionamiento_cantidad').hide();
                    $('#departamento_tipo_id').hide();
                    $('#areas_complementarias').hide();
                    $('#piso_ubicacion').hide();
                    $('#vista_local_id').hide();
                    break;
                default:
                    break;
            }
        });
    </script>
</body>
</html>

