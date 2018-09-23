<?php
include "../../../librerias.v2/mysql/dbconnector.php";
include "../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../librerias.v2/utilidades.php";
include "../modelo/httpush.php";

$modelo = new Coordinacion_Modelo_Eventos_HttPush();
set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
echo $modelo->countCoordinacionNoImpresas();
?>