SELECT 'DROP FUNCTION co_mensaje_nuevo' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_mensaje_nuevo;
SELECT 'CREATE FUNCTION co_mensaje_nuevo' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_mensaje_nuevo(
      in_cotizacion_id BIGINT
      , in_estado_id BIGINT
      , in_mensaje TEXT
      , in_fecha_proxima TIMESTAMP
      , in_proxima TINYINT
      , in_info_create_user INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    INSERT INTO co_mensaje (cotizacion_id, estado_id, mensaje, fecha_proxima, proxima, info_create_user)
    VALUES (in_cotizacion_id, in_estado_id, in_mensaje, in_fecha_proxima, in_proxima, in_info_create_user)
    ;
    SELECT last_insert_id() into ou_id;
    RETURN ou_id; 
END $$

DELIMITER ;

-- SET @cotizacion_id=1, @estado_id=1, @mensaje='test mensaje', 
--     @fecha_proxima='2006-06-06 06:06:06', @info_create_user=1
--     @proxima=0
-- ;
-- SELECT 'Antes' AS 'MENSAJE';
-- SELECT * FROM  co_mensaje
-- ORDER BY id DESC
-- LIMIT 10
-- ;
-- SELECT 'SELECT co_mensaje_nuevo' AS 'MENSAJE';
-- SELECT co_mensaje_nuevo(@cotizacion_id, @estado_id, @mensaje, @fecha_proxima, @proxima, @info_create_user) 
-- AS id;

-- SELECT 'Despues' AS 'MENSAJE';
-- SELECT * FROM  co_mensaje
-- ORDER BY id DESC
-- LIMIT 10
-- ;
