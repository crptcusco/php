<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/info.php";

// -------------------------------------------------------- INPUT
$in['vendedor_id'] = clear_input( $_POST['vendedor_id'] );

// ------------------------------------------------------- PROCESS
$ou = info_es_propuesta_de_usuario($in);

// -------------------------------------------------------- OUTPUT
echo $ou;