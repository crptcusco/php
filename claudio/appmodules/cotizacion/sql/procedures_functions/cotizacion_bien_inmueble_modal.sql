-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP PROCEDURE co_bien_inmueble_modal' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS co_bien_inmueble_modal;
SELECT 'CREATE PROCEDURE co_bien_inmueble_modal' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE co_bien_inmueble_modal(
        in_id BIGINT -- necesario
      , in_nombre VARCHAR(50)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_bien_sub_categoria(nombre, categoria_id, info_create_user )
       VALUES(in_nombre, 2, in_user_id)
       ; -- añadir tabla y campos
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_sub_categoria SET 
       nombre=in_nombre, categoria_id=2,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ; -- añadir tabla y campos
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_sub_categoria_history(sub_categoria_id, nombre, categoria_id, info_status, info_create_user)
    VALUES(ou_id, in_nombre, 2, in_info_status, in_user_id)
    ; -- primer parametro cambiar y añadir campos

    -- mostrando info
    SELECT id,nombre,info_status FROM co_bien_sub_categoria
    WHERE id=ou_id
    ;
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- SET   @id=0
--     , @nombre='prueba'
--     , @info_status=1
--     , @user_id=1
-- ;
-- -- caso 2: editar (añadir despues)
-- SET   @id=14
--     , @nombre='cambio'
--     , @info_status=0
--     , @user_id=1
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_bien_sub_categoria
-- ;
-- SELECT * FROM co_bien_sub_categoria_history
-- ;
-- SELECT 'CALL co_bien_inmueble_modal' AS '---------------------------- MENSAJE ------------------------';
-- CALL co_bien_inmueble_modal (
--       @id
--     , @nombre
--     , @info_status
--     , @user_id
-- )
-- ; -- añdir campos
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_bien_sub_categoria
-- ;
-- SELECT * FROM co_bien_sub_categoria_history
-- ;
