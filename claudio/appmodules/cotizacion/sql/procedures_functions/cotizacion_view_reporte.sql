DROP VIEW IF EXISTS reporte_cotizacion_coordinador
;

CREATE VIEW reporte_cotizacion_coordinador AS
SELECT 
  co.codigo
, st.nombre AS tipo_servicio_nombre 
, pa.total_monto_igv
, mo.simbolo AS moneda
, pa.total_cambio
, es.nombre AS estado
, u.full_name AS usuario
FROM co_cotizacion co
LEFT JOIN co_servicio_tipo st ON st.id = co.servicio_tipo_id
LEFT JOIN co_estado es ON es.id=co.estado_id
LEFT JOIN login_user u ON u.id=co.info_create_user
LEFT JOIN co_pago pa ON pa.cotizacion_id = co.id
LEFT JOIN co_moneda mo ON mo.id = pa.total_moneda_id
WHERE co.codigo!=0
ORDER BY 7
;
