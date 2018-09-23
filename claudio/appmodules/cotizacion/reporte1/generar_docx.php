<?php
require_once '../../../librerias.v2/vendor/phpword/PHPWord.php';
date_default_timezone_set("America/Lima");

require('model.php');

//VERIDIFCACION DE CODIGO
if (!isset($_GET['codigo'])) {
    header("error.php");
}
//Recepcion de Datos
$cotizacion = new Cotizacion();
$resultado = $cotizacion->mostrar_cotizacion($_GET['codigo']);


$id = $resultado[0]['id'];
$fecha = $resultado[0]['fecha'];
$codigo = $resultado[0]['codigo'];
$tipo = $resultado[0]['tipo'];
$empresa = $resultado[0]['empresa'];
$cargo = $resultado[0]['cargo'];
$involucrado = $resultado[0]['involucrado'];
$servicio = $resultado[0]['servicio'];
$servicio_id = $resultado[0]['servicio_id'];
$monto = number_format($resultado[0]['monto'], 2, ".", ",");
//$monto_igv = number_format($resultado[0]['monto_igv'], 2, ".", ",");
$moneda = $resultado[0]['moneda'];
$simbolo = $resultado[0]['simbolo'];
$correo = $resultado[0]['email'];
$desglose = $resultado[0]['desglose'];


//FORMATEO DE DATOS
$fecha_cotizacion = "Lima, " . date("d", strtotime($fecha)) . " de " . mes_a_texto($fecha) . " del " . date("Y", strtotime($fecha));
$senores = $empresa;
$correlativo = substr($codigo, 6, 4) . "-" . substr($codigo, 0, 4);
$anio = date("Y", strtotime($fecha));
$decimal = explode('.', $monto);
$precioletras = $simbolo . " " . $monto . " (" . strtolower(numtoletras($resultado[0]['monto'], $moneda)) . " " . $moneda . ")";
//echo $precioletras;
//die();
// New Word Document
$PHPWord = new PHPWord();

//Propuesta Tecnica o Simple
if ($tipo == 1) {

// Estilos y marca de Agua
    $PHPWord->setDefaultFontName('Calibri');
    $PHPWord->setDefaultFontSize(10);
    $ParagraphStyle = array('align' => 'left', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0);
    $ParagraphCellStyle = array('align' => 'center', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0);
//Estilo General
    $section = $PHPWord->createSection();
    $sectionStyle = $section->getSettings();
    $sectionStyle->setPortrait();
    $sectionStyle->setMarginLeft(1000);
    $sectionStyle->setMarginRight(1000);
    $sectionStyle->setMarginTop(300);
    $sectionStyle->setMarginBottom(0);
    $imageStyle = array('width' => 100, 'height' => 100, 'align' => 'left');
    $footerImageStyle = array('width' => 650, 'height' => 64);
//Estilo Especifico
    $boldStyle = array('bold' => true);
    $footerStyle = array('name' => 'Times New Roman', 'size' => 9);
    $footerParagraphStyle = array('align' => 'center', 'spaceBefore' => 0, 'spaceAfter' => 0, 'spacing' => 0);
//ESTILOS DE TABLA
// Define table style arrays
    $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
// Define cell style arrays
    $styleCell = array('valign' => 'center',
        'borderTopSize' => 1,
        'borderRightSize' => 1,
        'borderLeftSize' => 1,
        'borderBottomSize' => 1,
        'borderTopColor' => '000000',
        'borderLeftColor' => '000000',
        'borderRightColor' => '000000',
        'borderBottomColor' => '000000');
// Define font style for first row
    $fontStyle = array('bold' => true, 'align' => 'center');
// Add table style
    $PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleCell);

//    $header = $section->createHeader();
//    $header->addImage('logo.jpg', $imageStyle);
//    $styleWatermark = array('marginLeft' => 150, marginTop => 300,'width' => 400, 'height' => 400);
//    $header->addWatermark("marca_agua.jpg", $styleWatermark);
// Add text elements
    $section->addImage('logo.jpg', $imageStyle);
    $section->addText(utf8_decode("Cotización Nº $correlativo/AC-AAPV"));
//$section->addTextBreak(1);
    $section->addText(utf8_decode($fecha_cotizacion));
//$section->addTextBreak(1,null,'My $ParagraphStyle');
    $section->addText(utf8_decode('Señores:'), null, $ParagraphStyle);
    $section->addText($empresa, $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('Presente.-'), array('underline' => PHPWord_Style_Font::UNDERLINE_SINGLE), $ParagraphStyle);

    $table = $section->addTable();
    $table->addRow(100);
    $table->addCell(2000)->addText(utf8_decode(""));
    $table->addCell(2000)->addText(utf8_decode("Atención"));
    $table->addCell(6000)->addText(": " . $involucrado);
    $table->addRow(50);
    $table->addCell(2000)->addText(utf8_decode(""));
    $table->addCell(2000)->addText(utf8_decode(""));
    $table->addCell(6000)->addText("  " . $cargo);
    $table->addRow(100);
    $table->addCell(2000)->addText(utf8_decode(""));
    $table->addCell(2000)->addText(utf8_decode("Asunto"));
    $table->addCell(6000)->addText(": " . $servicio);

    $section->addText(utf8_decode('De nuestra consideración:'));
    $section->addText(utf8_decode('Por intermedio de la presente nos dirigimos a Usted, con la finalidad de hacer entrega de nuestra cotización, para el servicio solicitado vía email:'), null);
    $table = $section->addTable('myOwnTableStyle');
    $table->addRow(100);
    $table->addCell(4000, $styleCell)->addText(utf8_decode("DENOMINACION"), $fontStyle, $ParagraphCellStyle);
    $table->addCell(4000, $styleCell)->addText(utf8_decode("UBICACIÓN"), $fontStyle, $ParagraphCellStyle);
    $table->addCell(4000, $styleCell)->addText(utf8_decode("TOTAL EN US$ (NO INCLUYE IGV)"), $fontStyle, $ParagraphCellStyle);


    $items_cotizacion = $cotizacion->mostrar_items_cotizacion($id);
    foreach ($items_cotizacion as $arreglo) {
        
        $table->addRow(100);
        $table->addCell(4000, $styleCell)->addText(utf8_decode($arreglo['descripcion']), null, $ParagraphCellStyle);
        $table->addCell(4000, $styleCell)->addText($arreglo['direccion'], null, $ParagraphCellStyle);
        $table->addCell(4000, $styleCell)->addText("US$ " . $monto, null, $ParagraphCellStyle);
    }
    $section->addText(utf8_decode('La presente cotización tiene una vigencia de 15 días, contadas a partir de la fecha de emisión.'), $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('Plazo del servicio: 06 días hábiles, contados a partir del día siguiente de realizada la inspección y entregada la documentación completa.'), null, $ParagraphStyle);
    $section->addTextBreak(1);
    $tipo_tasacion = 10;
    $section->addText(utf8_decode('Asimismo, para la valorización se necesitará lo siguiente:'), $boldStyle, $ParagraphStyle);

    $requisitos_cotizacion = $cotizacion->mostrar_requisitos_cotizacion($servicio_id);
    foreach ($requisitos_cotizacion as $arreglo) {
        $section->addText('- ' . $arreglo['nombre'], null, $ParagraphStyle);
    }

    $section->addTextBreak(1);
    $section->addText(utf8_decode('Forma de pago: ') . $desglose, $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('- Adelanto del 50% a la aprobación de la cotizacion.'), null, $ParagraphStyle);
    $section->addText(utf8_decode('- Cancelación del 50% a la entrega del informe virtual.'), null, $ParagraphStyle);
    $section->addText(utf8_decode('Vía transferencia a nuestras cuentas siguientes:'), $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('- Cuenta Corriente Dólares del BCP Nº 194-1900582-1-07'), null, $ParagraphStyle);
    $section->addText(utf8_decode('- Cuenta Interbancaria Dólares del BCP Nº 002-194-001900582107-99'), null, $ParagraphStyle);
    $section->addTextBreak(1);
    $section->addText(utf8_decode('El informe final será entregado en Original (01), incluye la presentación del álbum fotográfico.'), null, $ParagraphStyle);
    $section->addText(utf8_decode("Agradeceremos remitir la conformidad a la presente, al correo electrónico $correo e indicar el Nº de RUC para tenerlo presente al facturar el servicio."), null, $ParagraphStyle);
    $section->addTextBreak(1);
    $section->addText(utf8_decode("Sin otro particular, quedo de Usted."), null, $ParagraphStyle);
    $section->addText(utf8_decode('Atentamente,'), null, $ParagraphStyle);
    $section->addTextBreak(1);
    $section->addText(utf8_decode('Pedro Carreño Bardales'), $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('Gerente Operaciones'), $boldStyle, $ParagraphStyle);
    $section->addText(utf8_decode('Allemant Asociados Peritos Valuadores S.A.C.'), $boldStyle, $ParagraphStyle);

//PIE DE PAGINA
    $footer = $section->createFooter();
//$footer->addImage('footer.jpg',$footerImageStyle);
    $footer->addText(utf8_decode('Av. Manuel Olguín N° 373 Piso 5, Oficina 503 - Santiago de Surco'), $footerStyle, $footerParagraphStyle);
    $footer->addText(utf8_decode('Teléfono: 436 1420 - 436 1303, Email: peritos@allemantperitos.com'), $footerStyle, $footerParagraphStyle);

//BORRANDO LOS ARCHIVOS WORD
    foreach (glob("*.docx") as $filename) {
        if ($filename != "Template.docx") {
            unlink($filename);
        }
    }

//GRABANDO 
    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $nombre_archivo = substr($codigo, 5, 5) . " PROPUESTA ALLEMANT - " . $empresa . ".docx";
    $objWriter->save($nombre_archivo);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $nombre_archivo);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($nombre_archivo));
    flush();
    readfile($nombre_archivo);
    unlink($nombre_archivo); // deletes the temporary file
    exit;

    //echo '<a href="' . $nombre_archivo . '">DESCARGAR COTIZACION</a>';
} else if ($tipo == 2) {
    //BORRANDO LOS ARCHIVOS WORD
    foreach (glob("*.docx") as $filename) {
        if ($filename != "Template.docx") {
            unlink($filename);
        }
    }

//CARGANDO 
    $template = $PHPWord->loadTemplate('Template.docx');

//    var_dump( $correlativo );
//    var_dump( $fecha_cotizacion);
//    var_dump( $senores);
//    var_dump( $involucrado);
//    var_dump( $cargo);
//    var_dump( $servicio);
//    var_dump( $anio);
//    var_dump( $monto);
//    var_dump( $precioletras);    
//    die();

    $template->setValue('CODIGO', $correlativo);
    $template->setValue('FECHA', $fecha_cotizacion);
    $template->setValue('CLIENTE', $senores);
    $template->setValue('CONTACTO', $involucrado);
    $template->setValue('CARGO', $cargo);
    $template->setValue('SERVICIO', strtoupper($servicio));
    $template->setValue('ANIO', $anio);
    $template->setValue('LETRAS', $precioletras);
    $template->setValue('DESGLOSE', $desglose);

//GRABANDO 
    $nombre_archivo = substr($codigo, 5, 5) . " PROPUESTA ALLEMANT - " . $empresa . ".docx";
    $template->save($nombre_archivo);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $nombre_archivo);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($nombre_archivo));
    flush();
    readfile($nombre_archivo);
    unlink($nombre_archivo); // deletes the temporary file
    exit;
    //echo '<a class="button" href="' . $nombre_archivo . '">DESCARGAR COTIZACION</a>';
}

//FUNCIONES
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

function numtoletras($xcifra, $moneda) {
    $xarray = array(0 => "Cero",
        1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
        "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
        "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
        100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, ".");
    $xaux_int = $xcifra;
    $xdecimales = "00";
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = "0" . $xcifra;
            $xpos_punto = strpos($xcifra, ".");
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                    $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                            
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (TRUE === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20)
                                    $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3;
                            }
                            else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10)
                                    $xcadena = " " . $xcadena . " " . $xseek;
                                else
                                    $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN BILLON ";
                    else
                        $xcadena.= " BILLONES ";
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                        $xcadena.= "UN MILLON ";
                    else
                        $xcadena.= " MILLONES ";
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO CON $xdecimales/100 $moneda";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 $moneda ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena.= " CON $xdecimales/100 $moneda "; //
                        // $xcadena.= " CON $xdecimales/100  "; //
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
}

function subfijo($xx) {
    // esta función regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
}

?>
<!--
<style type="text/css">
    a {
        background-color: #008cba; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
    }
</style>
-->