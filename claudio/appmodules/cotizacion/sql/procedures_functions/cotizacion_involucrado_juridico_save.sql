SELECT 'DROP FUNCTION co_juridico_modal_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_juridico_modal_save;
SELECT 'CREATE FUNCTION co_juridico_modal_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE FUNCTION co_juridico_modal_save(
        in_id BIGINT
      , in_clasificacion_id BIGINT
      , in_actividad_id BIGINT
      , in_grupo_id BIGINT
      , in_nombre VARCHAR(75)
      , in_ruc VARCHAR(25)
      , in_direccion VARCHAR(150)
      , in_telefono VARCHAR(100)
      , in_info_status TINYINT(1)
      , in_user_id INT
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_juridica(clasificacion_id, actividad_id, grupo_id, nombre, ruc, direccion, telefono, info_create_user)
       VALUES(in_clasificacion_id, in_actividad_id, in_grupo_id, in_nombre, in_ruc, in_direccion, in_telefono, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_juridica SET 
       clasificacion_id=in_clasificacion_id, actividad_id=in_actividad_id, grupo_id=in_grupo_id, 
       nombre=in_nombre, ruc=in_ruc, direccion=in_direccion, telefono=in_telefono, 
       info_status=in_info_status, info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_juridica_history(juridica_id, clasificacion_id, actividad_id, grupo_id, nombre, ruc, direccion, telefono, info_create_user)
    VALUES(ou_id, in_clasificacion_id, in_actividad_id, in_grupo_id, in_nombre, in_ruc, in_direccion, in_telefono, in_user_id)
    ;
    RETURN ou_id; 
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- caso 1: nuevo vendedor 
-- SET @id=0, @clasificacion_id=1, @actividad_id=1, @grupo_id=1, 
--      @nombre='nombre', @ruc='ruc', @direccion='direccion', @telefono='direccion',
--      @info_status=1, @user_id=1
-- ;
-- caso 2: editar vendedor 
-- SET @id=4, @clasificacion_id=2, @actividad_id=2, @grupo_id=2, 
--      @nombre='nombre2', @ruc='ruc2', @direccion='direccion2', @telefono='direccion2',
--      @info_status=0, @user_id=2
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_juridica
-- ;
-- SELECT * FROM co_involucrado_juridica_history
-- ;
-- SELECT 'SELECT co_juridico_modal_save' AS '---------------------------- MENSAJE ------------------------';
-- SELECT co_juridico_modal_save (
--      @id,
--      @clasificacion_id,
--      @actividad_id,
--      @grupo_id,
--      @nombre,
--      @ruc,
--      @direccion,
--      @telefono,
--      @info_status,
--      @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado_juridica
-- ;
-- SELECT * FROM co_involucrado_juridica_history
-- ;
