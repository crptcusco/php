SELECT 'DROP co_save' AS 'mensaje';
DROP FUNCTION IF EXISTS co_save;

SELECT 'CREATE co_save' AS 'mensaje';
DELIMITER $$ 

CREATE FUNCTION co_save (
      in_id BIGINT
    , in_actualizacion INT 
    , in_servicio_tipo_id BIGINT
    , in_estado_id BIGINT
    , in_fecha_solicitud TIMESTAMP
    , in_fecha_envio_cliente TIMESTAMP
    , in_fecha_finalizacion TIMESTAMP
    , in_vendedor_id BIGINT 
    , usuario_id INT
    ) RETURNS BIGINT 
BEGIN
	DECLARE pr_codigo BIGINT; 
	DECLARE ou_codigo BIGINT;
    	DECLARE pr_v1 BIGINT;
    	DECLARE pr_v2 BIGINT;
	-- para modulo de ventas
	SELECT vendedor_id INTO pr_v1
	FROM co_cotizacion 
	WHERE id=in_id
	;
	SET pr_v2 = in_vendedor_id
	;
	IF pr_v1 != pr_v2 AND pr_v2 != 2 AND pr_v2 != 0  THEN
	   UPDATE co_involucrado_juridica j 
	   JOIN co_involucrado i ON i.persona_id = j.id
	   SET vendedor_id = pr_v2
	   WHERE i.cotizacion_id = in_id AND i.persona_tipo='Juridica' AND i.rol_id=1
	   ;
	   UPDATE co_involucrado_natural n 
	   JOIN co_involucrado i ON i.persona_id = n.id
	   SET vendedor_id = pr_v2
	   WHERE i.cotizacion_id = in_id AND i.persona_tipo='Natural' AND i.rol_id=1
	   ;   
	END IF
	;
	SELECT codigo INTO pr_codigo 
        FROM co_cotizacion WHERE id=in_id
	;
	IF pr_codigo=0 THEN 
	   SELECT codigo INTO ou_codigo 
	   FROM co_codigo
	   ;           
	   SET ou_codigo = ou_codigo + 1
           ;
	   UPDATE co_codigo SET codigo = ou_codigo
	   ;
	   UPDATE co_cotizacion SET 
	     codigo = ou_codigo
	   , actualizacion = in_actualizacion
	   , servicio_tipo_id = in_servicio_tipo_id
	   , estado_id = in_estado_id
	   , fecha_solicitud = in_fecha_solicitud
	   , fecha_envio_cliente = in_fecha_envio_cliente
	   , fecha_finalizacion = in_fecha_finalizacion
	   , info_create_user = usuario_id
	   , vendedor_id = in_vendedor_id
	   WHERE id=in_id
	   ;
	ELSE
	   SELECT codigo INTO ou_codigo
	   FROM co_cotizacion
	   WHERE id=in_id
	   ;
	   UPDATE co_cotizacion SET 
	     actualizacion = in_actualizacion
	   , servicio_tipo_id = in_servicio_tipo_id
	   , estado_id = in_estado_id
	   , fecha_solicitud = in_fecha_solicitud
	   , fecha_envio_cliente = in_fecha_envio_cliente
	   , fecha_finalizacion = in_fecha_finalizacion
	   , info_update_user = usuario_id
	   , vendedor_id = in_vendedor_id
	   WHERE id=in_id
	   ;
	END IF
        ;
	RETURN ou_codigo;
END$$ 
DELIMITER ;

-- SET @id=363, @actualizacion = 1
--    , @servicio_tipo = 2, @estado = 1
--    , @fecha_solicitud = '2015-02-04', @fecha_envio_cliente ='2015-02-04', @fecha_finalizacion='2015-02-04'
--    , @vendedor_id=1
--    , @usuario_id = 1; 

-- SELECT 'ANTES ' AS 'mensaje';
-- SELECT * FROM co_cotizacion
-- WHERE id=@id
-- ;

-- SELECT 'SELECT co_save' AS 'mensaje';
-- SELECT co_save(
--        @id, @actualizacion, @servicio_tipo, @estado, 
--        @fecha_solicitud, @fecha_envio_cliente, @fecha_finalizacion, @vendedor_id,
--        @usuario_id
--        ) AS codigo;

-- SELECT 'DESPUES ' AS 'mensaje';
-- SELECT * FROM co_cotizacion
-- WHERE id=@id
-- ;
