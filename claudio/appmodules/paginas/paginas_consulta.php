<?php
require_once('pagina_model.php');
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Paginas de Consulta</title>
    <link rel="stylesheet" href="../../librerias.v2/vendor/foundation6/css/foundation.css" />
    <style>
        h1{
            font-family: Verdana,Arial,sans-serif;
            color: #244c89;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="large-12 columns">
            <div class="medium-10 large-offset-1 columns ">
                <div class="row">
                    <div class="medium-3 columns">
                        <img src="../../static/img/LOGO.JPG"></td>
                    </div>
                    <div class="medium-9 columns">
                        <h1>Páginas de Consulta</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 columns"><!-- ... -->
                        <ul class="accordion" data-accordion data-allow-all-closed="true">
                            <?php
                            $pagina = new Pagina();
                            $array = array("INMUEBLES", "VEHICULOS", "MAQUINARIAS", "EQUIPOS");
                            $longitud = count($array);
                            for ($i = 0; $i < $longitud; $i++) {
                                ?>
                                <li class="accordion-item" data-accordion-item>
                                    <a href="#" class="accordion-title"><h6><?= $array[$i] ?></h6></a>
                                    <div class="accordion-content" data-tab-content>
                                        <ol>
                                            <?php
                                            $categoria = $i + 1;
                                            $resultado = null;
                                            $resultado = $pagina->listar_pagina_categoria($categoria);
                                            foreach ($resultado as $arreglo) {
                                                ?>
                                                <li><a href="<?= $arreglo['url'] ?>" target="_blank"><?= $arreglo['nombre'] ?></a></li>   
                                                <?php }
                                                ?>
                                            </ol>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="large-6 columns"><!-- ... -->
                            <h3>Nueva Pagina</h3>
                            <form action="pagina_controlador.php" method="POST">
                                <input type="hidden" name="opcion" value="nuevo">
                                <div class="row">
                                    <div class="medium-6 columns">
                                        <label>Pagina
                                            <input type="text" name="nombre" placeholder="Nombre de la Pagina">
                                        </label>
                                    </div>
                                    <div class="medium-6 columns">
                                        <label>Categorias
                                            <select name="categoria" >
                                                <option value="1">INMUEBLES</option>
                                                <option value="2">VEHICULOS</option>
                                                <option value="3">MAQUINARIAS</option>
                                                <option value="4">EQUIPOS</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-12 columns">
                                        <label>URL
                                            <input type="url" name="url" placeholder="URL de la Pagina">

                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="medium-12 columns">
                                        <input type="submit" class="button success button" name="Grabar" value="Grabar">
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../librerias.v2/vendor/foundation6/js/vendor/jquery.js"></script>
        <script src="../../librerias.v2/vendor/foundation6/js/vendor/what-input.js"></script>
        <script src="../../librerias.v2/vendor/foundation6/js/vendor/foundation.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
    </html>
