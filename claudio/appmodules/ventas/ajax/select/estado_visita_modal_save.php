<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/select.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );

// -------------------------------------------------------- OUTPUT
get_options_estado_visita( $input );