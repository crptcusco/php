<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/selects.php";

$select = new Coordinacion_Modelo_Eventos_Selects();
// -------------------------------------------------------- INPUT
$in['code'] = Utilidades::clear_input($_POST['code']);
$in['text'] = Utilidades::clear_input_text($_POST['text']);
// -------------------------------------------------------- OUTPUT
$ou = $select->reporteInicialAutoCompletado($in);
if (isset($ou)) {
    foreach ($ou as $row) {
        $row['text'] = utf8_encode($row['text']);
        $row['text'] = quitar_tildes($row['text']);
        echo $row['text'] . '!!-!!';
    }
}

function quitar_tildes($cadena) {
    $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
    $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
    $texto = str_replace($no_permitidas, $permitidas ,$cadena);
    return $texto;
}

function limpiar_caracteres_especiales($s) {
    $s = ereg_replace("[áàâãªä]","a",$s);
    $s = ereg_replace("[ÁÀÂÃÄ]","A",$s);
    $s = ereg_replace("[éèêë]","e",$s);
    $s = ereg_replace("[ÉÈÊË]","E",$s);
    $s = ereg_replace("[íìîï]","i",$s);
    $s = ereg_replace("[ÍÌÎÏ]","I",$s);
    $s = ereg_replace("[óòôõºö]","o",$s);
    $s = ereg_replace("[ÓÒÔÕÖ]","O",$s);
    $s = ereg_replace("[úùûü]","u",$s);
    $s = ereg_replace("[ÚÙÛÜ]","U",$s);
    // $s = str_replace("[¿?\]","_",$s);
    // $s = str_replace(" ","-",$s);
    $s = str_replace("ñ","n",$s);
    $s = str_replace("Ñ","N",$s);
//para ampliar los caracteres a reemplazar agregar lineas de este tipo:
//$s = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$s);
    return $s;
    }
?>
