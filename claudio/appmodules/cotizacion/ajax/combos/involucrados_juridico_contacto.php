<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/combos.php";
if (! empty($_POST['juridico_id'])){
    get_options_involucrados_juridico_contacto( clear_input($_POST['id']), clear_input($_POST['juridico_id']) );
}

