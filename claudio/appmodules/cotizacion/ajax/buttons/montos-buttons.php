<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

// -------------------------------------------------- INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );

$input['sin'] = clear_input( $_POST['sin'] );
$input['sin'] = str_num_null( $input['sin'] );

$input['igv_si'] = clear_input( $_POST['igv_si'] );
$input['igv_monto'] = clear_input( $_POST['igv_monto'] );
if ($input['igv_si'] == 'false') {
    $input['igv'] = 0;
} elseif($input['igv_si'] == 'true') {
    $input['igv'] = $input['igv_monto'];
}
unset($input['igv_si']);
unset($input['igv_monto']);

$input['con'] = clear_input( $_POST['con'] );
$input['con'] = str_num_null( $input['con'] );

$input['moneda_id'] = clear_input( $_POST['moneda_id'] );
$input['cambio'] = clear_input( $_POST['cambio'] );
$input['cambio'] = str_num_null( $input['cambio'] );

$input['de'] = clear_input( $_POST['de'] );
$input['fecha'] = date('Y-m-d');
// -------------------------------------------------- PROCESS
$son_numeros = true;
if ( is_numeric( $input['sin'] )
    and is_numeric( $input['igv'] )
    and is_numeric( $input['con'] )
    and is_numeric( $input['cambio'] )
    ){
    $son_numeros = true;
} else {
    $son_numeros = false;
}

// -------------------------------------------------- OUTPUT
if ($son_numeros) {
  $output = set_buttons_montos($input);
}

// -------------------------------------------------- TEST
/*
echo '<h1>POST</h1>';
print_r( $_POST );
echo '<h1>INPUT</h1>';
print_r( $input );
echo '<h1>OUTPUT</h1>';
print_r( $output );
*/
