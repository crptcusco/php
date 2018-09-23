SELECT 'DROP PROCEDURE ve_juridico_modal_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_juridico_modal_save;
SELECT 'CREATE PROCEDURE ve_juridico_modal_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ve_juridico_modal_save(
        in_id BIGINT
      , in_clasificacion_id BIGINT
      , in_actividad_id BIGINT
      , in_grupo_id BIGINT
      , in_nombre VARCHAR(75)
      , in_ruc VARCHAR(25)
      , in_direccion VARCHAR(150)
      , in_telefono VARCHAR(100)
      , in_vendedor_id BIGINT
      , in_estado_id BIGINT
      , in_observacion VARCHAR(150)
      , in_importante_id BIGINT
      , in_referido_id BIGINT
      , in_info_status TINYINT(1)
      , in_user_id INT
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_juridica(clasificacion_id, actividad_id, grupo_id, 
                                           nombre, ruc, direccion, telefono,
                                           vendedor_id, estado_id, observacion, importante_id, referido_id,
                                           info_status, info_create_user)
       VALUES(in_clasificacion_id, in_actividad_id, in_grupo_id, 
              in_nombre, in_ruc, in_direccion, in_telefono,
              in_vendedor_id, in_estado_id, in_observacion, in_importante_id, in_referido_id,
              in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_juridica SET 
       clasificacion_id=in_clasificacion_id, actividad_id=in_actividad_id, grupo_id=in_grupo_id, 
       nombre=in_nombre, ruc=in_ruc, direccion=in_direccion, telefono=in_telefono, 
       vendedor_id=in_vendedor_id, estado_id=in_estado_id, observacion=in_observacion, importante_id=in_importante_id, referido_id=in_referido_id,
       info_status=in_info_status, info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_juridica_history(juridica_id, clasificacion_id, actividad_id, grupo_id, 
                                                nombre, ruc, direccion, telefono,
                                                vendedor_id, estado_id, observacion, importante_id, referido_id,
                                                info_status, info_create_user)
    VALUES(ou_id, in_clasificacion_id, in_actividad_id, in_grupo_id, 
           in_nombre, in_ruc, in_direccion, in_telefono,
           in_vendedor_id, in_estado_id, in_observacion, in_importante_id, in_referido_id,
           in_info_status, in_user_id)
    ;
    SELECT  
       ju.id
     , ju.clasificacion_id
     , cl.nombre clasificacion_nombre
     , ju.actividad_id
     , ac.nombre actividad_nombre
     , ju.grupo_id
     , gr.nombre grupo_nombre
     , ju.nombre
     , ju.ruc
     , ju.direccion
     , ju.telefono
     , ju.info_status
     , ve.id
     , ve.nombre
     , pe.id persona_estado_id
     , pe.nombre persona_estado_nombre
     , ju.observacion
     , ju.importante_id
     , ju.referido_id
     FROM co_involucrado_juridica ju
     LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
     LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
     LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
     LEFT JOIN co_vendedor ve ON ve.id=ju.vendedor_id
     LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
     WHERE ju.id=ou_id
     ;
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET @id=0, @clasificacion_id=1, @actividad_id=1, @grupo_id=1, 
--     @nombre='nombre', @ruc='ruc', @direccion='direccion', @telefono='telefono',
--     @vendedor_id=1, @estado_id=2, @observacion='observacion', @importante_id=1, @referido_id=2,
--     @info_status=1, @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @id=138, @clasificacion_id=2, @actividad_id=2, @grupo_id=2, 
--     @nombre='name', @ruc='cur', @direccion='path', @telefono='phone',
--     @vendedor_id=3, @estado_id=1, @observacion='obs', @importante_id=0, @referido_id=3,
--     @info_status=0, @user_id=2
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_juridica ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_juridica_history ORDER BY id DESC LIMIT 3
-- ;
-- SELECT 'CALL ve_juridico_modal_save' AS '---------------------------- MENSAJE ------------------------';
-- CALL ve_juridico_modal_save (
--      @id, @clasificacion_id, @actividad_id, @grupo_id,
--      @nombre, @ruc, @direccion, @telefono,     
--      @vendedor_id, @estado_id, @observacion, @importante_id, @referido_id,
--      @info_status, @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado_juridica ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_juridica_history ORDER BY id DESC LIMIT 3
-- ;
