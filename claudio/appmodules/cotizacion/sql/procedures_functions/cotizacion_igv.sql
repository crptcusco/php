SELECT 'DROP PROCEDURE co_igv_update_pp' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS co_igv_update_pp;
SELECT 'CREATE FUNCTION co_igv_update_pp' AS 'MENSAJE';
DELIMITER $$ 
CREATE PROCEDURE co_igv_update_pp(
      in_cotizacion_id BIGINT
      , in_igv DECIMAL(9,5)
    )
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE pr_monto  decimal(22,5);
   DECLARE pr_igv DECIMAL(9,5);
   DECLARE pr_id BIGINT;
   DECLARE cur1 CURSOR FOR SELECT pp.id, pp.monto, pp.igv FROM co_pago_has_perito pp
                                JOIN co_pago p ON p.id=pp.pago_id
                                WHERE p.cotizacion_id = in_cotizacion_id;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

   UPDATE co_igv SET monto = in_igv ;
   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO pr_id, pr_monto, pr_igv;
     IF done THEN
       LEAVE read_loop;
     END IF;
     IF pr_igv != 0 THEN
       UPDATE co_pago_has_perito SET total = pr_monto * (in_igv +1) , igv = in_igv WHERE id=pr_id;
     END IF;
   END LOOP;
   CLOSE cur1;

END $$

DELIMITER ;
-- ----------------------- INPUT -------------------------
-- SET @cotizacion_id=1,@igv=0.68
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT pp.id, pp.igv, p.cotizacion_id FROM co_pago_has_perito pp
-- JOIN co_pago p ON p.id=pp.pago_id
-- WHERE p.cotizacion_id = @cotizacion_id
-- ;

-- SELECT 'SELECT co_igv_update_pp' AS '---------------------------- MENSAJE ------------------------';
-- CALL co_igv_update_pp(
--        @cotizacion_id, @igv
-- );
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT pp.id, pp.igv, p.cotizacion_id FROM co_pago_has_perito pp
-- JOIN co_pago p ON p.id=pp.pago_id
-- WHERE p.cotizacion_id = @cotizacion_id
-- ;

