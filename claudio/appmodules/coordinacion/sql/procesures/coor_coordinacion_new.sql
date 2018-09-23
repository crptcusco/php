SELECT 'DROP coor_coordinacion_new' AS 'mensaje';
DROP PROCEDURE IF EXISTS coor_coordinacion_new;

SELECT 'CREATE coor_coordinacion_new' AS 'mensaje';
DELIMITER $$ 
CREATE PROCEDURE coor_coordinacion_new (
  in_cotizacion_codigo BIGINT
, in_solicitante_fecha TIMESTAMP
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  -- coordinacion
  DECLARE pr_correlativo BIGINT;
  DECLARE pr_cotizacion_id BIGINT;
  DECLARE pr_servicio_tipo_id BIGINT;  
  DECLARE pr_solicitante_persona_id BIGINT;
  DECLARE pr_solicitante_persona_tipo VARCHAR(20);
  DECLARE pr_solicitante_contacto_id BIGINT;
  DECLARE pr_cliente_persona_id BIGINT;
  DECLARE pr_cliente_persona_tipo VARCHAR(20); 
  DECLARE pr_coordinacion_id BIGINT;
  DECLARE pr_inspeccion_id BIGINT;

  -- ---------------------------------------------- coordinacion
  SELECT id, servicio_tipo_id INTO pr_cotizacion_id, pr_servicio_tipo_id FROM co_cotizacion
  WHERE codigo=in_cotizacion_codigo
  ;
  SELECT correlativo INTO pr_correlativo FROM coor_cotizacion_correlativo
  WHERE cotizacion_id=0
  ;
  
  SET pr_correlativo=pr_correlativo+1
  ;
  SELECT i.persona_tipo, i.persona_id, i.contacto_id INTO
  pr_solicitante_persona_tipo, pr_solicitante_persona_id, pr_solicitante_contacto_id
  FROM co_involucrado i
  JOIN co_cotizacion co ON co.id=i.cotizacion_id
  WHERE co.codigo=in_cotizacion_codigo AND i.rol_id=2
  LIMIT 1
  ;
  IF pr_solicitante_persona_tipo IS NULL THEN
     SET pr_solicitante_persona_tipo = '';
  END IF
  ;
  IF pr_solicitante_persona_id IS NULL THEN
     SET pr_solicitante_persona_id = 0;
  END IF
  ;
  IF pr_solicitante_contacto_id IS NULL THEN
     SET pr_solicitante_contacto_id = 0;
  END IF
  ;
  SELECT i.persona_tipo, i.persona_id INTO
  pr_cliente_persona_tipo, pr_cliente_persona_id
  FROM co_involucrado i
  JOIN co_cotizacion co ON co.id=i.cotizacion_id
  WHERE co.codigo=in_cotizacion_codigo AND i.rol_id=1
  LIMIT 1
  ;
  IF pr_cliente_persona_tipo IS NULL THEN
     SET pr_cliente_persona_tipo = '';
  END IF
  ;
  IF pr_cliente_persona_id IS NULL THEN
     SET pr_cliente_persona_id = 0;
  END IF
  ;

  -- ---------------------------------------------- coordinacion
  INSERT INTO coor_coordinacion (
  info_update, info_update2,
  coordinador_id, cotizacion_id, cotizacion_correlativo, tipo_id, estado_id,
  solicitante_persona_tipo, solicitante_persona_id, solicitante_contacto_id,
  solicitante_fecha,
  cliente_persona_tipo, cliente_persona_id,
  tipo2_id
  )
  VALUES (
  in_info_update, in_info_update,
  in_user_id, pr_cotizacion_id, pr_correlativo, 1, 1, 
  pr_solicitante_persona_tipo, pr_solicitante_persona_id, pr_solicitante_contacto_id,
  in_solicitante_fecha,
  pr_cliente_persona_tipo, pr_cliente_persona_id,
  pr_servicio_tipo_id
  )
  ;
  SELECT last_insert_id() INTO pr_coordinacion_id
  ;
  UPDATE coor_cotizacion_correlativo SET correlativo=pr_correlativo
  WHERE cotizacion_id=0
  ;
  -- ---------------------------------------------- INSPECCION
  INSERT INTO coor_inspeccion
  ( coordinacion_id, info_update, estado_id, hora_estimada, hora_real, departamento_id, provincia_id, distrito_id)
  VALUES(pr_coordinacion_id, in_info_update, 1, '00:00-00:00', '00:00', 15, 1, 1)
  ;
  SELECT last_insert_id() INTO pr_inspeccion_id
  ;
  SELECT pr_inspeccion_id
  ;
END$$ 
DELIMITER ;
-- -- -------------------------------------- TEST
-- SET
--   @cotizacion_codigo=2015000299
-- , @solicitante_fecha='2015-10-06'
-- , @user_id=2
-- ;
-- SELECT 'CALL coor_coordinacion_new' AS 'mensaje';
-- CALL coor_coordinacion_new (
--   @cotizacion_codigo
-- , @solicitante_fecha
-- , NOW()
-- , @user_id
-- );

