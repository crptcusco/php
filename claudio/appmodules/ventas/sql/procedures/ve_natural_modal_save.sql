SELECT 'DROP PROCEDURE ve_natural_modal_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_natural_modal_save;
SELECT 'CREATE PROCEDURE ve_natural_modal_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE PROCEDURE ve_natural_modal_save(
        in_id BIGINT
      , in_nombre VARCHAR(75)
      , in_documento_tipo_id BIGINT
      , in_documento VARCHAR(25)
      , in_direccion VARCHAR(150)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_vendedor_id BIGINT
      , in_estado_id BIGINT
      , in_observacion VARCHAR(150)
      , in_importante_id BIGINT
      , in_referido_id BIGINT
      , in_info_status TINYINT
      , in_user_id INT
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id = 0 THEN
       INSERT INTO co_involucrado_natural (nombre, documento_tipo_id, documento, direccion, telefono, correo,
       	      	   			   vendedor_id, estado_id, observacion, importante_id, referido_id,
                                           info_status, info_create_user)
       VALUES(in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, 
              in_vendedor_id, in_estado_id, in_observacion, in_importante_id, in_referido_id,
              in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_natural SET 
       nombre=in_nombre, documento_tipo_id=in_documento_tipo_id, documento=in_documento, direccion=in_direccion, telefono=in_telefono, correo=in_correo, 
       vendedor_id=in_vendedor_id, estado_id=in_estado_id, observacion=in_observacion, importante_id=in_importante_id, referido_id=in_referido_id,
       info_status=in_info_status, info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_natural_history (natural_id, nombre, documento_tipo_id, documento, direccion, telefono, correo, 
                                                vendedor_id, estado_id, observacion, importante_id, referido_id,
                                                info_status, info_create_user)
    VALUES (ou_id, in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, 
            in_vendedor_id, in_estado_id, in_observacion, in_importante_id, in_referido_id,
    	    in_info_status, in_user_id)
    ;
    SELECT  na.id
           , na.nombre
           , na.documento_tipo_id
           , do.nombre as "documento_tipo"
           , na.documento as "documento_numero"
           , na.direccion
           , na.telefono
           , na.correo
           , na.info_status
           , ve.id
           , ve.nombre
           , pe.id persona_estado_id
           , pe.nombre persona_estado_nombre
           , na.observacion
           , na.importante_id
           , na.referido_id
    FROM co_involucrado_natural na 
    LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
    LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
    LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
    WHERE na.id=ou_id
    ;
END $$

DELIMITER ;
-- -- ----------------------- input -------------------------

-- -- caso 1: nuevo vendedor 
-- SET @id = 0, @nombre = 'Mili R. ', @documento_tipo_id = 1, @documento = ' 88888888', @direccion='Av 888', @telefono='888 888 888', @correo='mili@gmailcom',
--     @vendedor_id=1, @estado_id=2, @observacion='observacion', @importante_id=1, @referido_id=2,
--     @info_status=1,  @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @id = 16, @nombre = 'Julia F. ', @documento_tipo_id = 1, @documento = ' 222 222 222', @direccion='Av 222', @telefono='222 222 222', @correo='julia@gmailcom',
--     @vendedor_id=3, @estado_id=1, @observacion='obs', @importante_id=4, @referido_id=3,
--     @info_status=0,  @user_id=2
-- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_natural ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_natural_history ORDER BY id DESC LIMIT 3
-- ;
-- SELECT 'SELECT ve_natural_modal_save' AS '---------------------------- MENSAJE ------------------------';
-- CALL ve_natural_modal_save (
--    @id, @nombre, @documento_tipo_id, @documento, @direccion, @telefono, @correo,
--    @vendedor_id, @estado_id, @observacion, @importante_id, @referido_id,
--    @info_status,  @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_natural ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM co_involucrado_natural_history ORDER BY id DESC LIMIT 3
-- ;
