<html class="no-js" lang="es" >
    <head>
        <meta charset="utf-8">
        <!-- If you delete this meta tag World War Z will become a reality -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Estudio Externo</title>
        <link rel="stylesheet" href="../../librerias.v2/vendor/foundation6/css/foundation.css" />
        <script src="../../librerias.v2/vendor/jquery.js"></script>
        <script src="estudio_externo.js"></script>
    </head>
    <body>
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
                    ?>
                    <div class="row">
                        <div class="large-10 large-offset-1 columns">
                            <h1>Reporte Avance Cotizaciones
                                <a href="./reporte.php?opcion=cotizaciones" class="button success " style="margin:0" target="propuesta_item">GENERAR EXCEL</a>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-10 large-offset-1 columns">
                            <table class="stack">
                                <thead>
                                    <tr>
                                        
                                        <th>USUARIO</th>
                                        <th>SOLICITUD</th>
                                        <th>ULTIMA ACCION</th>
                                        <th>SERVICIO</th>
                                        <th>EMPRESA</th>                                        
                                        <th>ESTADO</th>
                                        <th>CONTACTO</th>
                                        <th>TELEFONO</th>
                                        <th>PRECIO MAS IGV</th>
                                        <th>MENSAJE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($fila = $resultado->fetch_array()) { ?>
                                        <tr>
<!--                                            <td><?= utf8_encode($fila['codigo']) ?></td>-->
                                            <td><?= utf8_encode($fila['coordinador']) ?></td>
                                            <td><?= utf8_encode($fila['solicitud']) ?></td>
                                            <td><?= utf8_encode($fila['seguimiento']) ?></td>
                                            <td><?= utf8_encode($fila['servicio']) ?></td>
                                            <td><?= utf8_encode($fila['empresa']) ?></td>
                                            <td><?= utf8_encode($fila['estado']) ?></td>
                                            <td><?= utf8_encode($fila['involucrado']) ?></td>
                                            <td><?= utf8_encode($fila['telefono']) ?></td>
                                            <td><?= utf8_encode($fila['simbolo']) ?> <?= number_format(utf8_encode($fila['monto']), 2, ".", ","); ?></td>
                                            <td><?= utf8_encode($fila['mensaje']) ?></td>
                                        </tr>    
                                    <?php }
                                    ?>
                                <tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<p>No hay resultados que mostrar</p>';
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
                    ?>
                    <div class="row">
                        <div class="large-10 large-offset-1 columns">
                            <h1>Reporte Cotizaciones Gerencia
                                <a href="./reporte.php?opcion=gerencia" class="button success " style="margin:0" target="propuesta_item">GENERAR EXCEL</a>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-10 large-offset-1 columns">
                            <table class="stack">
                                <thead>
                                    <tr>
                                        
                                        <th>USUARIO</th>
                                        <th>SOLICITUD</th>
                                        <th>ULTIMA ACCION</th>
                                        <th>SERVICIO</th>
                                        <th>EMPRESA</th>                                        
                                        <th>ESTADO</th>
                                        <th>CONTACTO</th>
                                        <th>TELEFONO</th>
                                        <th>PRECIO SIN IGV</th>
                                        <th>MENSAJE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($fila = $resultado->fetch_array()) { ?>
                                        <tr>
<!--                                            <td><?= utf8_encode($fila['codigo']) ?></td>-->
                                            <td><?= utf8_encode($fila['coordinador']) ?></td>
                                            <td><?= utf8_encode($fila['solicitud']) ?></td>
                                            <td><?= utf8_encode($fila['seguimiento']) ?></td>
                                            <td><?= utf8_encode($fila['servicio']) ?></td>
                                            <td><?= utf8_encode($fila['empresa']) ?></td>
                                            <td><?= utf8_encode($fila['estado']) ?></td>
                                            <td><?= utf8_encode($fila['involucrado']) ?></td>
                                            <td><?= utf8_encode($fila['telefono']) ?></td>
                                            <td><?= utf8_encode($fila['simbolo']) ?> <?= number_format(utf8_encode($fila['monto']), 2, ".", ","); ?></td>
                                            <td><?= utf8_encode($fila['mensaje']) ?></td>
                                        </tr>    
                                    <?php }
                                    ?>
                                <tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                } else {
                    echo '<p>No hay resultados que mostrar</p>';
                }
                break;
            default:
                break;
        }
        ?>       
    </div>
</body>
</html>

