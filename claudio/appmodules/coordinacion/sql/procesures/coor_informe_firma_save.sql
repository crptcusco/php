SELECT 'DROP PROCEDURE coor_informe_firma_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_informe_firma_save;
SELECT 'CREATE PROCEDURE coor_informe_firma_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_informe_firma_save(
  in_id BIGINT
, in_informe_id BIGINT
, in_firmante_id BIGINT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_firma(informe_id, firmante_id, info_create_user)
       VALUES(in_informe_id, in_firmante_id, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_firma SET
       informe_id=in_informe_id, firmante_id=in_firmante_id, 
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_firma_history
    (firma_id, informe_id, firmante_id, info_create_user)
    VALUES(ou_id, in_informe_id, in_firmante_id, in_user_id)
    ;
    SELECT f.id, f.firmante_id, u.full_name firmante_nombre 
    FROM coor_informe_firma f
    JOIN login_user u ON u.id=f.firmante_id
    WHERE f.id=ou_id
    ;
END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: INSERT
-- SET
--   @id=0
-- , @informe_id=1
-- , @firmante_id=9
-- , @user_id=1
-- ;
-- -- caso 2: UPDATE
-- SET
--   @id=3
-- , @informe_id=2
-- , @firmante_id=0
-- , @user_id=2
-- ;

-- SELECT 'CALL coor_informe_firma_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_informe_firma_save (
--   @id
-- , @informe_id
-- , @firmante_id
-- , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM coor_informe_firma ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM coor_informe_firma_history ORDER BY id DESC LIMIT 3
-- ;
