<?php
// ---------------------------------------------- ini-libs
include ("../../../../librerias.v2/html/tabla.php");
include("../../../../librerias.v2/mysql/dbconnector.php");
include("../../models/combos.php");

get_options_modelo_vehiculo($_POST['tipo'],$_POST['marca'],$_POST['modelo']);