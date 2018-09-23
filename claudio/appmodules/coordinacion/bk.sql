-- entrega cliente: en otra consulta "coor_informe_entrega"
select
  concat(coti.codigo, "-", coor.cotizacion_correlativo) coordinacion_codigo
, coordinador.full_name coordinador_nombre
, coor.solicitante_fecha
-- fecha de entrega
, modalidad.nombre formato_nombre
, coor.solicitante_persona_tipo
, coor.solicitante_persona_id
, coor.solicitante_contacto_id
, servicio.nombre servicio_nombre
, inspeccion_tipo.nombre inspeccion_tipo_nombre
, tipo_cambio.nombre tipo_cambio_nombre
, coor.cliente_persona_tipo
, coor.cliente_persona_id
, perito.full_name perito_nombre
, consultor.full_name consultor_nombre
, inspector.full_name inspector_nombre
, inspeccion.departamento_id
, depa.nombre departamento_nombre
, inspeccion.provincia_id
, prov.nombre provincia_nombre
, inspeccion.distrito_id
, dist.nombre distrito_nombre
, inspeccion.direccion inspeccion_direccion
, inspeccion.contactos inspeccion_contactos
, inspeccion.fecha inspeccion_fecha
, inspeccion.hora_estimada inspeccion_hora_estimada
, inspeccion.hora_estimada_mostrar inspeccion_hora_estimada_mostrar
, inspeccion.hora_real inspeccion_hora_real
, inspeccion.hora_real_mostrar inspeccion_hora_real_mostrar
-- bienes
, coor.observacion 
from coor_coordinacion coor
left join co_cotizacion coti ON coti.id=coor.cotizacion_id
left join login_user coordinador ON coordinador.id=coor.coordinador_id
left join coor_coordinacion_modalidad modalidad ON modalidad.id=coor.modalidad_id
left join co_servicio_tipo servicio ON servicio.id=coor.tipo2_id 
left join coor_coordinacion_tipo inspeccion_tipo ON inspeccion_tipo.id=coor.tipo_id
left join coor_coordinacion_tipo_cambio tipo_cambio ON tipo_cambio.id=coor.tipo_cambio_id
join coor_informe informe ON informe.coordinacion_id=coor.id
join coor_inspeccion inspeccion ON inspeccion.informe_id=informe.id
left join login_user perito ON perito.id=inspeccion.perito_id
left join login_user consultor ON consultor.id=informe.consultor_id
left join login_user inspector ON inspector.id=inspeccion.inspector_id
left join co_bien_inmuebles_ubigeo depa ON 
          depa.departamento_id=inspeccion.departamento_id and 
          depa.provincia_id=0 and 
          depa.distrito_id=0
left join co_bien_inmuebles_ubigeo prov ON 
          prov.departamento_id=inspeccion.departamento_id and
          prov.provincia_id=inspeccion.provincia_id and 
          prov.distrito_id=0
left join co_bien_inmuebles_ubigeo dist ON 
          dist.departamento_id=inspeccion.departamento_id and
          dist.provincia_id=inspeccion.provincia_id and 
          dist.distrito_id=inspeccion.distrito_id
