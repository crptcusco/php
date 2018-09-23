-- ----------------------------------------------------------------------- inmuebles

/*
 * casa
*/

-- ---------------------------------------------- data
DROP VIEW view_casa;
CREATE VIEW view_casa AS
SELECT 
-- count(*)
  em.tipoinmueble
, i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, em.tipocalle AS 'TIPO UBICACION'
, em.calle as 'UBICACION'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, '' as 'LATITUD'
, '' as 'LONGITUD'
, em.zonificacion as 'ZONIFICACION'
, em.piso as 'NRO DE PISOS'
, em.areaterreno as 'AREA TERRENO'
, em.unidadterreno as 'uni01'
, em.valorunitarioterreno as 'VALOR UNITARIO DE TERRENO'
, em.unidadvalunitter as 'uni02'
, em.valorunitarioedificacion as 'VALOR UNITARIO DE EDIFICACION'
, em.unidadvalunitedif as 'uni03'
, em.areaconstruida as 'AREA DE EDIFICACION'
, em.unidadconstruida as 'uni04'
, em.valorcomercial as 'VALOR COMERCIAL'
, em.valorobras as 'AREAS COMPLEMENTARIAS'
, '' as 'TIPO DE CAMBIO'
, em.observacion  as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoinmueble em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN departamento ub_de ON ub_de.id=em.departamento
LEFT JOIN provincia ub_pr ON ub_pr.id=em.provincia
LEFT JOIN distrito ub_di ON ub_di.id=em.distrito
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
WHERE 
-- em.idInformeTasacion=10057
   em.tipoinmueble='casa'
;

/*
 * departamento
*/

-- ---------------------------------------------------- data
DROP VIEW view_departamento;
CREATE VIEW view_departamento AS
SELECT 
  em.tipoinmueble
, i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, em.tipocalle AS 'TIPO UBICACION'
, em.calle as 'UBICACION'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, '' as 'LATITUD'
, '' as 'LONGITUD'
, em.zonificacion as 'ZONIFICACION'
, em.piso as 'NRO DE PISOS'
, em.pisonumero as 'EN QUE NIVEL SE ENCUENTRA' 
, '' as 'TIPO DE DEPARTAMENTO'
, em.areaterreno as 'AREA TERRENO'
, em.unidadterreno as 'uni01'
, em.valorunitarioterreno as 'VALOR UNITARIO DE TERRENO'
, em.unidadvalunitter as 'uni02'
, em.valorunitarioedificacion as 'VALOR UNITARIO DE EDIFICACION'
, em.unidadvalunitedif as 'uni03'
, em.areaconstruida as 'AREA DE EDIFICACION'
, em.unidadconstruida as 'uni04'
, em.valorcomercial as 'VALOR COMERCIAL'
, em.valorocupada as 'VALOR DE AREA OCUPADA'
, em.cochera as 'ESTACIONAMIENTO'
, em.valorobras as 'AREAS COMPLEMENTARIAS'
, '' as 'TIPO DE CAMBIO'
, em.observacion  as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoinmueble em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN departamento ub_de ON ub_de.id=em.departamento
LEFT JOIN provincia ub_pr ON ub_pr.id=em.provincia
LEFT JOIN distrito ub_di ON ub_di.id=em.distrito
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
WHERE
-- em.idInformeTasacion=10002
em.tipoinmueble='departamento'
;

/*
 * local comercial
*/

-- ---------------------------------------------------------- data
DROP VIEW view_local_comercial;
CREATE VIEW view_local_comercial AS
SELECT 
  em.tipoinmueble
, em.tipozona
, i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, em.tipocalle AS 'TIPO UBICACION'
, em.calle as 'UBICACION'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, '' as 'LATITUD'
, '' as 'LONGITUD'
, em.zonificacion as 'ZONIFICACION'
, em.piso as 'NRO DE PISOS'
, '' as 'VISTA DEL LOCAL'
, em.areaterreno as 'AREA TERRENO'
, em.unidadterreno as 'uni01'
, em.valorunitarioterreno as 'VALOR UNITARIO DE TERRENO'
, em.unidadvalunitter as 'uni02'
, em.valorunitarioedificacion as 'VALOR UNITARIO DE EDIFICACION'
, em.unidadvalunitedif as 'uni03'
, em.areaconstruida as 'AREA DE EDIFICACION'
, em.unidadconstruida as 'uni04'
, em.valorcomercial as 'VALOR COMERCIAL'
, em.valorocupada as 'VALOR DE AREA OCUPADA'
, '' as 'TIPO DE CAMBIO'
, em.observacion  as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoinmueble em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN departamento ub_de ON ub_de.id=em.departamento
LEFT JOIN provincia ub_pr ON ub_pr.id=em.provincia
LEFT JOIN distrito ub_di ON ub_di.id=em.distrito
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
WHERE 
-- em.idInformeTasacion=10060
   ( em.tipoinmueble = 'local' AND em.tipozona='comercial' ) 
   OR em.tipoinmueble = 'local de comercio'
;

/*
 * local industrial
*/
DROP VIEW view_local_industrial;
CREATE VIEW view_local_industrial AS
SELECT 
  em.tipoinmueble
, em.tipozona
, i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, em.tipocalle AS 'TIPO UBICACION'
, em.calle as 'UBICACION'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, '' as 'LATITUD'
, '' as 'LONGITUD'
, em.zonificacion as 'ZONIFICACION'
, em.piso as 'NRO DE PISOS'
, em.areaterreno as 'AREA TERRENO'
, em.unidadterreno as 'uni01'
, em.valorunitarioterreno as 'VALOR UNITARIO DE TERRENO'
, em.unidadvalunitter as 'uni02'
, em.valorunitarioedificacion as 'VALOR UNITARIO DE EDIFICACION'
, em.unidadvalunitedif as 'uni03'
, em.areaconstruida as 'AREA DE EDIFICACION'
, em.unidadconstruida as 'uni04'
, em.valorcomercial as 'VALOR COMERCIAL'
, '' as 'AREAS COMPLEMENTARIAS'
, '' as 'TIPO DE CAMBIO'
, em.observacion  as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoinmueble em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN departamento ub_de ON ub_de.id=em.departamento
LEFT JOIN provincia ub_pr ON ub_pr.id=em.provincia
LEFT JOIN distrito ub_di ON ub_di.id=em.distrito
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
WHERE 
-- em.idInformeTasacion=10047
   ( em.tipoinmueble = 'local' AND em.tipozona='industrial' ) 
   OR em.tipoinmueble = 'local industrial'
;

/*
 * terreno
*/
DROP VIEW view_terreno;
CREATE VIEW view_terreno AS
SELECT 
  em.tipoinmueble
, i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, em.tipocalle AS 'TIPO UBICACION'
, em.calle as 'UBICACION'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, '' as 'LATITUD'
, '' as 'LONGITUD'
, em.zonificacion as 'ZONIFICACION'
, '' as 'CULTIVO'
, '' as 'TIPO DE CULTIVO'
, em.areaterreno as 'AREA TERRENO'
, em.unidadterreno as 'uni01'
, em.valorunitarioterreno as 'VALOR UNITARIO DE TERRENO'
, em.unidadvalunitter as 'uni02'
, em.valorcomercial as 'VALOR COMERCIAL'
, '' as 'TIPO DE CAMBIO'
, em.observacion  as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoinmueble em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN departamento ub_de ON ub_de.id=em.departamento
LEFT JOIN provincia ub_pr ON ub_pr.id=em.provincia
LEFT JOIN distrito ub_di ON ub_di.id=em.distrito
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
WHERE 
-- em.idInformeTasacion=10062
   em.tipoinmueble='terreno'
;
-- -- ----------------- tener en cuenta 
-- SELECT tipoinmueble, COUNT(tipoinmueble) 
-- FROM estudiomercadoinmueble GROUP BY tipoinmueble;
/*
+-------------------+---------------------+
| tipoinmueble      | count(tipoinmueble) |
+-------------------+---------------------+
| 0                 |                  93 |
| embarcacion       |                   3 |
| estacion          |                  17 |
| estacionamiento   |                   3 |
*/

-- ------------------------------------------------------------------------ maquinaria
DROP VIEW view_maquinaria;
CREATE VIEW view_maquinaria AS
SELECT
  i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, c.descripcion as 'TIPO UBICACION'
, CONCAT(l.calle, ' ', l.numero) as 'UBICACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, '' as 'TIPO DE MAQUINARIA'
, em.marca as 'MARCA'
, em.modelo as 'MODELO'
, em.fabricacion as 'ANO DE FABRICACION'
, em.edad as 'ANTIGUEDAD'
, em.valornuevo as 'VALOR SIMILAR NUEVO'
, em.valorcomercial as 'VALOR COMERCIAL'
, '' as 'TIPO DE CAMBIO'
, em.observacion as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadomaquinaria em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN locacion l ON l.idProyecto = i.idProyecto
LEFT JOIN calle c ON c.id = l.idCalle
LEFT JOIN distrito ub_di ON ub_di.id= l.idDistrito
LEFT JOIN provincia ub_pr ON ub_pr.id= ub_di.IdProvincia
LEFT JOIN departamento ub_de ON ub_de.id= ub_pr.IdDepartamento
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
-- WHERE 
-- em.idInformeTasacion=10051
;

-- --------------------------------------------------------------------- vehiculos
-- ---------------------- busqueda de rango
-- SELECT 
--   em.idInformeTasacion as 'CODIGO DE INFORME'
-- FROM estudiomercadoauto em
-- WHERE 
--     em.idInformeTasacion >= 10000
-- AND em.idInformeTasacion <= 19000
-- ;
-- ---------------------- data
DROP VIEW view_vehiculo;
CREATE VIEW view_vehiculo AS
SELECT 
  i.idProyecto as 'CODIGO DE PROYECTO'
, em.idInformeTasacion as 'CODIGO DE INFORME'
, em.representante as 'CLIENTE'
, '' as 'PROPIETARIO'
, '' as 'SOLICITANTE'
, c.descripcion as 'TIPO UBICACION'
, CONCAT(l.calle, ' ', l.numero) as 'UBICACION'
, ub_de.nombre as 'DEPARTAMENTO'
, ub_pr.nombre as 'PROVINCIA'
, ub_di.nombre as 'DISTRITO'
, Date_format(em.fechatasacion,'%d/%m/%Y') as 'FECHA  DE TASACION'
, em.tipoautomovil as 'TIPO DE VEHICULO'
, em.marca as 'MARCA'
, em.modelo as 'MODELO'
, em.fabricacion as 'ANO DE FABRICACION'
, em.edad as 'ANTIGUEDAD'
, '' as 'TRACCION'
, em.valornuevo as 'VALOR SIMILAR NUEVO'
, em.valorcomercial as 'VALOR COMERCIAL'
, '' as 'TIPO DE CAMBIO'
, em.observacion as 'OBSERVACION'
, do.nombre as 'RUTA DEL INFORME'
FROM estudiomercadoauto em
LEFT JOIN informetasacion i ON i.id = em.idInformeTasacion
LEFT JOIN locacion l ON l.idProyecto = i.idProyecto
LEFT JOIN calle c ON c.id = l.idCalle
LEFT JOIN distrito ub_di ON ub_di.id= l.idDistrito
LEFT JOIN provincia ub_pr ON ub_pr.id= ub_di.IdProvincia
LEFT JOIN departamento ub_de ON ub_de.id= ub_pr.IdDepartamento
LEFT JOIN documentoinforme do ON do.idInformeTasacion=em.idInformeTasacion
-- WHERE 
--     em.idInformeTasacion = 10069
;
