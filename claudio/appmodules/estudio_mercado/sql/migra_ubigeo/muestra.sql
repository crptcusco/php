SELECT 'em_casa' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `em_casa` limit 5;
--
SELECT 't_casa' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `t_casa` limit 5;
--
SELECT 'em_departamento' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id
           ubi_provincia_id, dic_provincia_id, bk_provincia_id
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `em_departamento` limit 5;
SELECT 't_departamento' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id, 
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `t_departamento` limit 5;
--
SELECT 'em_local_comercial' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `em_local_comercial` limit 5;
SELECT 't_local_comercial' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id, 
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `t_local_comercial` limit 5;
--
SELECT 'em_local_industrial' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `em_local_industrial` limit 5;
SELECT 't_local_industrial' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `t_local_industrial` limit 5;
--
SELECT 'em_terreno' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `em_terreno` limit 5;
SELECT 't_terreno' as 'tabla';
SELECT id, ubi_departamento_id, dic_departamento_id, bk_departamento_id,
           ubi_provincia_id, dic_provincia_id, bk_provincia_id,
	   ubi_distrito_id, dic_distrito_id, bk_distrito_id
FROM `t_terreno` limit 5;
