﻿-- 
-- Estructura de tabla para la tabla `ubi_provincia`
-- 

CREATE TABLE `ubi_provincia` (
  `provincia_id` bigint(20) NOT NULL default '0',
  `departamento_id` bigint(20) default NULL,
  `nombre` varchar(500) default NULL,
  PRIMARY KEY  (`provincia_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Volcar la base de datos para la tabla `ubi_provincia`
-- 

INSERT INTO `ubi_provincia` VALUES (1, 1, 'BAGUA');
INSERT INTO `ubi_provincia` VALUES (2, 1, 'BONGARA');
INSERT INTO `ubi_provincia` VALUES (3, 1, 'CHACHAPOYAS');
INSERT INTO `ubi_provincia` VALUES (4, 1, 'CONDORCANQUI');
INSERT INTO `ubi_provincia` VALUES (5, 1, 'LUTA');
INSERT INTO `ubi_provincia` VALUES (6, 1, 'RODRIGUEZ DE M.');
INSERT INTO `ubi_provincia` VALUES (7, 1, 'UTCUBAMBA');
INSERT INTO `ubi_provincia` VALUES (8, 2, 'A. RAYMONDI');
INSERT INTO `ubi_provincia` VALUES (9, 2, 'BOLOGNESI');
INSERT INTO `ubi_provincia` VALUES (10, 2, 'CARHUAZ');
INSERT INTO `ubi_provincia` VALUES (11, 2, 'CASMA');
INSERT INTO `ubi_provincia` VALUES (12, 2, 'CORONGO');
INSERT INTO `ubi_provincia` VALUES (13, 2, 'HUARAZ');
INSERT INTO `ubi_provincia` VALUES (14, 2, 'HUARI');
INSERT INTO `ubi_provincia` VALUES (15, 2, 'HUARMEY');
INSERT INTO `ubi_provincia` VALUES (16, 2, 'HUAYLAS');
INSERT INTO `ubi_provincia` VALUES (17, 2, 'PALLASA');
INSERT INTO `ubi_provincia` VALUES (18, 2, 'POMABAMBA');
INSERT INTO `ubi_provincia` VALUES (19, 2, 'RECUAY');
INSERT INTO `ubi_provincia` VALUES (20, 2, 'SANTA');
INSERT INTO `ubi_provincia` VALUES (21, 2, 'SIHUAS');
INSERT INTO `ubi_provincia` VALUES (22, 2, 'YUNGAY');
INSERT INTO `ubi_provincia` VALUES (23, 3, 'ABANCAY');
INSERT INTO `ubi_provincia` VALUES (24, 3, 'ANDAHUAYLAS');
INSERT INTO `ubi_provincia` VALUES (25, 3, 'ANTABAMBA');
INSERT INTO `ubi_provincia` VALUES (26, 3, 'AYMARA');
INSERT INTO `ubi_provincia` VALUES (27, 3, 'CHINCHEROS');
INSERT INTO `ubi_provincia` VALUES (28, 3, 'GRAU');
INSERT INTO `ubi_provincia` VALUES (29, 4, 'AREQUIPA');
INSERT INTO `ubi_provincia` VALUES (30, 4, 'CASTILLA');
INSERT INTO `ubi_provincia` VALUES (31, 4, 'CAYLLONA');
INSERT INTO `ubi_provincia` VALUES (32, 4, 'CONDESUYOS');
INSERT INTO `ubi_provincia` VALUES (33, 4, 'ISLAY');
INSERT INTO `ubi_provincia` VALUES (34, 4, 'LA UNION');
INSERT INTO `ubi_provincia` VALUES (35, 5, 'CANGALLO');
INSERT INTO `ubi_provincia` VALUES (36, 5, 'HUAMANGA');
INSERT INTO `ubi_provincia` VALUES (37, 5, 'HUANCA SANCOS');
INSERT INTO `ubi_provincia` VALUES (38, 5, 'HUANTA');
INSERT INTO `ubi_provincia` VALUES (39, 5, 'LA MAR');
INSERT INTO `ubi_provincia` VALUES (40, 5, 'LUCANAS');
INSERT INTO `ubi_provincia` VALUES (41, 5, 'VICTOR FAJARDO');
INSERT INTO `ubi_provincia` VALUES (42, 5, 'SUCRE');
INSERT INTO `ubi_provincia` VALUES (43, 6, 'CAJABAMBA');
INSERT INTO `ubi_provincia` VALUES (44, 6, 'CAJAMARCA');
INSERT INTO `ubi_provincia` VALUES (45, 6, 'CELEDIN');
INSERT INTO `ubi_provincia` VALUES (46, 6, 'CHOTA');
INSERT INTO `ubi_provincia` VALUES (47, 6, 'CONTUMAZÁ');
INSERT INTO `ubi_provincia` VALUES (48, 6, 'CUTERVO');
INSERT INTO `ubi_provincia` VALUES (49, 6, 'HUALGAYOC');
INSERT INTO `ubi_provincia` VALUES (50, 6, 'JAEN');
INSERT INTO `ubi_provincia` VALUES (51, 6, 'SAN IGNACIO');
INSERT INTO `ubi_provincia` VALUES (52, 6, 'SAN MARCOS');
INSERT INTO `ubi_provincia` VALUES (53, 6, 'SAN PABLO');
INSERT INTO `ubi_provincia` VALUES (54, 6, 'SANTA CRUZ');
INSERT INTO `ubi_provincia` VALUES (55, 15, 'CALLAO');
INSERT INTO `ubi_provincia` VALUES (56, 8, 'ACOMAYO');
INSERT INTO `ubi_provincia` VALUES (57, 8, 'ANTA');
INSERT INTO `ubi_provincia` VALUES (58, 8, 'CALCA');
INSERT INTO `ubi_provincia` VALUES (59, 8, 'CANAS');
INSERT INTO `ubi_provincia` VALUES (60, 8, 'CANCHIS');
INSERT INTO `ubi_provincia` VALUES (61, 8, 'CHUMBIVILCAS');
INSERT INTO `ubi_provincia` VALUES (62, 8, 'CUSCO');
INSERT INTO `ubi_provincia` VALUES (63, 8, 'ESPINAR');
INSERT INTO `ubi_provincia` VALUES (64, 8, 'LA CONVENCIÓN');
INSERT INTO `ubi_provincia` VALUES (65, 8, 'QUISPICANCHI');
INSERT INTO `ubi_provincia` VALUES (66, 8, 'URUBAMBA');
INSERT INTO `ubi_provincia` VALUES (67, 9, 'ACOBAMBA');
INSERT INTO `ubi_provincia` VALUES (68, 9, 'ANGARAES');
INSERT INTO `ubi_provincia` VALUES (69, 9, 'CASTROVIRREYNA');
INSERT INTO `ubi_provincia` VALUES (70, 9, 'CHURCAMPA');
INSERT INTO `ubi_provincia` VALUES (71, 9, 'HUANCAVELICA');
INSERT INTO `ubi_provincia` VALUES (72, 9, 'HUAYTARA');
INSERT INTO `ubi_provincia` VALUES (73, 9, 'TAYACAJA');
INSERT INTO `ubi_provincia` VALUES (74, 10, 'AMBO');
INSERT INTO `ubi_provincia` VALUES (75, 10, 'HUAYCABAMBA');
INSERT INTO `ubi_provincia` VALUES (76, 10, 'HUAMALIES');
INSERT INTO `ubi_provincia` VALUES (77, 10, 'HUANUCO');
INSERT INTO `ubi_provincia` VALUES (78, 10, 'LAURICOCHA');
INSERT INTO `ubi_provincia` VALUES (79, 10, 'LEONCIO PRADO');
INSERT INTO `ubi_provincia` VALUES (80, 11, 'CHINCHA');
INSERT INTO `ubi_provincia` VALUES (81, 11, 'ICA');
INSERT INTO `ubi_provincia` VALUES (82, 11, 'NAZCA');
INSERT INTO `ubi_provincia` VALUES (83, 11, 'PALPA');
INSERT INTO `ubi_provincia` VALUES (84, 11, 'PISCO');
INSERT INTO `ubi_provincia` VALUES (85, 12, 'CHANCHAMAYO');
INSERT INTO `ubi_provincia` VALUES (86, 12, 'CHUPACA');
INSERT INTO `ubi_provincia` VALUES (87, 12, 'CONCEPCION');
INSERT INTO `ubi_provincia` VALUES (88, 12, 'HUANCAYO');
INSERT INTO `ubi_provincia` VALUES (89, 12, 'JAUJA');
INSERT INTO `ubi_provincia` VALUES (90, 12, 'JUNIN');
INSERT INTO `ubi_provincia` VALUES (91, 12, 'SATIPO');
INSERT INTO `ubi_provincia` VALUES (92, 12, 'TARMA');
INSERT INTO `ubi_provincia` VALUES (93, 12, 'YAULI');
INSERT INTO `ubi_provincia` VALUES (94, 13, 'ASCOPE');
INSERT INTO `ubi_provincia` VALUES (95, 13, 'TALAMBO');
INSERT INTO `ubi_provincia` VALUES (96, 13, 'OTUZCO');
INSERT INTO `ubi_provincia` VALUES (97, 13, 'PACASMAYO');
INSERT INTO `ubi_provincia` VALUES (98, 13, 'SANCHEZ CARRION');
INSERT INTO `ubi_provincia` VALUES (99, 13, 'TRUJILLO');
INSERT INTO `ubi_provincia` VALUES (100, 13, 'VIRU');
INSERT INTO `ubi_provincia` VALUES (101, 14, 'FERRENAFE');
INSERT INTO `ubi_provincia` VALUES (102, 14, 'LAMBAYEQUE');
INSERT INTO `ubi_provincia` VALUES (103, 15, 'LIMA');
INSERT INTO `ubi_provincia` VALUES (104, 15, 'BARRANCA');
INSERT INTO `ubi_provincia` VALUES (105, 15, 'CAJATAMBO');
INSERT INTO `ubi_provincia` VALUES (106, 15, 'CANTA');
INSERT INTO `ubi_provincia` VALUES (107, 15, 'CANETE');
INSERT INTO `ubi_provincia` VALUES (108, 15, 'HUARAL');
INSERT INTO `ubi_provincia` VALUES (109, 15, 'HUAROCHIRI');
INSERT INTO `ubi_provincia` VALUES (110, 15, 'HUAURA');
INSERT INTO `ubi_provincia` VALUES (111, 15, 'OYON');
INSERT INTO `ubi_provincia` VALUES (112, 15, 'YAUYOS');
INSERT INTO `ubi_provincia` VALUES (113, 16, 'ALTO AMAZONAS');
INSERT INTO `ubi_provincia` VALUES (114, 16, 'LORETO');
INSERT INTO `ubi_provincia` VALUES (115, 16, 'RAMON CASTILLA');
INSERT INTO `ubi_provincia` VALUES (116, 16, 'MAYNAS');
INSERT INTO `ubi_provincia` VALUES (117, 16, 'REQUENA');
INSERT INTO `ubi_provincia` VALUES (118, 16, 'UCAYALI');
INSERT INTO `ubi_provincia` VALUES (119, 17, 'MANU');
INSERT INTO `ubi_provincia` VALUES (120, 17, 'YAHUAMANU');
INSERT INTO `ubi_provincia` VALUES (121, 17, 'TAMBOPATA');
INSERT INTO `ubi_provincia` VALUES (122, 18, 'SANCHEZ CARRION');
INSERT INTO `ubi_provincia` VALUES (123, 18, 'ILO');
INSERT INTO `ubi_provincia` VALUES (124, 18, 'MARISCAL NIETO');
INSERT INTO `ubi_provincia` VALUES (125, 19, 'DANIEL ALCIDES CARRIÓN');
INSERT INTO `ubi_provincia` VALUES (126, 19, 'OXAPAMPA');
INSERT INTO `ubi_provincia` VALUES (127, 19, 'PASCO');
INSERT INTO `ubi_provincia` VALUES (128, 20, 'AYABACA');
INSERT INTO `ubi_provincia` VALUES (129, 20, 'HUANCABAMBA');
INSERT INTO `ubi_provincia` VALUES (130, 20, 'MORROPON');
INSERT INTO `ubi_provincia` VALUES (131, 20, 'PAITA');
INSERT INTO `ubi_provincia` VALUES (132, 20, 'PIURA');
INSERT INTO `ubi_provincia` VALUES (133, 20, 'SECHURA');
INSERT INTO `ubi_provincia` VALUES (134, 20, 'SULLANA');
INSERT INTO `ubi_provincia` VALUES (135, 20, 'TALARA');
INSERT INTO `ubi_provincia` VALUES (136, 21, 'AZANGARO');
INSERT INTO `ubi_provincia` VALUES (137, 21, 'CARTABAYA');
INSERT INTO `ubi_provincia` VALUES (138, 21, 'ILAVE');
INSERT INTO `ubi_provincia` VALUES (139, 21, 'HUANCANE');
INSERT INTO `ubi_provincia` VALUES (140, 21, 'MELGA');
INSERT INTO `ubi_provincia` VALUES (141, 21, 'MOHO');
INSERT INTO `ubi_provincia` VALUES (142, 21, 'PUNO');
INSERT INTO `ubi_provincia` VALUES (143, 21, 'SAN ANTONIO DE P.');
INSERT INTO `ubi_provincia` VALUES (144, 21, 'SAN ROMAN');
INSERT INTO `ubi_provincia` VALUES (145, 21, 'HUANCANE');
INSERT INTO `ubi_provincia` VALUES (146, 21, 'SANDIA');
INSERT INTO `ubi_provincia` VALUES (147, 21, 'YUNGUYO');
INSERT INTO `ubi_provincia` VALUES (148, 22, 'BELLAVISTA');
INSERT INTO `ubi_provincia` VALUES (149, 22, 'EL DORADO');
INSERT INTO `ubi_provincia` VALUES (150, 22, 'HUALLAGA');
INSERT INTO `ubi_provincia` VALUES (151, 22, 'LAMAS');
INSERT INTO `ubi_provincia` VALUES (152, 22, 'MARISCAL CACERES');
INSERT INTO `ubi_provincia` VALUES (153, 22, 'MOYOBAMBA');
INSERT INTO `ubi_provincia` VALUES (154, 22, 'PICOTA');
INSERT INTO `ubi_provincia` VALUES (155, 22, 'RIOJA');
INSERT INTO `ubi_provincia` VALUES (156, 22, 'SAN MARTIN');
INSERT INTO `ubi_provincia` VALUES (157, 22, 'TOCACHE');
INSERT INTO `ubi_provincia` VALUES (158, 23, 'CANDARAVE');
INSERT INTO `ubi_provincia` VALUES (159, 23, 'JORGE BASADRE');
INSERT INTO `ubi_provincia` VALUES (160, 23, 'TACNA');
INSERT INTO `ubi_provincia` VALUES (161, 23, 'TARATA');
INSERT INTO `ubi_provincia` VALUES (162, 24, 'CTRLMTE. VILLAR');
INSERT INTO `ubi_provincia` VALUES (163, 24, 'TUMBES');
INSERT INTO `ubi_provincia` VALUES (164, 24, 'ZARUMILLA');
INSERT INTO `ubi_provincia` VALUES (165, 25, 'ATALAYA');
INSERT INTO `ubi_provincia` VALUES (166, 25, 'CORONEL PORTILLO');
INSERT INTO `ubi_provincia` VALUES (167, 25, 'PADRE ABAD');
INSERT INTO `ubi_provincia` VALUES (168, 26, 'NO ESPECIFICO');
INSERT INTO `ubi_provincia` VALUES (169, 4, 'CAMANA');
INSERT INTO `ubi_provincia` VALUES (170, 3, 'COTABAMBAS');
INSERT INTO `ubi_provincia` VALUES (171, 6, 'SAN MIGUEL');
INSERT INTO `ubi_provincia` VALUES (172, 27, 'OTROS');
INSERT INTO `ubi_provincia` VALUES (173, 4, 'prueba2');
INSERT INTO `ubi_provincia` VALUES (174, 1, '321321321');
