SELECT 'DROP PROCEDURE ve_visita_delete' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_visita_delete;
SELECT 'CREATE PROCEDURE ve_visita_delete' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ve_visita_delete(
  in_propuesta_id BIGINT
, in_visita_id BIGINT
    )
BEGIN
    DECLARE pr_estado_id BIGINT;
    DECLARE pr_contacto_id BIGINT;
    DECLARE pr_fecha TIMESTAMP;
    DECLARE pr_hora INT;
    DECLARE pr_minuto INT;
    DECLARE pr_visita_id BIGINT;

    UPDATE ve_visita SET info_status=0
    WHERE id= in_visita_id
    ;
    SELECT visita_id INTO pr_visita_id FROM ve_propuesta
    WHERE id=in_propuesta_id
    ;
    IF pr_visita_id = in_visita_id THEN
       SELECT id, estado_id, contacto_id, fecha, hora, minuto
       INTO pr_visita_id, pr_estado_id, pr_contacto_id, pr_fecha, pr_hora, pr_minuto
       FROM ve_visita WHERE propuesta_id=in_propuesta_id and info_status!=0 
       ORDER BY id DESC LIMIT 1
       ;
       UPDATE ve_propuesta SET
       estado_id=pr_estado_id, contacto_id=pr_contacto_id, 
       fecha=pr_fecha, hora=pr_hora, minuto=pr_minuto,
       visita_id=pr_visita_id
       WHERE id=in_propuesta_id
       ;
    END IF
    ;
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET
--   @propuesta_id = 3
-- , @visita_id = 9
-- ;
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT id, info_status FROM ve_visita WHERE id=@visita_id
-- ;
-- SELECT id, estado_id, contacto_id, fecha, hora, minuto, visita_id
-- FROM ve_propuesta WHERE id=@propuesta_id
-- ;
-- SELECT 'CALL ve_visita_delete' AS '---------------------------- MENSAJE ------------------------';
-- CALL ve_visita_delete (
--   @propuesta_id
-- , @visita_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT id, info_status FROM ve_visita WHERE id=@visita_id
-- ;
-- SELECT id, estado_id, contacto_id, fecha, hora, minuto, visita_id
-- FROM ve_propuesta WHERE id=@propuesta_id
-- ;
