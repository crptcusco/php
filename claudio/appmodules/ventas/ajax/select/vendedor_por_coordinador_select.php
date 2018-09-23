<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/select.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['coordinador_id'] = clear_input( $_POST['coordinador_id'] );

// -------------------------------------------------------- OUTPUT
get_options_vendedor_por_coordinador2( $input );
