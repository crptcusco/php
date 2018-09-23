<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/combos.php";

// ---------------------------------------------- INPUT
if (isset($_POST['id']))
    $input['id'] = clear_input ( $_POST['id'] );
else
    $input['id'] =  '0';
// ---------------------------------------------- OUTPUT

get_options_monto_perito_id( $input );