SELECT 'DROP FUNCTION co_nuevo' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_nuevo;

SELECT 'CREATE FUNCTION co_nuevo' AS 'MENSAJE'; 

DELIMITER $$ 
CREATE FUNCTION co_nuevo(
      in_info_create_user INT
    ) RETURNS BIGINT 
BEGIN
    DECLARE ou_id BIGINT;
    INSERT INTO co_cotizacion (info_create_user)
    VALUES (in_info_create_user)
    ;
    SELECT last_insert_id() into ou_id
    ;
    INSERT INTO co_pago (cotizacion_id, info_create_user,
    total_igv, total_igv_de, total_monto, total_monto_igv,
    total_cambio, total_moneda_id
    )
    VALUES (ou_id, in_info_create_user, 
    0.18, 'sin', 0, 0,
    1.0, 1
    );

    RETURN ou_id; 

END $$

DELIMITER ;

SET @user_id=1;
-- SELECT 'SELECT co_nuevo' AS 'MENSAJE';
SELECT co_nuevo(@user_id) AS id;
