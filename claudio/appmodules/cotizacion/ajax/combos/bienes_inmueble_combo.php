<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/combos.php";

// -------------------------------------------------------- INPUT
if (isset($input['sub_categoria_id'])) 
    $input['sub_categoria_id'] = clear_input( $_POST['sub_categoria_id'] );
else 
    $input['sub_categoria_id'] = '0';
// -------------------------------------------------------- OUTPUT
get_options_bienes_inmueble($input);