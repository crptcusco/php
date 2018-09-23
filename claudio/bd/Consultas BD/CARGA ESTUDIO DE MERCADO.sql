select * from t_casa where tasacion_fecha like '%2016%';
select * from t_departamento where tasacion_fecha like '%2016%';
select * from t_local_comercial where tasacion_fecha like '%2016%';
select * from t_local_industrial where tasacion_fecha like '%2016%';
select * from t_maquinaria where tasacion_fecha like '%2016%';
select * from t_terreno where YEAR(tasacion_fecha) = 2016;
select * from t_vehiculo where YEAR(tasacion_fecha) = 2016;

/*SISTEMA COORDINACION*/
select fechaSolicitud from solicitudservicio;

select fechaInspeccion, fechaEntregaInforme,idParticipante, estado from coordinacion
where estado=0;

select * from cotizacion;

select * from proyecto;
select * from solicitudservicio;
select * from coordina;

/* Seleccionar Cantidad de Registro de Tablas*/
select table_name,table_rows from information_schema.tables where table_schema='claudio';

/* */
select * from ubi_departamento;

select  provincia.provincia_id, distrito.nombre  from ubi_distrito distrito
inner join ubi_provincia provincia on distrito.distrito_id = provincia.provincia_id;

-- ACTUALIZACION DE LAS FECHAS EN CRUDO
-- SELECT * FROM claudio.crudo_t_casa;
UPDATE crudo_t_casa
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_departamento
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_local_comercial
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_local_industrial
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_maquinaria
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_terreno
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_vehiculo
SET tasacion_fecha = STR_TO_DATE(tasacion_fecha, '%d/%m/%Y');

UPDATE crudo_t_vehiculo
SET fabricacion_anio = SUBSTRING_INDEX(fabricacion_anio,'-', 1);

UPDATE crudo_t_maquinaria
SET fabricacion_anio = SUBSTRING_INDEX(fabricacion_anio,'-', 1);



/*SOLUCION NO EXISTENTES*/
/*DEPARTAMENTOS*/
select * from diccionario_ubi_departamento where nombre like '%libertad%';
UPDATE t_local_comercial SET ubi_departamento_id = 2 WHERE ubi_departamento_id = 21 AND ubi_provincia_id = 6 AND ubi_distrito_id = 36;
UPDATE t_local_industrial SET ubi_departamento_id = 13 WHERE ubi_departamento_id = 18 AND ubi_provincia_id = 32 AND ubi_distrito_id = 13;
/*PROVINCIA*/
select * from diccionario_ubi_provincia where nombre like '%cañete%';
select * from ubi_provincia where nombre like '%portillo%';
UPDATE t_casa SET ubi_provincia_id = 4 WHERE ubi_departamento_id = 1 AND ubi_provincia_id = 67 AND ubi_distrito_id = 4;
/*DISTRITOS*/
select * from diccionario_ubi_distrito where nombre like '%breña%';
UPDATE t_local_comercial SET ubi_distrito_id = 4 WHERE ubi_departamento_id = 1 AND ubi_provincia_id = 1 AND ubi_distrito_id = 207;



/*SOLUCION INCONSISTENCIAS*/
/* DEPARTAMENTOS */
select * from diccionario_ubi_departamento where nombre like '%arequipa%';
UPDATE t_local_comercial SET ubi_departamento_id = 3 WHERE ubi_departamento_id = 1 AND ubi_provincia_id = 1 AND ubi_distrito_id = 121;
/* PROVINCIA */
select * from diccionario_ubi_provincia where nombre like '%lima%';
UPDATE t_casa SET ubi_provincia_id = 1 WHERE ubi_departamento_id = 1 AND ubi_provincia_id = 4 AND ubi_distrito_id = 4;
/* DISTRITOS */
select * from diccionario_ubi_distrito where nombre like '%callao%';
UPDATE t_local_industrial SET ubi_distrito_id = WHERE ubi_departamento_id = 1 AND ubi_provincia_id = 3 AND ubi_distrito_id = 0;




