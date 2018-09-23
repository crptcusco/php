SELECT '---------------------- Tables ---------------------- ' AS 'MENSAJE';
-- ----------------------------- ini general
DROP TABLE IF EXISTS co_servicio_tipo;
CREATE TABLE co_servicio_tipo (
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	PRIMARY KEY (id) 
)
;
DROP TABLE IF EXISTS co_servicio_tipo_history;
CREATE TABLE co_servicio_tipo_history (
	id BIGINT NOT NULL AUTO_INCREMENT,
	servicio_tipo_id BIGINT,
	FOREIGN KEY (servicio_tipo_id) REFERENCES  co_servicio_tipo(id),
	nombre VARCHAR(200) NULL,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	PRIMARY KEY (id) 
)
;
DROP TABLE IF EXISTS co_estado;
CREATE TABLE co_estado (
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(200) NULL,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	PRIMARY KEY (id) 
)
;
DROP TABLE IF EXISTS co_codigo;
CREATE TABLE co_codigo (
	codigo BIGINT NOT NULL
)
;

-- -------------------------------- end general
-- -------------------------------- ini involucrados

DROP TABLE IF EXISTS co_vendedor;
CREATE TABLE co_vendedor (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	telefono VARCHAR(75) NOT NULL,
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_vendedor_history;
CREATE TABLE co_vendedor_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	vendedor_id BIGINT,
	FOREIGN KEY (vendedor_id) REFERENCES  co_vendedor(id),
	nombre VARCHAR(75) NULL,
	telefono VARCHAR(75) NULL,
	correo VARCHAR(100) NULL,
	PRIMARY KEY (id)
)
;
-- -------------------------------- end involucrados
-- -------------------------------- ini cotizacion

DROP TABLE IF EXISTS co_cotizacion;
CREATE TABLE co_cotizacion (
	id BIGINT NOT NULL AUTO_INCREMENT,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	-- general
	codigo BIGINT NULL DEFAULT 0,
	actualizacion TINYINT(1),
	servicio_tipo_id BIGINT,
	estado_id BIGINT,
	adjunto TEXT NULL,
	FOREIGN KEY (servicio_tipo_id) REFERENCES  co_servicio_tipo(id),
	FOREIGN KEY (estado_id) REFERENCES  co_estado(id),
	-- fechas
	fecha_solicitud TIMESTAMP,
	fecha_envio_cliente TIMESTAMP,
	fecha_finalizacion TIMESTAMP,
	-- involucrados
	vendedor_id BIGINT,
	FOREIGN KEY (vendedor_id) REFERENCES  co_vendedor(id),
	PRIMARY KEY (id)
) 
;

-- -------------------------------- end cotizacion
-- -------------------------------- ini involucrado

DROP TABLE IF EXISTS co_involucrado_documento_tipo;
CREATE TABLE co_involucrado_documento_tipo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_documento_tipo_history;
CREATE TABLE co_involucrado_documento_tipo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	documento_tipo_id BIGINT,
	FOREIGN KEY (documento_tipo_id) REFERENCES  co_involucrado_documento_tipo(id),
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
);
DROP TABLE IF EXISTS co_involucrado_rol;
CREATE TABLE co_involucrado_rol (
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_clasificacion;
CREATE TABLE co_involucrado_clasificacion (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_clasificacion_history;
CREATE TABLE co_involucrado_clasificacion_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	clasificacion_id BIGINT,
	FOREIGN KEY (clasificacion_id) REFERENCES  co_involucrado_clasificacion(id),
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
);
DROP TABLE IF EXISTS co_involucrado_actividad;
CREATE TABLE co_involucrado_actividad (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_actividad_history;
CREATE TABLE co_involucrado_actividad_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	actividad_id BIGINT,
	FOREIGN KEY (actividad_id) REFERENCES  co_involucrado_actividad(id),
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
);
DROP TABLE IF EXISTS co_involucrado_grupo;
CREATE TABLE co_involucrado_grupo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_grupo_history;
CREATE TABLE co_involucrado_grupo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	grupo_id BIGINT,
	FOREIGN KEY (grupo_id) REFERENCES  co_involucrado_grupo(id),
	nombre VARCHAR(75) NOT NULL,
	PRIMARY KEY (id)
);
DROP TABLE IF EXISTS co_involucrado_natural;
CREATE TABLE co_involucrado_natural (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75) NOT NULL,
	documento_tipo_id BIGINT,
	FOREIGN KEY (documento_tipo_id) REFERENCES co_involucrado_documento_tipo(id),
	documento VARCHAR(25) NOT NULL,
	direccion VARCHAR(150) NOT NULL,
	telefono VARCHAR(100) NOT NULL,
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_natural_history;
CREATE TABLE co_involucrado_natural_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	natural_id BIGINT,
	FOREIGN KEY (natural_id) REFERENCES co_involucrado_natural(id),
	nombre VARCHAR(75) NOT NULL,
	documento_tipo_id BIGINT,
	FOREIGN KEY (documento_tipo_id) REFERENCES co_involucrado_documento_tipo(id),
	documento VARCHAR(25) NOT NULL,
	direccion VARCHAR(150) NOT NULL,
	telefono VARCHAR(100) NOT NULL,
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_juridica;
CREATE TABLE co_involucrado_juridica (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	clasificacion_id BIGINT,
	FOREIGN KEY (clasificacion_id) REFERENCES co_involucrado_clasificacion(id),
	actividad_id BIGINT,
	FOREIGN KEY (actividad_id) REFERENCES co_involucrado_actividad(id),
	grupo_id BIGINT,
	FOREIGN KEY (grupo_id) REFERENCES co_involucrado_grupo(id),
	nombre VARCHAR(75),
	ruc VARCHAR(25),
	direccion VARCHAR(150),
	telefono VARCHAR(100),
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_juridica_history;
CREATE TABLE co_involucrado_juridica_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	juridica_id BIGINT,
	FOREIGN KEY (juridica_id) REFERENCES co_involucrado_juridica(id),
	clasificacion_id BIGINT,
	FOREIGN KEY (clasificacion_id) REFERENCES co_involucrado_clasificacion(id),
	actividad_id BIGINT,
	FOREIGN KEY (actividad_id) REFERENCES co_involucrado_actividad(id),
	grupo_id BIGINT,
	FOREIGN KEY (grupo_id) REFERENCES co_involucrado_grupo(id),
	nombre VARCHAR(75),
	ruc VARCHAR(25),
	direccion VARCHAR(150),
	telefono VARCHAR(100),
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_contacto;
CREATE TABLE co_involucrado_contacto (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	juridica_id BIGINT,
	FOREIGN KEY (juridica_id) REFERENCES co_involucrado_juridica(id),
	nombre VARCHAR(75),
	cargo VARCHAR(75),
	telefono VARCHAR(100),
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado_contacto_history;
CREATE TABLE co_involucrado_contacto_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	contacto_id BIGINT,
	FOREIGN KEY (contacto_id) REFERENCES co_involucrado_contacto(id),
	juridica_id BIGINT,
	FOREIGN KEY (juridica_id) REFERENCES co_involucrado_juridica(id),
	nombre VARCHAR(75),
	cargo VARCHAR(75),
	telefono VARCHAR(100),
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_involucrado;
CREATE TABLE co_involucrado (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT,
	rol_id BIGINT,
	FOREIGN KEY (rol_id) REFERENCES co_involucrado_rol(id),
	persona_tipo VARCHAR(10),
	persona_id BIGINT NOT NULL,
	contacto_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	PRIMARY KEY (id)
)
;
-- -------------------------------- end involucrado
-- -------------------------------- ini mensajes

DROP TABLE IF EXISTS co_mensaje;
CREATE TABLE co_mensaje (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT NOT NULL,
	estado_id BIGINT NOT NULL,
	mensaje TEXT NULL,
	fecha_proxima TIMESTAMP,
	proxima TINYINT(1) ,
	FOREIGN KEY (estado_id) REFERENCES  co_estado(id)
		ON DELETE NO ACTION ON UPDATE NO ACTION,
	FOREIGN KEY (cotizacion_id) REFERENCES  co_cotizacion(id)
		ON DELETE NO ACTION ON UPDATE NO ACTION,
	PRIMARY KEY (id)
)
;
-- -------------------------------- end mensajes
-- -------------------------------- ini montos

DROP TABLE IF EXISTS co_igv;
CREATE TABLE co_igv (
       monto DECIMAL(9,5) NOT NULL
)
;
DROP TABLE IF EXISTS co_moneda;
CREATE TABLE co_moneda (
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(20) NOT NULL,
	simbolo VARCHAR(20) NOT NULL,
	monto DECIMAL(9,5) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_perito;
CREATE TABLE co_perito (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(75),
	telefono VARCHAR(100),
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_perito_history;
CREATE TABLE co_perito_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	perito_id BIGINT,
	FOREIGN KEY (perito_id) REFERENCES co_perito(id),
	nombre VARCHAR(75),
	telefono VARCHAR(100),
	correo VARCHAR(100) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_pago;
CREATE TABLE co_pago (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	-- 
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	total_igv DECIMAL(9,5),
	total_igv_de VARCHAR(30) DEFAULT 'sin',
	total_monto DECIMAL(22,5),
	total_monto_igv DECIMAL(22,5),
	total_cambio DECIMAL(9,5),
	total_moneda_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES  co_cotizacion(id)
		ON DELETE NO ACTION ON UPDATE NO ACTION,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_pago_history;
CREATE TABLE co_pago_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT,
	info_status TINYINT(1) DEFAULT 1,
	-- 
	id BIGINT NOT NULL AUTO_INCREMENT,
	pago_id BIGINT,
	FOREIGN KEY (pago_id) REFERENCES co_pago(id),
	cotizacion_id BIGINT NOT NULL,
	fecha TIMESTAMP,
	total_igv DECIMAL(9,5),
	total_igv_de VARCHAR(30) DEFAULT 'sin',
	total_monto DECIMAL(22,5),
	total_monto_igv DECIMAL(22,5),
	total_cambio DECIMAL(9,5),
	total_moneda_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES  co_cotizacion(id)
		ON DELETE NO ACTION ON UPDATE NO ACTION,
	PRIMARY KEY (id)
)
;
-- DROP TABLE IF EXISTS co_pago_has_perito;
-- CREATE TABLE co_pago_has_perito (
-- 	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
-- 	info_create_user INT ,
-- 	info_update TIMESTAMP,
-- 	info_update_user INT,
-- 	info_status TINYINT(1) DEFAULT 1,
-- 	id BIGINT NOT NULL AUTO_INCREMENT,
-- 	pago_id BIGINT,
-- 	FOREIGN KEY (pago_id) REFERENCES co_pago(id),
-- 	perito_id BIGINT,
-- 	FOREIGN KEY (perito_id) REFERENCES co_perito(id),
-- 	monto DECIMAL(22,5),
-- 	igv DECIMAL(9,5),
-- 	total DECIMAL(24,5),
-- 	cambio DECIMAL(9,5),
-- 	moneda_id BIGINT NOT NULL,
-- 	PRIMARY KEY (id)
-- )
-- ;
-- DROP TABLE IF EXISTS co_pago_has_perito_history;
-- CREATE TABLE co_pago_has_perito_history (
-- 	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
-- 	info_create_user INT ,
-- 	info_status TINYINT(1) DEFAULT 1,
-- 	pago_has_perito_id BIGINT,
-- 	FOREIGN KEY (pago_has_perito_id) REFERENCES co_pago_has_perito(id),
-- 	id BIGINT NOT NULL AUTO_INCREMENT,
-- 	pago_id BIGINT,
-- 	FOREIGN KEY (pago_id) REFERENCES co_pago(id),
-- 	perito_id BIGINT,
-- 	FOREIGN KEY (perito_id) REFERENCES co_perito(id),
-- 	monto DECIMAL(22,5),
-- 	igv DECIMAL(9,5),
-- 	total DECIMAL(24,5),
-- 	cambio DECIMAL(9,5),
-- 	moneda_id BIGINT NOT NULL,
-- 	PRIMARY KEY (id)
-- )
-- ;

-- -------------------------------- end montos
-- -------------------------------- ini bienes

DROP TABLE IF EXISTS co_bien_categoria;
CREATE TABLE co_bien_categoria (
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_sub_categoria;
CREATE TABLE co_bien_sub_categoria (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	categoria_id BIGINT NOT NULL,
	FOREIGN KEY (categoria_id) REFERENCES co_bien_categoria(id),
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_sub_categoria_history;
CREATE TABLE co_bien_sub_categoria_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	categoria_id BIGINT NOT NULL,
	FOREIGN KEY (categoria_id) REFERENCES co_bien_categoria(id),
	nombre VARCHAR(50) NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_muebles_clasificacion;
CREATE TABLE co_bien_muebles_clasificacion (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	tipo_id BIGINT NOT NULL,
	marca_id BIGINT NOT NULL,
	modelo_id BIGINT NOT NULL,
	nombre VARCHAR(150) NOT NULL,	
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_muebles_clasificacion_history;
CREATE TABLE co_bien_muebles_clasificacion_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	clasificacion_id BIGINT NOT NULL,
	FOREIGN KEY (clasificacion_id) REFERENCES co_bien_muebles_clasificacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	tipo_id BIGINT NOT NULL,
	marca_id BIGINT NOT NULL,
	modelo_id BIGINT NOT NULL,
	nombre VARCHAR(150) NOT NULL,	
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_inmuebles_ubigeo;
CREATE TABLE co_bien_inmuebles_ubigeo (
       departamento_id VARCHAR(2) NOT NULL COMMENT 'Código de Departamento',
       provincia_id VARCHAR(2) NOT NULL COMMENT 'Código de Provincia',
       distrito_id VARCHAR(2) NOT NULL COMMENT 'Código de Distrito',
       nombre VARCHAR(100) NOT NULL COMMENT 'Nombre'
)
;
DROP TABLE IF EXISTS co_bien_mueble;
CREATE TABLE co_bien_mueble (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	tipo_id BIGINT NOT NULL,
	marca_id BIGINT NOT NULL,
	modelo_id BIGINT NOT NULL,
	descripcion TEXT NOT NULL,
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_mueble_history;
CREATE TABLE co_bien_mueble_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	mueble_id BIGINT NOT NULL,
	FOREIGN KEY (mueble_id) REFERENCES co_bien_mueble(id),
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	tipo_id BIGINT NOT NULL,
	marca_id BIGINT NOT NULL,
	modelo_id BIGINT NOT NULL,	
	descripcion TEXT NOT NULL,	
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_inmueble;
CREATE TABLE co_bien_inmueble (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	departamento_id BIGINT NOT NULL,
	provincia_id BIGINT NOT NULL,
	distrito_id BIGINT NOT NULL,
	direccion TEXT NOT NULL,
	descripcion TEXT NOT NULL,
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_inmueble_history;
CREATE TABLE co_bien_inmueble_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	inmueble_id BIGINT NOT NULL,
	FOREIGN KEY (inmueble_id) REFERENCES co_bien_inmueble(id),
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	departamento_id BIGINT NOT NULL,
	provincia_id BIGINT NOT NULL,
	distrito_id BIGINT NOT NULL,
	direccion TEXT NOT NULL,
	descripcion TEXT NOT NULL,
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_mazivo;
CREATE TABLE co_bien_mazivo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	direccion TEXT NOT NULL,
	descripcion TEXT,
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;
DROP TABLE IF EXISTS co_bien_mazivo_history;
CREATE TABLE co_bien_mazivo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT ,
	info_status TINYINT(1) DEFAULT 1,
	id BIGINT NOT NULL AUTO_INCREMENT,
	mazivo_id BIGINT NOT NULL,
	FOREIGN KEY (mazivo_id) REFERENCES co_bien_mazivo(id),
	cotizacion_id BIGINT NOT NULL,
	FOREIGN KEY (cotizacion_id) REFERENCES co_cotizacion(id),
	sub_categoria_id BIGINT NOT NULL,
	FOREIGN KEY (sub_categoria_id) REFERENCES co_bien_sub_categoria(id),
	direccion TEXT NOT NULL,
	descripcion TEXT,
	orden INT NOT NULL,
	PRIMARY KEY (id)
)
;

-- -------------------------------- end bienes



