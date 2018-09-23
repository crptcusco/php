<?php 
session_start();
class Query {

    public $fields = NULL;
    public $sql;
    public $data = NULL;

    public function exe() {
        DBConnector::set_db('cotiza_factura');
        DBConnector::$results = NULL;
        if ($this->fields == NULL) {
            DBConnector::ejecutar($this->sql, $this->data);
        } else {
            DBConnector::ejecutar($this->sql, $this->data, $this->fields);
        }

        return DBConnector::$results;
    }

}

function clear_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function timestamp_to_str( $i ) {
    
    if ($i!='') {
	$i = substr($i, 8,2) . '-' . substr($i, 5,2) . '-' . substr($i, 0,4);
    }
    if ($i!='00-00-0000'){
	echo $i;
    } else {
	echo '';
    }
    
    
}
function timestamp_to_str2( $i ) {
    
    if ($i!='') {
	$i = substr($i, 8,2) . '-' . substr($i, 5,2) . '-' . substr($i, 0,4);
    }
    if ($i!='00-00-0000'){
	return $i;
    } else {
	return '';
    }
    
    
}
function str_to_timestamp( $i ) {
    if ($i!='') {
	$i = substr($i, 6,4) . '-' . substr($i, 3,2) . '-' . substr($i, 0,2);
    }
    return $i;
}
function de_militar_a_meridiano($hora, $minuto) {
    $meridiano = ' am';
    if ( $hora>11 ) {
	$meridiano = ' pm';
	$hora -= 12;
    }
    return sprintf('%02d:%02d %s', $hora, $minuto, $meridiano);
}
function de_militar_a_meridiano_array($hora, $minuto) {
    $meridiano = 'am';
    if ( $hora>11 ) {
	$meridiano = 'pm';
	$hora -= 12;
    }
    return array('hora'=>$hora, 'minuto'=>$minuto, 'meridiano'=>$meridiano);
}
function embellecer($num) {
    return sprintf('%.2f', round( $num, 2 ) );
}
function str_num_null($num) {
  if (trim( $num ) == '') {
    return '0';
  } else {
    return $num;
  }
 
}
function is_null_id( $input ) {
    if ($input==''){
	return 0;
    } else {
	return $input;
    }
}
function is_nulo_id($input) {
  $input = clear_input($input);
  if ( $input=='' ) {
    return false;
  } else {
    return $input;
  }
}
function is_true_false_str($input) {
  $input = clear_input($input);
  if ( $input=='true' ) {
    return true;
  } elseif( $input=='false' ) {
    return false;
  }
}
function validate_str($input) {
  $input = clear_input($input);
  $input = utf8_encode($input);
  return $input;
}
function print_test($title, $list) {
    echo '<h2>'.$title.'</h2>';
    echo '<pre>';
    print_r( $list );
    echo '</pre>';
}
$q = new Query();