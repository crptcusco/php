SELECT 'DROP coor_coordinacion_save' AS 'mensaje';
DROP PROCEDURE IF EXISTS coor_coordinacion_save;

SELECT 'CREATE coor_coordinacion_save' AS 'mensaje';
DELIMITER $$ 
CREATE PROCEDURE coor_coordinacion_save (
  in_id BIGINT
, in_estado_id BIGINT
, in_modalidad_id BIGINT
, in_tipo_id BIGINT
, in_tipo2_id BIGINT
, in_tipo_cambio_id BIGINT
, in_solicitante_persona_tipo VARCHAR(20)
, in_solicitante_persona_id BIGINT
, in_solicitante_contacto_id BIGINT
, in_solicitante_fecha TIMESTAMP
, in_entrega_por_operaciones_fecha TIMESTAMP
, in_entrega_al_cliente_fecha TIMESTAMP
, in_cliente_persona_tipo VARCHAR(20)
, in_cliente_persona_id BIGINT
, in_sucursal TEXT
, in_observacion TEXT
, in_info_update VARCHAR(40)
, in_user_id INT
) 
BEGIN
  -- esto es para el correlativo
  DECLARE pr_codigo BIGINT;
  IF in_estado_id=2 THEN
     SELECT codigo INTO pr_codigo
     FROM coor_coordinacion
     WHERE id=in_id
     ;
     IF pr_codigo = 0 THEN
        SELECT codigo INTO pr_codigo
        FROM coor_codigo LIMIT 1
        ;
        SET pr_codigo = pr_codigo + 1
        ;
        UPDATE coor_codigo SET codigo = pr_codigo
        ;
     END IF
     ;
  ELSE
     SET pr_codigo = 0;
  END IF
  ;
  UPDATE coor_coordinacion SET
    info_update=in_info_update
  , info_update2=in_info_update
  , estado_id=in_estado_id
  , codigo=pr_codigo
  , modalidad_id=in_modalidad_id
  , tipo_id=in_tipo_id
  , tipo2_id=in_tipo2_id
  , tipo_cambio_id=in_tipo_cambio_id
  , solicitante_persona_tipo=in_solicitante_persona_tipo
  , solicitante_persona_id=in_solicitante_persona_id
  , solicitante_contacto_id=in_solicitante_contacto_id
  , solicitante_fecha=in_solicitante_fecha
  , entrega_por_operaciones_fecha = in_entrega_por_operaciones_fecha
  , entrega_al_cliente_fecha = in_entrega_al_cliente_fecha
  , cliente_persona_tipo=in_cliente_persona_tipo
  , cliente_persona_id=in_cliente_persona_id
  , sucursal=in_sucursal
  , observacion=in_observacion
  , info_update_user=in_user_id
  WHERE id=in_id
  ;
END$$ 
DELIMITER ;

