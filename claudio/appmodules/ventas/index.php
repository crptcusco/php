z<?php
// ---------------------------------------------- ini-libs

include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "./logica.php";

include "../autentificacion/logica.php";
usuario_logeado('Ventas', '../autentificacion');
$group = 've_propuesta';
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Ventas';
EtiquetasHtml::$path = '../../librerias.v2';

EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/ui/1.10.3/themes/smoothness/jquery-ui.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/filtergrid.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/real_ajax_upload/examples/css/base2Theme/style.css';
EtiquetasHtml::$files['header']['css'][] = '../../static/css/admin/admin.css?v=2.0.4';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
include ("../autentificacion/url.php");
include ("../autentificacion/menu.php");

$d = get_vendedorIdNombre_by_userid();

$input['vendedor_id'] = $d['id'];
$input['vendedor_nombre'] = utf8_encode($d['nombre']);
$input['vendedor_rol_id'] = $d['rol_id'];
$input['natural_id'] = 0;
$input['juridico_id'] = 0;
// print_test('$input', $input);
?>

<style>
    .mini .column, .mini .columns {
        padding: 0 0.5rem;
    }
    .no-margin .chosen-container {
        margin: 0;
    }
</style>
<div class="mini">
    <?php
    // Reporte solo para coordinador de Ventas
    if ($input['vendedor_rol_id'] == 2) {
        ?> 
        <div class="row">
            <div class="expanded button-group">
                <strong>REPORTES JEFE:</strong>
                <a href="./reporte.php?opcion=clientes" class="button " style="margin:0" target="propuesta_item"> CLIENTES</a>
                <a href="./reporte.php?opcion=propuestas" class="button " style="margin:0" target="propuesta_item"> SEGUIMIENTOS</a>
                <a href="./resumen.php?opcion=cotizaciones" class="button success " style="margin:0" target="propuesta_item"> COTIZACIONES</a>
                <a href="./resumen.php?opcion=gerencia" class="button alert" style="margin:0" target="propuesta_item">COTIZACIONES GERENCIA</a>
                <hr>
            </div>
        </div>
    <?php }
    ?>

    <div class="row">
        <div class="text-left">
            <a href="./nuevo.php" class="button success" style="margin:0" target="propuesta_item">NUEVO SEGUIMIENTO</a>
        </div>
    </div>
    <div class="row">

        <div class="small-3 columns text-right">
            <label>VENDEDOR:</label>
        </div>
        <div class="small-7 columns">
            <div class="row">
                <input type="hidden" id="<?php prefix('vendedor_id') ?>" value="<?php echo $input['vendedor_id'] ?>">
                <input type="hidden" id="<?php prefix('vendedor_rol_id') ?>" value="<?php echo $input['vendedor_rol_id'] ?>">
                <div class="small-1 columns text-right">	
                    <a id="<?php prefix('vendedor_link') ?>" data-reveal-id="<?php prefix('vendedor_modal') ?>" class="cld-icon-search right"></a>
                </div>
                <div class="small-11 columns">
                    <?php echo strtoupper($input['vendedor_nombre']) ?>
                </div>
            </div>
        </div>
        <div class="small-2 columns">
        </div>
    </div>
    <div class="row">
        <div class="small-2 columns text-right">
            <label>PERSONA:</label>
        </div>
        <div class="small-10 columns">
            <div class="panel callout">
                <div class="row">
                    <div class="small-2 columns">
                        <div class="row">
                            <div class="small-2 columns">
                                <input id="<?php prefix('persona_tipo_juridico') ?>" name="<?php prefix('persona_tipo') ?>" value="Juridica" class="<?php prefix('persona_tipo') ?>" type="radio" checked>
                            </div>
                            <div class="small-10 columns">
                                <label for="<?php prefix('persona_tipo_juridico') ?>">JURIDICO</label>
                            </div>	  
                        </div>
                        <div class="row">
                            <div class="small-2 columns">
                                <input id="<?php prefix('persona_tipo_natural') ?>" name="<?php prefix('persona_tipo') ?>" value="Natural" class="<?php prefix('persona_tipo') ?>" type="radio">
                            </div>
                            <div class="small-10 columns">
                                <label for="<?php prefix('persona_tipo_natural') ?>">NATURAL</label>
                            </div>	  
                        </div>	    
                    </div>
                    <div class="small-10 columns">
                        <div id="<?php prefix('persona_contenido_juridico') ?>">
                            <div class="row">
                                <div class="small-2 columns">
                                    <label class="right" for="<?php prefix('persona_juridico_id') ?>">RAZON.SOCIAL:</label>
                                </div>
                                <div class="small-1 columns text-right">	
                                    <a id="<?php prefix('persona_juridico_link') ?>" data-reveal-id="<?php prefix('persona_juridico_modal') ?>" class="cld-icon-search right"></a>
                                </div>
                                <div class="small-9 columns no-margin">
                                    <select id="<?php prefix('persona_juridico_id') ?>"  class="chosen-select">
                                        <option value="<?php echo $input['juridico_id'] ?>"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-3 columns"></div>
                                <div class="small-9 columns">
                                    <div id="<?php prefix('persona_juridico_info') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-2 columns">
                                    <label class="right" for="<?php prefix('persona_juridico_contacto_id') ?>">CONTACTO:</label>
                                </div>
                                <div class="small-1 columns text-right">	
                                    <a id="<?php prefix('persona_juridico_contacto_link') ?>" data-reveal-id="<?php prefix('persona_contacto_modal') ?>" class="cld-icon-search right"></a>
                                </div>
                                <div class="small-9 columns">
                                </div>
                            </div>
                        </div> <!-- end -->

                        <div id="<?php prefix('persona_contenido_natural') ?>" style="display:none;">
                            <div class="row">
                                <div class="small-2 columns">
                                    <label class="right" for="<?php prefix('persona_natural_id') ?>">NOMBRE:</label>
                                </div>
                                <div class="small-1 columns text-right">	
                                    <a id="<?php prefix('persona_natural_link') ?>" data-reveal-id="<?php prefix('persona_natural_modal') ?>" class="cld-icon-search right"></a>
                                </div>
                                <div class="small-9 columns no-margin">
                                    <select id="<?php prefix('persona_natural_id') ?>"  class="chosen-select">
                                        <option value="<?php echo $input['natural_id'] ?>"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-3 columns"></div>
                                <div class="small-9 columns">
                                    <div id="<?php prefix('persona_natural_info') ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-2 columns">
                                    <label class="right" for="<?php prefix('persona_natural_contacto_id') ?>">CONTACTO:</label>
                                </div>
                                <div class="small-1 columns text-right">	
                                    <a id="<?php prefix('persona_natural_contacto_link') ?>" data-reveal-id="<?php prefix('persona_contacto_modal') ?>" class="cld-icon-search right"></a>
                                </div>
                                <div class="small-9 columns"></div>
                            </div>
                        </div> <!-- end -->

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns"><h4>Listado de Seguimientos</h4></div>
        <div class="large-12 columns text-right">
            <a id="<?php prefix('search_update') ?>">ACTUALIZAR</a>
        </div>
        <style>
         #<?php prefix('search') ?> input.active,
         #<?php prefix('search') ?> select.active
         {
             background-color: #aaffa9;
         }
         #<?php prefix('search') ?>  input,
         #<?php prefix('search') ?>  select
         {
             font-size: 0.8em;
         }
         #<?php prefix('search') ?>  td,
         #<?php prefix('search') ?>  th
         {
             padding: 0;
             font-size: 0.8em;
         }
        </style>
        <div class="large-12 columns">
          <table class="" id="<?php prefix('search') ?>">
            <thead>
              <tr>
                <?php $i = -1 ?>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><input class="no-margin search-input-text" data-column="<?php echo ++$i ?>"  type="text"></td>
                <td><!-- <?php echo ++$i ?> --></td>
                <td><!-- <?php echo ++$i ?> --></td>
              </tr>
              <tr>
                <th width="90">Código</th>
                <th>Vendedor</th>
                <th>Persona</th>
                <th>Estado</th>
                <th>Contacto</th>
                <th>Cargo</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>              
              </tr>
            </thead>
          </table>          
        </div>
        
    </div>

    <?php
    // modales
    include ('./modals/propuesta/vendedor_modal.php');
    include ('./modals/propuesta/juridico_modal.php');
    include ('./modals/propuesta/natural_modal.php');
    include ('./modals/propuesta/contacto_modal.php');
    ?>
</div><!-- mini -->
<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/TableFilter_EN/TableFilter/tablefilter_all_min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/ui/1.10.3/jquery-ui.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/real_ajax_upload/examples/js/ajaxupload-min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_chosen.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_datapicker.js?v=1.0.0';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_propuesta.js?v=1.0.5';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/ventas_search.js?v=1.0.5';
EtiquetasHtml::footer();

function prefix($name) {
    global $group;
    echo $group . '_field_' . $name;
}
