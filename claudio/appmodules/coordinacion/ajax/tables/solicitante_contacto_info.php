<?php
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/tables.php";

$table = new Coordinacion_Modelo_Eventos_Tables();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id( $_POST['contacto_id'] );
print_r($in);
// -------------------------------------------------------- OUTPUT
$ou = $table->contactoInfo($in);
print_r($ou);
echo '<tr>';
echo '<tr><th>Nombre</th>';
echo '<td>'.utf8_encode($ou['nombre']).'</td>';
echo '<tr><th>Cargo</th>';
echo '<td>'.utf8_encode($ou['cargo']).'</td>';
echo '<tr><th>Teléfono</th>';
echo '<td>'.utf8_encode($ou['telefono']).'</td>';
echo '<tr><th>Correo</th>';
echo '<td>'.utf8_encode($ou['correo']).'</td>';

echo '</tr>';

