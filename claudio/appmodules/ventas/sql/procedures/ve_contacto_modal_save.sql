-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP PROCEDURE ve_contacto_modal_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_contacto_modal_save;
SELECT 'CREATE PROCEDURE ve_contacto_modal_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ve_contacto_modal_save(
        in_id BIGINT -- necesario
      , in_persona_id BIGINT
      , in_persona_tipo VARCHAR(75)
      , in_nombre VARCHAR(75)
      , in_cargo VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_persona_tipo = 'juridica' THEN
       IF in_id=0 THEN
          INSERT INTO co_involucrado_contacto(juridica_id, nombre, cargo, telefono, correo, info_status, info_create_user )
          VALUES(in_persona_id, in_nombre, in_cargo, in_telefono, in_correo , in_info_status, in_user_id)
          ; 
          SELECT last_insert_id() INTO ou_id;
       ELSE
          UPDATE co_involucrado_contacto SET 
          juridica_id=in_persona_id, nombre=in_nombre, cargo=in_cargo, 
          telefono=in_telefono, correo=in_correo,       
          info_status=in_info_status, info_update_user=in_user_id 
          WHERE id=in_id
          ;
          SET ou_id = in_id;
       END IF
       ;
       INSERT INTO co_involucrado_contacto_history(contacto_id, juridica_id, nombre, cargo, telefono, correo, info_status, info_create_user)
       VALUES(ou_id, in_persona_id, in_nombre, in_cargo, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT  c.id, c.juridica_id, c.nombre, c.cargo, c.telefono, c.correo, c.info_status
       FROM co_involucrado_contacto c WHERE c.id= ou_id
       ;
    END IF
    ;
    IF in_persona_tipo = 'natural' THEN
       IF in_id=0 THEN
          INSERT INTO co_involucrado_contacto(natural_id, nombre, cargo, telefono, correo, info_status, info_create_user )
          VALUES(in_persona_id, in_nombre, in_cargo, in_telefono, in_correo, in_info_status, in_user_id)
          ; 
          SELECT last_insert_id() INTO ou_id;
       ELSE
          UPDATE co_involucrado_contacto SET 
          natural_id=in_persona_id, nombre=in_nombre, cargo=in_cargo, 
          telefono=in_telefono, correo=in_correo,       
          info_status=in_info_status, info_update_user=in_user_id 
          WHERE id=in_id
          ;
          SET ou_id = in_id;
       END IF
       ;
       INSERT INTO co_involucrado_contacto_history(contacto_id, natural_id, nombre, cargo, telefono, correo, info_status, info_create_user)
       VALUES(ou_id, in_persona_id, in_nombre, in_cargo, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT  c.id, c.natural_id, c.nombre, c.cargo, c.telefono, c.correo, c.info_status
       FROM co_involucrado_contacto c WHERE c.id= ou_id
       ;
    END IF
    ;
END $$
DELIMITER ;
-- -- --------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET @id=147
-- , @persona_id=2
-- , @persona_tipo='natural'
-- , @nombre='2nombre2'
-- , @cargo='2cargo2'
-- , @telefono='2telefono2'
-- , @correo='2correo2'
-- , @info_status=0
-- , @user_id=2
-- ;
-- -- caso 2: editar vendedor 

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_contacto ORDER BY id DESC LIMIT 2
-- ;
-- SELECT * FROM co_involucrado_contacto_history ORDER BY id DESC LIMIT 2
-- ;
-- SELECT 'SELECT ve_contacto_modal_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- CALL ve_contacto_modal_save (
--      @id
--    , @persona_id
--    , @persona_tipo
--    , @nombre
--    , @cargo
--    , @telefono
--    , @correo
--    , @info_status
--    , @user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado_contacto ORDER BY id DESC LIMIT 2
-- ;
-- SELECT * FROM co_involucrado_contacto_history ORDER BY id DESC LIMIT 2
-- ;
