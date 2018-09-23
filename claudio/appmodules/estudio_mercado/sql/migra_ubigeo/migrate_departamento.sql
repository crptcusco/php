DELIMITER $$ 

-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_em_departamento_dep
$$
CREATE PROCEDURE migrate_em_departamento_dep()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_dep_id, ubi_dep_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_departamento_id
      FROM em_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_dep_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.departamento_id INTO ubi_dep_id
     FROM diccionario_ubi_departamento d
     LEFT JOIN ubi_departamento u ON u.nombre=d.nombre
     WHERE d.id = dic_dep_id
     LIMIT 1
     ;     
     IF dic_dep_id IS NOT NULL THEN
     	-- SELECT dic_dep_id, ubi_dep_id;
     	UPDATE em_departamento -- OK
     	SET dic_departamento_id = dic_dep_id
	  , bk_departamento_id  = ubi_dep_id
     	WHERE ubi_departamento_id = dic_dep_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$

-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_em_departamento_pro
$$
CREATE PROCEDURE migrate_em_departamento_pro()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_pro_id, ubi_pro_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_provincia_id
      FROM em_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_pro_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.provincia_id INTO ubi_pro_id
     FROM diccionario_ubi_provincia d
     LEFT JOIN ubi_provincia u ON u.nombre=d.nombre
     WHERE d.id = dic_pro_id
     LIMIT 1
     ;     
     IF dic_pro_id IS NOT NULL THEN
     	-- SELECT dic_pro_id, ubi_pro_id;
     	UPDATE em_departamento -- OK
     	SET dic_provincia_id = dic_pro_id
          , bk_provincia_id  = ubi_pro_id
     	WHERE ubi_provincia_id = dic_pro_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$

-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_em_departamento_dis
$$
CREATE PROCEDURE migrate_em_departamento_dis()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_dis_id, ubi_dis_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_distrito_id
      FROM em_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_dis_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.distrito_id INTO ubi_dis_id
     FROM diccionario_ubi_distrito d
     LEFT JOIN ubi_distrito u ON u.nombre=d.nombre
     WHERE d.id = dic_dis_id
     LIMIT 1
     ;     
     IF dic_dis_id IS NOT NULL THEN
     	-- SELECT dic_dis_id, ubi_dis_id;
     	UPDATE em_departamento -- OK
     	SET dic_distrito_id = dic_dis_id
	  , bk_distrito_id  = ubi_dis_id
     	WHERE ubi_distrito_id = dic_dis_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$


-- ============================================


-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_t_departamento_dep
$$
CREATE PROCEDURE migrate_t_departamento_dep()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_dep_id, ubi_dep_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_departamento_id
      FROM t_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_dep_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.departamento_id INTO ubi_dep_id
     FROM diccionario_ubi_departamento d
     LEFT JOIN ubi_departamento u ON u.nombre=d.nombre
     WHERE d.id = dic_dep_id
     LIMIT 1
     ;     
     IF dic_dep_id IS NOT NULL THEN
     	-- SELECT dic_dep_id, ubi_dep_id;
     	UPDATE t_departamento -- OK
     	SET dic_departamento_id = dic_dep_id
	  , bk_departamento_id  = ubi_dep_id
     	WHERE ubi_departamento_id = dic_dep_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$

-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_t_departamento_pro
$$
CREATE PROCEDURE migrate_t_departamento_pro()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_pro_id, ubi_pro_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_provincia_id
      FROM t_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_pro_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.provincia_id INTO ubi_pro_id
     FROM diccionario_ubi_provincia d
     LEFT JOIN ubi_provincia u ON u.nombre=d.nombre
     WHERE d.id = dic_pro_id
     LIMIT 1
     ;     
     IF dic_pro_id IS NOT NULL THEN
     	-- SELECT dic_pro_id, ubi_pro_id;
     	UPDATE t_departamento -- OK
     	SET dic_provincia_id = dic_pro_id
	  , bk_provincia_id  = ubi_pro_id
     	WHERE ubi_provincia_id = dic_pro_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$

-- ------------------------------------------
DROP PROCEDURE IF EXISTS migrate_t_departamento_dis
$$
CREATE PROCEDURE migrate_t_departamento_dis()
BEGIN
   DECLARE done INT DEFAULT FALSE;
   DECLARE dic_dis_id, ubi_dis_id  BIGINT;
   DECLARE cur1 CURSOR
      FOR SELECT DISTINCT ubi_distrito_id
      FROM t_departamento; -- OK     
   DECLARE CONTINUE HANDLER
      FOR NOT FOUND SET done = TRUE;

   OPEN cur1;

   read_loop: LOOP
     FETCH cur1 INTO dic_dis_id;
     IF done THEN
       LEAVE read_loop;
     END IF;
     
     SELECT u.distrito_id INTO ubi_dis_id
     FROM diccionario_ubi_distrito d
     LEFT JOIN ubi_distrito u ON u.nombre=d.nombre
     WHERE d.id = dic_dis_id
     LIMIT 1
     ;     
     IF dic_dis_id IS NOT NULL THEN
     	-- SELECT dic_dis_id, ubi_dis_id;
     	UPDATE t_departamento -- OK
     	SET dic_distrito_id = dic_dis_id
	  , bk_distrito_id  = ubi_dis_id
     	WHERE ubi_distrito_id = dic_dis_id
     	;
     END IF
     ;
   END LOOP;
   CLOSE cur1;
END $$

DELIMITER ;
