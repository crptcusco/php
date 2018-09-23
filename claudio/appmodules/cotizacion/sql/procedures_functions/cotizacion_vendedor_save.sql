SELECT 'DROP FUNCTION co_vendedor_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_vendedor_save;
SELECT 'CREATE FUNCTION co_vendedor_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_vendedor_save(
      in_accion VARCHAR(10)
      , in_id BIGINT
      , in_nombre VARCHAR(75)
      , in_telefono VARCHAR(75)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT
      , in_user_id INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    IF in_accion = 'add' THEN
       INSERT INTO co_vendedor (nombre, telefono, correo, info_status, info_create_user)
       VALUES(in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSEIF in_accion = 'edit' THEN
       UPDATE co_vendedor SET nombre=in_nombre, telefono=in_telefono, 
       correo=in_correo, info_update=NOW() , info_update_user=in_user_id, info_status=in_info_status
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    IF in_accion = 'add' || in_accion = 'edit' THEN
       INSERT INTO co_vendedor_history (vendedor_id, nombre, telefono, correo, info_status, info_create_user)
       VALUES (ou_id, in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
       ;
    END IF
    ;
    RETURN ou_id; 
END $$

DELIMITER ;
-- ----------------------- input -------------------------
--
-- -- caso 1: nuevo vendedor 
-- SET @accion='add', @id=0, @nombre='Jun Perez',
--     @telefono='777 777 777', @correo='correo@gmail.com',
--     @info_status=1,  @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @accion='edit', @id=2, @nombre='xxx',
--     @telefono='nnn nnn nnn', @correo='xxx@gmail.com',
--     @info_status=0, @user_id=1
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_vendedor
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- SELECT * FROM co_vendedor_history
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- SELECT 'SELECT co_vendedor_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_vendedor_save (
--     @accion, @id, @nombre, @telefono, @correo, 
--     @info_status, @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_vendedor
-- ORDER BY id DESC
-- LIMIT 3
-- ;
-- SELECT * FROM co_vendedor_history
-- ORDER BY id DESC
-- LIMIT 3
-- ;
