<?php
require_once '../config.php';
require_once(RUTA . 'modelo/model_vehiculo.php');
require_once '../template/header.php';

?>
hola
        <div class="row">
            <form action="controlador.php" method="POST" data-abide>
                <div data-abide-error class="alert callout" style="display: none;">
                    <p><i class="fi-alert"></i> Hay Algunos Errores en tu vehiculo.</p>
                </div>
                <DIV class="large-12 columns">
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
                </DIV>
                <div class="large-6 columns"><!-- ... -->
                    <input type="hidden" name="opcion" value="nuevo_vehiculo">
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Codigo de Coordinacion
                                <input type="number" step="any" name="informe_id" required pattern="number">
                            </label>
                        </div>
                    </div>
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
                            <label>Tipo 
                                <a data-open="modal_es_vehiculo_tipo" id="link_vehiculo_tipo">Nuevo Tipo</a>
                            </label>
                            <select data-placeholder="Selecciona un tipo ..." style="width:350px;" 
                                    class="chosen-select"  name="vehiculo_tipo_id" id="vehiculo_tipo_id" 
                                    required>
                                        <?php
                                        $vehiculo = new Vehiculo();
                                        $resultado = $vehiculo->listar_vehiculo_tipo();
                                        foreach ($resultado as $arreglo) {
                                            ?>           
                                    <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div id="combo_es_vehiculo_marca" class="small-12 columns">
                            <label>Marca 
                                <a data-open="modal_es_vehiculo_marca" id="link_vehiculo_tipo">Nueva Marca</a>
                            </label>
                            <select data-placeholder="Selecciona una Marca ..." style="width:350px;" 
                                    class="chosen-select" id="vehiculo_marca_id" name="vehiculo_marca_id" required>
                                        <?php
                                        $vehiculo = new Vehiculo();
                                        $resultado = $vehiculo->listar_vehiculo_marca();
                                        foreach ($resultado as $arreglo) {
                                            ?>            
                                    <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-12 columns">
                            <label>Modelo <a data-reveal-id="modal_modelo">Nuevo Modelo</a></label>
                            <select data-placeholder="Selecciona un tipo ..." style="width:350px;" 
                                    class="chosen-select" id="vechiculo_modelo_id" name="vehiculo_modelo_id" required>
                                        <?php
                                        $vehiculo = new Vehiculo();
                                        $resultado = $vehiculo->listar_vehiculo_modelo();
                                        foreach ($resultado as $arreglo) {
                                            ?>            
                                    <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="large-6 columns">
                    <div class="row">
                        <div class="medium-6 columns">
                            <label>Traccion del Vehiculo</label>
                            <select <select data-placeholder="Selecciona un tipo ..." style="width:350px;" 
                                            class="chosen-select"  name="vehiculo_traccion_id" required>
                                                <?php
                                                $vehiculo = new Vehiculo();
                                                $resultado = $vehiculo->listar_vehiculo_traccion();
                                                foreach ($resultado as $arreglo) {
                                                    ?>            
                                        <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                    <?php }
                                    ?>
                                </select>
                        </div>
                        <div class="medium-6 columns">
                            <label>Valor Similar nuevo
                                <input type="number" class="division" step="any" id="valor_similar_nuevo" 
                                       name="valor_similar_nuevo" required pattern="number" >
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
                            <label>Ruta Informe
                                <input type="text" name="ruta_informe" required>
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
                <table border="1" >
                    <?php $vehiculo = new Vehiculo(); ?>
                    <thead>
                    <td>COORDINACION</td>
                    <td>FECHA</td>
                    <td>MARCA</td>
                    <td>MODELO</td>
                    <td>AÑO DE FABRICACION</td>
                    <td>VALOR SIMILAR NUEVO</td>
                    <td>DETALLE</td>
                    </thead>
                    <?php
                    $resultado = $vehiculo->listar_vehiculos();
                    foreach ($resultado as $arreglo) {
                        ?>
                        <tr>
                            <td><?= utf8_encode($arreglo['COORDINACION']) ?></td>
                            <td><?= utf8_encode($arreglo['FECHA']) ?></td>
                            <td><?= utf8_encode($arreglo['MARCA']) ?></td>
                            <td><?= utf8_encode($arreglo['MODELO']) ?></td>
                            <td><?= utf8_encode($arreglo['FABRICACION_ANIO']) ?></td>
                            <td><?= utf8_encode($arreglo['VALOR_NUEVO']) ?></td>
                            <td><p><a data-open="Modal<?= utf8_encode($arreglo['id']) ?>">
                                        Detalle</a></p></td>

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
            <div name ="prueba" id="prueba" >
            </div>
            <button id="close_modal_es_vehiculo_tipo" class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="reveal" id="modal_es_vehiculo_marca" data-reveal>
            <div name ="prueba" id="prueba" >
            </div>
            <button id="close_modal_es_vehiculo_marca" class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <script src="../vendor/foundation/js/vendor/jquery.js"></script>
        <script src="../vendor/foundation/js/vendor/what-input.js"></script>
        <script src="../vendor/foundation/js/vendor/foundation.js"></script>
        <script src="../vendor/chosen/chosen.jquery.min.js"></script>
        <script src="../js/estudio_vehiculo.js"></script>

        <script>
            $(".chosen-select").chosen();
            $(document).foundation();
        </script>

    </body>
</html>



<?php
include_once '../template/footer.php';
?>