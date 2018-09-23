<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/tables.php";

$table = new Coordinacion_Modelo_Eventos_Tables();
// -------------------------------------------------------- INPUT
$in['solicitante_id'] = Utilidades::clear_input( $_POST['solicitante_id'] );
$l = explode("-", $in['solicitante_id']);
$in['tipo_persona'] = $l[0];
$in['id'] = $l[1];
// -------------------------------------------------------- OUTPUT
echo '<tr>';
if ($in['tipo_persona']=='Juridica') {
    $ou = $table->juridicaInfo($in);
    echo '<tr><th>Clasificación</th>';
    echo '<td>'.utf8_decode($ou['clasificacion_nombre']).'</td>';
    echo '<tr><th>Actividad</th>';
    echo '<td>'.utf8_decode($ou['actividad_nombre']).'</td>';
    echo '<tr><th>Grupo</th>';
    echo '<td>'.utf8_decode($ou['grupo_nombre']).'</td>';
    echo '<tr><th>Nombre</th>';
    echo '<td>'.utf8_decode($ou['nombre']).'</td>';
    echo '<tr><th>RUC</th>';
    echo '<td>'.utf8_decode($ou['ruc']).'</td>';
    echo '<tr><th>Dirección</th>';
    echo '<td>'.utf8_decode($ou['direccion']).'</td>';
    echo '<tr><th>Teléfono</th>';
    echo '<td>'.utf8_decode($ou['telefono']).'</td>';
} elseif($in['tipo_persona']=='Natural') {
    $ou = $table->naturalInfo($in);
    echo '<tr><th>Nombre</th>';
    echo '<td>'.utf8_decode($ou['nombre']).'</td>';
    echo '<tr><th>Documento</th>';
    echo '<td>'.utf8_decode($ou['documento']).'</td>';
    echo '<tr><th>Dirección</th>';
    echo '<td>'.utf8_decode($ou['direccion']).'</td>';
    echo '<tr><th>Teléfono</th>';
    echo '<td>'.utf8_decode($ou['telefono']).'</td>';
    echo '<tr><th>Correo</th>';
    echo '<td>'.utf8_decode($ou['correo']).'</td>';
}
echo '</tr>';

