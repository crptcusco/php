SELECT 'DROP PROCEDURE coor_informe_fechasDeEntrega_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_informe_fechasDeEntrega_save;
SELECT 'CREATE PROCEDURE coor_informe_fechasDeEntrega_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_informe_fechasDeEntrega_save(
  in_id BIGINT
, in_informe_id BIGINT
, in_fecha TIMESTAMP
, in_tipo_id BIGINT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_entrega(informe_id, fecha, tipo_id, info_create_user)
       VALUES(in_informe_id, in_fecha, in_tipo_id, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_entrega SET
       informe_id=in_informe_id, fecha=in_fecha, tipo_id=in_tipo_id,
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_entrega_history(entrega_id, informe_id, fecha, tipo_id, info_create_user)
    VALUES(ou_id, in_informe_id, in_fecha, in_tipo_id, in_user_id)
    ;
    SELECT e.id, e.fecha, e.tipo_id, t.nombre tipo_nombre
    FROM coor_informe_entrega e
    LEFT JOIN coor_informe_entrega_tipo t ON t.id=e.tipo_id
    WHERE e.id=ou_id
    ;
END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: INSERT
-- SET
--   @id= 0
-- , @informe_id=1
-- , @fecha='2015-10-10'
-- , @tipo_id=1
-- , @user_id=1
-- ;
-- -- caso 2: UPDATE
-- SET
--   @id= 3
-- , @informe_id=1
-- , @fecha='2015-11-11'
-- , @tipo_id=2
-- , @user_id=2
-- ;

-- SELECT 'CALL coor_informe_fechasDeEntrega_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_informe_fechasDeEntrega_save (
--   @id
-- , @informe_id
-- , @fecha
-- , @tipo_id
-- , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM coor_informe_entrega ORDER BY id DESC LIMIT 5
-- ;
-- SELECT * FROM coor_informe_entrega_history ORDER BY id DESC LIMIT 5
-- ;
