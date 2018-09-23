DROP TABLE IF EXISTS backup_diccionarios_duplicados;
CREATE TABLE backup_diccionarios_duplicados(
       id bigint(20) NOT NULL AUTO_INCREMENT,
       tabla VARCHAR(250) NOT NULL,
       diccionario VARCHAR(250) NOT NULL,
       bad_id bigint(20) NOT NULL,
       data_id bigint(20) NOT NULL,
       info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (id) 
);
