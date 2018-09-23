SELECT 'DROP FUNCTION ve_contacto_delete' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS ve_contacto_delete;
SELECT 'CREATE FUNCTION ve_contacto_delete' AS 'MENSAJE';
DELIMITER $$ 

CREATE FUNCTION ve_contacto_delete (
  in_contacto_id BIGINT
, in_user_id BIGINT
) RETURNS TINYINT
BEGIN
    DECLARE pr_user_id TINYINT
    ;
    SELECT info_create_user INTO pr_user_id
    FROM co_involucrado_contacto
    WHERE id = in_contacto_id
    ;
    IF in_user_id = pr_user_id THEN
        UPDATE co_involucrado_contacto SET
	info_status=0
	WHERE id = in_contacto_id
	;
        RETURN 1;
    ELSE
	RETURN 0;
    END IF
    ;
    -- ver usuario de contacto
    -- si usuario == in_usuario
    --     eliminar
    --     retorna true
    -- sino
    --     retorna false
    RETURN ou_id;
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET
--   @contacto_id=169
-- , @user_id=10
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT id, info_status, info_create_user FROM co_involucrado_contacto
-- WHERE id=@contacto_id
-- ;
-- SELECT 'SELECT ve_contacto_delete' AS '---------------------------- MENSAJE ------------------------';
-- SELECT ve_contacto_delete (
--   @contacto_id
-- , @user_id
-- ) AS 'estado'
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT id, info_status, info_create_user FROM co_involucrado_contacto
-- WHERE id=@contacto_id
-- ;
