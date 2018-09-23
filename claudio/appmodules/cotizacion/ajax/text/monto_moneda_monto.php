<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/texto.php";

$input['id'] = clear_input( $_POST['id'] );
$monto = get_monto_moneda_monto( $input );
echo embellecer( $monto );

