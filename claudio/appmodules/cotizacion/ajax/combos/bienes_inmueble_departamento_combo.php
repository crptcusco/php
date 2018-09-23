<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/combos.php";

// -------------------------------------------------------- INPUT
$input['depatamento_id'] = clear_input( $_POST['departamento_id'] );

// -------------------------------------------------------- OUTPUT
get_options_bienes_inmueble_departamento($input);

