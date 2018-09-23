SELECT 'DROP PROCEDURE coor_asistencia_item_update' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_asistencia_item_update;
SELECT 'CREATE PROCEDURE coor_asistencia_item_update' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_asistencia_item_update(
  in_id BIGINT 
, in_perito_id BIGINT
, in_inspector_id BIGINT
, in_contactos TEXT
, in_fecha TEXT
, in_hora_estimada CHAR(11)
, in_hora_estimada_mostrar TINYINT
, in_hora_real CHAR(5)
, in_hora_real_mostrar TINYINT
, in_departamento_id BIGINT
, in_provincia_id BIGINT
, in_distrito_id BIGINT
, in_direccion TEXT
, in_observacion TEXT
, in_user_rol VARCHAR(100)
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  IF in_user_rol='Coordinador' THEN
     UPDATE coor_inspeccion SET
       info_update=in_info_update
     , perito_id=in_perito_id
     , inspector_id=in_inspector_id
     , contactos=in_contactos
     , fecha=in_fecha
     , hora_estimada=in_hora_estimada
     , hora_estimada_mostrar=in_hora_estimada_mostrar
     , hora_real=in_hora_real
     , hora_real_mostrar=in_hora_real_mostrar
     , departamento_id=in_departamento_id
     , provincia_id=in_provincia_id
     , distrito_id=in_distrito_id
     , direccion=in_direccion
     , observacion=in_observacion
     , info_update_user=in_user_id
     WHERE id=in_id
     ;  
  END IF
  ;

  SELECT
    ins.id
  , ins.perito_id
  , per.full_name perito_nombre
  , ins.inspector_id
  , pec.full_name inspector_nombre    
  , ins.contactos
  , IF(ins.fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(ins.fecha,"%d-%m-%Y"))
  , ins.hora_estimada
  , ins.hora_estimada_mostrar
  , ins.hora_real
  , ins.hora_real_mostrar
  , ins.departamento_id
  , dep.nombre departamento_nombre
  , ins.provincia_id
  , pro.nombre provincia_nombre
  , ins.distrito_id
  , dis.nombre distrito_nombre
  , ins.direccion
  , ins.observacion
  FROM coor_inspeccion ins
  LEFT JOIN login_user per ON per.id=ins.perito_id
  LEFT JOIN login_user pec ON pec.id=ins.inspector_id
  LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=ins.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
  LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=ins.departamento_id AND pro.provincia_id=ins.provincia_id AND pro.distrito_id=0
  LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=ins.departamento_id AND dis.provincia_id=ins.provincia_id AND dis.distrito_id=ins.distrito_id
  WHERE ins.id=in_id
  ;
END $$
DELIMITER ;

-- -- --------------------- Input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET
--   @id=1
-- , @perito_id=15
-- , @inspector_id=16
-- , @contactos='contacto_nombre contacto_telefonos'
-- , @fecha='2015-09-15'
-- , @hora_estimada='14:00-18:00'
-- , @hora_estimada_mostrar='0'
-- , @hora_real='14:30'
-- , @hora_real_mostrar='0'
-- , @departamento_id=15
-- , @provincia_id=1
-- , @distrito_id=32
-- , @direccion = 'direc'
-- , @observacion = 'observ'
-- , @user_rol = 'Coordinador'
-- , @user_id = 15
-- ;

-- SELECT 'CALL coor_asistencia_item_update' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_asistencia_item_update (
--   @id
-- , @perito_id
-- , @inspector_id
-- , @contactos
-- , @fecha
-- , @hora_estimada
-- , @hora_estimada_mostrar
-- , @hora_real
-- , @hora_real_mostrar
-- , @departamento_id
-- , @provincia_id
-- , @distrito_id
-- , @direccion
-- , @observacion
-- , @user_rol
-- , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM coor_inspeccion WHERE id=@id
-- ;
-- SELECT * FROM coor_inspeccion_history ORDER BY id DESC LIMIT 3
-- ;
