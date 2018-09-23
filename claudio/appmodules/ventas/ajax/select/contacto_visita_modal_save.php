<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/select.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['tipo_juridica'] = clear_input( $_POST['tipo_juridica'] );
$input['tipo_natural'] = clear_input( $_POST['tipo_natural'] );
$input['juridica_id'] = is_null_id( clear_input( $_POST['juridica_id'] ) );
$input['natural_id'] = is_null_id( clear_input( $_POST['natural_id'] ) );

if ( $input['tipo_juridica'] == 'true') {
    $input['persona_tipo'] = 'Juridica';
    $input['persona_id'] = $input['juridica_id'];
}
if ( $input['tipo_natural'] == 'true') {
    $input['persona_tipo'] = 'Natural';
    $input['persona_id'] = $input['natural_id'];
}
// -------------------------------------------------------- TEST
/*
print_test( '$_POST', $_POST );
print_test( '$input', $input );
*/

// -------------------------------------------------------- OUTPUT
if ( $input['persona_id'] != 0 ) { // no seleccionado
    get_options_contacto_visita($input);
}

