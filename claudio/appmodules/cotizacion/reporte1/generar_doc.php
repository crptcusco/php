<?php
header('Content-type: application/vnd.ms-word');
header("Content-Disposition: attachment; filename=archivo.doc");

date_default_timezone_set("America/Lima");
//Codigo General
require('model.php');

//Recepcion de Datos
if (!isset($_GET['codigo'])) {
    header("error.php");
}
//Recepcion de Datos
$cotizacion = new Cotizacion();
$resultado = $cotizacion->mostrar_cotizacion($_GET['codigo']);
$fecha = $resultado[0]['fecha'];
$codigo = $resultado[0]['codigo'];
$juridico = $resultado[0]['juridico'];
$cargo = $resultado[0]['cargo'];
$involucrado = $resultado[0]['involucrado'];
$servicio = $resultado[0]['servicio'];
$descripcion = $resultado[0]['descripcion'];
$monto = $resultado[0]['monto'];
$correo = $resultado[0]['correo'];

//Formateo de Partes Importantes
$fecha_cotizacion = "Lima, " . date("d", strtotime($fecha)) . " de " . mes_a_texto($fecha) . " del " . date("Y", strtotime($fecha));
$senores = $juridico;

echo "<html>";
echo "<head>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
?>
<style> 
    *{
        font-family: "calibri", Garamond, 'Comic Sans';
    }   
</style>
</head>
<body>
    <img src="logo.jpg" height="100" width="120"><br>
    Cotización Nº 0147-2016/AC-AAPV<br /><br />
    <?php
echo $fecha_cotizacion . "<br /><br />";
echo "Señores :" . "<br />";
echo $juridico . "<br />";
echo "<u>Presente.-</u><br />";
?>
<table border=0  cellpadding=0 cellspacing=10>
    <tr>
        <td></td>
        <td>Atención</td>
        <td>:</td>
        <td><strong><?= $involucrado ?></strong><br></td>
    </tr>
    <tr>
        <td></td>
        <td>Asunto</td>
        <td>:</td>
        <td><?= $descripcion ?></td>
    </tr>
</table>
<?php
echo "De nuestra consideración:<br /><br />
Por intermedio de la presente nos dirigimos a Usted, con la finalidad de hacer 
entrega de nuestra cotización, para el servicio solicitado vía email:
</p>";
?>
<table border=1 cellspacing=0 cellpadding=2>
    <thead>
        <tr>
            <td>DENOMINACIÓN</td>
            <td>UBICACIÓN</td>
            <td>TOTAL EN US$<br />
                (No Incluye IGV NI VIATICOS)</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $descripcion ?></td>
            <td> UBICACION</td>
            <td><?= $monto ?></td>
        </tr>
    </tbody>
</table>

<?php
echo "Plazo del servicio: 06 días hábiles, contados a partir del día siguiente "
 . "de realizada la inspección y entregada la documentación completa.<br /></br>";
echo "Asimismo, para la valorización se necesitará lo siguiente:<br />
- Copia de la Partida Registral actualizada.<br />
- Copia de HR y PU autovaluo municipal actualizado.<br />
- Certificado de Parámetros Urbanísticos o parámetros de uso y zonificación (si hubiera).<br />
- Recibo de luz o de agua (si hubiera).<br />
- Tasaciones anteriores (si hubiera).<br />
- Algún otro documento y/o información del inmueble que desee enviar.<br />
- Asimismo brindar las facilidades de acceso y permiso para las tomas fotográficas.<br /><br />
<strong>Forma de pago:</strong><br />
- Adelanto del 50% a la aprobación de la cotización.<br />
- Cancelación del 50% a la entrega del informe virtual.<br />
Vía transferencia a nuestras cuentas siguientes:<br />
- Cuenta Corriente Dólares del BCP Nº 194-1900582-1-07<br />
- Cuenta Interbancaria Dólares del BCP Nº 002-194-001900582107-99<br /><br />
El informe final será entregado en Original (01), incluye la presentación del álbum fotográfico.<br />
Agradeceremos remitir la conformidad a la presente, al correo electrónico $correo e 
indicar el Nº de RUC para tenerlo presente al facturar el servicio.<br /><br />
Sin otro particular, quedo de Usted.<br />
Atte.<br /><br />";
echo"<strong>
Pedro Carreño Bardales<br />
Gerente Operaciones<br />
Allemant Asociados Peritos Valuadores S.A.C.</strong><br />";

echo "<hr>Av. Manuel Olguín N° 373 Piso 5, Oficina 503 – Santiago de Surco<br />
Teléfono: 436 1340 - Fax: 436 1420, Email: peritos@allemantperitos.com";
echo "</body></html>";

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
