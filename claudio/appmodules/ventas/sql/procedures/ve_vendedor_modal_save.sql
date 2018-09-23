DELIMITER ;
SELECT 'DROP PROCEDURE ve_vendedor_modal_save' AS 'MENSAJE'; 
DROP PROCEDURE IF EXISTS ve_vendedor_modal_save;

SELECT 'CREATE PROCEDURE ve_vendedor_modal_save' AS 'MENSAJE'; 
DELIMITER $$ 
CREATE PROCEDURE ve_vendedor_modal_save (
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
END $$

DELIMITER ;
-- SET
--   @id=13
-- , @nombre='aa_nombre'
-- , @telefono='aa_telefono'
-- , @correo='aa_correo'
-- , @rol_id=3
-- , @info_status=0
-- , @user_id = 4
-- , @login='aa_login'
-- , @pass='aa_pass'
-- , @pass_pregunta='false'
-- ;
-- SELECT 'ANTES' AS 'MENSAJE'
-- ;
-- SELECT id, nombre, telefono, correo
-- FROM co_vendedor ORDER BY id DESC LIMIT 1
-- ;
-- SELECT id, vendedor_id, nombre, telefono, correo
-- FROM co_vendedor_history ORDER BY id DESC LIMIT 1
-- ;
-- SELECT full_name, login, pass
-- FROM login_user ORDER BY id DESC LIMIT 1
-- ;
-- SELECT 'CALL ve_vendedor_modal_save' AS 'MENSAJE';
-- CALL ve_vendedor_modal_save(
--   @id
-- , @nombre
-- , @telefono
-- , @correo
-- , @rol_id
-- , @info_status
-- , @user_id
-- , @login
-- , @pass
-- , @pass_pregunta
-- );
-- SELECT 'DESPUES' AS 'MENSAJE'
-- ;
-- SELECT id, nombre, telefono, correo
-- FROM co_vendedor ORDER BY id DESC LIMIT 1
-- ;
-- SELECT id, vendedor_id, nombre, telefono, correo
-- FROM co_vendedor_history ORDER BY id DESC LIMIT 1
-- ;
-- SELECT full_name, login, pass
-- FROM login_user ORDER BY id DESC LIMIT 1
-- ;
