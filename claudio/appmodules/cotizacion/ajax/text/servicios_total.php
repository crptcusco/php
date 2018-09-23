<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/texto.php";

$in['cotizacion_id'] = clear_input($_POST['cotizacion_id']);
$in['igv_sino'] = clear_input($_POST['igv_sino']);


$lista = get_servicio_total($in);


$ou['total'] = 0;
foreach($lista as $row)
{
    $ou['total'] += floatval($row['subtotal']);
}

$ou['total'] = sprintf('%1.2f', $ou['total']);

if ($in['igv_sino'] == 'true') {
    $ou['igv'] = get_monto_igv();
    $ou['igv'] = 1 + sprintf('%1.2f', $ou['igv']);
    $ou['total_igv'] = $ou['total'] * $ou['igv'];
    unset($ou['igv']);
} elseif ($in['igv_sino'] == 'false' ) {
    $ou['total_igv'] = $ou['total'];
}
$ou['total_igv'] = sprintf('%1.2f', $ou['total_igv']);

get_servicio_total_pago(array(
    'cotizacion_id' => $in['cotizacion_id'],
    'total_monto' => $ou['total'],
    'total_monto_igv' => $ou['total_igv'],
));
echo json_encode($ou);