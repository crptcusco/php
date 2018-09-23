<?php
// ---------------------------------------------- ini-libs

include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../librerias.v2/utilidades.php";
include "./logica.php";

include "../autentificacion/logica.php";
usuario_logeado('Coordinacion', '../autentificacion');
$group = 'coor_reporte_coordinacion_cotizacion';

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Coordinacion';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/ui/1.10.3/themes/smoothness/jquery-ui.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table_colvis/dataTables.colVis.css';

EtiquetasHtml::$files['header']['css'][] = '../../static/css/admin/admin.css?v=2.0.4';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
include ("../autentificacion/url.php");
include ("../autentificacion/menu.php");
$logica = new Coordinacion_Modelo_Logica();
$logica->getListaRol();

// ---------------------------------- usuarios pendex
if ( $logica->searchListaRol('ControlDeCalidad') ) {
    $in['rol'] = 'ControlDeCalidad';
} else {
    if ( $logica->searchListaRol('Perito') ) {
        header("Location: ..");
    }
    if ( $logica->searchListaRol('Coordinador') ) {
        $in['rol'] = 'Coordinador';
    } else {
        $in['rol'] = 'ControlDeCalidad';
    }
    
}
// Utilidades::print_r('session', $_SESSION);
// $logica->printListaRol();
// ----------------------------------
$column_dev = false;
?>
<style>
 table {
     margin: 0;
     clear: both;
 }
 table td, table select
 {
     text-align: center;
 }
 table input, table select
 {
     font-size: 0.8em;
 }
 table ul
 {
     text-align: left;
     margin: 0 0 0 1em;
     font-size: 0.7em;
 }
 table th {
     padding-top:0;
     padding-botton:0;
 } 
 dl.tabs {
     background-color: #C4C4C4;
 }
 dl.tabs dd a {
     padding: 0.5rem 1rem;
 }
 .tabs-content {
     margin:0;
 }

 .research {
     background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , #ffffff 0%, #f3f3f3 89%, #f9f9f9 100%) repeat scroll 0 0;
     border: 1px solid #999;
     border-radius: 2px;
     box-shadow: 1px 1px 3px #ccc;
     color: black !important;
     cursor: pointer;
     width: 2.3em;
     height: 2.3em;
     outline: none;
 }
  .research a {
      padding: 0.6em;
      color: black !important;
      outline: medium none;
  }
 .sin-imprimir {
     background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , #ffffff 0%, #f3f3f3 89%, #f9f9f9 100%) repeat scroll 0 0;
     border: 1px solid #999;
     border-radius: 2px;
     box-shadow: 1px 1px 3px #ccc;
     color: black !important;
     cursor: pointer;
     /*width: 6.4em;*/
     height: 2.3em;
     padding: 0.4em;
 }
 ol.bienes li{
     color:red;
 }
 ol.bienes li span{
     color:black;
 }
</style>

<dl class="tabs" data-tab>
  <?php if($in['rol'] == 'Coordinador'): ?>
    <dd id="tab-panel1" class="active"><a href="#panel1">Cotizaciones Aprobadas</a></dd>
  <?php endif ?>
  <dd id="tab-panel2"><a href="#panel2">Coordinaciones</a></dd>         
</dl>
<div class="tabs-content">
  <?php
  $active1 = ''; $active2 = '';
  if($in['rol'] == 'Coordinador') $active1 = 'active';
  else $active2 = 'active';
  ?>
  <div class="content <?php echo $active1 ?>" id="panel1" style="padding: 0">
    <!-- -----------------  cotización  -------------------- -->
    <?php $group = 'coor_reporte_coordinacion_cotizacion'; ?>
    <div id="<?php prefix('tabla_cols') ?>"></div>
    <div class="research left">
      <a id="<?php prefix('tabla_search') ?>">
        <i class="fi-refresh size-21"></i>
      </a>
    </div>
    <table id="<?php prefix('tabla') ?>" class="cell-border" cellspacing="0">
      <thead>
        <?php if ($column_dev): ?>
          <tr>
            <th>00</th>
            <th>01</th>
            <th>02</th>
            <th>03</th>
            <th>04</th>
            <th>05</th>
            <th>06</th>
          </tr>
        <?php endif; ?>
        <tr>
          <?php $i = -1 ?>
          <th>
            <input id="<?php prefix('tabla-coordinacion_creacion') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_creacion"
                   class="search-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-cotizacion_solicitud_fecha') ?>"
                   data-column="<?php echo ++$i ?>" code="cotizacion_solicitud_fecha"
                   class="search-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-coordinacion_tipo2') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_tipo2"
                   class="search-input-text autocomplete-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-coordinacion_coordinador') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_coordinador"
                   class="search-input-text autocomplete-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-coordinacion_cliente') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_cliente"
                   class="search-input-text autocomplete-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-coordinacion_solicitante') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_solicitante"
                   class="search-input-text autocomplete-input-text" style="margin:0" type="text"
                   >
          </th>
          <th>
            <input id="<?php prefix('tabla-') ?>"
                   data-column="<?php echo ++$i ?>" code=""
                   class="search-input-text" style="margin:0" type="text"
                   >
          </th>
        </tr>
        <tr>
          <th class="text-center" width="80">Fecha de Creación</th>
          <th class="text-center" width="80">Fecha de Aprobacion</th>
          <th class="text-center" width="80">Tipo de Servicio</th>
          <th class="text-center" width="80">Coordinador</th>
          <th class="text-center" width="80">Cliente</th>
          <th class="text-center" width="80">Solicitante</th>
          <th class="text-center" width="80">Cotización</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="content <?php echo $active2 ?>" id="panel2" style="padding: 0">
    <!-- ----------------- coordinación -------------------- -->
    <?php $group = 'coor_reporte_coordinacion_coordinacion'; ?>
    <input id="<?php prefix('rol') ?>" value="<?php echo $in['rol'] ?>" type="hidden">
    <div id="<?php prefix('tabla_cols') ?>"></div>
    <div class="research left">
      <a id="<?php prefix('tabla_search') ?>">
        <i class="fi-refresh size-21"></i>
      </a>
    </div>
    <div class="research left">
      <a href="./excel/coordinacion.download.xlsx.php?tipo=programacion" target="_blank">
        <i class="fi-page-export size-21"></i>
      </a>
    </div>
    <table id="<?php prefix('tabla') ?>" style="width:100%">
      <thead>
        <?php if ($column_dev): ?>
          <tr>
            <td>00</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>04</td>
            <td>05</td>
            <td>06</td>
            <td>07</td>
            <td>08</td>
            <td>09</td>
            <td>10</td>
            <td>11</td>
          </tr>
        <?php endif ?>
        <tr>
          <?php $i = -1 ?>
          <td>
            <input id="<?php prefix('tabla-cotizacion_codigo') ?>"
                   data-column="<?php echo ++$i ?>" code="cotizacion_codigo"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <select id="<?php prefix('tabla-coordinacion_estado') ?>"
                    data-column="<?php echo ++$i ?>" code="coordinacion_estado"
                    class="search-input-select" style="margin:0; width: 130px;"
            >
              <option value="0">Todo</option>
              <option value="1">En Programación</option>
              <option value="2">En Espera</option>
              <option value="3">Por Aprobar</option>
              <option value="4">Impreso</option>
              <option value="5">Desestimado</option>              
            </select>
          </td>     
          <td>
            <input id="<?php prefix('tabla-coordinacion_solicitante') ?>" 
                   data-column="<?php echo ++$i ?>" code="coordinacion_solicitante"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_cliente') ?>" 
                   data-column="<?php echo ++$i ?>" code="coordinacion_cliente"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_perito') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_perito"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_tipo2') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_tipo2"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_inspeccion_ubicacion') ?>"
                   data-column="<?php echo ++$i ?>" code="inspeccion_ubicacion"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>          
          <td>
            <input id="<?php prefix('tabla-coordinacion_solicitud_fecha') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_solicitud_fecha"
                   class="search-input-text" style="margin:0" type="text"
                   >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_inspeccion') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_finalizacion_inspeccion"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>

          <td><!-- <?php echo ++$i ?> hora --></td>
          <td>
            <input id="<?php prefix('tabla-entrega_al_cliente_fecha') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_entrega_al_cliente_fecha"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-entrega_por_operaciones_fecha') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_entrega_por_operaciones_fecha"
                   class="search-input-text" style="margin:0" type="text"
            >
          </td>
          <td><!-- <?php echo ++$i ?> --></td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_control') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_control"
                   class="search-input-text " style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_coordinador') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_coordinador"
                   class="search-input-text" style="margin:0" type="text"
                   >
          </td>
          <td><!-- <?php echo ++$i ?> --></td>  
          <td><!-- <?php echo ++$i ?> --></td>          
          <td>
            <select id="<?php prefix('tabla-coordinacion_tipo') ?>"
                    data-column="<?php echo ++$i ?>" code="coordinacion_tipo"
                    class="search-input-select" style="margin:0"
                    >
              <option value="0">Todo</option>
              <option value="2">Interior</option>
              <option value="1">Exterior</option>
              <option value="3">Gabinete</option>
            </select>
          </td>
          <td>
            <input id="<?php prefix('tabla-coordinacion_modalidad') ?>"
                   data-column="<?php echo ++$i ?>" code="coordinacion_modalidad"
                   class="search-input-text autocomplete-input-text" style="margin:0" type="text"
            >
          </td>
          <td>
            <input id="<?php prefix('tabla-cotizacion_codigo') ?>"
                   data-column="<?php echo ++$i ?>" code="cotizacion_codigo"
                   class="search-input-text" style="margin:0" type="text"
                   >
          </td>
        </tr>
        <tr>
          <th class="text-center" width="80">Coordinacion</th>
          <th class="text-center" width="90">Estado</th>
          
          <th class="text-center">Solicitante</th>
          <th class="text-center">Cliente</th>
          <th class="text-center" width="90">Perito</th>
          
          <th class="text-center" width="90">Tipo de Servicio</th>
          <th class="text-center" width="90">Ubicación</th>
          
          <th class="text-center" width="80">Fecha de Solicitud</th>
          <th class="text-center" width="80">Fecha de Inspección</th>
          <th class="text-center" width="80">Hora de Inspección</th>
          <th class="text-center" width="80">Fecha entrega al Cliente</th>
          <th class="text-center" width="80">Fecha entrega por Operaciones</th>

          <th class="text-center" width="90">Observación</th>
          <th class="text-center" width="90">Control Calidad</th>
          <th class="text-center" width="90">Coordinador</th>

          <th class="text-center" width="90">Ultimo Comentario</th>          
          <th class="text-center" width="60">Funciones</th>
          
          <th class="text-center" width="90">Modalidad</th>
          <th class="text-center" width="90">Formato</th>
          <th class="text-center" width="80">Cotización</th>
        </tr>
      </thead>
    </table>
  </div>

<?php

// coordinaciones
$group = 'coor_reporte_coordinacion_coordinacion';
include "./content/modal_inspeccion_reporte_coordinacion.php";
include "./content/modal_bien_reporte_coordinacion.php";
include "./content/modal_reporte_hoja_preview.php";


// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table_colvis/dataTables.colVis.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_chosen.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_datapicker.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_numbers.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/ui/1.10.3/jquery-ui.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_reporte_cotizacion.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_reporte_coordinacion.js?v=1.0.3';
// EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_reporte_hojas.js?v=1.0.0';
// EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_reporte_hojas_httpush.js?v=1.0.0';

EtiquetasHtml::footer();

function prefix($name) {
    global $group;
    echo $group . '_field_' . $name;
}

