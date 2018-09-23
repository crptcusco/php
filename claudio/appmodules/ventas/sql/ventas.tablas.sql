
DROP TABLE IF EXISTS ve_persona_estado;
CREATE TABLE ve_persona_estado (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_importante;
CREATE TABLE ve_importante (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_vendedor_rol;
CREATE TABLE ve_vendedor_rol (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_estado;
CREATE TABLE ve_estado (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_servicio_tipo;
CREATE TABLE ve_servicio_tipo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
	parent_id BIGINT,
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_codigo;
CREATE TABLE ve_codigo (
	codigo BIGINT NOT NULL
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_propuesta;
CREATE TABLE ve_propuesta (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	codigo BIGINT NULL DEFAULT 0,
	vendedor_id BIGINT,
	persona_tipo VARCHAR(10),
	persona_id BIGINT NOT NULL,
	-- visita
	estado_id BIGINT,
	contacto_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	hora INT,
	minuto INT,
	FOREIGN KEY (vendedor_id) REFERENCES co_vendedor(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_propuesta_history;
CREATE TABLE ve_propuesta_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	codigo BIGINT NULL DEFAULT 0,
	propuesta_id BIGINT,
	vendedor_id BIGINT,
	persona_tipo VARCHAR(10),
	persona_id BIGINT NOT NULL,
	-- visita
	estado_id BIGINT,
	contacto_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	hora INT,
	minuto INT,
	FOREIGN KEY (propuesta_id) REFERENCES ve_propuesta(id),
	FOREIGN KEY (vendedor_id) REFERENCES co_vendedor(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_propuesta_has_servicio_tipo;
CREATE TABLE ve_propuesta_has_servicio_tipo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	propuesta_id BIGINT,
	servicio_tipo_id BIGINT,
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_visita;
CREATE TABLE ve_visita (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	propuesta_id BIGINT,
	estado_id BIGINT,
	contacto_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	hora INT,
	minuto INT,
	departamento_id BIGINT NOT NULL,
	provincia_id BIGINT NOT NULL,
	distrito_id BIGINT NOT NULL,
	direccion TEXT,	
	observacion TEXT,
	FOREIGN KEY (propuesta_id) REFERENCES ve_propuesta(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ve_visita_history;
CREATE TABLE ve_visita_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	
	id BIGINT NOT NULL AUTO_INCREMENT,
	visita_id BIGINT,
	propuesta_id BIGINT,
	estado_id BIGINT,
	contacto_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	hora INT,
	minuto INT,
	departamento_id BIGINT NOT NULL,
	provincia_id BIGINT NOT NULL,
	distrito_id BIGINT NOT NULL,
	direccion TEXT,
	observacion TEXT,
	FOREIGN KEY (visita_id) REFERENCES ve_visita(id),
	FOREIGN KEY (propuesta_id) REFERENCES ve_propuesta(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;
