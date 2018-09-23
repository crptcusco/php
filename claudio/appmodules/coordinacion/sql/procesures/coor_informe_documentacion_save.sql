SELECT 'DROP PROCEDURE coor_informe_documentacion_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_informe_documentacion_save;
SELECT 'CREATE PROCEDURE coor_informe_documentacion_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_informe_documentacion_save(
  in_id BIGINT
, in_informe_id BIGINT
, in_enlace TEXT
, in_descripcion TEXT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_documentacion(informe_id, enlace, descripcion, info_create_user)
       VALUES(in_informe_id, in_enlace, in_descripcion, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_documentacion SET
       informe_id=in_informe_id, enlace=in_enlace, descripcion=in_descripcion, 
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_documentacion_history
    (documentacion_id, informe_id, enlace, descripcion, info_create_user)
    VALUES(ou_id, in_informe_id, in_enlace, in_descripcion, in_user_id)
    ;
    SELECT id, enlace, descripcion 
    FROM coor_informe_documentacion
    WHERE id=ou_id
    ;
END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: INSERT
-- SET
--   @id=0
-- , @informe_id=1
-- , @enlace='enlacetest'
-- , @descripcion='desctest'
-- , @user_id=1
-- ;
-- -- caso 2: UPDATE
-- SET
--   @id=2
-- , @informe_id=1
-- , @enlace='2enlacetest2'
-- , @descripcion='2desctest2'
-- , @user_id=2
-- ;

-- SELECT 'CALL coor_informe_documentacion_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_informe_documentacion_save (
--   @id
-- , @informe_id
-- , @enlace
-- , @descripcion
-- , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM coor_informe_documentacion ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM coor_informe_documentacion_history ORDER BY id DESC LIMIT 3
-- ;
