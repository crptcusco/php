<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/texto.php";

// ------------------------------------- INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
// ------------------------------------- PROCESS
$datos = get_monto_cargar($input);

// ------------------------------------- OUTPUT
imprimir( $datos );

// ------------------------------------- FUNCTIONS
function imprimir($input) {
  echo '
{
    "sin_igv":"' . embellecer( $input['sin'] ) . '",
    "igv":"' . embellecer( $input['igv'] ) . '",
    "igv_de":"' . $input['de'] . '",
    "con_igv":"' . embellecer( $input['con'] ) . '",
    "moneda_id":"' . $input['moneda_id'] . '",
    "moneda_monto":"' . embellecer( $input['cambio'] ) . '"
}
        ';
}
?>

