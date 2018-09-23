SELECT 'DROP FUNCTION co_monto_nuevo' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_monto_nuevo;
SELECT 'CREATE FUNCTION co_monto_nuevo' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_monto_nuevo(
      in_cotizacion_id BIGINT
      , in_monto DECIMAL(22,5)
      , in_igv_si VARCHAR(10)
      , in_igv DECIMAL(9,5)
      , in_total DECIMAL(24,5)
      , in_moneda_id BIGINT
      , in_cambio DECIMAL(9,5)
      , in_fecha TIMESTAMP
      , in_id_user INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    IF in_igv_si = 'false' THEN
       SET in_igv=0;
    END IF
    ; -- validando el igv
    IF in_moneda_id = 1 THEN
       SET in_cambio = 1;
    END IF
    ; -- insertando moneda
    INSERT INTO co_pago (cotizacion_id, monto, igv, total, moneda_id, cambio, fecha, info_create_user)
    VALUES (in_cotizacion_id, in_monto, in_igv, in_total, in_moneda_id, in_cambio, in_fecha, in_id_user)
    ; -- insertando informacion
    SELECT last_insert_id() INTO ou_id
    ; -- opteniendo codigo
    IF in_igv_si != 'false' THEN
       UPDATE co_igv SET monto=in_igv;
    END IF
    ; -- insertando igv
    IF in_moneda_id != 1 THEN
       UPDATE co_moneda SET monto=in_cambio
       WHERE id = in_moneda_id;
    END IF
    ; -- insertando moneda
    RETURN ou_id; 
END $$

DELIMITER ;
-- ----------------------- input -------------------------
-- caso 1: sin igv, con soles
-- SET @cotizacion_id=1,@monto=300.0,@igv_si='false',
--     @igv=0.18, @total=300.0, @moneda_id=1,
--     @cambio=1.0, @fecha='2015-02-06',@user_id=1
-- ;
-- caso 2: con igv, no soles
-- SET @cotizacion_id=1,@monto=300.0,@igv_si='true',
--     @igv=0.18, @total=354.0, @moneda_id=2,
--     @cambio=3.635, @fecha='2015-02-06',@user_id=1
-- ;


-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_igv
-- LIMIT 1
-- ;
-- SELECT * FROM co_moneda
-- WHERE id = @moneda_id
-- ;
-- SELECT cotizacion_id, monto, igv, total, moneda_id, cambio, fecha, info_create_user, info_create FROM co_pago
-- WHERE cotizacion_id = @cotizacion_id
-- ORDER BY info_create DESC
-- ;
-- SELECT 'SELECT co_monto_nuevo' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_monto_nuevo(
--        @cotizacion_id, @monto, @igv_si, @igv, 
--        @total, @moneda_id, @cambio, @fecha,@user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_igv
-- LIMIT 1
-- ;
-- SELECT * FROM co_moneda
-- WHERE id = @moneda_id
-- ;
-- SELECT cotizacion_id, monto, igv, total, moneda_id, cambio, fecha, info_create_user, info_create FROM co_pago
-- WHERE cotizacion_id = @cotizacion_id
-- ORDER BY info_create DESC
-- ;

