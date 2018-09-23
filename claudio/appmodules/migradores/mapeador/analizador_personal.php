<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$mysqli = new mysqli("localhost", "root", "allemant", "allemant02");

consulta();


// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();

function consulta() 
{
    global $mysqli;
    
    if ($mysqli->connect_errno) {
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    }

    // opteniendo todas las tablas
    $out = array();
    $result = $mysqli->query("select fechaInspeccion, fechaEntregaInforme, observacion from coordinacion where observacion like '%barras%' or observacion like '%de oro%'");
    echo '<table>';
    echo '
<tr>
  <th>Inspeccion</th>
  <th>Entrega</th>
  <th>Observacion</th>
</tr>
         ';
    while ($row = $result->fetch_array()){
	echo '
<tr>
  <td>' . $row[0] . '<td>
  <td>' . $row[1] . '<td>
  <td>' . utf8_encode($row[2]) . '<td>
</tr>
             ';
    }
    echo '</table>';

}

?>
