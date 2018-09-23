SELECT 'DROP PROCEDURE coor_tipo2_add_edit' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS coor_tipo2_add_edit;
SELECT 'CREATE PROCEDURE coor_tipo2_add_edit' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE coor_tipo2_add_edit(
        in_id BIGINT -- necesario
      , in_nombre VARCHAR(75)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_servicio_tipo(nombre, info_status, info_create_user)
       VALUES(in_nombre, in_info_status, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_servicio_tipo SET 
       nombre=in_nombre,
       info_status=in_info_status,
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_servicio_tipo_history(servicio_tipo_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre, in_info_status, in_user_id)
    ;     
END $$
DELIMITER ;
-- --------------------- input -------------------------
-- -- caso 1: add
-- SET
--  @id=0,
--  @nombre = 'nombre',
--  @info_status=1,
--  @user_id=1
-- ;

-- -- caso 2: edit
-- SET
--  @id=2,
--  @nombre = 'edit',
--  @info_status=0,
--  @user_id=2
-- ;

-- SELECT 'CALL coor_tipo2_add_edit' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL coor_tipo2_add_edit (
--      @id,
--      @nombre, 
--      @info_status,
--      @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_servicio_tipo ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM co_servicio_tipo_history ORDER BY id DESC LIMIT 3
-- ;
