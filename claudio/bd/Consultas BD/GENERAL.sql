-- SELECCIONAR CANTIDAD DE REGISTROS DE TABLAS
select table_name,table_rows from information_schema.tables where table_schema='cotiza_factura';
select * from co_bien_categoria;
select * from co_bien_inmueble;

-- LISTAR TODOS LOS CAMPOS DE UNA TABLA O BD
USE information_schema;
SELECT * FROM COLUMNS WHERE TABLE_SCHEMA = '<Base de datos>' AND TABLE_NAME = '<Nombre de la tabla>';

USE information_schema;
SELECT * FROM COLUMNS WHERE TABLE_SCHEMA = 'claudio' ;

-- SELECIONAR REGISTROS QUE EXISTEN EN UNA TABLA PERO NO EN OTRA
select * from ubi_departamento ud 
where not exists (select nombre from diccionario_ubi_departamento dud where ud.nombre = dud.nombre);