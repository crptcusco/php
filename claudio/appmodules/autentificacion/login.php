<?php 
include ("../../librerias.v2/mysql/dbconnector.php");
include ("../../librerias.v2/mysql/reutilizabes_cotizacion.php");
include ("./logica.php");

$login = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $login = clear_input($_POST["login"]);
  $pass = clear_input($_POST["pass"]);

  logIn( $login, $pass );
}
header('Location: ../autentificacion');

