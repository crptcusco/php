-- ---------------------------------- maquinaria

SELECT 'maquinaria: tipo->marca->modelo' AS 'MENSAJE';

SELECT id, nombre as 'tipo'
FROM diccionario_maquinaria_tipo
LIMIT 1
;
SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
FROM t_maquinaria t
JOIN diccionario_maquinaria_marca dmm ON dmm.id=t.maquinaria_marca_id
WHERE t.maquinaria_tipo_id=1
;
SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
FROM t_maquinaria t
JOIN diccionario_maquinaria_modelo dmm ON dmm.id=t.maquinaria_modelo_id
WHERE t.maquinaria_marca_id=1
;

-- ---------------------------------- vehiculo

SELECT 'vehiculo: tipo->marca->modelo' AS 'MENSAJE';

SELECT id, nombre as 'tipo'
FROM diccionario_vehiculo_tipo
LIMIT 1
;
SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
FROM t_vehiculo t
JOIN diccionario_vehiculo_marca dmm ON dmm.id=t.vehiculo_marca_id
WHERE t.vehiculo_tipo_id=1
;
SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
FROM t_vehiculo t
JOIN diccionario_vehiculo_modelo dmm ON dmm.id=t.vehiculo_modelo_id
WHERE t.vehiculo_marca_id=1
;
