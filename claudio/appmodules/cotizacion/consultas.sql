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
co_involucrado.cotizacion_id = 32
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
co_involucrado.cotizacion_id = 32
AND co_involucrado.persona_tipo = "Juridica"
AND co_involucrado.info_status = 1
) AS unica01
ORDER BY 1
;

-- co_involucrado_natural
-- co_involucrado_juridica
-- co_involucrado_contacto
