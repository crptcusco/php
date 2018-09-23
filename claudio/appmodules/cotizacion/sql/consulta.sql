-- SELECT 
--   co.codigo
-- , st.nombre AS tipo_servicio_nombre 
-- , pa.total_monto_igv
-- , mo.simbolo AS moneda
-- , pa.total_cambio
-- , es.nombre AS estado
-- , u.full_name AS usuario
-- FROM co_cotizacion co
-- LEFT JOIN co_servicio_tipo st ON st.id = co.servicio_tipo_id
-- LEFT JOIN co_estado es ON es.id=co.estado_id
-- LEFT JOIN login_user u ON u.id=co.info_create_user
-- LEFT JOIN co_pago pa ON pa.cotizacion_id = co.id
-- LEFT JOIN co_moneda mo ON mo.id = pa.total_moneda_id
-- WHERE co.codigo=1
-- ;

SELECT j.id juridica_id, c.vendedor_id 
FROM co_involucrado i
JOIN co_cotizacion c ON c.id=i.cotizacion_id
JOIN co_involucrado_juridica j ON j.id=i.persona_id
WHERE j.vendedor_id=0 AND i.persona_tipo='Juridica' AND i.rol_id=1
ORDER BY 1
;

SELECT n.id natural_id, c.vendedor_id
FROM co_involucrado i
JOIN co_cotizacion c ON c.id=i.cotizacion_id
JOIN co_involucrado_natural n ON n.id=i.persona_id
WHERE n.vendedor_id=0 AND i.persona_tipo='Natural' AND i.rol_id=1
ORDER BY 1
;