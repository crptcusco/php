<?php
// ---------------------------------------------- ini-libs
include ("../librerias.v2/html/etiquetas.php");
include ("../librerias.v2/acciones/validar.php");
include ("../librerias.v2/acciones/fechas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 

// EtiquetasHtml::$files['header']['css'][] = './style01.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../librerias.v2';

EtiquetasHtml::header();
// ---------------------------------------------- ini-body
// validando si hay data o no en la fecha de filtro Y si la fecha es valida
if ( isset($_POST['fecha_inicial']) ) {
    $fecha_inicial['value'] = fechaMysql($_POST['fecha_inicial']);
    $fecha_inicial['valido'] = validar_fecha($fecha_inicial['value'], 'Y-m-d');
} else {
    $fecha_inicial['value'] = date('Y-m-d');
    $fecha_inicial['valido'] = TRUE;
}
if ( isset($_POST['fecha_final']) ) {
    $fecha_final['value'] = fechaMysql($_POST['fecha_final']);
    $fecha_final['valido'] = validar_fecha($fecha_final['value'], 'Y-m-d');
} else {
    $fecha_final['value'] = date('Y-m-d');
    $fecha_final['valido'] = TRUE;
}

$existencias=null;
$fecha_mayor_igual['valido']=FALSE;
if ($fecha_inicial['valido'] && $fecha_final['valido']) { // ¿ son validos las fechas ?    
    if (validar_fecha_mayor_igual($fecha_inicial['value'],$fecha_final['value'])) { // ¿ estan ordenadas las fecha ?
        // codigo aqui
        $fecha_mayor_igual['valido']=TRUE;
    }
}
?>
<div class="row">
    <div class="large-12 columns">

    <form action="" method="POST" id="example">
        <input type="text" class="fecha-inicio" name="fecha_inicial" value="<?php echo fechaPhp($fecha_inicial['value']) ?>" />                
        <input type="text" class="fecha-final" name="fecha_final" value="<?php echo fechaPhp($fecha_final['value']) ?>" />
        <button type="submit" value="0">Filtrar</button>                
    </form>
    <div>
        <?php
        if ($fecha_inicial['valido'] == FALSE)
            printf('%s  es invalido<br>', fechaPhp($fecha_inicial['value']));
        if ($fecha_final['valido'] == FALSE)
            printf('%s  es invalido<br>', fechaPhp($fecha_final['value']));
        if ( $fecha_mayor_igual['valido'] == FALSE && ($fecha_inicial['valido'] && $fecha_final['valido'] ) )
            printf('%s debe ser <= %s ', fechaPhp($fecha_inicial['value']), fechaPhp($fecha_final['value']));
        ?>
    </div>        
        
        
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer

// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';

EtiquetasHtml::footer();
