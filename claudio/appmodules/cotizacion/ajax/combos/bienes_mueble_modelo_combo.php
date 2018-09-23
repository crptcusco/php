<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/combos.php";

// -------------------------------------------------------- INPUT
$input['mueble_tipo_id'] = clear_input( $_POST['mueble_tipo_id'] );
$input['tipo_id'] = clear_input( $_POST['tipo_id'] );
$input['marca_id'] = clear_input( $_POST['marca_id'] );
$input['modelo_id'] = clear_input( $_POST['modelo_id'] );

// -------------------------------------------------------- OUTPUT
if ($input['tipo_id']!='' and $input['marca_id']!='') {
    get_options_bienes_mueble_modelo($input);
}
