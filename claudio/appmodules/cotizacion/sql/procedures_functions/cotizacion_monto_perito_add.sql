SELECT 'DROP FUNCTION co_monto_perito_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_monto_perito_save;
SELECT 'CREATE FUNCTION co_monto_perito_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE FUNCTION co_monto_perito_save(
        in_id BIGINT
      , in_cotizacion_id BIGINT
      , in_perito_id BIGINT
      , in_monto DECIMAL(22,5)
      , in_igv DECIMAL(9,5)
      , in_total DECIMAL(24,5)
      , in_cambio DECIMAL(9,5)
      , in_moneda_id BIGINT
      , in_user_id INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE ou_pago_id BIGINT;

    SELECT id INTO ou_pago_id 
    FROM co_pago
    WHERE cotizacion_id = in_cotizacion_id
    ;
    IF in_id = 0 THEN
       INSERT INTO co_pago_has_perito (pago_id, perito_id, monto, igv, total, cambio, moneda_id, info_status, info_create_user)
       VALUES(ou_pago_id , in_perito_id, in_monto, in_igv, in_total, in_cambio, in_moneda_id, 1, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_pago_has_perito SET pago_id=ou_pago_id, perito_id=in_perito_id, monto=in_monto, igv=in_igv, total=in_total, cambio=in_cambio, moneda_id=in_moneda_id, info_status=1, info_update_user=in_user_id
       WHERE id=in_id
       ;
    SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_pago_has_perito_history (pago_has_perito_id, pago_id, perito_id, monto, igv, total, cambio, moneda_id, info_status, info_create_user)
    VALUES(ou_id, ou_pago_id , in_perito_id, in_monto, in_igv, in_total, in_cambio, in_moneda_id, 1, in_user_id)
    ;    
    RETURN ou_id; 
END $$

DELIMITER ;
-- ----------------------- input -------------------------
--
-- -- caso 1: nuevo vendedor 
-- SET @id=0, @cotizacion_id=1, @perito_id=1, @monto=100
--    , @igv=0.18, @total=118, @cambio=1
--    , @moneda_id=1, @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @id=3, @cotizacion_id=1, @perito_id=2, @monto=200
--    , @igv=0, @total=200, @cambio=3.6
--    , @moneda_id=2, @user_id=2
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_pago_has_perito
-- ;
-- SELECT * FROM co_pago_has_perito_history
-- ;
-- SELECT 'SELECT co_monto_perito_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_monto_perito_save (
--      @id, @cotizacion_id, @perito_id, @monto
--    , @igv, @total, @cambio, @moneda_id
--    , @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_pago_has_perito
-- ;
-- SELECT * FROM co_pago_has_perito_history
-- ;
