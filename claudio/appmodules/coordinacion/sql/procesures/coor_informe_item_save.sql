SELECT 'DROP FUNCTION coor_informe_item_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_informe_item_save;
SELECT 'CREATE FUNCTION coor_informe_item_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_informe_item_save(
  in_informe_id BIGINT
, in_ruta TEXT
, in_user_id INT
)
BEGIN
  UPDATE coor_informe SET
  ruta=in_ruta, info_update_user=in_user_id
  WHERE id=in_informe_id
  ;
  INSERT INTO coor_informe_history(informe_id, ruta, info_create_user)
  VALUES(in_informe_id, in_ruta, in_user_id)
  ;
END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET
--   @informe_id=1
-- , @ruta='rutaxx'
-- , @user_id=16
-- ;

-- SELECT 'CALL coor_informe_item_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_informe_item_save (
--   @informe_id
-- , @ruta
-- , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM coor_informe WHERE id =  @informe_id
-- ;
-- SELECT * FROM coor_informe_history ORDER BY id DESC LIMIT 5
-- ;
