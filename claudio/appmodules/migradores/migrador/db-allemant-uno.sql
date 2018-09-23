-- eme: estudio de mercado
-- ubi: ubigeo
-- inm: inmueble
-- dep: departamento
-- lco: local comercial
-- ter: terreno
-- nin: no-inmueble
-- veh: vehiculo
DROP TABLE IF EXISTS eme_todo;
CREATE TABLE eme_todo(
       id BIGINT NOT NULL AUTO_INCREMENT
       , PRIMARY KEY (ID)
       , proyecto_id BIGINT                                 -- todo
       , informe_id BIGINT                                  -- todo
       , cliente_nombre VARCHAR(500)                        -- todo
       , propietario_nombre VARCHAR(500)                    -- todo
       , solicitante_nombre VARCHAR(500)                    -- todo
       , ubi_ubicacion_tipo VARCHAR(50)                     -- todo
       , ubi_ubicacion_dato TEXT                            -- todo
       , tasacion_fecha DATE                                -- todo
       , ubi_departamento_dato VARCHAR(500)                 -- todo
       , ubi_provincia_dato VARCHAR(500)                    -- todo
       , ubi_distrito_dato VARCHAR(500)                     -- todo
       , valor_comercial VARCHAR(50)                        -- todo
       , tipo_cambio VARCHAR(50)                            -- todo
       , observacion TEXT                                   -- todo
       , ruta_informe VARCHAR(50)                           -- todo
       , map_latitud VARCHAR(500)                           -- inmuebles
       , map_longitud VARCHAR(500)                          -- inmuebles
       , inm_zonificacion VARCHAR(50)                       -- inmuebles
       , inm_terreno_area VARCHAR(50)                       -- inmuebles
       , inm_terreno_area_unidad VARCHAR(50)                -- inmuebles
       , inm_terreno_valor_unitario VARCHAR(50)             -- inmuebles
       , inm_terreno_valor_unitario_unidad VARCHAR(50)      -- inmuebles
       , inm_num_pisos TINYINT                              -- inmuebles (- terreno)
       , inm_edificacion_area VARCHAR(50)                   -- inmuebles (- terreno)
       , inm_edificacion_area_unidad VARCHAR(50)            -- inmuebles (- terreno)
       , inm_edificacion_valor_unitario VARCHAR(50)         -- inmuebles (- terreno)
       , inm_edificacion_valor_unitario_unidad VARCHAR(50)  -- inmuebles (- terreno)
       , inm_area_complementarias VARCHAR(50)               -- inmuebles (- terreno, -local comercial)
       , dep_piso TINYINT                                   -- inmuebles (departamento)
       , dep_tipo VARCHAR(500)                              -- inmuebles (departamento)
       , dep_estacionamiento_num VARCHAR(50)                -- inmuebles (departamento)
       , lco_vista VARCHAR(500)                             -- inmuebles (departamento)
       , inm_valor_area_ocupada VARCHAR(50)                 -- inmuebles (departamento, casa)
       , ter_cultivo BOOLEAN                                -- inmuebles (terreno)
       , ter_cultivo_tipo VARCHAR(500)                      -- inmuebles (terreno)
       , maq_tipo VARCHAR(500)                              -- no-inmuebles (maquinaria)
       , nin_marca VARCHAR(500)                             -- no-inmuebles
       , nin_modelo VARCHAR(500)                            -- no-inmuebles
       , nin_fabricacion_anio VARCHAR(50)                   -- no-inmuebles
       , nin_antiguedad VARCHAR(500)                        -- no-inmuebles
       , nin_valor_nuevo VARCHAR(50)                        -- no-inmuebles
       , veh_tipo VARCHAR(50)                               -- vehiculo
       , veh_traccion VARCHAR(50)                           -- vehiculo
       , origen VARCHAR(500)                                -- fuente de la informacion
)CHARACTER SET utf8, ENGINE=InnoDB;
DESC eme_todo;
