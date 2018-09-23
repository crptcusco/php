select cotizacion_correlativo COORDINACION,
DATE_FORMAT(coor_coordinacion.info_create, '%d/%m/%y')  FECHA, 
login1.full_name PERITO, 
login2.full_name CONTROL_CALIDAD, 
if(coor_coordinacion.solicitante_persona_tipo like 'Natural' ,coinna2.nombre,coinju2.nombre) as SOLICITANTE, 
if(coor_coordinacion.cliente_persona_tipo like 'Natural' ,coinna.nombre,coinju.nombre) as CLIENTE  
 from coor_coordinacion 
left join coor_inspeccion as coorin on 
coor_coordinacion.id = coorin.coordinacion_id 
left join login_user as login1 on  
login1.id =  coorin.perito_id 
left join login_user as login2 on  
login2.id =  coorin.inspector_id 
left join co_involucrado_juridica as coinju on 
coor_coordinacion.cliente_persona_id = coinju.id 
left join co_involucrado_natural as coinna on 
coor_coordinacion.cliente_persona_id = coinna.id 
left join co_involucrado_juridica as coinju2 on 
coor_coordinacion.solicitante_persona_id = coinju2.id 
left join co_involucrado_natural as coinna2 on 
coor_coordinacion.solicitante_persona_id = coinna2.id 
where not exists (select 1 from t_terreno  
where t_terreno.informe_id = coor_coordinacion.cotizacion_correlativo) 
order by PERITO DESC ;


-- PARA CAMBIAR LA RUTA DE LOS INFORMES
select id ,proyecto_id, ruta_informe 
from t_vehiculo where id = 155;
-- Z:\Tasaciones\Bco. Continental\2009\SETIEMBRE\TasBCont3377-2009-2136 AQUINO ISIQUE
select id  
from t_casa where ruta_informe like '%Z\:\\\\Tasaciones%'; 
-- 418
select id ,proyecto_id, ruta_informe 
from t_cao where ruta_informe like '%Z\:\\\\Operaciones\\\\Tasaciones%';
select ruta_informe from t_casa;
select ruta_informe from t_vehiculo where ruta_informe like '%Z\:\\\\Tasaciones%';
update t_terreno set ruta_informe = 
replace(ruta_informe, 'Z\:\\Tasaciones', 'Z\:\\OPERACIONES\\Tasaciones')
where id IN (  SELECT cid FROM (
select id as cid from t_terreno where ruta_informe like '%Z\:\\\\Tasaciones%' )
AS c);
