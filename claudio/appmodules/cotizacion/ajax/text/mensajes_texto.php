<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/texto.php";

$lista = get_texto_mensaje();
/* echo '<h2>MySql</h2>'; */
/* echo '<pre>'; */
/* print_r($lista); */
/* echo '</pre>'; */
foreach($lista as $row){
    echo utf8_encode( $row['mensaje'] ) . '!!-!!';
}