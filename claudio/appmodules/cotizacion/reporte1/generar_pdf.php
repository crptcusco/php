<?php
date_default_timezone_set("America/Lima");
//Codigo General
require('model.php');
require('../../../librerias.v2/vendor/fpdf181/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', null, 10);
$pdf->SetMargins(5,5,null);

//Recepcion de Datos
if (!isset($_GET['codigo'])) {
    header("error.php");
}

$cotizacion = new Cotizacion();
$resultado = $cotizacion->mostrar_cotizacion($_GET['codigo']);


$fecha= $resultado[0]['fecha'];
$codigo= $resultado[0]['codigo'];
$juridico = $resultado[0]['juridico'];
$cargo = $resultado[0]['cargo'];
$involucrado = $resultado[0]['involucrado'];
$servicio = $resultado[0]['servicio'];
$descripcion = $resultado[0]['descripcion'];
$monto = $resultado[0]['monto'];
$correo = $resultado[0]['correo'];

$fecha_cotizacion = "Lima,". date("d", strtotime($fecha)) . " de " . mes_a_texto($fecha) . " del ".date("Y", strtotime($fecha)) ;
$senores= $juridico;

//UBICACION
//TOTAL EN US$ SIN igV
//REQUISITOS


//
$pdf->Cell(40, 8, "", 0, 1);
$pdf->Cell(40, 8, "Cotización Nº 0001-2016/AC-AAPV", 0, 1);
$pdf->Cell(40, 8, $fecha_cotizacion, 0, 1);
$pdf->Cell(40, 8, 'Señores' , 0, 1);
$pdf->Cell(40, 8, $juridico , 0, 1);

$pdf->Cell(40, 8, "Presente.-" , 0, 1);
$pdf->Cell(40, 8, "Atención    : ".$involucrado , 0, 1);
$pdf->Cell(40, 8,  '            '.$cargo , 0, 1);
$pdf->Cell(40, 8, "Asunto        : ".$servicio , 0, 1);
$pdf->Cell(40, 8, 'De nuestra consideración:', 0, 1);
$pdf->Cell(40, 8, 'Por intermedio de la presente nos dirigimos a Usted, con la finalidad de hacer entrega de nuestra cotización, para el servicio solicitado vía email:', 0, 1);
$pdf->Cell(40, 8, 'DENOMINACION'.$descripcion, 0, 1);
$pdf->Cell(40, 8, 'UBICACIÓN'.$descripcion, 0, 1);
$pdf->Cell(40, 8, 'Total en US$ (No incluye IGV, Si viáticos)'.$monto, 0, 1);
$pdf->Cell(40, 8, 'Plazo de Servicio: 03 dias Hábiles, contados a partir del día siguiente de realizada la Inspección y entregada la documentación completa.', 0, 1);
$pdf->Cell(40, 8, "Asimismo, para la valorización se necesitará lo siguiente:" , 0, 1);
$pdf->MultiCell(200, 8, "- Relación de equipos en Excel con su detalle completo (código, cantidad, marca, modelo, capacidad, dimensiones, fecha de fabricación, etc. Fecha de adquisición y valor de adquisición)
- Base de datos contable.
- Copia de ficha técnica del activo.
- Se recomienda que en la inspección ocular se deba asignar a alguna persona que pueda indicar el estado, operatividad y mantenimiento de los activos.", 0, 1);
$pdf->Cell(40, 8,"Forma de pago: ", 0, 1);
$pdf->MultiCell(200, 8,"Adelanto del 50 % vía transferencia a nuestras cuentas y la cancelación a la entrega del informe virtual.
- Cuenta Corriente Dólares del BCP Nº 194-1900582-1-07
- Cuenta Interbancaria Dólares del BCP Nº 002-194-00190058257-99
El informe final será entregado en Original (01), incluye la presentación del álbum fotográfico." , 0, 1);
$pdf->Cell(40, 8, "Agradeceremos remitir la conformidad a la presente, al correo electrónico $correo e indicar el Nº de RUC para tenerlo presente al facturar el servicio.
Sin otro particular, quedo de usted.
Atentamente,
Pedro Carreño Bardales
Gerente General
ALLEMANT ASOCIADOS PERITOS VALUADORES S.A.C.", 0, 1);
$pdf->SetXY(5, 268);
$pdf->Line(5,267, 200, 267);
$pdf->MultiCell(200, 4, "Av. Manuel Olguín N° 373 Piso 5, Oficina 503 – Santiago de Surco
Teléfono: 436 1340 - Fax: 436 1420, Email: peritos@allemantperitos.com", 0, 'C');



$pdf->Output();

function mes_a_texto($fecha) {
    if (!ini_get('date.timezone')) {
        date_default_timezone_set('GMT');
    }
    $res = "";
    list($dia, $mes, $año) = split('[/.-]', $fecha);
    switch ($mes) {
        case "1":
            $res = "enero";
            break;
        case "2":
            $res = "febrero";
            break;
        case "3":
            $res = "marzo";
            break;
        case "4":
            $res = "abril";
            break;
        case "5":
            $res = "mayo";
            break;
        case "6":
            $res = "junio";
            break;
        case "7":
            $res = "julio";
            break;
        case "8":
            $res+="agosto";
            break;
        case "9":
            $res+="setiempbre";
            break;
        case "5":
            $res+="octubre";
            break;
        case "11":
            $res+="noviembre";
            break;
        case "12":
            $res+="diciembre";
            break;
        default:
            $res = "no pusiste fecha $fecha";
            break;
    }
    return $res;
}
?>

