DELIMITER ;
SELECT 'DROP PROCEDURE ve_nuevo' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_nuevo;

SELECT 'CREATE PROCEDURE ve_nuevo' AS 'MENSAJE'; 
DELIMITER $$ 
CREATE PROCEDURE ve_nuevo (
      in_user INT
    )
BEGIN
    DECLARE pr_id BIGINT;
    DECLARE pr_vendedor_id BIGINT
    ;
    SELECT id INTO pr_vendedor_id
    FROM co_vendedor WHERE user_id = in_user
    ;
    INSERT INTO ve_propuesta (info_create_user, vendedor_id)
    VALUES (in_user, pr_vendedor_id)
    ;
    SELECT last_insert_id() into pr_id
    ;
    SELECT pr.id
         , ve.id vendedor_id
         , ve.nombre vendedor_nombre
	 , ve.rol_id
    FROM ve_propuesta pr
    LEFT JOIN co_vendedor ve ON ve.id=pr.vendedor_id
    WHERE pr.id = pr_id
    ;
END $$

DELIMITER ;

-- SET @user_id = 9;
-- SELECT 'CALL ve_nuevo' AS 'MENSAJE';
-- CALL ve_nuevo(@user_id);
