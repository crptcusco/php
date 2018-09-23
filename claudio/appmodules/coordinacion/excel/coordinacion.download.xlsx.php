<?php

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel.php';
require_once '../../../librerias.v2/utilidades.php';
require_once '../../../librerias.v2/mysql/dbconnector.php';
require_once '../../../librerias.v2/mysql/reutilizabes_cotizacion.php';
require_once '../modelo/excel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$in = $_GET;

print_xls($in);
print_header();

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

// -------------------------------------------------- function
function print_xls($in)
{
    global $objPHPExcel;
    $modelo = new Coordinacion_Modelo_Eventos_Excel();
    
    $title = '';
    $data = array();
    if ( isset($in['tipo']) &&  $in['tipo'] == 'programacion') {
        $title = 'Programación';
        $data = $modelo->listaCoordinacion(array( 'tipo' => '1'));
        // Utilidades::print_r('DATA',$data);
    } else {
        die('Seleccione tipo');
    }
    
    // Set document properties
    $objPHPExcel->getProperties()
        ->setCreator("Allemant")
        ->setTitle("Coordinaciones")
        ->setSubject("Coordinaciones")
        ->setDescription("Coordinaciones")
        ;
    // encabezado
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Coordinación')
        ->setCellValue('B1', 'Perito')
        ->setCellValue('C1', 'Control de Calidad')
        ->setCellValue('D1', 'Coordinador')
        ->setCellValue('E1', 'Ubicación')
        ->setCellValue('F1', 'Fecha Solicitud')
        ->setCellValue('G1', 'Fecha Inspección')
        ->setCellValue('H1', 'Hora Inspección')
        ->setCellValue('I1', 'Fecha al Cliente')
        ->setCellValue('J1', 'Fecha Operaciones')
        ;

    // data
    $i = 1;
    foreach($data as $row)
    {
        $i++;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, utf8_encode($row['coordinacion_codigo']))
            ->setCellValue('B'.$i, utf8_encode($row['perito_nombre']))
            ->setCellValue('C'.$i, utf8_encode($row['control_nombre']))
            ->setCellValue('D'.$i, utf8_encode($row['coordinador_nombre']))
            ->setCellValue('E'.$i, utf8_encode(
                $row['distrito_nombre'] . ' ->'.
                $row['provincia_nombre'] . ' -> '.
                $row['departamento_nombre'] 
            ))
            ->setCellValue('F'.$i, utf8_encode($row['solicitante_fecha']))
            ->setCellValue('G'.$i, utf8_encode($row['inspeccion_fecha']))
            ->setCellValue('H'.$i, utf8_encode(imprimir_hora($row)))
            ->setCellValue('I'.$i, utf8_encode($row['entrega_al_cliente_fecha']))
            ->setCellValue('J'.$i, utf8_encode($row['entrega_por_operaciones']))           
            ;
    }
    
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle($title);
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
}
function imprimir_hora($in)
{
    // hora aproximada
    $h = explode("-", $in['hora_estimada']);
    $h1 = explode(":",$h[0]);
    $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
    $h2 = explode(":",$h[1]);
    $h2 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h2[0], 'minuto'=>(int)$h2[1], 'return'=>'array'));
    $in['hora_estimada_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
    $in['hora_estimada_str'].= ' a ';
    $in['hora_estimada_str'].= sprintf("%02d:%02d %s" , $h2['hora'] , $h2['minuto'], $h2['meridiano']);
    if ($in['hora_estimada_mostrar']=='0') {
        $in['hora_estimada_str']='';
    } else {
        $in['hora_estimada_str'] = 'Entre: ' . $in['hora_estimada_str'];
    }
    $in['hora_estimada_ini'] = $h1;
    $in['hora_estimada_end'] = $h2;
    // hora exacta
    $h1 = explode(":", $in['hora_real']);
    $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
    $in['hora_real'] = $h1;
    $in['hora_real_str'] = sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
    if ($in['hora_real_mostrar'] == '0') {
        $in['hora_real_str'] = '';
    } else {
        $in['hora_real_str'] = $in['hora_real_str'];
    }
    return $in['hora_estimada_str'] . $in['hora_real_str'];
}
function print_header()
{
    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="coordinaciones.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
}
