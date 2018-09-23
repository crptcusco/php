<?php 
include ("../../settings.php"); 
include  '../../../../librerias.v2/acciones/validar.php';
if ( isset($_POST['table']) && isset($_POST['type_date']) && isset($_POST['value']) && isset($_POST['search']) )
{
  $input['table']= $_POST['table'];
  $input['field']= $_POST['field'];
  $input['type_date']= $_POST['type_date'];
  $input['value']= $_POST['value'];
  $input['search']= $_POST['search'];

  if (que_es($input['value'], $input['type_date'])==0)
    echo 'error';
  else {
    $mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);
    $sql = 'UPDATE '.$input['table'].' SET '.$input['field'].'="'.$input['value'].'" WHERE '.$input['field'].'="'.$input['search'].'"';
    $result = $mysqli->query($sql);
  echo 'echo';    
  } 

}

function que_es($val,$tip){
  switch ($tip){
    case 'int':
      $val2 = (int)$val;
      $val2 = (string) $val2;
      if ($val==$val2)
	return 1;
      else
	return 0;
      break;
    case 'float':
      $val2 = (float)$val;
      $val2 = (string) $val2;
      if ($val==$val2)
	return 1;
      else
	return 0;
      break;
    case 'date':
      if ( validar_fecha($val, 'd/m/Y') )
	return 1;
      else
	return 0;
      break;
  }
}

?>
