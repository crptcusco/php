<?php 
include ("../settings.php"); 

if ( isset($_POST['id']) && isset($_POST['value']) && isset($_POST['table']) )
{
  $input['id']= $_POST['id'];
  $input['value']= $_POST['value'];
  $input['table']= $_POST['table'];
  
  $mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);
  $sql = 'INSERT INTO '.$input['table'].'_history(nombre, '.$input['table'].'_diccionary_id) VALUES("'.$input['value'].'","'.$input['id'].'")';
  $result = $mysqli->query($sql);
  echo 'echo';
}

?>
