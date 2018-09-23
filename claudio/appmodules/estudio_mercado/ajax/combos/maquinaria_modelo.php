<?php
// ---------------------------------------------- ini-libs
include ("../../../../librerias.v2/html/tabla.php");
include("../../../../librerias.v2/mysql/dbconnector.php");
include("../../models/combos.php");
//print_r($_POST);
get_options_modelo_maquinaria($_POST['tipo'],$_POST['marca'], $_POST['modelo']);