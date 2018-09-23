-- fecha
-- EMPRESA
-- CONTACTO
-- SERVICIO
-- DENOMINACION
-- TOTAL EN US$ SIN igV
-- REQUISITOS
-- FORMA DE PAGO
-- Correo Cordinadora
select * from login_user;
select * from co_cotizacion where codigo = 2015000457;

-- CONSULTA COTIZACION
select coco.fecha_envio_cliente as fecha,
coco.id as id,
coco.codigo as codigo,
cocoti.id as tipo,

coinco.nombre as involucrado,
coinco.cargo as cargo,
cose.nombre as servicio,
cose.id as servicio_id,
copa.total_monto as monto,
copa.total_monto_igv as monto_igv,
como.nombre as moneda,
como.simbolo as simbolo,
codes.nombre as desglose,
lous.email as email
from co_cotizacion as coco
inner join login_user as lous on lous.id = coco.info_create_user
inner join co_involucrado as coin on coco.id = coin.cotizacion_id
inner join co_involucrado_juridica as coinju on coinju.id = coin.persona_id
inner join co_involucrado_natural as coinna on coinna.id = coin.persona_id
inner join co_involucrado_contacto as coinco on coinco.id = coin.contacto_id
inner join co_servicio_tipo as cose on coco.servicio_tipo_id = cose.id
inner join co_pago as copa on coco.id = copa.cotizacion_id
inner join co_cotizacion_tipo as cocoti on cocoti.id = coco.tipo_cotizacion_id
inner join co_moneda as como on como.id = copa.total_moneda_id
inner join co_desglose as codes on codes.id = coco.desglose_id
where coco.codigo = 2016000182 and coin.rol_id=1;





-- CONSULTA INVOLUCRADOS
select * from co_involucrado coin
inner join co_cotizacion coco on coin.cotizacion_id = coco.id
inner join co_involucrado_contacto coinco on coinco.id = coin.contacto_id
where  coco.codigo = 2015000507 and coin.rol_id=1;

-- CONSULTA ITEMS COORDINACION
SELECT descripcion,direccion FROM co_bien_inmueble
where cotizacion_id = 4
union select descripcion,'' from co_bien_mueble
where cotizacion_id=4;

-- CONSULTA REQUISITOS COORDINACION
select id,nombre from co_requisito where servicio_tipo_id = 1;


coinju.nombre as juridico,

select coco.fecha_envio_cliente as fecha,
coco.id as id,
coco.codigo as codigo,
cocoti.id as tipo,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
if(coin.contacto_id=0,'PERSONA NATURAL',coinco.cargo) as cargo,
cose.nombre as servicio,
cose.id as servicio_id,
copa.total_monto as monto,
copa.total_monto_igv as monto_igv,
como.nombre as moneda,
como.simbolo as simbolo,
codes.nombre as desglose,
lous.email as email
from co_cotizacion as coco
inner join login_user as lous on lous.id = coco.info_create_user
inner join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_juridica as coinju on coinju.id = coin.persona_id
left join co_involucrado_natural as coinna on coinna.id=coin.persona_id
left join co_involucrado_contacto as coinco on coinco.id=coin.contacto_id
inner join co_servicio_tipo as cose on coco.servicio_tipo_id = cose.id
inner join co_pago as copa on coco.id = copa.cotizacion_id
inner join co_cotizacion_tipo as cocoti on cocoti.id = coco.tipo_cotizacion_id
inner join co_moneda as como on como.id = copa.total_moneda_id
inner join co_desglose as codes on codes.id = coco.desglose_id
where coco.codigo = 2016000183 and coin.rol_id=1;



select coco.codigo,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as nombre,
coinco.nombre ,
coco.fecha_envio_cliente as fecha,
coco.id as id
from co_cotizacion as coco
inner join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_contacto as coinco on coinco.id=coin.contacto_id
left join co_involucrado_natural as coinna on coinna.id=coin.persona_id
where coco.codigo = 2016000182 and coin.rol_id=1;



select id from co_cotizacion where co_cotizacion.codigo = 2016000182 

-- MENSAJES
SELECT
  co_mensaje3.codigo
, DATE_FORMAT(co_mensaje3.fecha_proxima,"%d-%m-%Y") fecha
, co_mensaje3.mensaje
, co_mensaje3.estado
FROM ( 
       SELECT
       co_cotizacion.codigo
       , co_mensaje2.id
       , co_mensaje2.fecha_proxima
       , co_mensaje2.mensaje
       , co_estado.nombre estado
       FROM(
              SELECT
       	      co_mensaje.cotizacion_id
	    , co_mensaje.id
       	    , co_mensaje.mensaje
       	    , co_mensaje.fecha_proxima
       	    , co_mensaje.estado_id
       	    FROM co_mensaje
       	    WHERE co_mensaje.estado_id=1 AND co_mensaje.info_create_user = 2
       	    ORDER BY co_mensaje.id DESC
       ) AS co_mensaje2
       JOIN co_cotizacion ON co_cotizacion.id=co_mensaje2.cotizacion_id AND co_cotizacion.estado_id=1
       JOIN co_estado ON co_estado.id = co_mensaje2.estado_id
       WHERE 
       co_cotizacion.codigo != "0"
       GROUP BY co_mensaje2.cotizacion_id
       ORDER BY co_mensaje2.fecha_proxima DESC
) as co_mensaje3;




SELECT * FROM
(
SELECT 
co_involucrado.id
, co_involucrado.rol_id
, co_involucrado_rol.nombre rol_nombre
, co_involucrado.persona_tipo
, co_involucrado.persona_id
, co_involucrado.contacto_id
, co_involucrado_natural.nombre persona_nombre
, co_involucrado_natural.documento persona_documento
, co_involucrado_natural.telefono persona_telefono
, co_involucrado_natural.correo persona_correo
FROM co_involucrado
JOIN co_involucrado_rol ON co_involucrado_rol.id=co_involucrado.rol_id
JOIN co_involucrado_natural on co_involucrado_natural.id= co_involucrado.persona_id
WHERE
    co_involucrado.cotizacion_id = 638
AND co_involucrado.persona_tipo = "Natural"
AND co_involucrado.info_status = 1
UNION
SELECT 
co_involucrado.id
, co_involucrado.rol_id 
, co_involucrado_rol.nombre rol_nombre
, co_involucrado.persona_tipo
, co_involucrado.persona_id
, co_involucrado.contacto_id
, IF(co_involucrado.contacto_id=0
  , CONCAT( co_involucrado_juridica.nombre, "_--| _--| _--|")
  , CONCAT( co_involucrado_juridica.nombre, "_--|", co_involucrado_contacto.nombre, "_--|", co_involucrado_contacto.cargo, "_--|")
) persona_nombre
, co_involucrado_juridica.ruc persona_documento
, co_involucrado_contacto.telefono persona_documento
, co_involucrado_contacto.correo persona_documento
FROM co_involucrado
JOIN co_involucrado_rol ON co_involucrado_rol.id = co_involucrado.rol_id
JOIN co_involucrado_juridica ON co_involucrado_juridica.id = co_involucrado.persona_id
LEFT JOIN co_involucrado_contacto ON co_involucrado_contacto.id = co_involucrado.contacto_id
WHERE
    co_involucrado.cotizacion_id = 638
AND co_involucrado.persona_tipo = "Juridica"
AND co_involucrado.info_status = 1
) AS unica01
ORDER BY 1;

-- REPORTE COTIZACIONES
select * from (select DISTINCT 
coco.codigo as codigo,
lous.full_name as coordinador,
DATE_FORMAT(coco.fecha_solicitud,'%d-%m-%Y') as solicitud,
DATE_FORMAT(come.info_create,'%d-%m-%Y') as seguimiento,
cose.nombre as servicio,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
copa.total_monto_igv as monto_igv,
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
where codigo != 0 and (coco.estado_id = 1 or coco.estado_id = 2) ORDER BY coco.fecha_solicitud,come.info_create DESC
)sub GROUP BY codigo ;

-- REPORTE COTIZACION PEDRO
select * from (select DISTINCT
coco.codigo as codigo, 
DATE_FORMAT(coco.fecha_solicitud,'%d-%m-%Y') as solicitud,
DATE_FORMAT(come.info_create,'%d-%m-%Y') as seguimiento,
lous.full_name as coordinador,
coes.nombre as estado,
cose.nombre as servicio,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado,
copa.total_monto_igv as monto_igv,
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
where codigo != 0 and (DATEDIFF(now(),coco.fecha_solicitud)  <= 8 or coco.estado_id = 1 ) 
ORDER BY come.info_create desc
)sub GROUP BY codigo order by codigo desc;

-- 
-- VERIFICAR DOBLE USUARIO NATURAL
select 
coco.id as ID,
coco.codigo as CODIGO,
coin.id as INVOLUCRADO,
coin.contacto_id as CONTACTO,
coin.persona_id as PERSONA,
if(coin.contacto_id=0,'PERSONA NATURAL',coinju.nombre) as empresa,
if(coin.contacto_id=0,coinna.nombre,coinco.nombre) as involucrado
from co_cotizacion as coco
left join co_involucrado as coin on coco.id = coin.cotizacion_id
left join co_involucrado_juridica as coinju on coin.persona_id = coinju.id
left join co_involucrado_natural as coinna on  coin.persona_id = coinna.id
left join co_involucrado_contacto as coinco on coin.contacto_id = coinco.id
where coco.codigo = '2016000278';
