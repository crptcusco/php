DROP TABLE IF EXISTS login_user;
CREATE TABLE login_user (
	id INT NOT NULL AUTO_INCREMENT,
	full_name VARCHAR(100) NULL,
	login VARCHAR(75) NULL,
	pass VARCHAR(45) NULL,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_update TIMESTAMP,
	info_status TINYINT(1) DEFAULT 1,
	PRIMARY KEY (id) 
);
DROP TABLE IF EXISTS login_profile;
CREATE TABLE IF NOT EXISTS login_profile (
	id INT NOT NULL AUTO_INCREMENT,
	full_name VARCHAR(45) NOT NULL,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_update TIMESTAMP,
	info_status TINYINT(1) DEFAULT 1,
	PRIMARY KEY (id)
);
DROP TABLE IF EXISTS login_user_has_profile;
CREATE TABLE login_user_has_profile(
	user_id INT NOT NULL ,
	profile_id INT NOT NULL ,
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_update TIMESTAMP,
	info_status TINYINT(1) DEFAULT 1,
	INDEX fk_login_user_has_profile_user_id_index (user_id ASC) ,
	INDEX fk_login_user_has_profile_profile_id_index (profile_id ASC) ,
	CONSTRAINT fk_login_user_has_profile_user_id FOREIGN KEY (user_id ) REFERENCES login_user (id ) 
		  ON DELETE NO ACTION ON UPDATE NO ACTION,
        CONSTRAINT fk_login_user_has_profile_profile_id FOREIGN KEY (profile_id ) REFERENCES login_profile (id )
       		  ON DELETE NO ACTION ON UPDATE NO ACTION
); 
DROP TABLE IF EXISTS login_resource;
CREATE TABLE login_resource (
       id INT NOT NULL AUTO_INCREMENT,
       full_name VARCHAR(100),
       info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       info_update TIMESTAMP,
       info_status TINYINT(1) DEFAULT 1,
       PRIMARY KEY (id) 
);
DROP TABLE IF EXISTS login_profile_has_resource;
CREATE TABLE login_profile_has_resource (
       id INT NOT NULL AUTO_INCREMENT,
       query_accion TINYINT(1) NULL DEFAULT 0 ,
       add_accion TINYINT(1) NULL DEFAULT 0 ,
       edit_accion TINYINT(1) NULL DEFAULT 0 ,
       delete_accion TINYINT(1) NULL DEFAULT 0 ,
       resource_id INT NOT NULL,
       profile_id INT NOT NULL,
       INDEX fk_login_profile_has_resource_resource_id_index (resource_id ASC),
       INDEX fk_login_profile_has_resource_profile_id_index (profile_id ASC),
       CONSTRAINT fk_login_profile_has_resource_resource_id FOREIGN KEY (resource_id)
       		  REFERENCES resource (id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
       CONSTRAINT fk_login_profile_has_resource_profile_id FOREIGN KEY (profile_id)
       		  REFERENCES profile (id ) ON DELETE NO ACTION ON UPDATE NO ACTION,
       info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       info_update TIMESTAMP,
       info_status TINYINT(1) DEFAULT 1,
       PRIMARY KEY (id) 
);

