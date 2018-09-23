-- -- windows
-- -- mysql_import.bat coordinacion.main.sql

-- SOURCE ./coordinacion.migrate.sql
SOURCE ./coordinacion.tables.sql
SOURCE ./coordinacion.inserts.sql
-- SOURCE ./coordinacion.migrate.sql

-- -- PROCEDURES
SOURCE ./procesures/coor_coordinacion_save.sql
SOURCE ./procesures/coor_coordinacion_new.sql
SOURCE ./procesures/coor_contacto_save.sql
SOURCE ./procesures/coor_modalidad_add_edit.sql
SOURCE ./procesures/coor_tipo2_add_edit.sql
SOURCE ./procesures/coor_cambio_add_edit.sql
SOURCE ./procesures/coor_asistencia_item_update.sql
SOURCE ./procesures/coor_informe_item_save.sql
SOURCE ./procesures/coor_persona_add_to_coordinacion.sql
SOURCE ./procesures/coor_informe_fechasDeEntrega_save.sql
SOURCE ./procesures/coor_informe_documentacion_save.sql
SOURCE ./procesures/coor_informe_firma_save.sql
SOURCE ./procesures/coor_coordinacion_estado.sql


-- -- FUNCTIONS
-- SOURCE ./functions/.sql
