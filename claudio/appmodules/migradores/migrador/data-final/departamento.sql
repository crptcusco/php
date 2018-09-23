
-- 
-- Estructura de tabla para la tabla `ubi_departamento`
-- 

CREATE TABLE `ubi_departamento` (
  `departamento_id` bigint(20) NOT NULL default '0',
  `nombre` varchar(500) default NULL,
  PRIMARY KEY  (`departamento_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `ubi_departamento`
-- 

INSERT INTO `ubi_departamento` VALUES (1, 'AMAZONAS');
INSERT INTO `ubi_departamento` VALUES (2, 'ANCASH');
INSERT INTO `ubi_departamento` VALUES (3, 'APURIMAC');
INSERT INTO `ubi_departamento` VALUES (4, 'AREQUIPA');
INSERT INTO `ubi_departamento` VALUES (5, 'AYACUCHO');
INSERT INTO `ubi_departamento` VALUES (6, 'CAJAMARCA');
INSERT INTO `ubi_departamento` VALUES (7, 'CALLAO');
INSERT INTO `ubi_departamento` VALUES (8, 'CUSCO');
INSERT INTO `ubi_departamento` VALUES (9, 'HUANCAVELICA');
INSERT INTO `ubi_departamento` VALUES (10, 'HUANUCO');
INSERT INTO `ubi_departamento` VALUES (11, 'ICA');
INSERT INTO `ubi_departamento` VALUES (12, 'JUNIN');
INSERT INTO `ubi_departamento` VALUES (13, 'LA LIBERTAD');
INSERT INTO `ubi_departamento` VALUES (14, 'LAMBAYEQUE');
INSERT INTO `ubi_departamento` VALUES (15, 'LIMA');
INSERT INTO `ubi_departamento` VALUES (16, 'LORETO');
INSERT INTO `ubi_departamento` VALUES (17, 'MADRE DE DIOS');
INSERT INTO `ubi_departamento` VALUES (18, 'MOQUEGUA');
INSERT INTO `ubi_departamento` VALUES (19, 'PASCO');
INSERT INTO `ubi_departamento` VALUES (20, 'PIURA');
INSERT INTO `ubi_departamento` VALUES (21, 'PUNO');
INSERT INTO `ubi_departamento` VALUES (22, 'SAN MARTIN');
INSERT INTO `ubi_departamento` VALUES (23, 'TACNA');
INSERT INTO `ubi_departamento` VALUES (24, 'TUMBES');
INSERT INTO `ubi_departamento` VALUES (25, 'UCAYALI');
INSERT INTO `ubi_departamento` VALUES (26, 'NO ESPECIFICO');
INSERT INTO `ubi_departamento` VALUES (27, 'OTROS');
