SELECT 'DROP ve_propuesta_save' AS 'mensaje';
DROP FUNCTION IF EXISTS ve_propuesta_save;

SELECT 'CREATE ve_propuesta_save' AS 'mensaje';
DELIMITER $$ 

CREATE FUNCTION ve_propuesta_save (
      in_id BIGINT
    , in_persona_tipo VARCHAR(10)
    , in_persona_id BIGINT
    , usuario_id INT
    ) RETURNS BIGINT 
BEGIN
	DECLARE pr_codigo BIGINT; 
	DECLARE ou_codigo BIGINT;

	SELECT codigo INTO pr_codigo 
        FROM ve_propuesta WHERE id=in_id
	;
	IF pr_codigo=0 THEN 
	   SELECT codigo INTO ou_codigo 
	   FROM ve_codigo
	   ;           
	   SET ou_codigo = ou_codigo + 1
           ;
	   UPDATE ve_codigo SET codigo = ou_codigo
	   ;
	   UPDATE ve_propuesta SET 
	     codigo = ou_codigo
	   , persona_tipo=in_persona_tipo
	   , persona_id=in_persona_id
	   , info_create_user = usuario_id
	   WHERE id=in_id
	   ;
	ELSE
	   SELECT codigo INTO ou_codigo
	   FROM ve_propuesta
	   WHERE id=in_id
	   ;
	   UPDATE ve_propuesta SET
	     persona_tipo=in_persona_tipo
	   , persona_id=in_persona_id
	   , info_update_user = usuario_id
	   WHERE id=in_id
	   ;
	END IF
        ;
	RETURN ou_codigo;
END$$ 
DELIMITER ;

-- SET   @id=2
--     , @persona_tipo='Natural'
--     , @persona_id=9
--     , @usuario_id=8
--     ; 
-- SELECT 'ANTES ' AS 'mensaje';
-- SELECT * FROM ve_propuesta
-- WHERE id=@id
-- ;

-- SELECT 'SELECT ve_propuesta_save' AS 'mensaje';
-- SELECT ve_propuesta_save(
--       @id
--     , @persona_tipo
--     , @persona_id
--     , @usuario_id
-- ) AS codigo
-- ;

-- SELECT 'DESPUES ' AS 'mensaje';
-- SELECT * FROM ve_propuesta
-- WHERE id=@id
-- ;
