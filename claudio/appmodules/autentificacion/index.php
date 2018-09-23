<?php
/* $str='123'; */
/* echo md5($str); */
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/mysql/dbconnector.php");
include ("../../librerias.v2/mysql/reutilizabes_cotizacion.php");
include ("./logica.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Autentificación';
EtiquetasHtml::$path = '../../librerias.v2';
// EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
include ("./url.php");
include ("./menu.php");

$bandera = existe_usuario();
if($bandera===False) {

  imprimir_formulario();
} elseif($bandera===True) {
  /* var_dump( $_SESSION ); */
  printf('<h1>Usuario Actual: <u>%s</u></h1>',$_SESSION['usuario']);
  if ($_SESSION["user_id"] == 1) {
      echo '<p>d:/AppServ/www/claudio/appmodules/autentificacion/Pendientes.ods</p>';
  }

}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/';
EtiquetasHtml::footer();

// funciones 
function imprimir_formulario(){
?>
<form action="login.php" method="POST">
  <hr>
  <div class="row"> 
    <div class="small-3 columns">Login</div> 
    <div class="small-9 columns"><input type="text" name="login"></div>
  </div>
  <div class="row"> 
    <div class="small-3 columns">Password</div> 
    <div class="small-9 columns"><input type="password" name="pass"></div>
  </div>
  <div class="row"> 
    <div class="small-push-3  small-9 columns"><input class="button" type="submit" name="enviar" value="Acceder"></div>
  </div>

 
</form>
<?php
}
