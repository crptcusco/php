DROP PROCEDURE IF EXISTS em_diccionary_add;
delimiter //
CREATE PROCEDURE em_diccionary_add ( 
         in_valor VARCHAR(500)
       , in_tabla VARCHAR(500)
) 
BEGIN
	DECLARE stmt1 VARCHAR(500);
	DECLARE stmt2 VARCHAR(500);

	SET @consulta1 = CONCAT('INSERT INTO ', in_tabla,'_diccionary(nombre) VALUES("',in_valor,'")'); 
	PREPARE stmt1 FROM @consulta1; 
	EXECUTE stmt1;


	SET @consulta2 = CONCAT('INSERT INTO ', in_tabla,'_history(nombre, ',in_tabla ,'_diccionary_id) VALUES("',in_valor,'",LAST_INSERT_ID())');
	PREPARE stmt2 FROM @consulta2; 
	EXECUTE stmt2;

	
END
//
delimiter ;

SET @valor ='mierda2', @tabla='marca';


CALL em_diccionary_add (@valor,@tabla);
