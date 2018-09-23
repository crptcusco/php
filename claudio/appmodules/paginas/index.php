<?php
require_once('pagina_model.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Paginas de Consulta</title>
        <title>Paginas de Consulta</title>
        <link rel="stylesheet" href="../../librerias.v2/vendor/foundation6/css/foundation.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>
            $(function () {
                $("#accordion").accordion();
            });
        </script>
        <style>
            h1{
                font-family: Verdana,Arial,sans-serif;
                color: #244c89;

            }
            p{
                font-size: 1.1em;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <div class="large-12 columns">
                <div class="medium-10 large-offset-1 columns ">
                    <div class="row align-middle">
                        <div class="medium-3 columns">
                            <img src="../../static/img/LOGO.JPG"></td>
                        </div>
                        <div class="medium-9 columns">
                                <h1>Páginas de Consulta</h1>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <div class="medium-10 large-offset-1 columns ">
                    <div class="row">
                        <div class="large-6 columns"><!-- ... -->
                            <div id="accordion">
                                <?php
                                $pagina = new Pagina();
                                $listado_categoria = $pagina->listar_categorias();
                                foreach ($listado_categoria as $categoria) {
                                    ?>
                                    <p><?= $categoria['nombre'] ?></p>
                                    <div>
                                        <ol>
                                            <?php
                                            $categoriaId = $categoria['id'];
                                            $listado_paginas = null;
                                            $listado_paginas = $pagina->listar_pagina_categoria($categoriaId);
                                            foreach ($listado_paginas as $arreglo) {
                                                ?>
                                                <li><a href="<?= $arreglo['url'] ?>" target="_blank"><?= $arreglo['nombre'] ?></a></li>   
                                            <?php }
                                            ?>
                                        </ol>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
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

                                                <?php
                                                $listado_categoria = $pagina->listar_categorias();
                                                foreach ($listado_categoria as $arreglo) {
                                                    ?>
                                                    <option value="<?= $arreglo['id'] ?>"><?= $arreglo['nombre'] ?></option>   
                                                <?php }
                                                ?>

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
                            <!--                                            <h3>Nueva Categoria</h3>
                                                                        <form>
                                                                            <div class="row">
                                                                                <div class="medium-12 columns">
                                                                                    <label>Categoria
                                                                                        <input type="text" placeholder="Nombre de la Categoria">
                                                        
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="medium-12 columns">
                                                                                    <input type="submit" class="button success button" name="Grabar" value="Grabar">
                                                                                </div>
                                                        
                                                                            </div>
                                                                        </form>-->
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
