<?php
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("./settings.php");
/* PROCEDIMEINTO
 * 1. sugerir consulta sql de busqueda
 * 2. sugerir consulta sql de remplazo
 * 2. mostrar ids 
 * 3. remplazar por el nombre correcto
 */


// comparar departamentos
// comparar provinciass  
// comparar distritos

comparar('departamento');
comparar('provincia');
comparar('distrito');

function comparar($tipo) {
    global $mysqli;
    
    if ($mysqli->connect_errno) 
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;   
    $sql = '
    SELECT id,nombre FROM diccionario_ubi_%1$s t1
    WHERE NOT EXISTS (SELECT * FROM ubi_%1$s t2 WHERE  t1.nombre=t2.nombre)
    ';
    $sql = sprintf($sql,$tipo);
    $result = $mysqli->query($sql); 
    if ( is_object($result) ) {
	printf('SELECT * FROM ubi_%1$s WHERE nombre LIKE "";<br>', $tipo);
	printf('UPDATE diccionario_ubi_%1$s SET nombre = "" WHERE id="";<br>', $tipo);
	echo '<ol>';
	while ( $row = $result->fetch_assoc() ) {
	    printf('<li>%s(%s) </li>',$row['nombre'],$row['id']);
	}
	echo '</ol>';
    } // end-if
    echo '<hr>';
}
?>