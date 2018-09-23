<?php

require_once('../../librerias.v2/vendor/tcpdf/examples/tcpdf_include.php');
require_once('../../librerias.v2/utilidades.php');

// ---------------------------------------------- ini-libs
include "../../librerias.v2/mysql/dbconnector.php";
include "../../librerias.v2/mysql/reutilizabes_cotizacion.php";

include "./modelo/pdf.php";
include "./modelo/selects.php";
include "./modelo/tables.php";

// -------------------------------------------------------- INPUT
$in['coordinacion_id'] = Utilidades::clear_input_id( $_GET['coordinacion_id']);

// -------------------------------------------------------- 
$modelo_pdf = new Coordinacion_Modelo_Eventos_PDF();
$select = new Coordinacion_Modelo_Eventos_Selects();
$table = new Coordinacion_Modelo_Eventos_Tables();

$data1= $modelo_pdf->setData1($in);


$solicitante = utf8_encode($modelo_pdf->setPersona( array('tipo'=>$data1['solicitante_persona_tipo'], 'id'=>$data1['solicitante_persona_id']) ));
$solicitante.= ' <span style="color:red"> / </span>';
$solicitante.= utf8_encode($modelo_pdf->setContacto($data1['solicitante_contacto_id']));
$solicitante.= ' <span style="color:red"> / </span>';
$solicitante.= utf8_encode($data1['sucursal']);

$cliente = utf8_encode($modelo_pdf->setPersona( array('tipo'=>$data1['cliente_persona_tipo'], 'id'=>$data1['cliente_persona_id']) ));

$ubigeo = $modelo_pdf->setUbigeo($data1);

$hora = $modelo_pdf->setHora($data1);

$data1['modo']='text';
$ou = $table->bienListaCoordinacion($data1);
$bienes = '';
if (is_array($ou))
    foreach ($ou as $row) {
        $row['descripcion'] = Utilidades::sanear_complete_string( utf8_decode($row['descripcion']) );
        $bienes.= $row['descripcion'] . "<hr>";
    }



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Allemant');
$pdf->SetTitle('Hoja de Coordinacion');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage('L', 'A4');

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$html = '
    <table cellpadding="2" cellspacing="0"  border="1">
      <colgroup span="32"></colgroup>
      <tbody>
        <tr>
	  <td colspan="15" valign="middle" align="center">Allemant Asociados Peritos Valuadores SAC</td>
	  <td colspan="6"  valign="middle" bgcolor="#DDDDDD" align="right">Codigo de coordinacion</td>
	  <td colspan="11"  valign="middle" align="left">[[CODIGO-COORDINACION]]</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Coordinador</td>
	  <td colspan="11" valign="middle" align="left">[[COORDINADOR]]</td>
	  <td colspan="6"  valign="middle" bgcolor="#DDDDDD" align="right">F. Solicitud</td>
	  <td colspan="11"  valign="middle" align="left">[[SOLICITUD-FECHA]]</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Formato</td>
	  <td colspan="11" valign="middle" align="left">[[FORMATO]]</td>
	  <td colspan="6"  valign="middle" bgcolor="#DDDDDD" align="right">F. Entrega al Cliente</td>
	  <td colspan="11" valign="middle" align="left">[[ENTREGA-FECHA]]</td>
        </tr>
        <tr>
	  <td colspan="32" valign="middle" bgcolor="#bbbbbb" align="center">Solicitud de Tasación</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right" rowspan="4">Solicitante <br> Funcionario <br> Sucursal</td>
	  <td colspan="11" valign="middle" align="left" rowspan="4">[[SOLICITANTE-FUNCIONARIO-SUCURSAL]]</td>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right" rowspan="1">Tipo de Servicio</td>
	  <td colspan="13" valign="middle" align="left" rowspan="1">[[SERVICIO-TIPO]]</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Inspección</td>
	  <td colspan="13" valign="middle" align="left">[[INSPECCION]]</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Tipo de Cambio</td>
	  <td colspan="13" valign="middle" align="left">[[TIPO-DE-CAMBIO]]</td>
        </tr>
        <tr>
	  <td colspan="17"  valign="middle" align="center"><br></td>
        </tr>

        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right" rowspan="4">Cliente</td>
	  <td colspan="11" valign="middle" align="left" rowspan="4">[[CLIENTE]]</td>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Perito</td>
	  <td colspan="13" valign="middle" align="left" >[[PERITO]]</td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right">Control de Calidad</td>
	  <td colspan="13" valign="middle" align="left">[[CONTROL-CALIDAD]]</td>
        </tr>
        <tr>
	  <td colspan="17" valign="middle" align="center"><br></td>
        </tr>
        <tr>
	  <td colspan="17" valign="middle" align="center"><br></td>
        </tr>
        <tr>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right" rowspan="3">Ubicacion</td>
	  <td colspan="11" valign="middle" align="left" rowspan="3">[[UBICACION]]</td>
	  <td colspan="4"  valign="middle" bgcolor="#DDDDDD" align="right" rowspan="1">Contactos</td>
	  <td colspan="13" valign="middle" align="left" rowspan="1">[[CONTACTOS]]</td>
        </tr>
        <tr>
	  <td colspan="4" valign="middle" bgcolor="#DDDDDD" align="right" rowspan="2">Inspeccion Ocular</td>
	  <td colspan="7" valign="middle" bgcolor="#DDDDDD" align="center">Fecha</td>
	  <td colspan="6" valign="middle" bgcolor="#DDDDDD" align="center">Hora</td>
        </tr>
        <tr>
	  <td colspan="7" valign="middle" align="center">[[INSPECCION-FECHA]]</td>
	  <td colspan="6" valign="middle" align="center">[[INSPECCION-HORA]]</td>
        </tr>
        <tr>
	  <td colspan="15"  valign="middle" bgcolor="#DDDDDD" align="center">Servicios</td>
	  <td colspan="17" valign="middle" bgcolor="#DDDDDD" align="center">Observación</td>
        </tr>
        <tr>
	  <td height="320" colspan="15" valign="middle" align="left">[[BIENES]]</td>
	  <td colspan="17" valign="middle" align="left"><pre>[[OBSERVACION]]</pre></td>
        </tr>
      </tbody>
    </table>
';
// Set some content to print

// custom
$order   = array("\r\n", "\n", "\r");
$replace = "<br>";
$data1['observacion'] = str_replace($order, $replace, $data1['observacion']);

// var
$ou['coordinacion_id'] = $data1['coordinacion_codigo'];
$ou['coordinador_nombre'] = utf8_encode($data1['coordinador_nombre']);
$ou['solicitud_fecha'] =  substr($data1['solicitante_fecha'], 0, 10);
$ou['formato_nombre'] = utf8_encode($data1['formato_nombre']);
$ou['entrega_fecha'] = $data1['entrega_al_cliente_fecha'];
$ou['solicitante_datos'] = $solicitante;
$ou['servicio_tipo_nombre'] = utf8_encode($data1['servicio_nombre']);
$ou['inspeccion_tipo'] = utf8_encode($data1['inspeccion_tipo_nombre']);
$ou['tipo_cambio'] = utf8_encode($data1['tipo_cambio_nombre']);
$ou['cliente_nombre'] = $cliente;
$ou['perito_nombre'] = utf8_encode($data1['perito_nombre']);

$ou['control_nombre'] = utf8_encode($data1['control_nombre']);
$ou['inspeccion_ubicacion'] = $ubigeo;
$ou['inspeccion_contactos'] = utf8_encode($data1['inspeccion_contactos']);
$ou['inspeccion_fechas'] = utf8_encode($data1['inspeccion_fecha']);
$ou['inspeccion_hora'] = $hora;
$ou['bienes'] = $bienes;
$ou['observacion'] = utf8_encode($data1['observacion']);


$html = str_replace('[[CODIGO-COORDINACION]]', $ou['coordinacion_id'], $html);
$html = str_replace('[[COORDINADOR]]', $ou['coordinador_nombre'], $html);
$html = str_replace('[[SOLICITUD-FECHA]]', $ou['solicitud_fecha'], $html);
$html = str_replace('[[FORMATO]]', $ou['formato_nombre'], $html);
$html = str_replace('[[ENTREGA-FECHA]]', $ou['entrega_fecha'], $html);
$html = str_replace('[[SOLICITANTE-FUNCIONARIO-SUCURSAL]]', $ou['solicitante_datos'], $html);
$html = str_replace('[[SERVICIO-TIPO]]', $ou['servicio_tipo_nombre'], $html);
$html = str_replace('[[INSPECCION]]', $ou['inspeccion_tipo'], $html);
$html = str_replace('[[TIPO-DE-CAMBIO]]', $ou['tipo_cambio'], $html);
$html = str_replace('[[CLIENTE]]', $ou['cliente_nombre'], $html);
$html = str_replace('[[PERITO]]', $ou['perito_nombre'], $html);
$html = str_replace('[[CONTROL-CALIDAD]]', $ou['control_nombre'], $html);
$html = str_replace('[[UBICACION]]', $ou['inspeccion_ubicacion'], $html);
$html = str_replace('[[CONTACTOS]]', $ou['inspeccion_contactos'], $html);
$html = str_replace('[[INSPECCION-FECHA]]', $ou['inspeccion_fechas'], $html);
$html = str_replace('[[INSPECCION-HORA]]', $ou['inspeccion_hora'], $html);
$html = str_replace('[[BIENES]]', $ou['bienes'], $html);
$html = str_replace('[[OBSERVACION]]', $ou['observacion'], $html);

$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTML($html, true, false, false, false, '');

/* $pdf->writeHTML($html, true, 0, true, true); */
/* $pdf->lastPage(); */
// $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('hoja de coordinacion ' . $data1['coordinacion_codigo'] . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
