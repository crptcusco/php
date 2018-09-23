DROP TABLE IF EXISTS coor_rol;
CREATE TABLE coor_rol (
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL DEFAULT '',
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_rol_has_user;
CREATE TABLE coor_rol_has_user (
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	rol_id BIGINT NOT NULL,
	user_id BIGINT NOT NULL,
	--
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_codigo;
CREATE TABLE coor_codigo (
	codigo BIGINT NOT NULL
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_cotizacion_correlativo;
CREATE TABLE coor_cotizacion_correlativo (
	cotizacion_id BIGINT NOT NULL,
	correlativo INT NOT NULL DEFAULT 0,
	--	
	PRIMARY KEY (cotizacion_id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_estado;
CREATE TABLE coor_coordinacion_estado (
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_modalidad;
CREATE TABLE coor_coordinacion_modalidad (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_modalidad_history;
CREATE TABLE coor_coordinacion_modalidad_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	modalidad_id BIGINT NOT NULL,
	nombre VARCHAR(300) NULL,
	--
	FOREIGN KEY (modalidad_id) REFERENCES coor_coordinacion_modalidad(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_tipo;
CREATE TABLE coor_coordinacion_tipo (
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_tipo2;
CREATE TABLE coor_coordinacion_tipo2 (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_tipo2_history;
CREATE TABLE coor_coordinacion_tipo2_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	tipo2_id BIGINT NOT NULL,
	nombre VARCHAR(300) NULL,
	--
	FOREIGN KEY (tipo2_id) REFERENCES coor_coordinacion_tipo2(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_tipo_cambio;
CREATE TABLE coor_coordinacion_tipo_cambio (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;
DROP TABLE IF EXISTS coor_coordinacion_tipo_cambio_history;
CREATE TABLE coor_coordinacion_tipo_cambio_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	tipo_cambio_id BIGINT NOT NULL,
	nombre VARCHAR(300) NULL,
	--
	FOREIGN KEY (tipo_cambio_id) REFERENCES coor_coordinacion_tipo_cambio(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion;
CREATE TABLE coor_coordinacion (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
        info_update2 TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--	
	id BIGINT NOT NULL AUTO_INCREMENT,
	codigo BIGINT NULL DEFAULT 0,
	estado_id BIGINT NOT NULL DEFAULT 0,
	modalidad_id BIGINT NOT NULL DEFAULT 0,
	tipo_id BIGINT NOT NULL DEFAULT 0,
        tipo2_id BIGINT NOT NULL DEFAULT 0,
	coordinador_id BIGINT NOT NULL DEFAULT 0,
	cotizacion_id BIGINT NOT NULL DEFAULT 0,
	cotizacion_correlativo INT NULL DEFAULT 0,
	solicitante_persona_tipo VARCHAR(20),
	solicitante_persona_id BIGINT NOT NULL DEFAULT 0,
	solicitante_contacto_id BIGINT NOT NULL DEFAULT 0,
	solicitante_fecha TIMESTAMP,
        entrega_por_operaciones_fecha TIMESTAMP,
        entrega_al_cliente_fecha TIMESTAMP,
	cliente_persona_tipo VARCHAR(20),
	cliente_persona_id BIGINT NOT NULL DEFAULT 0,
	sucursal TEXT DEFAULT '',
	observacion TEXT DEFAULT '',
        tipo_cambio_id BIGINT NOT NULL DEFAULT 0,
        impreso TINYINT NOT NULL DEFAULT 0,
	--
	FOREIGN KEY (estado_id) REFERENCES coor_coordinacion_estado(id),
	FOREIGN KEY (modalidad_id) REFERENCES coor_coordinacion_modalidad(id),
	FOREIGN KEY (tipo_id)  REFERENCES coor_coordinacion_tipo(id),
        FOREIGN KEY (tipo2_id) REFERENCES co_servicio_tipo(id),
        FOREIGN KEY (tipo_cambio_id) REFERENCES coor_coordinacion_tipo_cambio(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_coordinacion_servicio;
CREATE TABLE coor_coordinacion_servicio (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        coordinacion_id BIGINT NOT NULL DEFAULT 0,
        servicio_id BIGINT NULL DEFAULT NULL,
        --
        FOREIGN KEY (coordinacion_id) REFERENCES coor_coordinacion(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

-- DROP TABLE IF EXISTS coor_inspeccion_rol;
-- CREATE TABLE coor_inspeccion_rol (
-- 	info_status TINYINT(1) DEFAULT 1,
-- 	--
-- 	id BIGINT NOT NULL AUTO_INCREMENT,
-- 	nombre VARCHAR(300),
-- 	PRIMARY KEY (id) 
-- ) ENGINE = MYISAM
-- ;

DROP TABLE IF EXISTS coor_inspeccion;
CREATE TABLE coor_inspeccion (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--	
	id BIGINT NOT NULL AUTO_INCREMENT,
	coordinacion_id BIGINT NOT NULL DEFAULT 0,
	perito_id BIGINT NOT NULL DEFAULT 0,
        inspector_id BIGINT NOT NULL DEFAULT 0,
	estado_id BIGINT NOT NULL DEFAULT 0,
	contactos TEXT NOT NULL DEFAULT '',
	fecha TIMESTAMP,
	hora_estimada CHAR(11) DEFAULT '00:00-00:00',
        hora_estimada_mostrar TINYINT DEFAULT 0,
	hora_real CHAR(5) DEFAULT '00:00',
        hora_real_mostrar TINYINT DEFAULT 0,
	departamento_id BIGINT NOT NULL DEFAULT 0,
	provincia_id BIGINT NOT NULL DEFAULT 0,
	distrito_id BIGINT NOT NULL DEFAULT 0,
	direccion TEXT,
        observacion TEXT,
        observacion_user_id TEXT,
	--
	FOREIGN KEY (coordinacion_id) REFERENCES coor_coordinacion(id),
	FOREIGN KEY (estado_id) REFERENCES coor_inspeccion_estado(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_inspeccion_history;
CREATE TABLE coor_inspeccion_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	--	
	id BIGINT NOT NULL AUTO_INCREMENT,
	inspeccion_id BIGINT NOT NULL DEFAULT 0,
	coordinacion_id BIGINT NOT NULL DEFAULT 0,
	perito_id BIGINT NOT NULL DEFAULT 0,
        inspector_id BIGINT NOT NULL DEFAULT 0,        
	estado_id BIGINT NOT NULL DEFAULT 0,
        contactos TEXT NOT NULL DEFAULT '',
	fecha TEXT,
	hora_estimada CHAR(11) DEFAULT '00:00-00:00',
        hora_estimada_mostrar TINYINT DEFAULT 0,
	hora_real CHAR(5) DEFAULT '00:00',
        hora_real_mostrar TINYINT DEFAULT 0,
	departamento_id BIGINT NOT NULL DEFAULT 0,
	provincia_id BIGINT NOT NULL DEFAULT 0,
	distrito_id BIGINT NOT NULL DEFAULT 0,
	direccion TEXT,
        observacion TEXT,
        observacion_user_id TEXT,
	--
	FOREIGN KEY (inspeccion_id) REFERENCES coor_inspeccion(id),
	FOREIGN KEY (estado_id) REFERENCES coor_inspeccion_estado(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS coor_inspeccion_observacion;
CREATE TABLE coor_inspeccion_observacion (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	--	
	id BIGINT NOT NULL AUTO_INCREMENT,        
	inspeccion_id BIGINT NOT NULL DEFAULT 0,
	user_id BIGINT NOT NULL DEFAULT 0,
        observacion TEXT,        
	--
	FOREIGN KEY (inspeccion_id) REFERENCES coor_inspeccion(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;
