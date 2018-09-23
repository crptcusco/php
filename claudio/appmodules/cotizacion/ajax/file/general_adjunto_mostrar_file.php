<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/file.php";

// ------------------------------------------------------- INPUT
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );

// ------------------------------------------------------- PROCESS
$output = file_general_adjunto_show($input);

// ------------------------------------------------------- OUTPUT
imprimir( $output );

// ------------------------------------------------------- test
/* echo 'POST'; */
/* print_r($_POST); */
/* echo 'INPUT'; */
/* print_r($input); */
/* echo 'OUTPUT'; */
/* print_r($output); */

// ------------------------------------------------------- FUNCTIONS
function imprimir( $row ) {
    $file = '../../../files/cotizacion/adjuntos/'.$row['adjunto'];
    echo '
          <a href="' . $file . '"  target="_blank">' . $row['adjunto'] . '</a>
          ';
}