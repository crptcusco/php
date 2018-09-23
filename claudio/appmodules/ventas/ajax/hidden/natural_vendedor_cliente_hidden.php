<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/hidden.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );

// ------------------------------------------------------- PROCESS
$ou = hidden_natural_vendedor_cliente($input);

// -------------------------------------------------------- OUTPUT
echo utf8_encode( $ou['vendedor_id'] );
