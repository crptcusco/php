-- replazar nonmbre
-- probar solo paramentos y comentar todo

SELECT 'DROP PROCEDURE co_involucrado_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS co_involucrado_save;
SELECT 'CREATE PROCEDURE co_involucrado_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE PROCEDURE co_involucrado_save(
        in_id BIGINT -- necesario
      , in_cotizacion_id BIGINT
      , in_rol_id BIGINT
      , in_persona_tipo VARCHAR(10)
      , in_persona_id BIGINT
      , in_contacto_id BIGINT
      , in_info_status TINYINT(1) -- necesario
      , in_user_id INT -- necesario
    )
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_v1 BIGINT;
    DECLARE pr_v2 BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado(cotizacion_id, rol_id, persona_tipo, persona_id, contacto_id, info_status, info_create_user )
       VALUES(in_cotizacion_id, in_rol_id, in_persona_tipo, in_persona_id, in_contacto_id, in_info_status, in_user_id)
       ; -- añadir tabla y campos
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado SET 
         cotizacion_id=in_cotizacion_id
       , rol_id=in_rol_id
       , persona_tipo=in_persona_tipo
       , persona_id=in_persona_id
       , contacto_id=in_contacto_id
       , info_status=in_info_status
       , info_update_user=in_user_id 
       WHERE id=in_id
       ; -- añadir tabla y campos
       SET ou_id = in_id;
    END IF
    ;
    -- esto es para modulo de ventas
    IF in_rol_id = 1 THEN       
       SELECT vendedor_id INTO pr_v1 
       FROM co_cotizacion 
       WHERE id = in_cotizacion_id
       ;
       IF in_persona_tipo = 'Juridica' THEN
       	SELECT vendedor_id INTO pr_v2  
	FROM co_involucrado_juridica 
	WHERE id = in_persona_id
	;
	IF pr_v1 !=0 AND pr_v1 != pr_v2 AND pr_v1 != 2 THEN
	   UPDATE co_involucrado_juridica SET vendedor_id = pr_v1 
	   WHERE id = in_persona_id
	   ;
	END IF
	;
       END IF
       ;
       IF in_persona_tipo = 'Natural' THEN
       	SELECT vendedor_id INTO pr_v2  
	FROM co_involucrado_juridica 
	WHERE id = in_persona_id
	;
	IF pr_v1 !=0 AND pr_v1 != pr_v2 AND pr_v1 != 2 THEN
	   UPDATE co_involucrado_natural SET vendedor_id = pr_v1 
	   WHERE id = in_persona_id
	   ;
	END IF
	;
       END IF
       ;
    END IF
    ;
    -- mostrando info
    SELECT * FROM
    (
    SELECT 
    	   co_involucrado.id
         , co_involucrado.rol_id
    	 , co_involucrado_rol.nombre rol_nombre
    	 , co_involucrado.persona_tipo
    	 , co_involucrado.persona_id
    	 , co_involucrado.contacto_id
    	 , co_involucrado_natural.nombre persona_nombre
    	 , co_involucrado_natural.documento persona_documento
    	 , co_involucrado_natural.telefono persona_telefono
    	 , co_involucrado_natural.correo persona_correo
    FROM co_involucrado
    JOIN co_involucrado_rol ON co_involucrado_rol.id=co_involucrado.rol_id
    JOIN co_involucrado_natural on co_involucrado_natural.id= co_involucrado.persona_id
    WHERE
            co_involucrado.id = ou_id
        AND co_involucrado.persona_tipo = "Natural"
        AND co_involucrado.info_status = 1
    UNION
    SELECT 
    	   co_involucrado.id
    	 , co_involucrado.rol_id 
    	 , co_involucrado_rol.nombre rol_nombre
    	 , co_involucrado.persona_tipo
    	 , co_involucrado.persona_id
    	 , co_involucrado.contacto_id
    	 , IF(co_involucrado.contacto_id=0
    	   , CONCAT( co_involucrado_juridica.nombre, '_--| _--| _--|')
    	   , CONCAT( co_involucrado_juridica.nombre, '_--|', co_involucrado_contacto.nombre, '_--|', co_involucrado_contacto.cargo, '_--|')
    	 ) persona_nombre
    	 , co_involucrado_juridica.ruc persona_documento
    	 , co_involucrado_contacto.telefono persona_documento
    	 , co_involucrado_contacto.correo persona_documento
    FROM co_involucrado
    JOIN co_involucrado_rol ON co_involucrado_rol.id = co_involucrado.rol_id
    JOIN co_involucrado_juridica ON co_involucrado_juridica.id = co_involucrado.persona_id
    LEFT JOIN co_involucrado_contacto ON co_involucrado_contacto.id = co_involucrado.contacto_id
    WHERE
            co_involucrado.id = ou_id
        AND co_involucrado.persona_tipo = "Juridica"
    	AND co_involucrado.info_status = 1
    ) AS unica01
    ORDER BY 1
    ;
END $$
DELIMITER ;
-- -- ----------------------- input -------------------------
-- 
-- SET   @id=0
--     , @cotizacion_id=32
--     , @rol_id=1
--     , @persona_tipo='Juridica'
--     , @persona_id=2
--     , @contacto_id=0
--     , @info_status=1
--     , @user_id=2
-- ;
-- -- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM co_involucrado
-- WHERE cotizacion_id=@cotizacion_id
-- ;
-- SELECT 'CALL co_involucrado_save' AS '---------------------------- MENSAJE ------------------------';
-- CALL co_involucrado_save (
--       @id
--     , @cotizacion_id
--     , @rol_id
--     , @persona_tipo
--     , @persona_id
--     , @contacto_id
--     , @info_status
--     , @user_id
-- )
-- ; -- añdir campos
-- SELECT 'Despues' AS '------------------------- MENSAJE ----------------------------'
-- ;
-- SELECT * FROM co_involucrado
-- WHERE cotizacion_id=@cotizacion_id
-- ;
