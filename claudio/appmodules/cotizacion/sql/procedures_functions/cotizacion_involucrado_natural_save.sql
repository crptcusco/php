SELECT 'DROP FUNCTION co_vendedor_involucrado_natural_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_vendedor_involucrado_natural_save;
SELECT 'CREATE FUNCTION co_vendedor_involucrado_natural_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_vendedor_involucrado_natural_save(
        in_id BIGINT
      , in_nombre VARCHAR(75)
      , in_documento_tipo_id BIGINT
      , in_documento VARCHAR(25)
      , in_direccion VARCHAR(150)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT
      , in_user_id INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id = 0 THEN
       INSERT INTO co_involucrado_natural (id, nombre, documento_tipo_id, documento, direccion, telefono, correo, info_status, info_create_user)
       VALUES(in_id, in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_natural SET nombre=in_nombre, documento_tipo_id=in_documento_tipo_id, documento=in_documento, direccion=in_direccion, telefono=in_telefono, correo=in_correo, info_status=in_info_status, info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_natural_history (natural_id, nombre, documento_tipo_id, documento, direccion, telefono, correo, info_status, info_create_user)
    VALUES (ou_id, in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, in_info_status, in_user_id)
    ;
    RETURN ou_id; 
END $$

DELIMITER ;
-- ----------------------- input -------------------------
--
-- -- caso 1: nuevo vendedor 
-- SET @id = 0, @nombre = 'Mili R. ', 
--     @documento_tipo_id = 1, @documento = ' 88888888',
--     @direccion='Av 888', @telefono='888 888 888', @correo='mili@gmailcom',
--     @info_status=1,  @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @id = 6, @nombre = 'Milagros R.  ', 
--     @documento_tipo_id = 2, @documento = '44444444',
--     @direccion='Av 888', @telefono='444 444 444', @correo='milagros@gmailcom',
--     @info_status=0,  @user_id=2
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- 
-- SELECT * FROM co_involucrado_natural
-- WHERE id=@id
-- ;
-- SELECT * FROM co_involucrado_natural
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_natural_history
-- WHERE id=@id
-- ;
-- SELECT * FROM co_involucrado_natural_history
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- 
-- SELECT 'SELECT co_vendedor_involucrado_natural_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_vendedor_involucrado_natural_save (
--    @id, @nombre, 
--    @documento_tipo_id, @documento,
--    @direccion, @telefono, @correo,
--    @info_status,  @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_natural
-- WHERE id=@id
-- ;
-- SELECT * FROM co_involucrado_natural
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_natural_history
-- WHERE id=@id
-- ;
-- SELECT * FROM co_involucrado_natural_history
-- ORDER BY id DESC
-- LIMIT 3
-- ;
