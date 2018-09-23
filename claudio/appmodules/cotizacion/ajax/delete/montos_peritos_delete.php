<?php 
include ("../../../../librerias.v2/html/tabla.php");
include("../../../../librerias.v2/mysql/dbconnector.php");
include("../../modelo/delete.php");
$input['id'] = clear_input( $_POST['id'] );
set_delete_montos_peritos($input);