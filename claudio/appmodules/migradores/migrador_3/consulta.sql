SELECT 
  de.nombre as 'dep'
, po.nombre as 'pr'
, di.nombre as 'di'

FROM ubi_departamento de
JOIN ubi_provincia po ON  po.departamento_id=de.departamento_id
JOIN ubi_distrito di ON di.provincia_id=po.provincia_id
WHERE
--de.nombre = 'lima' 
--and 
po.nombre = 'PAITA' 
-- and 
-- di.nombre = 'PAITA'
;

-- DELETE FROM t_casa where tasacion_fecha like '%2014%';
-- DELETE FROM t_departamento where tasacion_fecha like '%2014%';
-- DELETE FROM t_local_comercial where tasacion_fecha like '%2014%';
-- DELETE FROM t_local_industrial where tasacion_fecha like '%2014%';
-- DELETE FROM t_terreno where tasacion_fecha like '%2014%';

-- SELECT tipo,count(tipo) FROM em_input_inmuebles 
-- group BY tipo;
