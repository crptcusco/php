<?php 
include ("../settings.php"); 
if ( isset($_POST['table']) && 
    isset($_POST['field']) &&
    isset($_POST['value']) &&
    isset($_POST['search']) 
    )
{// falta replazar + por otra cosa
  $input['table']= $_POST['table'];
  $input['field']= $_POST['field'];
  $input['value']= $_POST['value'];
  $input['search']= $_POST['search'];
  
  $sql = 'UPDATE '.$input['table'].' SET '.$input['field'].'="'.$input['value'].'" WHERE '.$input['field'].'="'.$input['search'].'"';
  $result = $mysqli->query($sql);
  print_r($sql);
  //print 'search: '.$_POST['search'];
  //echo 'echo';
}

?>
