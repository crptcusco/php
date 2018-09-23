<?php 
include ("../settings.php"); 
if ( isset($_POST['bad']) && 
    isset($_POST['table']) 
     ){
    $input['table'] = $_POST['table'];
    $input['field'] = $_POST['bad'];
    $sql = 'UPDATE %s SET sinonimo="0" WHERE id="%s"';
    $sql = sprintf( $sql, $input['table'], $input['field'] );
    $result = $mysqli->query($sql);
    print 'exito';
}

?>