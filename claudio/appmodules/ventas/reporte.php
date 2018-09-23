<?php
include "../../librerias.v2/mysql/dbconnector.php";
$objConn = new DBConnector_Alternative();

$conexion = new mysqli($objConn->servername,
                       $objConn->username,
                       $objConn->password,
                       $objConn->dbname,
                       3306);
if (mysqli_connect_errno()) {
    printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    exit();
}

$opcion = "hola a tyodos";
if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];
}
//echo "hola";
//print_r($opcion);
//echo "hola";
//die();

switch ($opcion) {
    case 'cotizaciones':
        $consulta = "select * from (select DISTINCT
coco.codigo as codigo, 
DATE_FORMAT(coco.fecha_solicitud,'%d-%m-%Y') as solicitud,
DATE_FORMAT(come.info_create,'%d-%m-%Y') as seguimiento,
lous.full_name as coordinador,
coes.nombre as estado,
cose.nombre as servicio,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
coinco.telefono as telefono,
copa.total_monto as monto,
como.simbolo as simbolo,
come.mensaje as mensaje
from co_cotizacion as coco
left join co_mensaje as come on come.cotizacion_id = coco.id
left join login_user as lous on lous.id = coco.info_create_user
left join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_juridica as coinju on coin.persona_id = coinju.id
left join co_involucrado_natural as coinna on  coin.persona_id = coinna.id
left join co_involucrado_contacto as coinco on coin.contacto_id = coinco.id
left join co_servicio_tipo as cose on coco.servicio_tipo_id = cose.id
left join co_pago as copa on coco.id = copa.cotizacion_id
left join co_cotizacion_tipo as cocoti on cocoti.id = coco.tipo_cotizacion_id
left join co_moneda as como on como.id = copa.total_moneda_id
left join co_desglose as codes on codes.id = coco.desglose_id
left join co_estado as coes on coes.id = coco.estado_id
where codigo != 0 and ( DATEDIFF(now(),coco.fecha_solicitud)  <= 8 or coco.estado_id = 1 ) 
ORDER BY come.info_create desc
)sub GROUP BY codigo order by codigo desc;";

        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            date_default_timezone_set('America/Lima');

            if (PHP_SAPI == 'cli')
                die('Este archivo solo se puede ver desde un navegador web');

            /** Se agrega la libreria PHPExcel */
            require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel.php';

// Se crea el objeto PHPExcel
            $objPHPExcel = new PHPExcel();
            // Se asignan las propiedades del libro
            $objPHPExcel->getProperties()->setCreator("Allemant") // Nombre del autor
                    ->setLastModifiedBy("Allemant") //Ultimo usuario que lo modificó
                    ->setTitle("Reporte Avance Coticaciones") // Titulo
                    ->setSubject("Reporte Avance Coticaciones") //Asunto
                    ->setDescription("Reporte Avance Coticaciones") //Descripción
                    ->setKeywords("Reporte Avance Coticaciones") //Etiquetas
                    ->setCategory("Reporte Avance Coticaciones"); //Categorias

            $tituloReporte = "Reporte Avance Cotizaciones";
            $titulosColumnas = array('CODIGO',
                'USUARIO', 'SOLICITUD', 'SEGUIMIENTO','SERVICIO', 'EMPRESA', 'ESTADO',  'CONTACTO',
                'TELEFONO', 'MONEDA', 'PRECIO SIN IGV', 'MENSAJE');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:L1');
            
// Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', $tituloReporte) // Titulo del reporte
                    ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
                    ->setCellValue('B3', $titulosColumnas[1])
                    ->setCellValue('C3', $titulosColumnas[2])
                    ->setCellValue('D3', $titulosColumnas[3])
                    ->setCellValue('E3', $titulosColumnas[4])
                    ->setCellValue('F3', $titulosColumnas[5])
                    ->setCellValue('G3', $titulosColumnas[6])
                    ->setCellValue('H3', $titulosColumnas[7])
                    ->setCellValue('I3', $titulosColumnas[8])
                    ->setCellValue('J3', $titulosColumnas[9])
                    ->setCellValue('K3', $titulosColumnas[10])
                    ->setCellValue('L3', $titulosColumnas[11]);

//Se agregan los datos de los alumnos

            $i = 4; //Numero de fila donde se va a comenzar a rellenar
            while ($fila = $resultado->fetch_array()) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, utf8_encode($fila['codigo']))
                        ->setCellValue('B' . $i, utf8_encode($fila['coordinador']))
                        ->setCellValue('C' . $i, utf8_encode($fila['solicitud']))
                        ->setCellValue('D' . $i, utf8_encode($fila['seguimiento']))
                        ->setCellValue('E' . $i, utf8_encode($fila['servicio']))
                        ->setCellValue('F' . $i, utf8_encode($fila['empresa']))
                        ->setCellValue('G' . $i, utf8_encode($fila['estado']))
                        ->setCellValue('H' . $i, utf8_encode($fila['involucrado']))
                        ->setCellValue('I' . $i, utf8_encode($fila['telefono']))
                        ->setCellValue('J' . $i, utf8_encode($fila['simbolo']))
                        ->setCellValue('K' . $i, number_format(utf8_encode($fila['monto']), 2, ".", ","))
                        ->setCellValue('L' . $i, utf8_encode($fila['mensaje']));
                $i++;
            }

            $estiloTituloReporte = array(
                'font' => array(
                    'name' => 'Verdana',
                    'bold' => true,
                    'italic' => false,
                    'strike' => false,
                    'size' => 16,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation' => 0,
                    'wrap' => TRUE
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'name' => 'Arial',
                    'bold' => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            );

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(array(
                'font' => array(
                    'name' => 'Arial',
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => 'FFFFFF')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            ));

            $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:L" . ($i - 1));

            for ($i = 'A'; $i <= 'L'; $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(FALSE);
            }

// Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte Avance Cotizaciones');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReporteAvanceCotizaciones.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {
            print_r('No hay resultados para mostrar');
        }


        break;
    case 'clientes':
        $consulta = "SELECT  
      ju.ruc RUC
     , ju.nombre EMPRESA
     , pe.nombre TIPO
     , ac.nombre ACTIVIDAD
     , cl.nombre CLASIFICACION
     , ju.direccion DIRECCION
     , ju.telefono TELEFONO
     , ve.nombre VENDEDOR
     , coic.nombre CONTACTO
     , coic.cargo CARGO
     , coic.telefono CTELEFONO
     , coic.correo CORREO
     FROM co_involucrado_juridica ju
     LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
     LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
     LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
     LEFT JOIN co_vendedor ve ON ve.id=ju.vendedor_id
     LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
     left join co_involucrado_contacto coic on ju.id = coic.juridica_id
     ;";

        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            date_default_timezone_set('America/Lima');

            if (PHP_SAPI == 'cli')
                die('Este archivo solo se puede ver desde un navegador web');

            /** Se agrega la libreria PHPExcel */
            require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel.php';

// Se crea el objeto PHPExcel
            $objPHPExcel = new PHPExcel();
            // Se asignan las propiedades del libro
            $objPHPExcel->getProperties()->setCreator("Allemant") // Nombre del autor
                    ->setLastModifiedBy("Allemant") //Ultimo usuario que lo modificó
                    ->setTitle("Reporte Clientes") // Titulo
                    ->setSubject("Reporte Clientes") //Asunto
                    ->setDescription("Reporte Clientes") //Descripción
                    ->setKeywords("Reporte Clientes") //Etiquetas
                    ->setCategory("Reporte Clientes"); //Categorias

            $tituloReporte = "Reporte Clientes";
            $titulosColumnas = array('RUC', 'EMPRESA', 'TIPO CLIENTE',
                'ACTIVIDAD', 'CLASIFICACION', 'DIRECCION', 'TELEFONO', 'VENDEDOR',
                'CONTACTO', 'CARGO', 'CONTACTO TELEFONO', 'CORREO');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:L1');




// Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', $tituloReporte) // Titulo del reporte
                    ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
                    ->setCellValue('B3', $titulosColumnas[1])
                    ->setCellValue('C3', $titulosColumnas[2])
                    ->setCellValue('D3', $titulosColumnas[3])
                    ->setCellValue('E3', $titulosColumnas[4])
                    ->setCellValue('F3', $titulosColumnas[5])
                    ->setCellValue('G3', $titulosColumnas[6])
                    ->setCellValue('H3', $titulosColumnas[7])
                    ->setCellValue('I3', $titulosColumnas[8])
                    ->setCellValue('J3', $titulosColumnas[9])
                    ->setCellValue('K3', $titulosColumnas[10])
                    ->setCellValue('L3', $titulosColumnas[11]);

//Se agregan los datos de los alumnos

            $i = 4; //Numero de fila donde se va a comenzar a rellenar
            while ($fila = $resultado->fetch_array()) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, utf8_encode($fila['RUC']))
                        ->setCellValue('B' . $i, utf8_encode($fila['EMPRESA']))
                        ->setCellValue('C' . $i, utf8_encode($fila['TIPO']))
                        ->setCellValue('D' . $i, utf8_encode($fila['ACTIVIDAD']))
                        ->setCellValue('E' . $i, utf8_encode($fila['CLASIFICACION']))
                        ->setCellValue('F' . $i, utf8_encode($fila['DIRECCION']))
                        ->setCellValue('G' . $i, utf8_encode($fila['TELEFONO']))
                        ->setCellValue('H' . $i, utf8_encode($fila['VENDEDOR']))
                        ->setCellValue('I' . $i, utf8_encode($fila['CONTACTO']))
                        ->setCellValue('J' . $i, utf8_encode($fila['CARGO']))
                        ->setCellValue('K' . $i, utf8_encode($fila['CTELEFONO']))
                        ->setCellValue('L' . $i, utf8_encode($fila['CORREO']));
                $i++;
            }

            $estiloTituloReporte = array(
                'font' => array(
                    'name' => 'Verdana',
                    'bold' => true,
                    'italic' => false,
                    'strike' => false,
                    'size' => 16,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation' => 0,
                    'wrap' => TRUE
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'name' => 'Arial',
                    'bold' => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            );

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(array(
                'font' => array(
                    'name' => 'Arial',
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => 'FFFFFF')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            ));

            $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:L" . ($i - 1));

            for ($i = 'A'; $i <= 'L'; $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(FALSE);
            }

// Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte Clientes');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReporteClientes.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {
            print_r('No hay resultados para mostrar');
        }


        break;
    case 'propuestas':
        $consulta = "SELECT pr.codigo as codigo,
cove.nombre as vendedor,
coij.nombre as empresa,
vees.nombre as estado,
vevi.fecha as fecha_visita,
coic.nombre as contacto,
coic.cargo as cargo,
vevi.observacion as observacion
FROM ve_propuesta pr
left JOIN co_vendedor as cove ON cove.id = pr.vendedor_id
left join co_involucrado_juridica as coij on coij.id= pr.persona_id
left join ve_visita as vevi on vevi.propuesta_id = pr.id
left join co_involucrado_contacto as coic on  coic.id = vevi.contacto_id
left join ve_estado as vees on  vees.id = pr.estado_id
order by codigo desc,fecha_visita desc ;";

        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            date_default_timezone_set('America/Lima');

            if (PHP_SAPI == 'cli')
                die('Este archivo solo se puede ver desde un navegador web');

            /** Se agrega la libreria PHPExcel */
            require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel.php';

// Se crea el objeto PHPExcel
            $objPHPExcel = new PHPExcel();
            // Se asignan las propiedades del libro
            $objPHPExcel->getProperties()->setCreator("Allemant") // Nombre del autor
                    ->setLastModifiedBy("Allemant") //Ultimo usuario que lo modificó
                    ->setTitle("Reporte Propuestas") // Titulo
                    ->setSubject("Reporte Propuestas") //Asunto
                    ->setDescription("Reporte Propuestas") //Descripción
                    ->setKeywords("Reporte Propuestas") //Etiquetas
                    ->setCategory("Reporte Propuestas"); //Categorias

            $tituloReporte = "Reporte Propuestas";
            $titulosColumnas = array('CODIGO', 'VENDEDOR', 'EMPRESA',
                'ESTADO', 'FECHA VISITA', 'CONTACTO', 'CARGO', 'OSERVACION');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:H1');

// Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', $tituloReporte) // Titulo del reporte
                    ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
                    ->setCellValue('B3', $titulosColumnas[1])
                    ->setCellValue('C3', $titulosColumnas[2])
                    ->setCellValue('D3', $titulosColumnas[3])
                    ->setCellValue('E3', $titulosColumnas[4])
                    ->setCellValue('F3', $titulosColumnas[5])
                    ->setCellValue('G3', $titulosColumnas[6])
                    ->setCellValue('H3', $titulosColumnas[7]);

//Agregando los Datos
            $i = 4; //Numero de fila donde se va a comenzar a rellenar
            while ($fila = $resultado->fetch_array()) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, utf8_encode($fila['codigo']))
                        ->setCellValue('B' . $i, utf8_encode($fila['vendedor']))
                        ->setCellValue('C' . $i, utf8_encode($fila['empresa']))
                        ->setCellValue('D' . $i, utf8_encode($fila['estado']))
                        ->setCellValue('E' . $i, utf8_encode($fila['fecha_visita']))
                        ->setCellValue('F' . $i, utf8_encode($fila['contacto']))
                        ->setCellValue('G' . $i, utf8_encode($fila['cargo']))
                        ->setCellValue('H' . $i, utf8_encode($fila['observacion']));
                $i++;
            }

            $estiloTituloReporte = array(
                'font' => array(
                    'name' => 'Verdana',
                    'bold' => true,
                    'italic' => false,
                    'strike' => false,
                    'size' => 16,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation' => 0,
                    'wrap' => TRUE
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'name' => 'Arial',
                    'bold' => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            );

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(array(
                'font' => array(
                    'name' => 'Arial',
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => 'FFFFFF')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            ));

            $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:H" . ($i - 1));

            for ($i = 'A'; $i <= 'H'; $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(FALSE);
            }

// Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte Propuestas');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReportePropuestas.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {
            print_r('No hay resultados para mostrar');
        }

        break;
    case 'gerencia':
        $consulta = "select * from (select DISTINCT
coco.codigo as codigo, 
DATE_FORMAT(coco.fecha_solicitud,'%d-%m-%Y') as solicitud,
DATE_FORMAT(come.info_create,'%d-%m-%Y') as seguimiento,
lous.full_name as coordinador,
coes.nombre as estado,
cose.nombre as servicio,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
coinco.telefono as telefono,
copa.total_monto as monto,
como.simbolo as simbolo,
come.mensaje as mensaje
from co_cotizacion as coco
left join co_mensaje as come on come.cotizacion_id = coco.id
left join login_user as lous on lous.id = coco.info_create_user
left join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_juridica as coinju on coin.persona_id = coinju.id
left join co_involucrado_natural as coinna on  coin.persona_id = coinna.id
left join co_involucrado_contacto as coinco on coin.contacto_id = coinco.id
left join co_servicio_tipo as cose on coco.servicio_tipo_id = cose.id
left join co_pago as copa on coco.id = copa.cotizacion_id
left join co_cotizacion_tipo as cocoti on cocoti.id = coco.tipo_cotizacion_id
left join co_moneda as como on como.id = copa.total_moneda_id
left join co_desglose as codes on codes.id = coco.desglose_id
left join co_estado as coes on coes.id = coco.estado_id
where codigo != 0 and ( coco.estado_id = 1 ) 
ORDER BY come.info_create desc
)sub GROUP BY codigo order by codigo desc;";

        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            date_default_timezone_set('America/Lima');

            if (PHP_SAPI == 'cli')
                die('Este archivo solo se puede ver desde un navegador web');

            /** Se agrega la libreria PHPExcel */
            require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel.php';

// Se crea el objeto PHPExcel
            $objPHPExcel = new PHPExcel();
            // Se asignan las propiedades del libro
            $objPHPExcel->getProperties()->setCreator("Allemant") // Nombre del autor
                    ->setLastModifiedBy("Allemant") //Ultimo usuario que lo modificó
                    ->setTitle("Reporte Gerencia Coticaciones") // Titulo
                    ->setSubject("Reporte Gerencia Coticaciones") //Asunto
                    ->setDescription("Reporte Gerencia Coticaciones") //Descripción
                    ->setKeywords("Reporte Gerencia Coticaciones") //Etiquetas
                    ->setCategory("Reporte Gerencia Coticaciones"); //Categorias

            $tituloReporte = "Reporte Gerencia Cotizaciones";
            $titulosColumnas = array('CODIGO',
                'USUARIO', 'SOLICITUD', 'SEGUIMIENTO','SERVICIO', 'EMPRESA', 'ESTADO',  'CONTACTO',
                'TELEFONO', 'MONEDA', 'PRECIO SIN IGV', 'MENSAJE');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:L1');
            
// Se agregan los titulos del reporte
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', $tituloReporte) // Titulo del reporte
                    ->setCellValue('A3', $titulosColumnas[0])  //Titulo de las columnas
                    ->setCellValue('B3', $titulosColumnas[1])
                    ->setCellValue('C3', $titulosColumnas[2])
                    ->setCellValue('D3', $titulosColumnas[3])
                    ->setCellValue('E3', $titulosColumnas[4])
                    ->setCellValue('F3', $titulosColumnas[5])
                    ->setCellValue('G3', $titulosColumnas[6])
                    ->setCellValue('H3', $titulosColumnas[7])
                    ->setCellValue('I3', $titulosColumnas[8])
                    ->setCellValue('J3', $titulosColumnas[9])
                    ->setCellValue('K3', $titulosColumnas[10])
                    ->setCellValue('L3', $titulosColumnas[11]);

//Se agregan los datos de los alumnos

            $i = 4; //Numero de fila donde se va a comenzar a rellenar
            while ($fila = $resultado->fetch_array()) {
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, utf8_encode($fila['codigo']))
                        ->setCellValue('B' . $i, utf8_encode($fila['coordinador']))
                        ->setCellValue('C' . $i, utf8_encode($fila['solicitud']))
                        ->setCellValue('D' . $i, utf8_encode($fila['seguimiento']))
                        ->setCellValue('E' . $i, utf8_encode($fila['servicio']))
                        ->setCellValue('F' . $i, utf8_encode($fila['empresa']))
                        ->setCellValue('G' . $i, utf8_encode($fila['estado']))
                        ->setCellValue('H' . $i, utf8_encode($fila['involucrado']))
                        ->setCellValue('I' . $i, utf8_encode($fila['telefono']))
                        ->setCellValue('J' . $i, utf8_encode($fila['simbolo']))
                        ->setCellValue('K' . $i, number_format(utf8_encode($fila['monto']), 2, ".", ","))
                        ->setCellValue('L' . $i, utf8_encode($fila['mensaje']));
                $i++;
            }

            $estiloTituloReporte = array(
                'font' => array(
                    'name' => 'Verdana',
                    'bold' => true,
                    'italic' => false,
                    'strike' => false,
                    'size' => 16,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation' => 0,
                    'wrap' => TRUE
                )
            );

            $estiloTituloColumnas = array(
                'font' => array(
                    'name' => 'Arial',
                    'bold' => true,
                    'color' => array(
                        'rgb' => 'FFFFFF'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => '1f497d')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
            );

            $estiloInformacion = new PHPExcel_Style();
            $estiloInformacion->applyFromArray(array(
                'font' => array(
                    'name' => 'Arial',
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array(
                        'argb' => 'FFFFFF')
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array(
                            'rgb' => '000000'
                        )
                    )
                )
            ));

            $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:L" . ($i - 1));

            for ($i = 'A'; $i <= 'L'; $i++) {
                $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(FALSE);
            }

// Se asigna el nombre a la hoja
            $objPHPExcel->getActiveSheet()->setTitle('Reporte Gerencia Cotizaciones');

// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
            $objPHPExcel->setActiveSheetIndex(0);

// Inmovilizar paneles
//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
            $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ReporteGerenciaCotizaciones.xlsx"');
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
            exit;
        } else {
            print_r('No hay resultados para mostrar');
        }
        break;
        default:
        break;
}


