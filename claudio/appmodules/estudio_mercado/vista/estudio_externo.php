<?php
require_once '../config.php';
require_once RUTA.'modelo/estudio_externo.php';
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
    <meta charset="utf-8">
    <!-- If you delete this meta tag World War Z will become a reality -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudio Externo</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
</head>
<body>
    <div class="row">
        <div data-abide-error class="alert callout" style="display: none;">
            <p><i class="fi-alert"></i> Hay Algunos Errores en tu Estudio.</p>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <h3><a href="../index.php" class="button basic"> Volver al Inicio </a>  Estudios de Mercado</h3>
            <?php
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
      <form action="../controlador/estudio_externo.php" method="POST" data-abide>
          <div class="large-6 columns">
            <input type="hidden" name="opcion" value="nuevo">
            <input type="hidden" name="consultor_id" value="<?= $_SESSION['id'] ?>">
            <input type="hidden" step="any" name="proyecto_id" value="1" >
            <input type="hidden" step="any" name="informe_id" value="1" >
            <div class="row">
                <div class="small-6 columns" >
                    <label for="categoria">Categoria</label>
                    <select name="categoria" id="categoria">
                        <option value="em_departamento">DEPARTAMENTO</option>
                        <option value="em_local_comercial">LOCAL COMERCIAL</option>
                        <option value="em_local_industrial">LOCAL INDUSTRIAL </option>
                        <option value="em_terreno">TERRENO</option>
                        <option value="em_casa">CASA</option>
                        <option value="em_oficina">OFICINA</option>
                    </select>
                </div>
                <div class="small-6 columns" >
                    <label for="tipo_propiedad">Tipo de Propiedad</label>
                    <select name="tipo_propiedad" id="tipo_propiedad">
                        <option value="HORIZONTAL">HORIZONTAL</option>
                        <option value="EXCLUSIVA">EXCLUSIVA</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="small-6 columns" >
                    <label>Tipo de Estudio</label>
                    <select name="estudio_tipo_id" id="estudio_tipo_id">
                        <option value="1">ESTUDIO SIMPLE</option>
                        <option value="2">VENTA CERRADA</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns">
                    <label>Fecha de Estudio / Fecha de Venta
                        <input type="date" name="estudio_fecha" id="estudio_fecha" value="">
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="medium-12 columns" id="ubicacion">
                    <label>Ubicacion
                        <input type="text" name="ubicacion"  placeholder="Ubicacion del Inmueble" required>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="small-4 columns">
                    <label>Departamento</label>
                    <select name="ubi_departamento_id" id="departamentos" name="departamentos" required>
                        <?php
                        $estudio = new Estudio();
                        $resultado = $estudio->listar_departamentos();
                        foreach ($resultado as $arreglo) {
                            ?>            
                            <option value="<?= $arreglo['departamento_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="small-4 columns">
                        <label>Provincia</label>
                        <select name="ubi_provincia_id" id="provincias" name="provincias" required>
                            <?php
                            $estudio = new Estudio();
                            $resultado = $estudio->listar_provincias(1);
                            foreach ($resultado as $arreglo) {
                                ?>            
                                <option value="<?= $arreglo['provincia_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="small-4 columns">
                            <label>Distrito</label>
                            <select name="ubi_distrito_id" id="distritos" name="distritos" required>
                                <?php
                                $estudio = new Estudio();
                                $resultado = $estudio->listar_distritos(1);
                                foreach ($resultado as $arreglo) {
                                    ?>            
                                    <option value="<?= $arreglo['distrito_id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="medium-6 columns">
                                <label>Zonificación</label>
                                <select name="zonificacion" required>
                                    <?php
                                    $estudio = new Estudio();
                                    $resultado = $estudio->listar_zonificacion();
                                    foreach ($resultado as $arreglo) {
                                        ?>            
                                        <option value="<?= $arreglo['nombre'] ?>"><?= utf8_encode($arreglo['detalle']) ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="medium-6 columns">
                                    <label>Area de Terreno (m2)
                                        <input type="number" class="division" step="any" id="terreno_area" name="terreno_area" required pattern="number" >
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
                                        <input type="number" step="any" class="division" id="valor_comercial" name="valor_comercial" required pattern="number">
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
                        </div>
                        <div class="large-6 columns">
                            <div class="row">
                                <div class="medium-6 columns">
                                    <label>Latitud
                                        <input type="number" step="any" name="mapa_latitud" required>
                                    </label>
                                </div>
                                <div class="medium-6 columns">
                                    <label>Longitud
                                        <input type="number" step="any" name="mapa_longitud" required>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <!-- FORMULARIOS PARTICULARES  -->
                                <div class="medium-6 columns" id="vista_local_id" required>
                                    <label>Vista Local
                                        <select name="vista_local_id" >
                                            <?php
                                            $estudio = new Estudio();
                                            $resultado = $estudio->listar_vista();
                                            foreach ($resultado as $arreglo) {
                                                ?>            
                                                <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-6 columns" id="edificacion_area" required pattern="number">
                                        <label>Area de Edificacion
                                            <input type="number" step="any" name="edificacion_area">
                                        </label>
                                    </div>
                                    <div class="medium-6 columns" id="piso_cantidad" required pattern="number">
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
                                        <label>Tipo de Departamento</label>
                                        <select name="departamento_tipo_id" required>
                                            <?php
                                            $estudio = new Estudio();
                                            $resultado = $estudio->listar_tipo_departamento();
                                            foreach ($resultado as $arreglo) {
                                                ?>            
                                                <option value="<?= $arreglo['id'] ?>"><?= utf8_encode($arreglo['nombre']) ?></option>
                                                <?php }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="medium-6 columns" id="areas_complementarias">
                                            <label>Areas Complementarias
                                                <select name="areas_complementarias" required pattern="number">
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
                                <table border="1" id="estudios_externos_data_table" class="display" width="100%" cellspacing="0" >
                                    <?php $estudio = new Estudio(); ?>
                                    <thead>
                                        <td>TIPO</td>
                                        <td>FECHA</td>
                                        <td>UBICACION</td>
                                        <td>AREA</td>
                                        <td>V.UNITARIO</td>
                                        <td>V.COMERCIAL</td>
                                        <td>ELIMINAR</td>
                                        <td>DETALLE</td>
                                    </thead>
                                    <?php
                                    $resultado = $estudio->listar_estudios();
                                    foreach ($resultado as $arreglo) {
                                        ?>
                                        <tr>
                                            <td><?= utf8_encode($arreglo['tipo']) ?></td>
                                            <td><?= utf8_encode($arreglo['fecha']) ?></td>
                                            <td><?= utf8_encode($arreglo['ubicacion']) ?></td>
                                            <td><?= utf8_encode($arreglo['terreno']) ?></td>
                                            <td><?= utf8_encode($arreglo['valorunitario']) ?></td>
                                            <td><?= utf8_encode($arreglo['valorcomercial']) ?></td>
                                            <td><a class="button alert" href="../controlador/estudio_externo.php?opcion=eliminar&id=<?= $arreglo['id'] ?>&tipo=<?= utf8_encode($arreglo['tipo'])?>">Eliminar</a> </td>
                                            <td><a class="button primary" data-open="Modal<?= utf8_encode($arreglo['tipo']) ?><?= utf8_encode($arreglo['id']) ?>">Detalle</a></td>
                                        </tr>
                                        <div class="reveal" id="Modal<?= utf8_encode($arreglo['tipo']) ?><?= utf8_encode($arreglo['id']) ?>" data-reveal>
                                            <h3><?= utf8_encode($arreglo['tipo']) ?> / <?= utf8_encode($arreglo['fecha']) ?>  </h3> 
                                            <p><strong>Proyecto : </strong><?= utf8_encode($arreglo['proyecto']) ?> <strong>Coordinacion : </strong><?= utf8_encode($arreglo['informe']) ?> <strong>Zonificacion : </strong><?= utf8_encode($arreglo['zonificacion']) ?></p>
                                            <p><strong>Ubicacion : </strong><?= utf8_encode($arreglo['ubicacion']) ?> </p>
                                            <p><strong>Departamento : </strong><?= utf8_encode($arreglo['departamento']) ?> <strong>Provincia : </strong><?= utf8_encode($arreglo['provincia']) ?> <strong>Distrito : </strong><?= utf8_encode($arreglo['distrito']) ?></p>
                                            <p><strong>Area : </strong><?= utf8_encode($arreglo['terreno']) ?> m2 <strong>V.Unitario : </strong><?= utf8_encode($arreglo['valorunitario']) ?> $ <strong>V.Comercial : </strong><?= utf8_encode($arreglo['valorcomercial']) ?> $</p>                          
                                            <p><strong>Observacion : </strong><?= utf8_encode($arreglo['observacion']) ?> </p>

                                            <button class="close-button" data-close aria-label="Close modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <script src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
                        <script src="../vendor/foundation/js/vendor/jquery.js"></script>
                        <script src="../vendor/data_table/datatables.min.js"></script>
                        <script src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
                        <script src="../vendor/foundation/js/vendor/what-input.js"></script>
                        <script src="../vendor/foundation/js/vendor/foundation.js"></script>
                        <script src="../js/estudio_externo.js"></script>
                        <script type="text/javascript">
        //Funciones javascript de Foundation
        $('#estudios_externos_data_table').DataTable();
        $(document).foundation();
    </script>
</body>
</html>