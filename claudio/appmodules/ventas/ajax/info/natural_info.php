<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/info.php";

// -------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
if (trim($input['id'])=='') $input['id']=0;
// ------------------------------------------------------- PROCESS
$ou = info_natural($input);

// -------------------------------------------------------- OUTPUT

echo '
<u>ESTADO</u>: ' . utf8_encode(strtoupper( $ou['estado_nombre'] ) ) . '
<br>
<u>VENDEDOR</u>: ' . utf8_encode(strtoupper( $ou['vendedor_nombre'] ) ) . '
';
