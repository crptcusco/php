<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/texto.php";

if ( ! empty($_POST['id']) ) {
    $contacto = get_involucrado_juridico_contacto_datos( clear_input($_POST['id']) );
    if ( ! is_array($contacto) ) {
    printf( '<label><u>Cargo</u>: %s</label>
<label><u>Teléfono</u>: %s</label>
<label><u>Correo</u>: %s</label>'
	    , utf8_encode( $contacto['cargo'] )
	    , utf8_encode( $contacto['telefono'] )
	    , utf8_encode( $contacto['correo'] )
	    );
    }

}

