<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/buttons.php";


$in['cotizacion_id'] = clear_input($_POST['cotizacion_id']);
$in['servicio_id'] = clear_input($_POST['servicio_id']);
$in['descripcion'] = clear_input($_POST['descripcion']);
$in['descripcion'] = utf8_encode($in['descripcion']);
$in['subtotal'] = clear_input($_POST['subtotal']);
$in['fecha'] = date('Y-m-d');
$in['usuario'] = $_SESSION['user_id'];

// Utilidades::print_r('in', $in);

set_buttons_servicios($in);
