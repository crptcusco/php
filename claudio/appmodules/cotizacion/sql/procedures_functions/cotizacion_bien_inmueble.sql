SELECT 'DROP FUNCTION co_bien_inmueble_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_bien_inmueble_save;
SELECT 'CREATE FUNCTION co_bien_inmueble_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_bien_inmueble_save(
        in_id BIGINT
      , in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_departamento_id BIGINT
      , in_provincia_id BIGINT
      , in_distrito_id BIGINT
      , in_direccion TEXT
      , in_descripcion TEXT
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
       INSERT INTO co_bien_inmueble(cotizacion_id, sub_categoria_id, departamento_id, provincia_id, distrito_id, direccion, descripcion, orden, info_create_user)
       VALUES(in_cotizacion_id, in_sub_categoria_id, in_departamento_id, in_provincia_id, in_distrito_id, in_direccion, in_descripcion, ultimo+1, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_inmueble SET 
         cotizacion_id=in_cotizacion_id, sub_categoria_id=in_sub_categoria_id
       , departamento_id=in_departamento_id, provincia_id=in_provincia_id
       , distrito_id=in_distrito_id, direccion=in_direccion, descripcion=in_descripcion
       , info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_inmueble_history(inmueble_id, cotizacion_id, sub_categoria_id, departamento_id, provincia_id, distrito_id, direccion, descripcion, info_create_user)
    VALUES(ou_id, in_cotizacion_id, in_sub_categoria_id, in_departamento_id, in_provincia_id, in_distrito_id, in_direccion, in_descripcion, in_user_id)
    ;
    RETURN ou_id;
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- -- SET @id=0, @cotizacion_id=1, @sub_categoria_id=6,
-- --      @departamento_id=15, @provincia_id=1, @distrito_id=2, 
-- --      @direccion='test direccion error orden',
-- --      @descripcion='test descripcion',
-- --      @user_id=1
-- -- ;
-- -- caso 2: editar
-- -- SET @id=2, @cotizacion_id=1, @sub_categoria_id=7,
-- --      @departamento_id=15, @provincia_id=2, @distrito_id=4, 
-- --      @direccion='test direccion update',
-- --      @descripcion='update descripcion',
-- --      @user_id=1
-- -- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_bien_inmueble
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_inmueble_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT 'SELECT co_bien_inmueble_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_bien_inmueble_save (
--      @id
--    , @cotizacion_id
--    , @sub_categoria_id
--    , @departamento_id
--    , @provincia_id
--    , @distrito_id
--    , @direccion
--    , @descripcion
--    , @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_bien_inmueble
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_inmueble_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
