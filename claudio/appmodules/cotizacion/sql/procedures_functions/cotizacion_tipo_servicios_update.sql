SELECT 'DROP FUNCTION co_tipo_servicio_update' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_tipo_servicio_update;

SELECT 'CREATE FUNCTION co_tipo_servicio_update' AS 'MENSAJE'; 

DELIMITER $$ 
CREATE FUNCTION co_tipo_servicio_update(
        in_id BIGINT
      , in_nombre VARCHAR(45)
      , in_info_status INT
      , in_info_update_user INT
    ) RETURNS BIGINT 
BEGIN
    UPDATE co_servicio_tipo 
    SET nombre=in_nombre, info_status=in_info_status, info_update_user=in_info_update_user 
    WHERE id=in_id
    ;
    INSERT INTO co_servicio_tipo_history (servicio_tipo_id, nombre,info_status, info_create_user)
    VALUES (in_id, in_nombre, in_info_status, in_info_update_user)
    ;
    RETURN in_id; 

END $$

DELIMITER ;

-- SET @id=4, @nombre='test01', @info_status=1, @user_id=1;

-- SELECT 'ANTES' AS 'MENSAJE';
-- SELECT * FROM co_servicio_tipo WHERE id=@id
-- ;
-- SELECT 'SELECT co_tipo_servicio_update' AS 'MENSAJE';
-- SELECT co_tipo_servicio_update(@id, @nombre, @info_status, @user_id) as id;

-- SELECT 'DESPUES' AS 'MENSAJE';
-- SELECT * FROM co_servicio_tipo WHERE id=@id
-- ;
