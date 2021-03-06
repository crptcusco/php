-- replazar nonmbre
-- probar solo paramentos

SELECT 'DROP FUNCTION co_bien_modelo_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_bien_modelo_save;
SELECT 'CREATE FUNCTION co_bien_modelo_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE FUNCTION co_bien_modelo_save(
        in_tipo_id BIGINT -- necesario
      , in_marca_id BIGINT
      , in_modelo_id BIGINT
      , in_sub_categoria_id  BIGINT
      , in_nombre  VARCHAR(150)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_modelo_id BIGINT;
    IF in_modelo_id=0 THEN
       SELECT (MAX(modelo_id) + 1) INTO ou_modelo_id FROM co_bien_muebles_clasificacion
       WHERE tipo_id=in_tipo_id AND marca_id=in_marca_id
       ;
       INSERT INTO co_bien_muebles_clasificacion(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_create_user )
       VALUES(in_tipo_id, in_marca_id, ou_modelo_id, in_sub_categoria_id, in_nombre, in_user_id)
       ; -- añadir tabla y campos
    ELSE
       SET ou_modelo_id = in_modelo_id;
       UPDATE co_bien_muebles_clasificacion SET 
       sub_categoria_id=in_sub_categoria_id, nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE tipo_id=in_tipo_id AND marca_id=in_marca_id AND modelo_id=in_modelo_id
       ; -- añadir tabla y campos
    END IF
    ;
    INSERT INTO co_bien_muebles_clasificacion_history(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_status, info_create_user )
    VALUES(in_tipo_id, in_marca_id, ou_modelo_id, in_sub_categoria_id, in_nombre, in_info_status, in_user_id)
    ; -- añadir tabla y campos
    RETURN ou_modelo_id; 
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- SET @tipo_id=4, 
--     @marca_id=6,
--     @modelo_id=0,
--     @sub_categoria_id=1,
--     @nombre='test modelo generate',
--     @info_status=1, 
--     @user_id=1
-- ;
-- -- caso 2: editar (añadir despues)
-- SET @tipo_id=4,
--     @marca_id=6,
--     @modelo_id=2,
--     @sub_categoria_id=1,
--     @nombre='test modelo update generate',
--     @info_status=0, 
--     @user_id=2
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM  co_bien_muebles_clasificacion
-- ;
-- SELECT * FROM  co_bien_muebles_clasificacion_history
-- ;
-- SELECT 'SELECT co_bien_modelo_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_bien_modelo_save (
--      @tipo_id,
--      @marca_id,
--      @modelo_id,
--      @sub_categoria_id,
--      @nombre,
--      @info_status,
--      @user_id
-- ) AS id
-- ; -- añdir campos
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM  co_bien_muebles_clasificacion
-- ;
-- SELECT * FROM  co_bien_muebles_clasificacion_history
-- ;
