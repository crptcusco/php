<?php 
if ( isset($_GET['cotizacion']) ) {
    $input['accion'] = 'editar';
    $input['codigo_cotizacion'] = $_GET['cotizacion'];  
    include './nuevo_editar.php';
} else{
    header('Location: ./nuevo.php');
}



