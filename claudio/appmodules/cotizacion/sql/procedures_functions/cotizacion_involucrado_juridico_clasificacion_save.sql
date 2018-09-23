-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP FUNCTION co_involucrado_juridico_clasificacion_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_involucrado_juridico_clasificacion_save;
SELECT 'CREATE FUNCTION co_involucrado_juridico_clasificacion_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE FUNCTION co_involucrado_juridico_clasificacion_save(
        in_id BIGINT -- necesario
      , in_nombre VARCHAR(75)		
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_clasificacion(nombre, info_create_user )
       VALUES(in_nombre, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_clasificacion SET 
       nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_clasificacion_history(clasificacion_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre,in_info_status, in_user_id)
    ; -- primer parametro cambiar y añadir campos
    RETURN ou_id; 
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- SET   @id=0
--     , @nombre='test'
--     , @info_status=1
--     , @user_id=1
-- ;
-- -- caso 2: editar (añadir despues)
-- SET   @id=4
--     , @nombre='UPDATE'
--     , @info_status=0
--     , @user_id=1
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_clasificacion
-- ;
-- SELECT * FROM co_involucrado_clasificacion_history
-- ;
-- SELECT 'SELECT co_involucrado_juridico_clasificacion_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_involucrado_juridico_clasificacion_save (
--       @id
--     , @nombre
--     , @info_status
--     , @user_id
-- ) AS id
-- ; -- añdir campos
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado_clasificacion
-- ;
-- SELECT * FROM co_involucrado_clasificacion_history
-- ;
