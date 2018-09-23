-- Seleccionar Propuestas y Visitas
SELECT pr.codigo as codigo,
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
order by codigo desc,fecha_visita desc ;


select coic.nombre CONTACTO,
coic.cargo CARGO,
coic.telefono TELEFONO,
coic.correo CORREO,
coij.nombre EMPRESA,
coij.ruc RUC,
coij.direccion DIRECCION,
coij.telefono TELEFONO
from co_involucrado_contacto as coic
inner join co_involucrado_juridica as coij on coic.juridica_id= coij.id;


select Distinct coco.id,
coij.ruc,
coij.nombre,
coic.correo,
coij.direccion,
cove.nombre,
vepe.nombre,
coic.nombre,
coic.cargo,
coic.telefono
from co_cotizacion as coco
inner join co_involucrado as coin on coin.cotizacion_id = coco.id
inner join co_involucrado_juridica as coij on coij.id = coin.persona_id
inner join co_involucrado_contacto as coic on coij.id = coic.juridica_id
inner join co_vendedor as cove on cove.id = coij.vendedor_id
inner join ve_persona_estado as vepe on coin.rol_id = vepe.id;
select * from co_involucrado;

select * from co_involucrado_juridica;
select * from co_involucrado_contacto;
select * from co_vendedor;
select * from ve_estado;

select * from co_involucrado_juridica as coij
left join co_vendedor as cove on cove.id = coij.vendedor_id
left join co_involucrado_contacto as coic on coij.id = coic.juridica_id
inner join ve_persona_estado as veps on coij.estado_id = veps.id;

SELECT  
      ju.ruc 
     , ju.nombre
     , pe.nombre persona_estado_nombre
	 , ac.nombre actividad_nombre
     , cl.nombre clasificacion_nombre
     , ju.direccion
     , ju.telefono
     , ve.nombre
     , coic.nombre
     , coic.cargo
     , coic.telefono
     , coic.correo
     FROM co_involucrado_juridica ju
     LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
     LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
     LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
     LEFT JOIN co_vendedor ve ON ve.id=ju.vendedor_id
     LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
     left join co_involucrado_contacto coic on ju.id = coic.juridica_id
     ;

select * , count(*) from co_involucrado_contacto group by juridica_id;

SELECT  
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
     ;