INSERT INTO ve_persona_estado(nombre)
VALUES ('Cliente Potencial'), ('Cliente');
-- SELECT id, nombre FROM ve_persona_estado;

INSERT INTO ve_vendedor_rol(nombre)
VALUES ('Gerencia'), ('Coordinador De Ventas'), ('Vendedor');
SELECT id, nombre FROM ve_vendedor_rol;

INSERT INTO ve_estado(nombre)
VALUES ('Reunión inicial'), ('Propuesta enviada'), ('Aceptación'), ('Rechazo');
-- SELECT id, nombre FROM ve_estado;

INSERT INTO ve_servicio_tipo(id, nombre, parent_id) VALUES
(1, 'Tasaciones o Valorizaciones', 0),

(2, 'Bienes Muebles', 1),

(3, 'Maquinarias y equipos ', 2),
(4, 'Transporte', 2),
(5, 'Terrestre', 2),
(6, 'Aéreo', 2),
(7, 'Fluvial', 2),
(8, 'Marítimo', 2),
(9, 'Prendas industriales y agrícolas', 2),
(10,'Prendas globales y flotantes', 2),
(11,'Muebles y enseres', 2),
(12,'Obras de arte', 2),
(13,'Joyas', 2),
(14,'Otros', 2),

(15,'Bienes Inmuebles', 1),
(16,'Urbanos', 15),
(17,'Residenciales', 15),
(18,'Comerciales', 15),
(19,'Industriales', 15),
(20,'Rurales', 15),
(21,'Ribereños', 15),
(22,'Agrícolas', 15),
(23,'Eriazos', 15),
(24,'Otros', 15),

(25,'Valorización de Empresas y Marcas Intangible', 0),
(26,'Marcas', 25),
(27,'Alquiler de marcas', 25),
(28,'Empresa', 25),
(29,'Acciones de la Empresa', 25),

(30,'Proyecto Inmobiliario', 0),
(31,'Evaluación de Proyecto', 30),
(32,'Informe de avance de Obras', 30),
(33,'Supervisión de Obras', 30),
(34,'Estudio técnico de Valor', 30),
(35,'Estudio técnico de Viabilidad del Proyecto', 30),

(36,'Estudio técnico de Merma', 0),

(37,'Consultorías', 0),
(38,'Revisión de Informes', 37),
(39,'Revisión de Valores', 37),

(40,'Inventario Físico de Activos fijos y existencias', 0),
(41,'Inventario', 40),
(42,'Inventario y conciliación', 40),
(43,'Inventario, conciliación y valorización', 40),

(44,'Saneamiento Legal', 0),
(45,'Levantamiento topográfico de terrenos', 44),
(46,'Levantamiento de planos', 44),

(47,'Medio Ambiente', 0),

(48,'Construcciones', 47),

(49,'Supervisión de Central eléctrica', 0);
-- SELECT id, nombre FROM ve_servicio_tipo;

INSERT INTO ve_codigo(codigo) VALUES (2015000000);

-- INSERT INTO ve_propuesta(info_create_user, codigo, vendedor_id, estado_id, fecha, servicio_tipo_id, persona_tipo, persona_id, contacto_id)
-- VALUES(1, 2015000001, 1, 1, '2015-06-16', 2, 'Juridica', 51, 52);

-- INSERT INTO ve_propuesta_history(info_create_user, propuesta_id, codigo, vendedor_id, estado_id, fecha, servicio_tipo_id, persona_tipo, persona_id, contacto_id)
-- VALUES(1, 1, 2015000001, 1, 1, '2015-06-16', 2, 'Juridica', 51, 52);

-- INSERT INTO ve_visita(info_create_user, propuesta_id, estado_id, contacto_id, observacion, fecha, hora, minuto, departamento_id, provincia_id, distrito_id, direccion )
-- VALUES(1, 1, 1, 52, 'test observacion', '2015-06-16', 14, 40, 15, 1, 1, 'direccion test' );

-- INSERT INTO ve_visita_history(info_create_user,visita_id, propuesta_id, estado_id, contacto_id, observacion, fecha, hora, minuto, departamento_id, provincia_id, distrito_id, direccion )
-- VALUES(1, 1, 1, 1, 52, 'test observacion', '2015-06-16', 14, 40, 15, 1, 1, 'direccion test' );

