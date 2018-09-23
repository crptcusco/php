INSERT coor_rol(id, nombre) VALUES
(1, 'Perito'),
(2, 'ControlDeCalidad'),
(3, 'Coordinador')
;

INSERT coor_rol_has_user(rol_id, user_id) VALUES

(1, 17),
(1, 18),
(1, 19),
(1, 20),

(2, 17),
(2, 18),
(2, 19),
(2, 20),

(3,  3),
(3, 17),
(3,  21)
;

INSERT INTO coor_codigo(codigo) VALUES(2015000000)
;

INSERT INTO coor_cotizacion_correlativo(cotizacion_id, correlativo)
VALUES(0,34100);

INSERT INTO coor_coordinacion_estado(id, nombre) VALUES
(1, 'En Programación'), (2, 'En Espera'), (3, 'Por Aprobar'), (4, 'Impreso'), (5, 'Desestimado') 
;

INSERT INTO coor_coordinacion_modalidad(id, nombre) VALUES
(1, 'BCP Masivo')
;
INSERT INTO coor_coordinacion_modalidad_history(modalidad_id, nombre) VALUES
(1, 'BCP Masivo')
;

INSERT INTO coor_coordinacion_tipo(id, nombre) VALUES (1, 'Interior'), (2, 'Exterior'), (3, 'Gabinete')
;

INSERT INTO coor_coordinacion_tipo_cambio(id, nombre) VALUES
(1, 'SBS')
;
INSERT INTO coor_coordinacion_tipo_cambio_history(tipo_cambio_id, nombre) VALUES
(1, 'SBS')
;

-- INSERT INTO coor_inspeccion_rol(id, nombre)
-- VALUES (1, 'Consulor'), (2, 'Inspector')
-- ;
