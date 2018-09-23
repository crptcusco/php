-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP FUNCTION co_montos_perito_modal_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_montos_perito_modal_save;
SELECT 'CREATE FUNCTION co_montos_perito_modal_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_montos_perito_modal_save(
        in_id BIGINT -- necesario
      , in_nombre VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_perito(nombre, telefono, correo, info_create_user )
       VALUES(in_nombre, in_telefono, in_correo, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_perito SET 
       nombre=in_nombre, telefono=in_telefono, correo=in_correo,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_perito_history(perito_id, nombre, telefono, correo, info_status, info_create_user )
    VALUES(ou_id, in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
    ;
    RETURN ou_id; 
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- SET @id=0
--   , @nombre='nombre'
--   , @telefono='mierda'
--   , @correo='correo'
--   , @info_status=1
--   , @user_id=1
-- ;
-- -- caso 2: editar (añadir despues)
-- SET @id=5
--   , @nombre='name'
--   , @telefono='telephone'
--   , @correo='mail'
--   , @info_status=0
--   , @user_id=1
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_perito
-- ;
-- SELECT * FROM co_perito_history
-- ;
-- SELECT 'SELECT co_montos_perito_modal_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_montos_perito_modal_save (
--        @id
--      , @nombre
--      , @telefono
--      , @correo
--      , @info_status
--      , @user_id
-- ) AS id
-- ; -- añdir campos
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_perito
-- ;
-- SELECT * FROM co_perito_history
-- ;
