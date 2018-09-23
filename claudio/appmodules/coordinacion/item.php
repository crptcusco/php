<?php
// ---------------------------------------------- ini-libs

include "../../librerias.v2/html/etiquetas.php";
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../librerias.v2/utilidades.php";
include "./logica.php";

include "../autentificacion/logica.php";
usuario_logeado('Coordinacion', '../autentificacion');
$group = 'coor_coordinacion_item';

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Modulo Coordinacion';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/foundation-datepicker-master/stylesheets/foundation-datepicker.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
EtiquetasHtml::$files['header']['css'][] = '../../static/css/admin/admin.css?v=2.0.4';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
include ("../autentificacion/url.php");
include ("../autentificacion/menu.php");
$logica = new Coordinacion_Modelo_Logica();
$logica->getListaRol();
// ---------------------------------- variables
$in['cotizacion_codigo'] = '';
if ( isset($_GET['startDataTable']) ) {
    $in['startDataTable'] = $_GET['startDataTable'];
} else {
    $in['startDataTable'] = 0;
}
    
if ( isset($_GET['cotizacion']) ) {
    $in['cotizacion_codigo'] = Utilidades::clear_input( $_GET['cotizacion'] );
    $in['cotizacion'] = $logica->getCotizacion($in['cotizacion_codigo']);
    $in['cotizacion_monto'] = sprintf(
        "%s %1.2f"
        , $in['cotizacion']['total_moneda_simbolo']
        , $in['cotizacion']['total_monto']
    );
    if ($in['cotizacion']['total_moneda_id']!='1') {
        $in['cotizacion_monto'].= sprintf(
            "<br>( cambio %1.2f S/.)"
            , $in['cotizacion']['total_cambio']
        );
    }
}

$in['coordinacion_id'] = '';
$in['coordinacion'] = array();
$in['inspecccion'] = array();
if ( isset($_GET['coordinacion']) ) {
    $in['coordinacion_id'] = Utilidades::clear_input( $_GET['coordinacion'] );
    $in['coordinacion'] = $logica->getCoordinacion( $in['coordinacion_id'] );
    $in['inspeccion'] = $logica->getInspeccion( $in['coordinacion_id'] );
    // echo '<pre>';
    // print_r($in['informe']);
    // echo '</pre>';
    if (isset($in['inspeccion']['inspector_id'])) {
        $logica->isConsultorListaRol($in['inspeccion']['inspector_id']);
    }

}
$in['coordinacion_modo'] = '';
if ( isset($_GET['modo']) ) {
  $in['coordinacion_modo'] = Utilidades::clear_input( $_GET['modo'] );
}

// ---------------------------------- usuarios pendex
if ( $logica->searchListaRol('Coordinador') ) {
    $in['rol'] = 'Coordinador';
} else {
    if ( $logica->searchListaRol('ControlDeCalidad') ) {
        $in['rol'] = 'ControlDeCalidad';
    } elseif ( $logica->searchListaRol('Perito') ) {
        header("Location: ..");
    } else {
        $in['rol'] = 'ControlDeCalidad';
    }
    

    
}
// Utilidades::print_r('session', $_SESSION);
// $logica->printListaRol();

// ---------------------------------- 
?>
<input type="hidden" id="<?php prefix('startDataTable') ?>"
       value="<?php echo $in['startDataTable'] ?>">

<input type="hidden" id="<?php prefix('cootizacion_id') ?>" value="<?php echo $in['coordinacion']['cotizacion_id'] ?>">
<input type="hidden" id="<?php prefix('rol') ?>" value="<?php echo $in['rol'] ?>">
<div class="row">
  <div class="small-3 columns panel text-center">
    <?php if ($in['rol'] == 'Coordinador'): ?>
      <h2>Cotización</h2>
      <h3><a title="ver cotización" target="cotizacion_item" href="../cotizacion/editar.php?cotizacion=<?php echo $in['cotizacion_codigo'] ?>"><?php echo $in['cotizacion_codigo'] ?></a></h3>
      <h4>Monto</h4>
      <?php echo $in['cotizacion_monto'] ?>
      <hr>
    <?php endif ?>
    <h2>Coordinación</h2>
    <table id="<?php prefix('cotiazacion_codigo') ?>" valor="<?php echo $in['cotizacion_codigo'] ?>" style="margin: 0px; width: 100%;" >
      <thead>
	<tr>
	  <th width="50">Nro</th>
	  <th></th>
	</tr>
      </thead>
    </table>
    <?php if ($logica->searchListaRol('Coordinador')):  ?>
      <a href="./nuevo.php?cotizacion=<?php echo $in['cotizacion_codigo'] ?>"
         class="button tiny success right">
        Añadir
      </a>      
    <?php endif ?>
  </div>
  <div class="small-9 columns">
    <?php
    if ($in['coordinacion_id'] != '') {
            include "./content/item.php";
            // Utilidades::print_r('$in',$in);
            
    }
    
    else ?>
    <input type="hidden" id="<?php prefix('coordinacion_id') ?>" value="">
  </div>
</div>
    
    
<?php
if ($in['coordinacion_id'] != '') {
    include "./content/modal_coordinacion_codigo_correlativo.php";
    // 
    include "./content/modal_persona.php";
    include "./content/info_solicitante.php";
    include "./content/info_solicitante_contacto.php";
    include "./content/info_cliente.php";
    include "./content/modal_contacto.php";
    include "./content/modal_modalidad.php";
    include "./content/modal_tipo2.php";
    include "./content/modal_cambio.php";
    include "./content/modal_inspeccion.php";
    //
    include "./content/modal_reporte_hoja_preview.php";
    
}
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/datatables.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';

EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/foundation-datepicker-master/js/foundation-datepicker.js';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_chosen.js?v=1.0.1';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_datapicker.js?v=1.1.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_numbers.js?v=1.0.0';

EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_item_correlativo.js?v=1.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_item_coordinacion.js?v=2.0.0';
EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_item_operacion.js?v=1.0.3';
//EtiquetasHtml::$files['footer']['js'][] = '../../static/js/coordinacion_item_informe.js?v=1.0.0';

// EtiquetasHtml::$files['footer']['js'][] = '../../static/js/.js?v=1.0.0';
EtiquetasHtml::footer();

function prefix($name) {
    global $group;
    echo $group . '_field_' . $name;
}
function sprefix($name) {
    global $group;
    return $group . '_field_' . $name;
}

