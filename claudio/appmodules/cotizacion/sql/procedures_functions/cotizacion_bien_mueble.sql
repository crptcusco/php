SELECT 'DROP FUNCTION co_bien_mueble_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_bien_mueble_save;
SELECT 'CREATE FUNCTION co_bien_mueble_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_bien_mueble_save(
        in_id BIGINT
      , in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_tipo_id BIGINT
      , in_marca_id BIGINT
      , in_modelo_id BIGINT
      , in_descripcion VARCHAR(150)
      , in_user_id INT
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE ultimo_mueble INT;
    DECLARE ultimo_inmueble INT;
    DECLARE ultimo_mazivo INT;
    DECLARE ultimo INT;
    IF in_id = 0 THEN
       SELECT MAX(orden) INTO ultimo_mueble
       FROM co_bien_mueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mueble IS NULL THEN
       	  SET ultimo_mueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_inmueble
       FROM co_bien_inmueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_inmueble IS NULL THEN
       	  SET ultimo_inmueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_mazivo
       FROM co_bien_mazivo
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mazivo IS NULL THEN
       	  SET ultimo_mazivo = 0;
       END IF
       ;
       IF ultimo_mueble>=ultimo_inmueble AND ultimo_mueble>=ultimo_mazivo  THEN 
       	  SET ultimo = ultimo_mueble;
       ELSEIF ultimo_inmueble>=ultimo_mueble AND ultimo_inmueble>=ultimo_mazivo THEN
 	  SET ultimo = ultimo_inmueble;
       ELSEIF ultimo_mazivo>=ultimo_mueble AND ultimo_mazivo>=ultimo_inmueble THEN
 	  SET ultimo = ultimo_mazivo;
       END IF
       ;
       INSERT INTO co_bien_mueble(cotizacion_id, sub_categoria_id, tipo_id, marca_id, modelo_id, descripcion, orden, info_create_user)
       VALUES(in_cotizacion_id, in_sub_categoria_id, in_tipo_id, in_marca_id, in_modelo_id, in_descripcion, ultimo+1, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_mueble SET 
         cotizacion_id=in_cotizacion_id, sub_categoria_id=in_sub_categoria_id
       , tipo_id=in_tipo_id, marca_id=in_marca_id, modelo_id=in_modelo_id
       , descripcion=in_descripcion   
       , info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_mueble_history(mueble_id, cotizacion_id, sub_categoria_id, tipo_id, marca_id, modelo_id, descripcion, info_create_user)
    VALUES(ou_id, in_cotizacion_id, in_sub_categoria_id, in_tipo_id, in_marca_id, in_modelo_id, in_descripcion, in_user_id)
    ;
    RETURN ou_id; 
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- -- caso 1: nuevo vendedor 
-- -- SET @id=0, @cotizacion_id=1, @sub_categoria_id=1, 
-- --      @tipo_id=1, @marca_id=1, @modelo_id=1, 
-- --      @descripcion='test procedure',
-- --      @user_id=1
-- -- ;
-- -- -- caso 2: editar vendedor 
-- -- SET @id=2, @cotizacion_id=3, @sub_categoria_id=3,
-- --      @tipo_id=3, @marca_id=3, @modelo_id=3,
-- --      @descripcion='test update database',
-- --      @user_id=1
-- -- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_bien_mueble
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_mueble_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT 'SELECT co_bien_mueble_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_bien_mueble_save (
--      @id
--    , @cotizacion_id
--    , @sub_categoria_id
--    , @tipo_id
--    , @marca_id
--    , @modelo_id
--    , @descripcion
--    , @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_bien_mueble
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_mueble_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
