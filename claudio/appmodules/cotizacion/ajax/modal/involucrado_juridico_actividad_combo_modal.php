<?php
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/modals.php";

$in['id'] = '0';
get_modals_option_involucrados_juridico_actividad($in);
