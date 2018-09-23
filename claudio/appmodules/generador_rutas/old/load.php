<?php 

    $file = fopen($_FILES['fileToUpload']['tmp_name'], 'r');

    $data = array();
    $header = array();
    $first = true;

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
		    $row[ $header[$i] ] = $value;
		    $i++; 
		}/*end foreach*/
		$data[] = $row;
	    }
	}
    }
    
    $data = array_change_key_case($data);
    /* echo '<pre>'; */
    /* var_dump($data); */
    /* echo '</pre>'; */

    fclose($file);
 


