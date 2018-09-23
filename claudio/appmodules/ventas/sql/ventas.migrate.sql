-- -- PERFIL
-- INSERT INTO login_profile (full_name) VALUES ('Ventas');
-- SELECT * FROM login_profile WHERE full_name='Ventas';
-- -- RECURSO
-- INSERT INTO login_resource (full_name) VALUES ('Ventas');
-- SELECT * FROM login_resource WHERE full_name='Ventas';

-- -- despues de select
-- INSERT INTO login_profile_has_resource(profile_id, resource_id) VALUES(5,4);
-- INSERT INTO login_profile_has_resource(profile_id, resource_id) VALUES(1,4);

-- -- USUARIOS
-- INSERT INTO login_user(full_name, login, pass)
-- VALUES ('Jennifer Rowlands De La Borda', 'j_rowlands', '87d06153e06fa53816e2ffa0aee0afc3');
-- -- jennifer987
-- INSERT INTO login_user(full_name, login, pass)
-- VALUES ('Milagros Custodio Ugarte', 'm_custodio', '6f6498644c351287b1de9fd1ded1664c');
-- -- milagros61
-- INSERT INTO login_user(full_name, login, pass)
-- VALUES ('Diego Jesús Martin Flores', 'd_martin', '009a3c89d4824c0baef58a022904e601');
-- -- diego81
-- INSERT INTO login_user(full_name, login, pass)
-- VALUES ('Alfredo Allemant', 'allemnat', '5e4c7955a46439b626b4e74298b02836');
-- alfredo390

-- SELECT id, full_name, login FROM login_user
-- -- WHERE login = 'j_rowlands' OR login = 'm_custodio' OR login = 'd_martin';
-- ;

-- -- despues de select, cuidado con: user_id, profile_id
-- INSERT login_user_has_profile(user_id, profile_id) VALUES
-- (10, 5),
-- (11, 5),
-- (12, 5)
-- ;

-- INSERT login_user_has_profile(user_id, profile_id) VALUES
--   (9 , 5)
-- , (13, 5)
-- ;
-- -- -------------------------------------------------- ALETERANDO TABLAS
-- ALTER TABLE co_vendedor ADD rol_id BIGINT;
-- ALTER TABLE co_vendedor_history ADD rol_id BIGINT;
-- ALTER TABLE co_vendedor ADD parent_id BIGINT;
-- ALTER TABLE co_vendedor_history ADD parent_id BIGINT;
-- ALTER TABLE co_vendedor ADD user_id BIGINT;
-- ALTER TABLE co_vendedor_history ADD user_id BIGINT;

-- SELECT * FROM co_vendedor WHERE nombre LIKE '%Jennifer%Rowlands%';

-- -- añadir vendendor: Jennifer
-- INSERT INTO co_vendedor(info_create_user, nombre, telefono, correo)
-- VALUES (1, 'Jennifer Rowlands De La Borda', '997 899 224', 'apjrowlands@gmail.com');

-- INSERT INTO co_vendedor(info_create_user, nombre, telefono, correo, rol_id, parent_id , user_id)
-- VALUES
--   (1, 'Pedro Carreño', '', '', 1, 0, 9)
-- , (1, 'Alfredo Allemant', '', '', 1, 0, 13)
-- ;

-- SELECT id, full_name FROM login_user WHERE login = 'j_rowlands' OR login = 'm_custodio' OR login = 'd_martin';
-- SELECT id,nombre FROM co_vendedor;

-- -- rol_id: gerencia= 1, coordinador= 2, vendedor= 3
-- -- actualizar vendedor: diego y milagros y jeniffer
-- UPDATE co_vendedor SET rol_id="3", parent_id="10", user_id="11" WHERE nombre LIKE '%Milagros%';
-- UPDATE co_vendedor SET rol_id="3", parent_id="10", user_id="12" WHERE nombre LIKE '%Diego%';
-- UPDATE co_vendedor SET rol_id="2", parent_id="0" , user_id="10" WHERE nombre LIKE '%Jennifer%';
-- SELECT id, nombre, rol_id, parent_id, user_id FROM co_vendedor;

-- ALTER TABLE co_involucrado_natural ADD vendedor_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_natural_history ADD vendedor_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_natural ADD estado_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_natural_history ADD estado_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_natural ADD observacion VARCHAR(150);
-- ALTER TABLE co_involucrado_natural_history ADD observacion VARCHAR(150);
-- ALTER TABLE co_involucrado_natural ADD importante TINYINT(1) DEFAULT 0;
-- ALTER TABLE co_involucrado_natural_history ADD importante TINYINT(1) DEFAULT 0;
-- ALTER TABLE co_involucrado_natural ADD referido_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_natural_history ADD referido_id BIGINT DEFAULT 0;

-- ALTER TABLE co_involucrado_juridica ADD vendedor_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_juridica_history ADD vendedor_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_juridica ADD estado_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_juridica_history ADD estado_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_juridica ADD observacion VARCHAR(150);
-- ALTER TABLE co_involucrado_juridica_history ADD observacion VARCHAR(150);
-- ALTER TABLE co_involucrado_juridica ADD importante TINYINT(1) DEFAULT 0;
-- ALTER TABLE co_involucrado_juridica_history ADD importante TINYINT(1) DEFAULT 0;
-- ALTER TABLE co_involucrado_juridica ADD referido_id BIGINT DEFAULT 0;
-- ALTER TABLE co_involucrado_juridica_history ADD referido_id BIGINT DEFAULT 0;

-- ALTER TABLE co_involucrado_contacto ADD natural_id BIGINT;
-- ALTER TABLE co_involucrado_contacto_history ADD natural_id BIGINT;

-- -- -------------------------------------------- migrate 2015-07-13
-- DROP TABLE IF EXISTS ve_importante;
-- CREATE TABLE ve_importante (
-- 	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
-- 	info_create_user INT ,
-- 	info_update TIMESTAMP,
-- 	info_update_user INT,
-- 	info_status TINYINT(1) DEFAULT 1,
	
-- 	id BIGINT NOT NULL AUTO_INCREMENT,
-- 	nombre VARCHAR(200) NULL,
-- 	PRIMARY KEY (id) 
-- ) ENGINE = MYISAM
-- ;

-- INSERT INTO ve_importante(id, nombre) VALUES
--   (1,'Bronce')
-- , (2,'Plata')
-- , (3,'Oro')
-- , (4,'Platino')
-- ;

-- ALTER TABLE co_involucrado_natural DROP importante;
-- ALTER TABLE co_involucrado_natural ADD importante_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_juridica DROP importante;
-- ALTER TABLE co_involucrado_juridica ADD importante_id BIGINT DEFAULT 1;

-- ALTER TABLE co_involucrado_natural_history  DROP importante;
-- ALTER TABLE co_involucrado_natural_history  ADD importante_id BIGINT DEFAULT 1;
-- ALTER TABLE co_involucrado_juridica_history DROP importante;
-- ALTER TABLE co_involucrado_juridica_history ADD importante_id BIGINT DEFAULT 1;

-- INSERT INTO ve_persona_estado(id, nombre)  VALUES (3,'Cliente dormido')
-- ;

-- -- -------------------------------------------- migrate 2015-07-15
-- ALTER TABLE ve_propuesta  ADD visita_id BIGINT DEFAULT 0;
-- ALTER TABLE ve_propuesta_history  ADD visita_id BIGINT DEFAULT 0;
-- -- -------------------------------------------- migrate 2015-09-07
-- actualizar:
-- - /var/www/html/claudio-dev/appmodules/cotizacion/sql/cotizacion_involucrado_save.sql
-- - /var/www/html/claudio-dev/appmodules/cotizacion/sql/cotizacion_save.sql
-- cursor:


-- DELIMITER $$ 
-- CREATE PROCEDURE cursor_01_tmp()
-- BEGIN
--   DECLARE done INT DEFAULT FALSE;
--   DECLARE pr_juridica_id, pr_vendedor_id BIGINT;
--   DECLARE cur1 CURSOR FOR 
--   SELECT j.id juridica_id, c.vendedor_id 
--   FROM co_involucrado i
--   JOIN co_cotizacion c ON c.id=i.cotizacion_id
--   JOIN co_involucrado_juridica j ON j.id=i.persona_id
--   WHERE j.vendedor_id=0 AND i.persona_tipo='Juridica' AND i.rol_id=1
--   ORDER BY 1
--   ;
--   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

--   OPEN cur1;

--   read_loop: LOOP
--     FETCH cur1 INTO pr_juridica_id, pr_vendedor_id;
--     IF done THEN
--       LEAVE read_loop;
--     END IF
--     ;
--     UPDATE  co_involucrado_juridica SET vendedor_id=pr_vendedor_id 
--     WHERE id=pr_juridica_id
--     ;
--   END LOOP
--   ;
--   CLOSE cur1;
-- END $$

-- DELIMITER ;

-- CALL cursor_01_tmp();


-- DELIMITER $$ 
-- CREATE PROCEDURE cursor_02_tmp()
-- BEGIN
--   DECLARE done INT DEFAULT FALSE;
--   DECLARE pr_natural_id, pr_vendedor_id BIGINT;
--   DECLARE cur1 CURSOR FOR 
--   SELECT n.id natural_id, c.vendedor_id
--   FROM co_involucrado i
--   JOIN co_cotizacion c ON c.id=i.cotizacion_id
--   JOIN co_involucrado_natural n ON n.id=i.persona_id
--   WHERE n.vendedor_id=0 AND i.persona_tipo='Natural' AND i.rol_id=1
--   ORDER BY 1
--   ;
--   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

--   OPEN cur1;

--   read_loop: LOOP
--     FETCH cur1 INTO pr_natural_id, pr_vendedor_id;
--     IF done THEN
--       LEAVE read_loop;
--     END IF
--     ;
--     UPDATE  co_involucrado_natural SET vendedor_id=pr_vendedor_id 
--     WHERE id=pr_natural_id
--     ;
--   END LOOP
--   ;
--   CLOSE cur1;
-- END $$

-- DELIMITER ;

-- CALL cursor_02_tmp();
