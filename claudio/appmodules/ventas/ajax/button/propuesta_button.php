<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/button.php";
include "../../logica.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['codigo'] = clear_input( $_POST['codigo'] );
$input['persona_tipo'] = clear_input( $_POST['persona_tipo'] );

if ( $input['persona_tipo'] == 'Juridica') {
    $input['persona_id'] = clear_input( $_POST['juridica_id'] );    
} elseif ( $input['persona_tipo'] == 'Natural') {
    $input['persona_id'] = clear_input( $_POST['natural_id'] );
}

// ------------------------------------------------------- PROCESS
if ( $input['codigo'] != '0' ) {
    if ( logica_verificar_usuario('ve_propuesta', $input['id']) ) {
	$ou = button_set_propuesta($input);
	echo $ou['codigo'];
    } else {
	echo 'NoUser';
    }
} else {
    $ou = button_set_propuesta($input);
    echo $ou['codigo'];
}

