<?php
include ("../settings.php"); 

if ( isset($_POST['search']) && isset($_POST['table']) )
{
  $input['search']= $_POST['search'];
  $input['table']= $_POST['table'];

  $mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);
  $sql = 'SELECT '.$input['table'].'_diccionary_id,nombre FROM '.$input['table'].'_history WHERE nombre LIKE "%'.$input['search'].'%"';
  $result = $mysqli->query($sql);
  echo '<table>';
  while ($row = $result->fetch_array()) {
    echo '<tr>';
    printf('<td>%s</td><td>%s</td>', $row[0], $row[1]);
    echo '</tr>';

  }  
}

?>
