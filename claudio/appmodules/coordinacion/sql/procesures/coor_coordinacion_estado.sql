SELECT 'DROP coor_coordinacion_save' AS 'mensaje';
DROP PROCEDURE IF EXISTS coor_coordinacion_estado;

SELECT 'CREATE coor_coordinacion_estado' AS 'mensaje';
DELIMITER $$ 
CREATE PROCEDURE coor_coordinacion_estado (
  in_id BIGINT
, in_estado_id BIGINT
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
        UPDATE coor_coordinacion SET codigo = pr_codigo
        WHERE id = in_id
        ;
     END IF
     ;
  END IF
  ;
  UPDATE coor_coordinacion 
  SET estado_id = in_estado_id
  , info_update = in_info_update
  , info_update2= in_info_update
  , info_update_user = in_user_id
  WHERE id = in_id
  ;
END$$ 
DELIMITER ;

-- -- -------------------------------------- TEST
CALL coor_coordinacion_estado (
  '1'
, '2'
, '2015-12-03'
, '2'
) 
