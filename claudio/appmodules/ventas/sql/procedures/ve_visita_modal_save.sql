SELECT 'DROP PROCEDURE ve_visita_modal_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_visita_modal_save;
SELECT 'CREATE PROCEDURE ve_visita_modal_save' AS 'MENSAJE';
DELIMITER $$ 
CREATE PROCEDURE ve_visita_modal_save(
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
END $$

DELIMITER ;
-- -- ----------------------- input -------------------------

-- -- caso 1: add
-- SET
--   @id = 0
-- , @propuesta_id = 1
-- , @estado_id = 1
-- , @contacto_id = 1
-- , @fecha = '2015-06-06'
-- , @hora = '16'
-- , @minuto = '0'
-- , @departamento_id = 15
-- , @provincia_id = 1
-- , @distrito_id = 1
-- , @direccion = 'direccion'
-- , @observacion = 'observacion'
-- , @in_user_id = '9'
-- ;
-- -- -- caso 2: edit
-- -- SET
-- --   @id = 2
-- -- , @propuesta_id = 2
-- -- , @estado_id = 2
-- -- , @contacto_id = 2
-- -- , @fecha = '2016-03-03'
-- -- , @hora = '19'
-- -- , @minuto = '30'
-- -- , @departamento_id = 15
-- -- , @provincia_id = 1
-- -- , @distrito_id = 32
-- -- , @direccion = '2direccion2'
-- -- , @observacion = '2observacion2'
-- -- , @in_user_id = '10'
-- -- ;

-- SELECT 'Antes' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM ve_visita ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM ve_visita_history ORDER BY id DESC LIMIT 3
-- ;
-- SELECT 'SELECT ve_visita_modal_save' AS '---------------------------- MENSAJE ------------------------';
-- CALL ve_visita_modal_save (
--   @id
-- , @propuesta_id
-- , @estado_id
-- , @contacto_id
-- , @fecha
-- , @hora
-- , @minuto
-- , @departamento_id
-- , @provincia_id
-- , @distrito_id
-- , @direccion
-- , @observacion
-- , @in_user_id
-- )
-- ;
-- SELECT 'Despues' AS '------------------- MENSAJE --------------------'
-- ;
-- SELECT * FROM ve_visita ORDER BY id DESC LIMIT 3
-- ;
-- SELECT * FROM ve_visita_history ORDER BY id DESC LIMIT 3
-- ;
