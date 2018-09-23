DELIMITER ;;
DROP FUNCTION IF EXISTS `co_bien_inmueble_save` ;;

CREATE FUNCTION `co_bien_inmueble_save`(
        in_id BIGINT
      , in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_departamento_id BIGINT
      , in_provincia_id BIGINT
      , in_distrito_id BIGINT
      , in_direccion TEXT
      , in_descripcion TEXT
      , in_user_id INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE ultimo_mueble INT;
    DECLARE ultimo_inmueble INT;
    DECLARE ultimo_mazivo INT;
    DECLARE ultimo INT;
    IF in_id = 0 THEN
       SELECT MAX(orden) INTO ultimo_mueble
       FROM co_bien_mueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mueble IS NULL THEN
       	  SET ultimo_mueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_inmueble
       FROM co_bien_inmueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_inmueble IS NULL THEN
       	  SET ultimo_inmueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_mazivo
       FROM co_bien_mazivo
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mazivo IS NULL THEN
       	  SET ultimo_mazivo = 0;
       END IF
       ;
       IF ultimo_mueble>=ultimo_inmueble AND ultimo_mueble>=ultimo_mazivo  THEN 
       	  SET ultimo = ultimo_mueble;
       ELSEIF ultimo_inmueble>=ultimo_mueble AND ultimo_inmueble>=ultimo_mazivo THEN
    	  SET ultimo = ultimo_inmueble;
       ELSEIF ultimo_mazivo>=ultimo_mueble AND ultimo_mazivo>=ultimo_inmueble THEN
    	  SET ultimo = ultimo_mazivo;
       END IF
       ;
       INSERT INTO co_bien_inmueble(cotizacion_id, sub_categoria_id, departamento_id, provincia_id, distrito_id, direccion, descripcion, orden, info_create_user)
       VALUES(in_cotizacion_id, in_sub_categoria_id, in_departamento_id, in_provincia_id, in_distrito_id, in_direccion, in_descripcion, ultimo+1, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_inmueble SET 
         cotizacion_id=in_cotizacion_id, sub_categoria_id=in_sub_categoria_id
       , departamento_id=in_departamento_id, provincia_id=in_provincia_id
       , distrito_id=in_distrito_id, direccion=in_direccion, descripcion=in_descripcion
       , info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_inmueble_history(inmueble_id, cotizacion_id, sub_categoria_id, departamento_id, provincia_id, distrito_id, direccion, descripcion, info_create_user)
    VALUES(ou_id, in_cotizacion_id, in_sub_categoria_id, in_departamento_id, in_provincia_id, in_distrito_id, in_direccion, in_descripcion, in_user_id)
    ;
    RETURN ou_id;
END ;;

DROP FUNCTION IF EXISTS `co_bien_marca_save` ;;

CREATE FUNCTION `co_bien_marca_save`(
        in_tipo_id BIGINT 
      , in_marca_id BIGINT
      , in_sub_categoria_id  BIGINT
      , in_nombre  VARCHAR(150)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_marca_id BIGINT;
    IF in_marca_id=0 THEN
       SELECT (MAX(marca_id) + 1) INTO ou_marca_id FROM co_bien_muebles_clasificacion
       WHERE tipo_id=in_tipo_id AND modelo_id=0
       ;
       INSERT INTO co_bien_muebles_clasificacion(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_create_user )
       VALUES(in_tipo_id, ou_marca_id, 0, in_sub_categoria_id, in_nombre, in_user_id)
       ; 
    ELSE
       SET ou_marca_id = in_marca_id;
       UPDATE co_bien_muebles_clasificacion SET 
       sub_categoria_id=in_sub_categoria_id, nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE tipo_id=in_tipo_id AND marca_id=in_marca_id AND modelo_id=0
       ; 
    END IF
    ;
    INSERT INTO co_bien_muebles_clasificacion_history(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_status, info_create_user )
    VALUES(in_tipo_id, ou_marca_id, 0, in_sub_categoria_id, in_nombre, in_info_status, in_user_id)
    ; 
    RETURN ou_marca_id; 
END ;;

DROP FUNCTION IF EXISTS `co_bien_mazivo_save` ;;

CREATE FUNCTION `co_bien_mazivo_save`(
      in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_id BIGINT
      , in_descripcion TEXT
      , in_direccion TEXT
      , in_user_id INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE ultimo_mueble INT;
    DECLARE ultimo_inmueble INT;
    DECLARE ultimo_mazivo INT;
    DECLARE ultimo INT;
    IF in_id = 0 THEN
        SELECT MAX(orden) INTO ultimo_mueble
    	FROM co_bien_mueble
	WHERE cotizacion_id=in_cotizacion_id
    	;
    	IF ultimo_mueble IS NULL THEN
       	   SET ultimo_mueble = 0;
    	END IF
	;
    	SELECT MAX(orden) INTO ultimo_inmueble
    	FROM co_bien_inmueble
    	WHERE cotizacion_id=in_cotizacion_id
    	;
    	IF ultimo_inmueble IS NULL THEN
       	   SET ultimo_inmueble = 0;
   	END IF
    	;
    	SELECT MAX(orden) INTO ultimo_mazivo
    	FROM co_bien_mazivo
    	WHERE cotizacion_id=in_cotizacion_id
    	;
    	IF ultimo_mazivo IS NULL THEN
      	SET ultimo_mazivo = 0;
    	END IF
    	;
    	IF ultimo_mueble>=ultimo_inmueble AND ultimo_mueble>=ultimo_mazivo  THEN 
       	   SET ultimo = ultimo_mueble;
    	ELSEIF ultimo_inmueble>=ultimo_mueble AND ultimo_inmueble>=ultimo_mazivo THEN
       	   SET ultimo = ultimo_inmueble;
    	ELSEIF ultimo_mazivo>=ultimo_mueble AND ultimo_mazivo>=ultimo_inmueble THEN
       	   SET ultimo = ultimo_mazivo;
    	END IF
    	;
    	INSERT INTO co_bien_mazivo(cotizacion_id, sub_categoria_id, direccion, descripcion, orden, info_create_user)
    	VALUES(in_cotizacion_id, in_sub_categoria_id, in_direccion, in_descripcion, ultimo+1, in_user_id)
    	;
    	SELECT last_insert_id() INTO ou_id;
    ELSE
	UPDATE co_bien_mazivo
	SET  direccion=in_direccion
           , descripcion=in_descripcion
           , info_update_user=in_user_id
	WHERE id = in_id
	;
	SET ou_id = in_id;
    END IF
    ;
    RETURN ou_id;
END ;;

DROP FUNCTION IF EXISTS `co_bien_modelo_save` ;;

CREATE FUNCTION `co_bien_modelo_save`(
        in_tipo_id BIGINT 
      , in_marca_id BIGINT
      , in_modelo_id BIGINT
      , in_sub_categoria_id  BIGINT
      , in_nombre  VARCHAR(150)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_modelo_id BIGINT;
    IF in_modelo_id=0 THEN
       SELECT (MAX(modelo_id) + 1) INTO ou_modelo_id FROM co_bien_muebles_clasificacion
       WHERE tipo_id=in_tipo_id AND marca_id=in_marca_id
       ;
       INSERT INTO co_bien_muebles_clasificacion(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_create_user )
       VALUES(in_tipo_id, in_marca_id, ou_modelo_id, in_sub_categoria_id, in_nombre, in_user_id)
       ; 
    ELSE
       SET ou_modelo_id = in_modelo_id;
       UPDATE co_bien_muebles_clasificacion SET 
       sub_categoria_id=in_sub_categoria_id, nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE tipo_id=in_tipo_id AND marca_id=in_marca_id AND modelo_id=in_modelo_id
       ; 
    END IF
    ;
    INSERT INTO co_bien_muebles_clasificacion_history(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_status, info_create_user )
    VALUES(in_tipo_id, in_marca_id, ou_modelo_id, in_sub_categoria_id, in_nombre, in_info_status, in_user_id)
    ; 
    RETURN ou_modelo_id; 
END ;;

DROP FUNCTION IF EXISTS `co_bien_mueble_save` ;;

CREATE FUNCTION `co_bien_mueble_save`(
        in_id BIGINT
      , in_cotizacion_id BIGINT
      , in_sub_categoria_id BIGINT
      , in_tipo_id BIGINT
      , in_marca_id BIGINT
      , in_modelo_id BIGINT
      , in_descripcion VARCHAR(150)
      , in_user_id INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE ultimo_mueble INT;
    DECLARE ultimo_inmueble INT;
    DECLARE ultimo_mazivo INT;
    DECLARE ultimo INT;
    IF in_id = 0 THEN
       SELECT MAX(orden) INTO ultimo_mueble
       FROM co_bien_mueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mueble IS NULL THEN
       	  SET ultimo_mueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_inmueble
       FROM co_bien_inmueble
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_inmueble IS NULL THEN
       	  SET ultimo_inmueble = 0;
       END IF
       ;
       SELECT MAX(orden) INTO ultimo_mazivo
       FROM co_bien_mazivo
       WHERE cotizacion_id=in_cotizacion_id
       ;
       IF ultimo_mazivo IS NULL THEN
       	  SET ultimo_mazivo = 0;
       END IF
       ;
       IF ultimo_mueble>=ultimo_inmueble AND ultimo_mueble>=ultimo_mazivo  THEN 
       	  SET ultimo = ultimo_mueble;
       ELSEIF ultimo_inmueble>=ultimo_mueble AND ultimo_inmueble>=ultimo_mazivo THEN
 	  SET ultimo = ultimo_inmueble;
       ELSEIF ultimo_mazivo>=ultimo_mueble AND ultimo_mazivo>=ultimo_inmueble THEN
 	  SET ultimo = ultimo_mazivo;
       END IF
       ;
       INSERT INTO co_bien_mueble(cotizacion_id, sub_categoria_id, tipo_id, marca_id, modelo_id, descripcion, orden, info_create_user)
       VALUES(in_cotizacion_id, in_sub_categoria_id, in_tipo_id, in_marca_id, in_modelo_id, in_descripcion, ultimo+1, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_mueble SET 
         cotizacion_id=in_cotizacion_id, sub_categoria_id=in_sub_categoria_id
       , tipo_id=in_tipo_id, marca_id=in_marca_id, modelo_id=in_modelo_id
       , descripcion=in_descripcion   
       , info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_mueble_history(mueble_id, cotizacion_id, sub_categoria_id, tipo_id, marca_id, modelo_id, descripcion, info_create_user)
    VALUES(ou_id, in_cotizacion_id, in_sub_categoria_id, in_tipo_id, in_marca_id, in_modelo_id, in_descripcion, in_user_id)
    ;
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_bien_tipo_save` ;;

CREATE FUNCTION `co_bien_tipo_save`(
        in_tipo_id BIGINT 
      , in_sub_categoria_id  BIGINT
      , in_nombre  VARCHAR(150)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_tipo_id BIGINT;
    IF in_tipo_id=0 THEN
       SELECT (MAX(tipo_id) + 1) INTO ou_tipo_id FROM co_bien_muebles_clasificacion
       WHERE marca_id=0 AND modelo_id=0
       ;
       INSERT INTO co_bien_muebles_clasificacion(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_create_user )
       VALUES(ou_tipo_id, 0, 0, in_sub_categoria_id, in_nombre, in_user_id)
       ; 
    ELSE
       SET ou_tipo_id = in_tipo_id;
       UPDATE co_bien_muebles_clasificacion SET 
       sub_categoria_id=in_sub_categoria_id, nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE tipo_id=in_tipo_id AND marca_id=0 AND modelo_id=0
       ; 
    END IF
    ;
    INSERT INTO co_bien_muebles_clasificacion_history(tipo_id, marca_id, modelo_id, sub_categoria_id, nombre, info_status, info_create_user )
    VALUES(ou_tipo_id, 0, 0, in_sub_categoria_id, in_nombre, in_info_status, in_user_id)
    ; 
    RETURN ou_tipo_id; 
END ;;

DROP FUNCTION IF EXISTS `co_involucrado_juridico_actividad_save` ;;

CREATE FUNCTION `co_involucrado_juridico_actividad_save`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)		
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_actividad(nombre, info_create_user )
       VALUES(in_nombre, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_actividad SET 
       nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_actividad_history(actividad_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre,in_info_status, in_user_id)
    ; 
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_involucrado_juridico_clasificacion_save` ;;

CREATE FUNCTION `co_involucrado_juridico_clasificacion_save`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)		
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_clasificacion(nombre, info_create_user )
       VALUES(in_nombre, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_clasificacion SET 
       nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_clasificacion_history(clasificacion_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre,in_info_status, in_user_id)
    ; 
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_involucrado_juridico_grupo_save` ;;

CREATE FUNCTION `co_involucrado_juridico_grupo_save`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)		
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado_grupo(nombre, info_create_user )
       VALUES(in_nombre, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_grupo SET 
       nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_grupo_history(grupo_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre,in_info_status, in_user_id)
    ; 
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_juridico_contacto_modal_save` ;;

CREATE FUNCTION `co_juridico_contacto_modal_save`(
        in_id BIGINT 
      , in_juridica_id BIGINT
      , in_nombre VARCHAR(75)
      , in_cargo VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
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
    ; 
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_juridico_modal_save` ;;

CREATE FUNCTION `co_juridico_modal_save`(
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
    ) RETURNS bigint(20)
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
END ;;

DROP FUNCTION IF EXISTS `co_mensaje_nuevo` ;;

CREATE FUNCTION `co_mensaje_nuevo`(
      in_cotizacion_id BIGINT
      , in_estado_id BIGINT
      , in_mensaje TEXT
      , in_fecha_proxima TIMESTAMP
      , in_proxima TINYINT
      , in_info_create_user INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    INSERT INTO co_mensaje (cotizacion_id, estado_id, mensaje, fecha_proxima, proxima, info_create_user)
    VALUES (in_cotizacion_id, in_estado_id, in_mensaje, in_fecha_proxima, in_proxima, in_info_create_user)
    ;
    SELECT last_insert_id() into ou_id;
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_montos_perito_modal_save` ;;

CREATE FUNCTION `co_montos_perito_modal_save`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_perito(nombre, telefono, correo, info_create_user )
       VALUES(in_nombre, in_telefono, in_correo, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_perito SET 
       nombre=in_nombre, telefono=in_telefono, correo=in_correo,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_perito_history(perito_id, nombre, telefono, correo, info_status, info_create_user )
    VALUES(ou_id, in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
    ;
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_monto_nuevo` ;;

CREATE FUNCTION `co_monto_nuevo`(
      in_cotizacion_id BIGINT
      , in_monto DECIMAL(22,5)
      , in_igv_si VARCHAR(10)
      , in_igv DECIMAL(9,5)
      , in_total DECIMAL(24,5)
      , in_moneda_id BIGINT
      , in_cambio DECIMAL(9,5)
      , in_fecha TIMESTAMP
      , in_id_user INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_igv_si = 'false' THEN
       SET in_igv=0;
    END IF
    ; 
    IF in_moneda_id = 1 THEN
       SET in_cambio = 1;
    END IF
    ; 
    INSERT INTO co_pago (cotizacion_id, monto, igv, total, moneda_id, cambio, fecha, info_create_user)
    VALUES (in_cotizacion_id, in_monto, in_igv, in_total, in_moneda_id, in_cambio, in_fecha, in_id_user)
    ; 
    SELECT last_insert_id() INTO ou_id
    ; 
    IF in_igv_si != 'false' THEN
       UPDATE co_igv SET monto=in_igv;
    END IF
    ; 
    IF in_moneda_id != 1 THEN
       UPDATE co_moneda SET monto=in_cambio
       WHERE id = in_moneda_id;
    END IF
    ; 
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_nuevo` ;;

CREATE FUNCTION `co_nuevo`(
      in_info_create_user INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    INSERT INTO co_cotizacion (info_create_user)
    VALUES (in_info_create_user)
    ;
    SELECT last_insert_id() into ou_id
    ;
    INSERT INTO co_pago (cotizacion_id, info_create_user,
    total_igv, total_igv_de, total_monto, total_monto_igv,
    total_cambio, total_moneda_id
    )
    VALUES (ou_id, in_info_create_user, 
    0.18, 'sin', 0, 0,
    1.0, 1
    );
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_save` ;;

CREATE  FUNCTION `co_save`(
      in_id BIGINT
    , in_actualizacion INT 
    , in_tipo_cotizacion_id INT(12)
    , in_desglose_id INT(12)
    , in_servicio_tipo_id BIGINT
    , in_estado_id BIGINT
    , in_fecha_solicitud TIMESTAMP
    , in_fecha_envio_cliente TIMESTAMP
    , in_fecha_finalizacion TIMESTAMP
    , in_vendedor_id BIGINT 
    , usuario_id INT
    ) RETURNS bigint(20)
BEGIN
	DECLARE pr_codigo BIGINT; 
	DECLARE ou_codigo BIGINT;
    	DECLARE pr_v1 BIGINT;
    	DECLARE pr_v2 BIGINT;
	
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
           , tipo_cotizacion_id = in_tipo_cotizacion_id
           , desglose_id = in_desglose_id
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
           , tipo_cotizacion_id = in_tipo_cotizacion_id
           , desglose_id = in_desglose_id
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
END ;;

DROP FUNCTION IF EXISTS `co_tipo_servicio_insert` ;;

CREATE FUNCTION `co_tipo_servicio_insert`(
        in_nombre VARCHAR(45)
      , in_info_status INT
      , in_info_create_user INT
    ) RETURNS int(11)
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
END ;;

DROP FUNCTION IF EXISTS `co_tipo_servicio_update` ;;

CREATE FUNCTION `co_tipo_servicio_update`(
        in_id BIGINT
      , in_nombre VARCHAR(45)
      , in_info_status INT
      , in_info_update_user INT
    ) RETURNS bigint(20)
BEGIN
    UPDATE co_servicio_tipo 
    SET nombre=in_nombre, info_status=in_info_status, info_update_user=in_info_update_user 
    WHERE id=in_id
    ;
    INSERT INTO co_servicio_tipo_history (servicio_tipo_id, nombre,info_status, info_create_user)
    VALUES (in_id, in_nombre, in_info_status, in_info_update_user)
    ;
    RETURN in_id; 
END ;;

DROP FUNCTION IF EXISTS `co_vendedor_involucrado_natural_save` ;;

CREATE FUNCTION `co_vendedor_involucrado_natural_save`(
        in_id BIGINT
      , in_nombre VARCHAR(75)
      , in_documento_tipo_id BIGINT
      , in_documento VARCHAR(25)
      , in_direccion VARCHAR(150)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT
      , in_user_id INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id = 0 THEN
       INSERT INTO co_involucrado_natural (id, nombre, documento_tipo_id, documento, direccion, telefono, correo, info_status, info_create_user)
       VALUES(in_id, in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_involucrado_natural SET nombre=in_nombre, documento_tipo_id=in_documento_tipo_id, documento=in_documento, direccion=in_direccion, telefono=in_telefono, correo=in_correo, info_status=in_info_status, info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_involucrado_natural_history (natural_id, nombre, documento_tipo_id, documento, direccion, telefono, correo, info_status, info_create_user)
    VALUES (ou_id, in_nombre, in_documento_tipo_id, in_documento, in_direccion, in_telefono, in_correo, in_info_status, in_user_id)
    ;
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `co_vendedor_save` ;;

CREATE FUNCTION `co_vendedor_save`(
      in_accion VARCHAR(10)
      , in_id BIGINT
      , in_nombre VARCHAR(75)
      , in_telefono VARCHAR(75)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT
      , in_user_id INT
    ) RETURNS bigint(20)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_accion = 'add' THEN
       INSERT INTO co_vendedor (nombre, telefono, correo, info_status, info_create_user)
       VALUES(in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSEIF in_accion = 'edit' THEN
       UPDATE co_vendedor SET nombre=in_nombre, telefono=in_telefono, 
       correo=in_correo, info_update=NOW() , info_update_user=in_user_id, info_status=in_info_status
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    IF in_accion = 'add' || in_accion = 'edit' THEN
       INSERT INTO co_vendedor_history (vendedor_id, nombre, telefono, correo, info_status, info_create_user)
       VALUES (ou_id, in_nombre, in_telefono, in_correo, in_info_status, in_user_id)
       ;
    END IF
    ;
    RETURN ou_id; 
END ;;

DROP FUNCTION IF EXISTS `ve_contacto_delete` ;;

CREATE FUNCTION `ve_contacto_delete`(
  in_contacto_id BIGINT
, in_user_id BIGINT
) RETURNS tinyint(4)
BEGIN
    DECLARE pr_user_id TINYINT
    ;
    SELECT info_create_user INTO pr_user_id
    FROM co_involucrado_contacto
    WHERE id = in_contacto_id
    ;
    IF in_user_id = pr_user_id THEN
        UPDATE co_involucrado_contacto SET
	info_status=0
	WHERE id = in_contacto_id
	;
        RETURN 1;
    ELSE
	RETURN 0;
    END IF
    ;
    RETURN ou_id;
END ;;

DROP FUNCTION IF EXISTS `ve_propuesta_save` ;;

CREATE FUNCTION `ve_propuesta_save`(
      in_id BIGINT
    , in_persona_tipo VARCHAR(10)
    , in_persona_id BIGINT
    , usuario_id INT
    ) RETURNS bigint(20)
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
END ;;

DROP PROCEDURE IF EXISTS `coor_asignadoConsultorDesdeItem` ;;

CREATE PROCEDURE `coor_asignadoConsultorDesdeItem`(
  in_id BIGINT
, in_consultor_id BIGINT
, in_info_update VARCHAR(40)
, in_user_id INT 
    )
BEGIN
   UPDATE coor_informe SET
     info_update=in_info_update
   , info_update_user=in_user_id
   , programador_id=in_user_id
   , consultor_id=in_consultor_id
   WHERE id=in_id
   ;
   INSERT INTO coor_informe_history
    (informe_id, programador_id, consultor_id, info_create_user, info_create)
   VALUES(in_id, in_user_id, in_consultor_id, in_user_id, in_info_update)
   ;
   UPDATE coor_coordinacion c
   JOIN coor_informe i ON i.coordinacion_id=c.id
   SET c.info_update=in_info_update,
       c.info_update2=in_info_update
   WHERE i.id=in_id
   ;
   SELECT 
   i.programador_id, p.full_name programador_nombre, 
   i.consultor_id,   c.full_name consultor_nombre
   FROM coor_informe i
   LEFT JOIN login_user p ON p.id=i.programador_id
   LEFT JOIN login_user c ON c.id=i.consultor_id
   WHERE i.id=in_id
   ;
END ;;

DROP PROCEDURE IF EXISTS `coor_asistencia_item_update` ;;

CREATE PROCEDURE `coor_asistencia_item_update`(
  in_id BIGINT 
, in_perito_id BIGINT
, in_inspector_id BIGINT
, in_contactos TEXT
, in_fecha TEXT
, in_hora_estimada CHAR(11)
, in_hora_estimada_mostrar TINYINT
, in_hora_real CHAR(5)
, in_hora_real_mostrar TINYINT
, in_departamento_id BIGINT
, in_provincia_id BIGINT
, in_distrito_id BIGINT
, in_direccion TEXT
, in_user_rol VARCHAR(100)
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  IF in_user_rol='Coordinador' THEN
     UPDATE coor_inspeccion SET
       info_update=in_info_update
     , perito_id=in_perito_id
     , inspector_id=in_inspector_id
     , contactos=in_contactos
     , fecha=in_fecha
     , hora_estimada=in_hora_estimada
     , hora_estimada_mostrar=in_hora_estimada_mostrar
     , hora_real=in_hora_real
     , hora_real_mostrar=in_hora_real_mostrar
     , departamento_id=in_departamento_id
     , provincia_id=in_provincia_id
     , distrito_id=in_distrito_id
     , direccion=in_direccion
     , info_update_user=in_user_id
     WHERE id=in_id
     ;  
  END IF
  ;
  INSERT INTO coor_inspeccion_history(
    info_create
  , inspeccion_id
  , perito_id
  , inspector_id
  , contactos
  , fecha
  , hora_estimada
  , hora_estimada_mostrar
  , hora_real
  , hora_real_mostrar
  , departamento_id
  , provincia_id
  , distrito_id
  , direccion
  , info_create_user
  )
  VALUES(
    in_info_update
  , in_id
  , in_perito_id
  , in_inspector_id
  , in_contactos
  , in_fecha
  , in_hora_estimada
  , in_hora_estimada_mostrar
  , in_hora_real
  , in_hora_real_mostrar
  , in_departamento_id
  , in_provincia_id
  , in_distrito_id
  , in_direccion
  , in_user_id    
  )
  ;
  SELECT
    ins.id
  , ins.estado_id
  , est.nombre estado_nombre
  , ins.perito_id
  , per.full_name perito_nombre
  , ins.inspector_id
  , pec.full_name inspector_nombre    
  , ins.contactos
  , ins.fecha
  , ins.hora_estimada
  , ins.hora_estimada_mostrar
  , ins.hora_real
  , ins.hora_real_mostrar
  , ins.departamento_id
  , dep.nombre departamento_nombre
  , ins.provincia_id
  , pro.nombre provincia_nombre
  , ins.distrito_id
  , dis.nombre distrito_nombre
  , ins.direccion
  FROM coor_inspeccion ins
  LEFT JOIN login_user per ON per.id=ins.perito_id
  LEFT JOIN login_user pec ON pec.id=ins.inspector_id
  LEFT JOIN coor_inspeccion_estado est ON est.id=ins.estado_id
  LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=ins.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
  LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=ins.departamento_id AND pro.provincia_id=ins.provincia_id AND pro.distrito_id=0
  LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=ins.departamento_id AND dis.provincia_id=ins.provincia_id AND dis.distrito_id=ins.distrito_id
  WHERE ins.informe_id=in_id
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_cambio_add_edit` ;;

CREATE PROCEDURE `coor_cambio_add_edit`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_coordinacion_tipo_cambio(nombre, info_status, info_create_user)
       VALUES(in_nombre, in_info_status, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_coordinacion_tipo_cambio SET 
       nombre=in_nombre,
       info_status=in_info_status,
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_coordinacion_tipo_cambio_history(tipo_cambio_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre, in_info_status, in_user_id)
    ;     
END ;;

DROP PROCEDURE IF EXISTS `coor_contacto_save` ;;

CREATE PROCEDURE `coor_contacto_save`(
        in_id BIGINT 
      , in_persona_id BIGINT
      , in_persona_tipo VARCHAR(20)
      , in_nombre VARCHAR(75)
      , in_cargo VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_persona_tipo='Juridica' THEN
       IF in_id=0 THEN
          INSERT INTO co_involucrado_contacto(juridica_id, nombre, cargo, telefono, correo, info_create_user )
          VALUES(in_persona_id, in_nombre, in_cargo, in_telefono, in_correo, in_user_id)
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
    ELSEIF in_persona_tipo='Natural' THEN
       IF in_id=0 THEN
          INSERT INTO co_involucrado_contacto(natural_id, nombre, cargo, telefono, correo, info_create_user )
          VALUES(in_persona_id, in_nombre, in_cargo, in_telefono, in_correo, in_user_id)
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
    END IF;
END ;;

DROP PROCEDURE IF EXISTS `coor_coordinacion_estado` ;;

CREATE PROCEDURE `coor_coordinacion_estado`(
  in_id BIGINT
, in_estado_id BIGINT
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  
  DECLARE pr_codigo BIGINT;
  IF in_estado_id=2 THEN
     SELECT codigo INTO pr_codigo
     FROM coor_coordinacion
     WHERE id=in_id
     ;
     IF pr_codigo = 0 THEN
        SELECT codigo INTO pr_codigo
        FROM coor_codigo LIMIT 1
        ;
        SET pr_codigo = pr_codigo + 1
        ;
        UPDATE coor_codigo SET codigo = pr_codigo
        ;
        UPDATE coor_coordinacion SET codigo = pr_codigo
        WHERE id = in_id
        ;
     END IF
     ;
  END IF
  ;
  UPDATE coor_coordinacion 
  SET estado_id = in_estado_id
  , info_update = in_info_update
  , info_update2= in_info_update
  , info_update_user = in_user_id
  WHERE id = in_id
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_coordinacion_new` ;;

CREATE PROCEDURE `coor_coordinacion_new`(
  in_cotizacion_codigo BIGINT
, in_solicitante_fecha TIMESTAMP
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  
  DECLARE pr_correlativo BIGINT;
  DECLARE pr_cotizacion_id BIGINT;
  DECLARE pr_servicio_tipo_id BIGINT;  
  DECLARE pr_solicitante_persona_id BIGINT;
  DECLARE pr_solicitante_persona_tipo VARCHAR(20);
  DECLARE pr_solicitante_contacto_id BIGINT;
  DECLARE pr_cliente_persona_id BIGINT;
  DECLARE pr_cliente_persona_tipo VARCHAR(20); 
  DECLARE pr_coordinacion_id BIGINT;
  DECLARE pr_informe_id BIGINT;
  DECLARE pr_inspeccion_id BIGINT;
  
  SELECT id, servicio_tipo_id INTO pr_cotizacion_id, pr_servicio_tipo_id FROM co_cotizacion
  WHERE codigo=in_cotizacion_codigo
  ;
  SELECT correlativo INTO pr_correlativo FROM coor_cotizacion_correlativo
  WHERE cotizacion_id=pr_cotizacion_id
  ;
  IF pr_correlativo IS NULL THEN    
    SET pr_correlativo=1;
    INSERT INTO coor_cotizacion_correlativo(cotizacion_id, correlativo)
    VALUES (pr_cotizacion_id, 0)
    ;
  ELSE
    SET pr_correlativo=pr_correlativo+1;
  END IF
  ;  
  SELECT i.persona_tipo, i.persona_id, i.contacto_id INTO
  pr_solicitante_persona_tipo, pr_solicitante_persona_id, pr_solicitante_contacto_id
  FROM co_involucrado i
  JOIN co_cotizacion co ON co.id=i.cotizacion_id
  WHERE co.codigo=in_cotizacion_codigo AND i.rol_id=2
  LIMIT 1
  ;
  IF pr_solicitante_persona_tipo IS NULL THEN
     SET pr_solicitante_persona_tipo = '';
  END IF
  ;
  IF pr_solicitante_persona_id IS NULL THEN
     SET pr_solicitante_persona_id = 0;
  END IF
  ;
  IF pr_solicitante_contacto_id IS NULL THEN
     SET pr_solicitante_contacto_id = 0;
  END IF
  ;
  SELECT i.persona_tipo, i.persona_id INTO
  pr_cliente_persona_tipo, pr_cliente_persona_id
  FROM co_involucrado i
  JOIN co_cotizacion co ON co.id=i.cotizacion_id
  WHERE co.codigo=in_cotizacion_codigo AND i.rol_id=1
  LIMIT 1
  ;
  IF pr_cliente_persona_tipo IS NULL THEN
     SET pr_cliente_persona_tipo = '';
  END IF
  ;
  IF pr_cliente_persona_id IS NULL THEN
     SET pr_cliente_persona_id = 0;
  END IF
  ;
  INSERT INTO coor_coordinacion (
  info_update, info_update2,
  coordinador_id, cotizacion_id, cotizacion_correlativo, tipo_id, estado_id,
  solicitante_persona_tipo, solicitante_persona_id, solicitante_contacto_id,
  solicitante_fecha,
  cliente_persona_tipo, cliente_persona_id,
  tipo2_id
  )
  VALUES (
  in_info_update, in_info_update,
  in_user_id, pr_cotizacion_id, pr_correlativo, 1, 1, 
  pr_solicitante_persona_tipo, pr_solicitante_persona_id, pr_solicitante_contacto_id,
  in_solicitante_fecha,
  pr_cliente_persona_tipo, pr_cliente_persona_id,
  pr_servicio_tipo_id
  )
  ;
  SELECT last_insert_id() INTO pr_coordinacion_id
  ;
  UPDATE coor_cotizacion_correlativo SET correlativo=pr_correlativo
  WHERE cotizacion_id=pr_cotizacion_id
  ;
  
  INSERT INTO coor_informe(coordinacion_id, info_update, estado_id)
  VALUES(pr_coordinacion_id, in_info_update, 1)
  ;
  SELECT last_insert_id() INTO pr_informe_id
  ;
  
  INSERT INTO coor_inspeccion
  ( informe_id, info_update, estado_id, hora_estimada, hora_real, departamento_id, provincia_id, distrito_id)
  VALUES( pr_informe_id, in_info_update, 1, '00:00-00:00', '00:00', 15, 1, 1)
  ;
  SELECT last_insert_id() INTO pr_inspeccion_id
  ;
  SELECT pr_inspeccion_id
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_coordinacion_save` ;;

CREATE PROCEDURE `coor_coordinacion_save`(
  in_id BIGINT
, in_estado_id BIGINT
, in_modalidad_id BIGINT
, in_tipo_id BIGINT
, in_tipo2_id BIGINT
, in_tipo_cambio_id BIGINT
, in_solicitante_persona_tipo VARCHAR(20)
, in_solicitante_persona_id BIGINT
, in_solicitante_contacto_id BIGINT
, in_solicitante_fecha TIMESTAMP
, in_cliente_persona_tipo VARCHAR(20)
, in_cliente_persona_id BIGINT
, in_sucursal TEXT
, in_observacion TEXT
, in_info_update VARCHAR(40)
, in_user_id INT
)
BEGIN
  
  DECLARE pr_codigo BIGINT;
  IF in_estado_id=2 THEN
     SELECT codigo INTO pr_codigo
     FROM coor_coordinacion
     WHERE id=in_id
     ;
     IF pr_codigo = 0 THEN
        SELECT codigo INTO pr_codigo
        FROM coor_codigo LIMIT 1
        ;
        SET pr_codigo = pr_codigo + 1
        ;
        UPDATE coor_codigo SET codigo = pr_codigo
        ;
     END IF
     ;
  ELSE
     SET pr_codigo = 0;
  END IF
  ;
  UPDATE coor_coordinacion SET
    info_update=in_info_update
  , info_update2=in_info_update
  , estado_id=in_estado_id
  , codigo=pr_codigo
  , modalidad_id=in_modalidad_id
  , tipo_id=in_tipo_id
  , tipo2_id=in_tipo2_id
  , tipo_cambio_id=in_tipo_cambio_id
  , solicitante_persona_tipo=in_solicitante_persona_tipo
  , solicitante_persona_id=in_solicitante_persona_id
  , solicitante_contacto_id=in_solicitante_contacto_id
  , solicitante_fecha=in_solicitante_fecha
  , cliente_persona_tipo=in_cliente_persona_tipo
  , cliente_persona_id=in_cliente_persona_id
  , sucursal=in_sucursal
  , observacion=in_observacion
  , info_update_user=in_user_id
  , coordinador_id=in_user_id
  WHERE id=in_id
  ;
  INSERT coor_coordinacion_history (
    info_update
  , coordinacion_id
  , codigo
  , estado_id
  , modalidad_id
  , tipo_id
  , tipo2_id
  , tipo_cambio_id
  , solicitante_persona_tipo
  , solicitante_persona_id
  , solicitante_contacto_id
  , solicitante_fecha
  , cliente_persona_tipo
  , cliente_persona_id
  , sucursal
  , observacion
  , coordinador_id
  , info_create_user
  )
  VALUES (
    in_info_update
  , in_id
  , pr_codigo
  , in_estado_id
  , in_modalidad_id
  , in_tipo_id
  , in_tipo2_id
  , in_tipo_cambio_id
  , in_solicitante_persona_tipo
  , in_solicitante_persona_id
  , in_solicitante_contacto_id
  , in_solicitante_fecha
  , in_cliente_persona_tipo
  , in_cliente_persona_id
  , in_sucursal
  , in_observacion
  , in_user_id
  , in_user_id
  )
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_informe_documentacion_save` ;;

CREATE PROCEDURE `coor_informe_documentacion_save`(
  in_id BIGINT
, in_informe_id BIGINT
, in_enlace TEXT
, in_descripcion TEXT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_documentacion(informe_id, enlace, descripcion, info_create_user)
       VALUES(in_informe_id, in_enlace, in_descripcion, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_documentacion SET
       informe_id=in_informe_id, enlace=in_enlace, descripcion=in_descripcion, 
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_documentacion_history
    (documentacion_id, informe_id, enlace, descripcion, info_create_user)
    VALUES(ou_id, in_informe_id, in_enlace, in_descripcion, in_user_id)
    ;
    SELECT id, enlace, descripcion 
    FROM coor_informe_documentacion
    WHERE id=ou_id
    ;
END ;;

DROP PROCEDURE IF EXISTS `coor_informe_fechasDeEntrega_save` ;;

CREATE PROCEDURE `coor_informe_fechasDeEntrega_save`(
  in_id BIGINT
, in_informe_id BIGINT
, in_fecha TIMESTAMP
, in_tipo_id BIGINT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_entrega(informe_id, fecha, tipo_id, info_create_user)
       VALUES(in_informe_id, in_fecha, in_tipo_id, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_entrega SET
       informe_id=in_informe_id, fecha=in_fecha, tipo_id=in_tipo_id,
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_entrega_history(entrega_id, informe_id, fecha, tipo_id, info_create_user)
    VALUES(ou_id, in_informe_id, in_fecha, in_tipo_id, in_user_id)
    ;
    SELECT e.id, e.fecha, e.tipo_id, t.nombre tipo_nombre
    FROM coor_informe_entrega e
    LEFT JOIN coor_informe_entrega_tipo t ON t.id=e.tipo_id
    WHERE e.id=ou_id
    ;
END ;;

DROP PROCEDURE IF EXISTS `coor_informe_firma_save` ;;

CREATE PROCEDURE `coor_informe_firma_save`(
  in_id BIGINT
, in_informe_id BIGINT
, in_firmante_id BIGINT
, in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_informe_firma(informe_id, firmante_id, info_create_user)
       VALUES(in_informe_id, in_firmante_id, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_informe_firma SET
       informe_id=in_informe_id, firmante_id=in_firmante_id, 
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_informe_firma_history
    (firma_id, informe_id, firmante_id, info_create_user)
    VALUES(ou_id, in_informe_id, in_firmante_id, in_user_id)
    ;
    SELECT f.id, f.firmante_id, u.full_name firmante_nombre 
    FROM coor_informe_firma f
    JOIN login_user u ON u.id=f.firmante_id
    WHERE f.id=ou_id
    ;
END ;;

DROP PROCEDURE IF EXISTS `coor_informe_item_save` ;;

CREATE PROCEDURE `coor_informe_item_save`(
  in_informe_id BIGINT
, in_ruta TEXT
, in_user_id INT
)
BEGIN
  UPDATE coor_informe SET
  ruta=in_ruta, info_update_user=in_user_id
  WHERE id=in_informe_id
  ;
  INSERT INTO coor_informe_history(informe_id, ruta, info_create_user)
  VALUES(in_informe_id, in_ruta, in_user_id)
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_modalidad_add_edit` ;;

CREATE PROCEDURE `coor_modalidad_add_edit`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO coor_coordinacion_modalidad(nombre, info_create_user)
       VALUES(in_nombre, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE coor_coordinacion_modalidad SET 
       nombre=in_nombre,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO coor_coordinacion_modalidad_history(modalidad_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre, in_info_status, in_user_id)
    ;     
END ;;

DROP PROCEDURE IF EXISTS `coor_persona_add_to_coordinacion` ;;

CREATE PROCEDURE `coor_persona_add_to_coordinacion`(
  in_persona_id BIGINT
, in_cotizacion_id BIGINT
, in_persona_tipo VARCHAR(20)
, in_persona_rol_id BIGINT
, in_user_id INT 
    )
BEGIN
  DECLARE pr_cnt BIGINT;
  SELECT COUNT(id) INTO pr_cnt FROM co_involucrado
  WHERE cotizacion_id=in_cotizacion_id AND persona_tipo=in_persona_tipo 
    AND persona_id=in_persona_id AND rol_id=in_persona_rol_id
  ;
  IF pr_cnt = 0 THEN
     INSERT INTO co_involucrado(cotizacion_id, persona_tipo, persona_id, rol_id, info_create_user)
     VALUES (in_cotizacion_id, in_persona_tipo, in_persona_id, in_persona_rol_id, in_user_id)
     ;
  END IF
  ;
END ;;

DROP PROCEDURE IF EXISTS `coor_tipo2_add_edit` ;;

CREATE PROCEDURE `coor_tipo2_add_edit`(
        in_id BIGINT 
      , in_nombre VARCHAR(75)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_servicio_tipo(nombre, info_status, info_create_user)
       VALUES(in_nombre, in_info_status, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_servicio_tipo SET 
       nombre=in_nombre,
       info_status=in_info_status,
       info_update_user=in_user_id 
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_servicio_tipo_history(servicio_tipo_id, nombre, info_status, info_create_user)
    VALUES(ou_id, in_nombre, in_info_status, in_user_id)
    ;     
END ;;

DROP PROCEDURE IF EXISTS `co_bien_inmueble_modal` ;;

CREATE PROCEDURE `co_bien_inmueble_modal`(
        in_id BIGINT 
      , in_nombre VARCHAR(50)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_bien_sub_categoria(nombre, categoria_id, info_create_user )
       VALUES(in_nombre, 2, in_user_id)
       ; 
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE co_bien_sub_categoria SET 
       nombre=in_nombre, categoria_id=2,
       info_status=in_info_status, info_update_user=in_user_id 
       WHERE id=in_id
       ; 
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO co_bien_sub_categoria_history(sub_categoria_id, nombre, categoria_id, info_status, info_create_user)
    VALUES(ou_id, in_nombre, 2, in_info_status, in_user_id)
    ; 
    
    SELECT id,nombre,info_status FROM co_bien_sub_categoria
    WHERE id=ou_id
    ;
END ;;

DROP PROCEDURE IF EXISTS `co_igv_update_pp` ;;

CREATE PROCEDURE `co_igv_update_pp`(
      in_cotizacion_id BIGINT
      , in_igv DECIMAL(9,5)
    )
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE pr_monto  decimal(22,5);
   DECLARE pr_igv DECIMAL(9,5);
   DECLARE pr_id BIGINT;
   DECLARE cur1 CURSOR FOR SELECT pp.id, pp.monto, pp.igv FROM co_pago_has_perito pp
                                JOIN co_pago p ON p.id=pp.pago_id
                                WHERE p.cotizacion_id = in_cotizacion_id;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
   UPDATE co_igv SET monto = in_igv ;
   OPEN cur1;
   read_loop: LOOP
     FETCH cur1 INTO pr_id, pr_monto, pr_igv;
     IF done THEN
       LEAVE read_loop;
     END IF;
     IF pr_igv != 0 THEN
       UPDATE co_pago_has_perito SET total = pr_monto * (in_igv +1) , igv = in_igv WHERE id=pr_id;
     END IF;
   END LOOP;
   CLOSE cur1;
END ;;

DROP PROCEDURE IF EXISTS `co_involucrado_save` ;;

CREATE PROCEDURE `co_involucrado_save`(
        in_id BIGINT 
      , in_cotizacion_id BIGINT
      , in_rol_id BIGINT
      , in_persona_tipo VARCHAR(10)
      , in_persona_id BIGINT
      , in_contacto_id BIGINT
      , in_info_status TINYINT(1) 
      , in_user_id INT 
    )
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_v1 BIGINT;
    DECLARE pr_v2 BIGINT;
    IF in_id=0 THEN
       INSERT INTO co_involucrado(cotizacion_id, rol_id, persona_tipo, persona_id, contacto_id, info_status, info_create_user )
       VALUES(in_cotizacion_id, in_rol_id, in_persona_tipo, in_persona_id, in_contacto_id, in_info_status, in_user_id)
       ; 
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
       ; 
       SET ou_id = in_id;
    END IF
    ;
    
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
END ;;

DROP PROCEDURE IF EXISTS `cursor_01_tmp` ;;

CREATE PROCEDURE `cursor_01_tmp`()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE pr_juridica_id, pr_vendedor_id BIGINT;
  DECLARE cur1 CURSOR FOR 
  SELECT j.id juridica_id, c.vendedor_id 
  FROM co_involucrado i
  JOIN co_cotizacion c ON c.id=i.cotizacion_id
  JOIN co_involucrado_juridica j ON j.id=i.persona_id
  WHERE j.vendedor_id=0 AND i.persona_tipo='Juridica' AND i.rol_id=1
  ORDER BY 1
  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  OPEN cur1;
  read_loop: LOOP
    FETCH cur1 INTO pr_juridica_id, pr_vendedor_id;
    IF done THEN
      LEAVE read_loop;
    END IF
    ;
    UPDATE  co_involucrado_juridica SET vendedor_id=pr_vendedor_id 
    WHERE id=pr_juridica_id
    ;
  END LOOP
  ;
  CLOSE cur1;
END ;;

DROP PROCEDURE IF EXISTS `cursor_02_tmp` ;;

CREATE PROCEDURE `cursor_02_tmp`()
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE pr_natural_id, pr_vendedor_id BIGINT;
  DECLARE cur1 CURSOR FOR 
  SELECT n.id natural_id, c.vendedor_id
  FROM co_involucrado i
  JOIN co_cotizacion c ON c.id=i.cotizacion_id
  JOIN co_involucrado_natural n ON n.id=i.persona_id
  WHERE n.vendedor_id=0 AND i.persona_tipo='Natural' AND i.rol_id=1
  ORDER BY 1
  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
  OPEN cur1;
  read_loop: LOOP
    FETCH cur1 INTO pr_natural_id, pr_vendedor_id;
    IF done THEN
      LEAVE read_loop;
    END IF
    ;
    UPDATE  co_involucrado_natural SET vendedor_id=pr_vendedor_id 
    WHERE id=pr_natural_id
    ;
  END LOOP
  ;
  CLOSE cur1;
END ;;

DROP PROCEDURE IF EXISTS `ve_contacto_modal_save` ;;

CREATE PROCEDURE `ve_contacto_modal_save`(
        in_id BIGINT 
      , in_persona_id BIGINT
      , in_persona_tipo VARCHAR(75)
      , in_nombre VARCHAR(75)
      , in_cargo VARCHAR(75)
      , in_telefono VARCHAR(100)
      , in_correo VARCHAR(100)
      , in_info_status TINYINT(1) 
      , in_user_id INT 
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
END ;;

DROP PROCEDURE IF EXISTS `ve_juridico_modal_save` ;;

CREATE PROCEDURE `ve_juridico_modal_save`(
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
END ;;

DROP PROCEDURE IF EXISTS `ve_natural_modal_save` ;;

CREATE PROCEDURE `ve_natural_modal_save`(
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
END ;;

DROP PROCEDURE IF EXISTS `ve_nuevo` ;;

CREATE PROCEDURE `ve_nuevo`(
      in_user INT
    )
BEGIN
    DECLARE pr_id BIGINT;
    DECLARE pr_vendedor_id BIGINT
    ;
    SELECT id INTO pr_vendedor_id
    FROM co_vendedor WHERE user_id = in_user
    ;
    INSERT INTO ve_propuesta (info_create_user, vendedor_id)
    VALUES (in_user, pr_vendedor_id)
    ;
    SELECT last_insert_id() into pr_id
    ;
    SELECT pr.id
         , ve.id vendedor_id
         , ve.nombre vendedor_nombre
	 , ve.rol_id
    FROM ve_propuesta pr
    LEFT JOIN co_vendedor ve ON ve.id=pr.vendedor_id
    WHERE pr.id = pr_id
    ;
END ;;

DROP PROCEDURE IF EXISTS `ve_vendedor_modal_save` ;;

CREATE PROCEDURE `ve_vendedor_modal_save`(
  in_id bigint
, in_nombre VARCHAR(75)
, in_telefono VARCHAR(75)
, in_correo VARCHAR(100)
, in_rol_id BIGINT
, in_info_status TINYINT(1)
, in_user_id BIGINT
, in_login VARCHAR(75)
, in_pass VARCHAR(45)
, in_pass_pregunta VARCHAR(45)
)
BEGIN
	DECLARE ou_id BIGINT;
	DECLARE pr_parent_id BIGINT;
	DECLARE pr_user_id BIGINT;
	DECLARE hs_id BIGINT;
	IF in_rol_id = 2 THEN
	   IF in_id = 0 THEN
	      SET pr_user_id = in_user_id;
	      SET pr_parent_id = in_user_id
	      ;
	      INSERT INTO login_user(full_name, login, pass)
	      VALUES (in_nombre, in_login, in_pass)
	      ;
	      SELECT last_insert_id() INTO pr_user_id
	      ;
	      INSERT INTO login_user_has_profile(user_id, profile_id)
	      VALUES (pr_user_id, 5)
	      ;
	      INSERT INTO co_vendedor( nombre, telefono, correo, rol_id, parent_id, user_id, info_create_user )
	      VALUES ( in_nombre, in_telefono, in_correo, 3, pr_parent_id, pr_user_id, in_user_id )
	      ;
	      SELECT last_insert_id() INTO ou_id
	      ;
	      INSERT INTO co_vendedor_history( vendedor_id, nombre, telefono, correo, rol_id, parent_id, user_id, info_create_user )
	      VALUES ( ou_id, in_nombre, in_telefono, in_correo, 3, pr_parent_id, pr_user_id, in_user_id )
	      ;
	   ELSE
	      SET ou_id = in_id;
	      SELECT user_id INTO pr_user_id
	      FROM co_vendedor
	      WHERE id=in_id
	      ;	      
	      UPDATE  co_vendedor SET
	      nombre=in_nombre, telefono=in_telefono, correo=in_correo,
	      info_status=in_info_status, info_update_user=in_user_id
	      WHERE id=in_id
	      ;
	      INSERT INTO co_vendedor_history( vendedor_id, nombre, telefono, correo, info_create_user )
	      VALUES ( in_id, in_nombre, in_telefono, in_correo, in_user_id )
	      ;
	      IF in_pass_pregunta='true' THEN
	      	 UPDATE login_user SET
		 full_name=in_nombre, login=in_login, pass=in_pass
		 WHERE id=pr_user_id
		 ;
	      END IF
	      ;
	      IF in_pass_pregunta='false' THEN
	      	 UPDATE login_user SET
		 full_name=in_nombre, login=in_login
		 WHERE id=pr_user_id
		 ;
	      END IF
	      ;
	   END IF
	   ;
	ELSE
	   SET ou_id = in_id;
	   SELECT user_id INTO pr_user_id
	   FROM co_vendedor
	   WHERE id=in_id
	   ;	      
	   UPDATE  co_vendedor SET
	   nombre=in_nombre, telefono=in_telefono, correo=in_correo, 
	   info_status=in_info_status, info_update_user=in_user_id
	   WHERE id=in_id
	   ;
	   INSERT INTO co_vendedor_history( vendedor_id, nombre, telefono, correo, info_create_user )
	   VALUES ( in_id, in_nombre, in_telefono, in_correo, in_user_id )
	   ;	   
	   IF in_pass_pregunta='true' THEN
	      UPDATE  login_user SET
	      full_name=in_nombre, login=in_login, pass=in_pass
	      WHERE id=pr_user_id
	      ;
	   END IF
	   ;
	   IF in_pass_pregunta='false' THEN
	      UPDATE  login_user SET
	      full_name=in_nombre, login=in_login
	      WHERE id=pr_user_id
	      ;
	   END IF
	   ;
	END IF
	;
	SELECT v.id, v.nombre, v.telefono, v.correo, v.info_status, u.login
	FROM co_vendedor v
	JOIN login_user u ON u.id=v.user_id
	WHERE v.id=ou_id
	;
END ;;

DROP PROCEDURE IF EXISTS `ve_visita_delete` ;;

CREATE PROCEDURE `ve_visita_delete`(
  in_propuesta_id BIGINT
, in_visita_id BIGINT
    )
BEGIN
    DECLARE pr_estado_id BIGINT;
    DECLARE pr_contacto_id BIGINT;
    DECLARE pr_fecha TIMESTAMP;
    DECLARE pr_hora INT;
    DECLARE pr_minuto INT;
    DECLARE pr_visita_id BIGINT;
    UPDATE ve_visita SET info_status=0
    WHERE id= in_visita_id
    ;
    SELECT visita_id INTO pr_visita_id FROM ve_propuesta
    WHERE id=in_propuesta_id
    ;
    IF pr_visita_id = in_visita_id THEN
       SELECT id, estado_id, contacto_id, fecha, hora, minuto
       INTO pr_visita_id, pr_estado_id, pr_contacto_id, pr_fecha, pr_hora, pr_minuto
       FROM ve_visita WHERE propuesta_id=in_propuesta_id and info_status!=0 
       ORDER BY id DESC LIMIT 1
       ;
       UPDATE ve_propuesta SET
       estado_id=pr_estado_id, contacto_id=pr_contacto_id, 
       fecha=pr_fecha, hora=pr_hora, minuto=pr_minuto,
       visita_id=pr_visita_id
       WHERE id=in_propuesta_id
       ;
    END IF
    ;
END ;;

DROP PROCEDURE IF EXISTS `ve_visita_modal_save` ;;

CREATE PROCEDURE `ve_visita_modal_save`(
  in_id BIGINT
, in_propuesta_id BIGINT
, in_estado_id BIGINT
, in_contacto_id BIGINT
, in_fecha TIMESTAMP
, in_hora  INT
, in_minuto INT
, in_departamento_id BIGINT
, in_provincia_id BIGINT
, in_distrito_id BIGINT
, in_direccion TEXT
, in_observacion TEXT
, in_user_id INT
    )
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_visita_id BIGINT;
    IF in_id = 0 THEN
       INSERT INTO ve_visita (propuesta_id, estado_id, contacto_id, 
                              fecha, hora, minuto,
                              departamento_id, provincia_id, distrito_id, 
                              direccion, observacion,
                              info_create_user)
       VALUES(in_propuesta_id, in_estado_id, in_contacto_id, 
              in_fecha, in_hora, in_minuto, 
              in_departamento_id, in_provincia_id, in_distrito_id, 
              in_direccion, in_observacion, 
              in_user_id)
       ;
       SELECT last_insert_id() INTO ou_id;
    ELSE
       UPDATE ve_visita SET
         propuesta_id=in_propuesta_id, estado_id=in_estado_id, contacto_id=in_contacto_id, 
         fecha=in_fecha, hora=in_hora, minuto=in_minuto,
         departamento_id=in_departamento_id, provincia_id=in_provincia_id, distrito_id=in_distrito_id, 
         direccion=in_direccion, observacion=in_observacion,
         info_update_user=in_user_id
       WHERE id=in_id
       ;
       SET ou_id = in_id;
    END IF
    ;
    INSERT INTO ve_visita_history (visita_id, propuesta_id, estado_id, contacto_id, 
                           fecha, hora, minuto,
                           departamento_id, provincia_id, distrito_id, 
                           direccion, observacion,
                           info_create_user)
    VALUES(ou_id, in_propuesta_id, in_estado_id, in_contacto_id, 
           in_fecha, in_hora, in_minuto, 
           in_departamento_id, in_provincia_id, in_distrito_id, 
           in_direccion, in_observacion, 
           in_user_id)
    ;
    SELECT visita_id INTO pr_visita_id FROM ve_propuesta
    WHERE id=in_propuesta_id
    ;    
    IF in_id = 0 OR in_id = pr_visita_id THEN
       UPDATE ve_propuesta SET
       estado_id=in_estado_id, contacto_id=in_contacto_id, 
       fecha=in_fecha, hora=in_hora, minuto=in_minuto,
       visita_id=ou_id
       WHERE id=in_propuesta_id
       ;
    END IF
    ;
    SELECT
      vi.id
    , vi.estado_id
    , es.nombre estado_nombre
    , vi.contacto_id
    , co.nombre contacto_nombre
    , vi.fecha
    , vi.hora
    , vi.minuto
    , vi.departamento_id
    , dep.nombre departamento_nombre
    , vi.provincia_id
    , pro.nombre provincia_nombre
    , vi.distrito_id
    , dis.nombre distrito_nombre
    , vi.direccion
    , vi.observacion
    FROM ve_visita vi
    LEFT JOIN ve_estado es ON es.id=vi.estado_id
    LEFT JOIN co_involucrado_contacto co ON co.id=vi.contacto_id
    LEFT JOIN co_bien_inmuebles_ubigeo dep ON (dep.departamento_id=vi.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0)
    LEFT JOIN co_bien_inmuebles_ubigeo pro ON (pro.departamento_id=vi.departamento_id AND pro.provincia_id=vi.provincia_id AND pro.distrito_id=0)
    LEFT JOIN co_bien_inmuebles_ubigeo dis ON (dis.departamento_id=vi.departamento_id AND dis.provincia_id=vi.provincia_id AND dis.distrito_id=vi.distrito_id)
    WHERE vi.id=ou_id
    ;
END ;;

DELIMITER ;
