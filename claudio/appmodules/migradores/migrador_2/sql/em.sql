DROP TABLE IF EXISTS `em_input_casa`;
CREATE TABLE `em_input_casa` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `ubi_departamento` text,
  `ubi_provincia` text,
  `ubi_distrito` text,
  `estudio_fecha` text,
  `terreno_area` text,
  `terreno_area_uni` text,
  `terreno_valorunitario` text,
  `terreno_valorunitario_uni` text,
  `edificacion_area` text,
  `edificacion_area_uni` text,
  `valor_comercial` text,
  `piso_cantidad` text,
  `contacto` text,
  `telefono` text,
  `mapa_latitud` text,
  `mapa_longitud` text,
  `zonificacion` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_casa`
--

LOCK TABLES `em_input_casa` WRITE;
/*!40000 ALTER TABLE `em_input_casa` DISABLE KEYS */;
INSERT INTO `em_input_casa` VALUES ('XXX','1','1','XXX','LIMA','LIMA','LA MOLINA','06/06/2014','6','M2','6','M2','6','M2','6','1','XXX','666666','-12.077351','-76.927199','RDA','XXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_casa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_departamento`
--

DROP TABLE IF EXISTS `em_input_departamento`;
CREATE TABLE `em_input_departamento` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `ubi_departamento` text,
  `ubi_provincia` text,
  `ubi_distrito` text,
  `estudio_fecha` text,
  `terreno_area` text,
  `terreno_area_uni` text,
  `terreno_valorunitario` text,
  `terreno_valorunitario_uni` text,
  `estacionamiento_cantidad` text,
  `departamento_tipo` text,
  `areas_complementarias` text,
  `piso_cantidad` text,
  `piso_ubicacion` text,
  `edificacion_area` text,
  `edificacion_area_uni` text,
  `valor_comercial` text,
  `contacto` text,
  `telefono` text,
  `mapa_latitud` text,
  `mapa_longitud` text,
  `zonificacion` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_departamento`
--

LOCK TABLES `em_input_departamento` WRITE;
/*!40000 ALTER TABLE `em_input_departamento` DISABLE KEYS */;
INSERT INTO `em_input_departamento` VALUES ('XXX','1','1','XXX','LIMA','LIMA','LA MOLINA','06/06/2014','5','M2','5','M2','5','FLAG','0','1','1','6','M2','6','XXX','9999999','-12.077351','-76.927199','RDA','XXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_local_comercial`
--

DROP TABLE IF EXISTS `em_input_local_comercial`;
CREATE TABLE `em_input_local_comercial` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `ubi_departamento` text,
  `ubi_provincia` text,
  `ubi_distrito` text,
  `estudio_fecha` text,
  `terreno_area` text,
  `terreno_area_uni` text,
  `terreno_valorunitario` text,
  `terreno_valorunitario_uni` text,
  `piso_cantidad` text,
  `vista_local` text,
  `edificacion_area` text,
  `edificacion_area_uni` text,
  `valor_comercial` text,
  `contacto` text,
  `telefono` text,
  `mapa_latitud` text,
  `mapa_longitud` text,
  `zonificacion` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_local_comercial`
--

LOCK TABLES `em_input_local_comercial` WRITE;
/*!40000 ALTER TABLE `em_input_local_comercial` DISABLE KEYS */;
INSERT INTO `em_input_local_comercial` VALUES ('XXX','1','1','XXX','LIMA','LIMA','LA MOLINA','06/06/2014','6','M2','6','M2','1','FLAG','6','M2','6','XXX','9999999','-12.077351','-76.927199','RDA','XXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_local_comercial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_local_industrial`
--

DROP TABLE IF EXISTS `em_input_local_industrial`;
CREATE TABLE `em_input_local_industrial` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `ubi_departamento` text,
  `ubi_provincia` text,
  `ubi_distrito` text,
  `estudio_fecha` text,
  `terreno_area` text,
  `terreno_area_uni` text,
  `terreno_valorunitario` text,
  `terreno_valorunitario_uni` text,
  `edificacion_area` text,
  `edificacion_area_uni` text,
  `valor_comercial` text,
  `piso_cantidad` text,
  `contacto` text,
  `telefono` text,
  `mapa_latitud` text,
  `mapa_longitud` text,
  `zonificacion` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_local_industrial`
--

LOCK TABLES `em_input_local_industrial` WRITE;
/*!40000 ALTER TABLE `em_input_local_industrial` DISABLE KEYS */;
INSERT INTO `em_input_local_industrial` VALUES ('XXX','1','1','XXX','LIMA','LIMA','LA MOLINA','06/06/2014','6','M2','6','M2','6','M2','6','1','XXX','9999999','-12.077351','-76.927199','RDA','XXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_local_industrial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_maquinaria`
--

DROP TABLE IF EXISTS `em_input_maquinaria`;
CREATE TABLE `em_input_maquinaria` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `estudio_fecha` text,
  `maquinaria_tipo` text,
  `maquinaria_marca` text,
  `maquinaria_modelo` text,
  `fabricacion_anio` text,
  `valor_similar_nuevo` text,
  `contacto` text,
  `telefono` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_maquinaria`
--

LOCK TABLES `em_input_maquinaria` WRITE;
/*!40000 ALTER TABLE `em_input_maquinaria` DISABLE KEYS */;
INSERT INTO `em_input_maquinaria` VALUES ('XXX','1','1','XXX','06/06/2014','XXX','XXX','XXX','1900','6','XXX','999999','XXXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_maquinaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_terreno`
--

DROP TABLE IF EXISTS `em_input_terreno`;
CREATE TABLE `em_input_terreno` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `ubi_departamento` text,
  `ubi_provincia` text,
  `ubi_distrito` text,
  `estudio_fecha` text,
  `terreno_area` text,
  `terreno_area_uni` text,
  `terreno_valorunitario` text,
  `terreno_valorunitario_uni` text,
  `valor_comercial` text,
  `contacto` text,
  `telefono` text,
  `mapa_latitud` text,
  `mapa_longitud` text,
  `zonificacion` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_terreno`
--

LOCK TABLES `em_input_terreno` WRITE;
/*!40000 ALTER TABLE `em_input_terreno` DISABLE KEYS */;
INSERT INTO `em_input_terreno` VALUES ('XXX','1','1','XXX','LIMA','LIMA','LA MOLINA','06/06/2014','6','M2','6','M2','6','XXX','9999999','-12.077351','-76.927199','RDA','XXX','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_terreno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `em_input_vehiculo`
--

DROP TABLE IF EXISTS `em_input_vehiculo`;
CREATE TABLE `em_input_vehiculo` (
  `estudio_tipo` text,
  `proyecto_id` text,
  `informe_id` text,
  `ubicacion` text,
  `estudio_fecha` text,
  `vehiculo_tipo` text,
  `vehiculo_marca` text,
  `vehiculo_modelo` text,
  `fabricacion_anio` text,
  `vehiculo_traccion` text,
  `valor_similar_nuevo` text,
  `contacto` text,
  `telefono` text,
  `observacion` text,
  `ruta_informe` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_input_vehiculo`
--

LOCK TABLES `em_input_vehiculo` WRITE;
/*!40000 ALTER TABLE `em_input_vehiculo` DISABLE KEYS */;
INSERT INTO `em_input_vehiculo` VALUES ('XXX','1','1','XXX','06/06/2014','xxx','xxx','xxx','1900','xxx','6','xxx','9999999','xxxx','d:\\AppServ\\www');
/*!40000 ALTER TABLE `em_input_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;
