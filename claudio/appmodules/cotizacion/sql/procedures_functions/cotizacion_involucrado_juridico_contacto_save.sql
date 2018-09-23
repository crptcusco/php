-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP FUNCTION co_juridico_contacto_modal_save' AS 'MENSAJE'; 
DROP FUNCTION IF EXISTS co_juridico_contacto_modal_save;
SELECT 'CREATE FUNCTION co_juridico_contacto_modal_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE FUNCTION co_juridico_contacto_modal_save(
        in_id BIGINT -- necesario
      , in_juridica_id BIGINT
      , in_nombre VARCHAR(75)
      , in_cargo VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    ) RETURNS BIGINT
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_contacto(juridica_id, nombre, cargo, telefono, correo, info_create_user )
       VALUES(in_juridica_id, in_nombre, in_cargo, in_telefono, in_correo, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_contacto SET 
       juridica_id=in_juridica_id, nombre=in_nombre, cargo=in_cargo, 
       telefono=in_telefono, correo=in_correo, 
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_contacto_history(contacto_id, juridica_id, nombre, cargo, telefono, correo, info_status, info_create_user)
    VALUES(ou_id, in_juridica_id, in_nombre, in_cargo, in_telefono, in_correo, in_info_status, in_user_id)
    ; -- cambiar la primera columna
    RETURN ou_id; 
END $$
DELIMITER ;
-- ----------------------- input -------------------------
-- -- caso 1: nuevo vendedor 
-- SET @id=0,
--      @juridica_id = 1, @nombre = 'nombre', @cargo='cargo',
--      @telefono='telefono', @correo='correo',
--      @info_status=1, @user_id=1
-- ;
-- -- caso 2: editar vendedor 
-- SET @id=3,
--      @juridica_id = 2, @nombre = 'nombre2', @cargo='cargo2',
--      @telefono='telefono2', @correo='correo2',
--      @info_status=0, @user_id=1
-- ;
-- 
-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado_contacto
-- ;
-- SELECT * FROM co_involucrado_contacto_history
-- ;
-- SELECT 'SELECT co_juridico_contacto_modal_save' AS '---------------------------- MENSAJE ------------------------'
-- ;
-- SELECT co_juridico_contacto_modal_save (
--      @id,
--      @juridica_id, 
--      @nombre, 
--      @cargo,
--      @telefono, 
--      @correo,
--      @info_status,
--      @user_id
-- ) AS id
-- ;
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado_contacto
-- ;
-- SELECT * FROM co_involucrado_contacto_history
-- ;
