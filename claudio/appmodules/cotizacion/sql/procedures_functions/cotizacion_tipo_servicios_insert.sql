SELECT 'DROP FUNCTION co_tipo_servicio_insert' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_tipo_servicio_insert;

SELECT 'CREATE FUNCTION co_tipo_servicio_insert' AS 'MENSAJE'; 

DELIMITER $$ 
CREATE FUNCTION co_tipo_servicio_insert(
        in_nombre VARCHAR(45)
      , in_info_status INT
      , in_info_create_user INT
    ) RETURNS INT 
BEGIN
    DECLARE ou_id BIGINT;
    INSERT INTO co_servicio_tipo (nombre,info_status, info_create_user)
    VALUES (in_nombre, in_info_status, in_info_create_user)
    ;
    SELECT last_insert_id() into ou_id
    ;
    INSERT INTO co_servicio_tipo_history (servicio_tipo_id, nombre,info_status, info_create_user)
    VALUES (ou_id, in_nombre, in_info_status, in_info_create_user)
    ;
    RETURN ou_id; 

END $$

DELIMITER ;

-- SET @nombre='test01', @info_status=1, @user_id=1;
-- SELECT 'SELECT co_tipo_servicio_insert' AS 'MENSAJE';
-- SELECT co_tipo_servicio_insert(@nombre, @info_status,@user_id) AS id;
