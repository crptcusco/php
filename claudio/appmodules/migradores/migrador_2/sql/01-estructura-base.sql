DROP TABLE IF EXISTS backup_diccionarios_duplicados;
CREATE TABLE backup_diccionarios_duplicados(
       id bigint(20) NOT NULL AUTO_INCREMENT,
       tabla VARCHAR(250) NOT NULL,
       diccionario VARCHAR(250) NOT NULL,
       bad_id bigint(20) NOT NULL,
       data_id bigint(20) NOT NULL,
       info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (id) 
);
-- -------------------------------------------------------------- 
DROP TABLE IF EXISTS tabla;
CREATE TABLE IF NOT EXISTS tabla(
         id BIGINT NOT NULL
       , nombre VARCHAR (500) NOT NULL
       , modulo VARCHAR (500) NOT NULL
       , prefijo VARCHAR (500) NOT NULL
       , PRIMARY KEY (id)
);
DESC tabla;

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (1,'t_casa','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (2,'t_departamento','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (3,'t_local_comercial','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (4,'t_local_industrial','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (5,'t_terreno','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (6,'t_maquinaria','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (7,'t_vehiculo','','t');

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (8,'em_casa','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (9,'em_departamento','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
VALUES (10,'em_local_comercial','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (11,'em_local_industrial','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (12,'em_terreno','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (13,'em_maquinaria','','em');

INSERT INTO tabla(id,nombre, modulo, prefijo)
values (14,'em_vehiculo','','em');

-- SELECT * FROM tabla;
-- ---------------------------------------------------------------

DROP TABLE IF EXISTS campo;
CREATE TABLE IF NOT EXISTS campo(
         id BIGINT NOT NULL
       , nombre VARCHAR (500) NOT NULL
       , tipo_dato VARCHAR (500) NOT NULL -- varchar, int, etc
       , categoria VARCHAR (500) NOT NULL -- diccionario, dato
       , PRIMARY KEY (id)
);
DESC campo;

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(1, 'proyecto_id', 'BIGINT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(2, 'informe_id', 'BIGINT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(3, 'cliente', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(4, 'ubicacion_tipo', 'VARCHAR(100)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(5, 'ubicacion', 'TEXT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(6, 'tasacion_fecha', 'DATE', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(7, 'ubi_departamento', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(8, 'ubi_provincia', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(9, 'ubi_distrito', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(10, 'mapa_latitud', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(11, 'mapa_longitud', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(12, 'zonificacion', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(13, 'piso_cantidad', 'INT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(14, 'terreno_area', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(15, 'terreno_area_uni', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(16, 'terreno_valorunitario', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(17, 'terreno_valorunitario_uni', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(18, 'edificacion_valorunitario', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(19, 'edificacion_valorunitario_uni', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(20, 'edificacion_area', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(21, 'edificacion_area_uni', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(22, 'valor_comercial', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(23, 'areas_complementarias', 'Bool', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(24, 'tipo_cambio', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(25, 'observacion', 'TEXT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(26, 'ruta_informe', 'TEXT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(27, 'propietario', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(28,  'solicitante', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(29,  'piso_ubicacion', 'INT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(30,  'departamento_tipo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(31,  'valor_ocupada', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(32,  'estacionamiento_cantidad', 'INT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(33,  'vista_local', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(34,  'cultivo_tipo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(35,  'maquinaria_tipo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(36,  'marca', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(37,  'modelo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(38,  'fabricacion_anio', 'INT', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(39,  'valor_similar_nuevo', 'DECIMAL(12,4)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(40,  'vehiculo_tipo', 'VARCHAR(255)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(41,  'vehiculo_traccion', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(42,  'maquinaria_marca', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(43,  'maquinaria_modelo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(44,  'vehiculo_marca', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(45,  'vehiculo_modelo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(46,  'estudio_fecha', 'DATE', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(47,  'estudio_tipo', 'VARCHAR(500)', 'diccionario');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(48,  'contacto', 'VARCHAR(500)', 'valor');

INSERT INTO campo(id,nombre,tipo_dato,categoria) 
VALUES(49,  'telefono', 'VARCHAR(500)', 'valor');

-- INSERT INTO campo(id,nombre,tipo_dato,categoria) 
-- VALUES(40,  '', 'VARCHAR(500)', 'diccionario');

-- SELECT * FROM campo;
-- ---------------------------------------------------------------

DROP TABLE IF EXISTS tabla_has_campo;
CREATE TABLE IF NOT EXISTS tabla_has_campo(
         id BIGINT NOT NULL AUTO_INCREMENT
       , tabla_id BIGINT
       , campo_id BIGINT
       , PRIMARY KEY (id)
);
DESC tabla_has_campo;
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,18);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,19);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,23);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (1,26);


INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,29);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,30);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,18);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,19);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,31);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,32);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,23);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (2,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,33);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,18);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,19);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,31);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (3,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,18);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,19);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,23);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (4,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,34);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,23);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (5,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,35);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,42);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,43);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,38);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,39);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (6,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,3);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,27);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,28);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,4);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,6);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,40);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,44);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,45);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,38);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,41);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,39);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,24);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (7,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (8,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,32);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,30);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,23);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,29);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (9,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,33);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (10,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,20);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,21);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,13);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (11,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,7);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,8);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,9);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,14);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,15);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,16);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,17);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,22);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,10);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,11);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,12);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (12,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,35);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,42);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,43);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,38);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,39);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (13,26);

INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,47);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,1);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,2);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,5);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,46);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,40);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,44);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,45);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,38);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,41);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,39);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,48);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,49);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,25);
INSERT INTO tabla_has_campo (tabla_id,campo_id) VALUES (14,26);

-- SELECT * FROM tabla_has_campo;

-- SELECT 
--   c.id
-- , t.id
-- --, t.nombre as 'Tabla'  
-- , c.nombre AS 'Campo'
-- , t.prefijo
-- , c.tipo_dato
-- , c.categoria 
-- FROM tabla_has_campo tc
-- JOIN tabla t ON t.id=tc.tabla_id
-- JOIN campo c ON c.id=tc.campo_id
-- WHERE
-- t.id = 9
-- ;


