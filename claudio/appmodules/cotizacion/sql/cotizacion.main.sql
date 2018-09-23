-- DROP DATABASE IF EXISTS cotiza_factura;
-- CREATE DATABASE cotiza_factura
--        DEFAULT CHARACTER SET utf8
--        DEFAULT COLLATE utf8_general_ci
--        ;
-- USE cotiza_factura;
-- SET default_storage_engine=MYISAM
-- ;

-- SOURCE ./cotizacion.dump.sql
-- SOURCE ./usuarios.tables.linux.sql -- esto no ba en produccion
-- SOURCE ./usuarios.inserts.sql -- esto no ba en produccion

-- SOURCE ./cotizacion.tables.sql -- esto no ba en produccion
-- SOURCE ./cotizacion.inserts.sql -- esto no ba en produccion
-- SOURCE ./cotizacion.selects.sql -- esto no ba en produccion

-- -- FUNCIONS AND PROCEDURES
SOURCE ./procedures_functions/cotizacion_bien_inmueble.sql
SOURCE ./procedures_functions/cotizacion_bien_mazivo.sql
SOURCE ./procedures_functions/cotizacion_bien_mueble.sql
SOURCE ./procedures_functions/cotizacion_bien_mueble_marca_save.sql
SOURCE ./procedures_functions/cotizacion_bien_mueble_modelo_save.sql
SOURCE ./procedures_functions/cotizacion_bien_mueble_tipo_save.sql
SOURCE ./procedures_functions/cotizacion_bien_inmueble_modal.sql
SOURCE ./procedures_functions/cotizacion_igv.sql
SOURCE ./procedures_functions/cotizacion_involucrado_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_juridico_contacto_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_juridico_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_juridico_clasificacion_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_juridico_actividad_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_juridico_grupo_save.sql
SOURCE ./procedures_functions/cotizacion_involucrado_natural_save.sql
SOURCE ./procedures_functions/cotizacion_mensaje_add.sql
SOURCE ./procedures_functions/cotizacion_monto_add.sql
SOURCE ./procedures_functions/cotizacion_monto_perito_save.sql
SOURCE ./procedures_functions/cotizacion_nuevo.sql
SOURCE ./procedures_functions/cotizacion_save.sql
SOURCE ./procedures_functions/cotizacion_tipo_servicios_insert.sql
SOURCE ./procedures_functions/cotizacion_tipo_servicios_update.sql
SOURCE ./procedures_functions/cotizacion_vendedor_save.sql
-- views
SOURCE ./procedures_functions/cotizacion_view_reporte.sql
