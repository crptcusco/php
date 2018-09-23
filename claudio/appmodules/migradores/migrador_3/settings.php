<?php 
$site = 'work';
define('FUENTE_COLS','W');
define('FUENTE_FILE','xls/casa_2014.xls');
define('FUENTE','t_input_casa');
define('DESTINO','t_casa');


if ($site == 'house') {
    define('HOST','localhost');
    define('DB_USER','root');
    define('DB_0','allemant01');
    define('DB_1','allemant02');
    define('DB_3','allemant03');
    define('DB_PASS','admin');    
} elseif($site == 'work') {
    define('HOST','localhost');
    define('DB_USER','root');
    define('DB_0','allemant02');
    define('DB_1','claudio');
    define('DB_2','dev02');
    define('DB_PASS','allemant');    
}
$mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);

$modelos[] = array('fuente'=>'t_input_casa', 'destino'=>'t_casa', 'col'=>'W', 'file'=>'casa_2014.xls');
$modelos[] = array('fuente'=>'t_input_departamento', 'destino'=>'t_departamento', 'col'=>'AA', 'file'=>'departamento_2014.xls');
$modelos[] = array('fuente'=>'t_input_local_comercial', 'destino'=>'t_local_comercial', 'col'=>'X', 'file'=>'local_comercial_2014.xls');
$modelos[] = array('fuente'=>'t_input_local_industrial', 'destino'=>'t_local_industrial', 'col'=>'W', 'file'=>'local_industrial_2014.xls');
$modelos[] = array('fuente'=>'t_input_terreno', 'destino'=>'t_terreno', 'col'=>'U', 'file'=>'terreno_2014.xls');
$modelos[] = array('fuente'=>'t_input_maquinaria', 'destino'=>'t_maquinaria', 'col'=>'Q', 'file'=>'maquinaria_2014.xls');
$modelos[] = array('fuente'=>'t_input_vehiculo', 'destino'=>'t_vehiculo', 'col'=>'R', 'file'=>'vehiculo_2014.xls');

$modelos[] = array('fuente'=>'em_input_casa', 'destino'=>'em_casa', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_departamento', 'destino'=>'em_departamento', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_local_comercial', 'destino'=>'em_local_comercial', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_local_industrial', 'destino'=>'em_local_industrial', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_terreno', 'destino'=>'em_terreno', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_maquinaria', 'destino'=>'em_maquinaria', 'col'=>'', 'file'=>'');
$modelos[] = array('fuente'=>'em_input_vehiculo', 'destino'=>'em_vehiculo', 'col'=>'', 'file'=>'');