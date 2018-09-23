SELECT 'DROP PROCEDURE coor_persona_add_to_coordinacion' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_persona_add_to_coordinacion;
SELECT 'CREATE PROCEDURE coor_persona_add_to_coordinacion' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_persona_add_to_coordinacion(
  in_persona_id BIGINT
, in_cotizacion_id BIGINT
, in_persona_tipo VARCHAR(20)
, in_persona_rol_id BIGINT
, in_user_id INT 
    )
BEGIN
  DECLARE pr_cnt BIGINT;
  SELECT COUNT(id) INTO pr_cnt FROM co_involucrado
  WHERE cotizacion_id=in_cotizacion_id AND persona_tipo=in_persona_tipo 
    AND persona_id=in_persona_id AND rol_id=in_persona_rol_id
  ;
  IF pr_cnt = 0 THEN
     INSERT INTO co_involucrado(cotizacion_id, persona_tipo, persona_id, rol_id, info_create_user)
     VALUES (in_cotizacion_id, in_persona_tipo, in_persona_id, in_persona_rol_id, in_user_id)
     ;
  END IF
  ;

END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET
--   @persona_id=27
-- , @cotizacion_id=362
-- , @persona_tipo='Juridica'
-- , @persona_rol_id=2
-- , @user_id=2
-- ;

-- SELECT 'CALL coor_persona_add_to_coordinacion' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_persona_add_to_coordinacion (
--   @persona_id
-- , @cotizacion_id
-- , @persona_tipo
-- , @persona_rol_id 
-- , @user_id 
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado
-- WHERE cotizacion_id=@cotizacion_id
-- ;
