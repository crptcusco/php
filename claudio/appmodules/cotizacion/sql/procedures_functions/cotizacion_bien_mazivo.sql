SELECT 'DROP FUNCTION co_bien_mazivo_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_bien_mazivo_save;
SELECT 'CREATE FUNCTION co_bien_mazivo_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_bien_mazivo_save(
      in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_id BIGINT
      , in_descripcion TEXT
      , in_direccion TEXT
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
    	INSERT INTO co_bien_mazivo(cotizacion_id, sub_categoria_id, direccion, descripcion, orden, info_create_user)
    	VALUES(in_cotizacion_id, in_sub_categoria_id, in_direccion, in_descripcion, ultimo+1, in_user_id)
    	;
    	SELECT last_insert_id() INTO ou_id;
    ELSE
	UPDATE co_bien_mazivo
	SET  direccion=in_direccion
           , descripcion=in_descripcion
           , info_update_user=in_user_id
	WHERE id = in_id
	;
	SET ou_id = in_id;
    END IF
    ;
    RETURN ou_id;
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- caso 1: nuevo
-- SET   @cotizacion_id=1
--     , @sub_categoria_id=11
--     , @id=0
--     , @descripcion='Descripcion'
--     , @direccion='perú.png'
--     , @user_id=1
-- ;
-- -- caso 2: editar
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_bien_mazivo
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_mazivo_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT 'SELECT co_bien_mazivo_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_bien_mazivo_save (
--      @cotizacion_id
--    , @sub_categoria_id
--    , @id
--    , @descripcion
--    , @direccion
--    , @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_bien_mazivo
-- WHERE cotizacion_id = @cotizacion_id
-- ;
-- SELECT * FROM co_bien_mazivo_history
-- WHERE cotizacion_id = @cotizacion_id
-- ;
