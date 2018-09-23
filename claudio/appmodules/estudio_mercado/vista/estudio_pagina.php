<?php
require_once '../config.php';
# Importar modelo de abstracción de base de datos
require_once RUTA . 'sql/db_abstract_model.php';
require_once RUTA . 'modelo/estudio_pagina.php';

?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="es" >
<head>
    <meta charset="utf-8">
    <!-- If you delete this meta tag World War Z will become a reality -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginas de Consulta</title>
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/chosen/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="../vendor/foundation/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css">
    <style type="text/css">
    .titulo {
        color: #000 ;
        font-weight: bolder;
        text-decoration:none;  
    }

    </style>
</head>
<body>
    <div class="row">
        <div class="large-12 columns">
            <h3><a href="../index.php" class="button basic"> Volver al Inicio </a> Paginas de Consulta para Estudios de Mercado</h3>
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
  </div>
  <div class="row">
    <div class="large-6 columns">
        <h3>Listado de Paginas</h3>
        <ul class="accordion" data-accordion data-allow-all-closed="true"> 
            <?php
            $pagina = new Pagina();
            $resultado = $pagina->listar_categorias();
            foreach ($resultado as $arreglo) { 
                ?>
                <li class="accordion-item" data-accordion-item>
                    <a href="#" class="accordion-title titulo"><?= $arreglo['nombre'] ?></a>
                    <div class="accordion-content" data-tab-content>
                      <?php
                      $resultado2 = $pagina->listar_pagina_categoria($arreglo['id']);
                      foreach ($resultado2 as $arreglo2) { 
                        echo '<a href="'.$arreglo2['url'].'" target="blank"> '.$arreglo2['nombre'] .' </a> <br/>';
                    } 
                    ?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="large-6 columns">
        <h3>Nueva Pagina de Consulta</h3>
        <form action="../controlador/estudio_pagina.php" method="POST">
            <input type="hidden" name="opcion" value="nuevo">
            <div class="row">
                <div class="medium-6 columns">
                    <label>Pagina
                        <input type="text" name="nombre" placeholder="Nombre de la Pagina">
                    </label>
                </div>
                <div id="combo_pagina_categoria" class="medium-6 columns">
                    <label>Categoria : 
                        <a data-open="modal_es_pagina_categoria" id="pagina_categoria_trigger_add">Nueva Categoria</a>
                    </label>
                    <select data-placeholder="Selecciona una Categoria ..." class="chosen-select" id="pagina_categoria_id" name="pagina_categoria_id" required>
                        <option value="0"></option>
                    </select>
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
                <div class="medium-6 columns">
                    <input type="submit" class="button success button" name="Grabar" value="Grabar">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="reveal" id="modal_es_pagina_categoria" data-reveal>
    <br>
    <h3>Nueva Categoria de Pagina</h3>
    <input id="modal_es_pagina_categoria_nombre" type="text" value="">
    <button id="modal_pagina_categoria_save" class="button" data-close>Guardar</button>

    <button id="close_modal_es_pagina_categoria" class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<script type="text/javascript" language="javascript" src="../vendor/data_table/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="../vendor/foundation/js/vendor/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../vendor/data_table/datatables.min.js"></script>
<script type="text/javascript" language="javascript" src="../vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js"></script>
<script type="text/javascript" src="../vendor/foundation/js/vendor/what-input.js"></script>
<script type="text/javascript" src="../vendor/foundation/js/vendor/foundation.js"></script>
<script type="text/javascript" src="../vendor/chosen/chosen.jquery.min.js"></script>

<script type="text/javascript" src="../js/estudio_pagina.js"></script>

<script type="text/javascript">
    $(".chosen-select").chosen();
    $('#tasacion_data_table').DataTable();
    $(document).foundation();
</script>
</body>
</html>