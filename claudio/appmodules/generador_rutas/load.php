<?php 

$file = fopen($_FILES['fileToUpload']['tmp_name'], 'r');

$data = array();
$header = array();
$first = true;
$l_google = array();
$l_item = array();

while(! feof($file)) {
    if ( $first ) {
	$first=false;
	$header = array();
	$header = fgetcsv($file, 0,';','"');
	//$header = fgetcsv($file);
    
	/* foreach ($temp2 as $row){ */
	/* 	$header[] = strtolower($row); */
	/* } */
	/* echo '<pre>'; */
	/* print_r($temp2); */
	/* echo '</pre>'; */
	/* echo '<pre>'; */
	/* print_r($header); */
	/* echo '</pre>'; */
    
    } else {
	$temp = fgetcsv($file, 0,';','"') ;
	//$temp = fgetcsv($file) ;
	if ( is_array( $temp ) ){
	    $i = 0;
	    foreach ( $temp as $value ) {
		$row[ $header[$i] ] = utf8_decode($value);
		$i++; 
	    }/*end foreach*/
	    $index1 = $row['ITEM'];
	    $index2 = $row['LATITUD'] . '-' . $row['LONGITUD'];	    
	    if ( array_search($index1, $l_item) === FALSE ) {
		$l_item[] = $index1;
		if ( array_search($index2, $l_google) === FALSE ) {
		    $l_google[] = $index2;
		    $data[$index2][] = array('ITEM'=>$row['ITEM'],'LATITUD'=>$row['LATITUD'],'LONGITUD'=>$row['LONGITUD']);
		    $data[$index2][] = $row;
		} else {
		    $data[$index2][] = $row;
		    $cnt = count( $data[$index2] );
		    $data[$index2][0]['ITEM'] .= ', ' . $row['ITEM'];
		}		
	    }
	    
	}
    }
}

$data = array_change_key_case($data);
/*
echo '<pre>';
var_dump($data);
echo '</pre>';
*/
fclose($file);
  


