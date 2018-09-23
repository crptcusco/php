<?php
function mapeador1() {
    $data = mapeador_data();
    $output = array();
    $index = '';
    foreach ($data as $row) {
	if ( $index != $row['tabla_nombre'] )  {
	    $index = $row['tabla_nombre'];	    
	}
	$row['campo_tipo_real'] = $row['campo_tipo'];
	$row['campo_tipo'] = mapeador_tipos_get( $row['campo_tipo'] );
	if ($row['campo_categoria'] == 'diccionario') {
	    $row['table'] = 'diccionario_' . $row['campo_nombre'];
	    $row['campo_nombre'] .= '_id';
	} else {
	    $row['table'] = '';
	}
	
	$output[$index][ $row['campo_nombre'] ] = array (
							 'tipo' => $row['campo_tipo']
							 , 'tipo_real' => $row['campo_tipo_real']
							 , 'table' => $row['table']
							 );
    }
    return $output;
}
function mapeador2() {
    $data = mapeador1();
    $output = array();
    foreach ( $data as $table => $row ) {
	$output[$table] = mapeador_info_fields_data_cruda( $table );
    }
    return $output;
}
function mapeador_data() {
    global $q;
    $q->fields = array(
		         'tabla_nombre'=>''
		       , 'campo_nombre'=>''
		       , 'campo_tipo'=>''
		       , 'campo_categoria'=>''
    		       );
    $q->sql = '
SELECT 
  t.nombre as tabla_nombre
, c.nombre as campo_nombre
, c.tipo_dato as campo_tipo
, c.categoria as campo_categoria
FROM tabla_has_campo tc
JOIN tabla t ON t.id=tc.tabla_id
JOIN campo c ON c.id=tc.campo_id
ORDER BY 1
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function mapeador_tipos_get ($input) {
    $l  = explode("(", $input);
    
    if ($l[0] == 'VARCHAR') {
	return 'string';
    } elseif($l[0] == 'TEXT') {
	return 'string';
    } elseif($l[0] == 'DECIMAL') {
	return 'float';
    } elseif($l[0] == 'BIGINT') {
	return 'int';
    } elseif($l[0] == 'INT') {
	return 'int';
    } elseif($l[0] == 'DATE') {
	return 'date';
    } elseif($l[0] == 'Bool') {
	return 'bool';
    } elseif($l[0] == 'TINYINT') {
	return 'bool';
    } else {
	return $l[0];
    }    
}
function mapeador_tipos_listar_distintos($data) {
    /* para verificar que funcione: 
     * mapeador_info_tipo
     */
    $search = array();
    foreach ($data as $table) {
	foreach ($table as $row) {
	    if ( array_search($row['tipo'], $search) === False ) {
		$search[] = $row['tipo'];		
	    }
	}
    }
    return $search;
}
function mapeador_info_fields1($data) {
    /* 
     * para verificar que este actualizado el mapeador
     */
    $output = array();
    foreach ($data as $table => $row) {
	$search = mapeador_info_fields_data( $table );
	foreach ($row as $field => $subrow ) {
	    if ( array_search($field, $search) === False ) {
		$output[$table][] = $field;
	    }
	}
    }
    return $output;
}
function mapeador_info_fields2( $data ) {
    /* 
     * para verificar que este actualizado el mapeador
     */
    $output = array();
    foreach ($data as $table => $row) {
	$search = array();
	foreach ($row as $field => $subrow ) $search[] = $field;
	
	$base = mapeador_info_fields_data( $table );
	foreach ($base as $field) {
	    if ( array_search($field, $search) === False && $field !='id') {
		$output[$table][] = $field;
	    }
	}
    }
    return $output;
}
function mapeador_info_fields3( $data1, $data3 ) {
    /* 
     * para verificar que este actualizado el mapeador
     */
    $output = array();
    foreach ($data3 as $table => $row) {
	if ( isset( $data1[$table] ) ) {
	    foreach ($row as $field) {		
	    	if ( ! isset( $data1[$table][$field] ) && $field!='id' ) {
	    	    $output[$table][] = $field;
	    	}
	    }
	}
    }
    return $output;
}
function mapeador_info_fields3_b( $data1, $data3 ) {
    /* 
     * 
     */
    $output = array();
    foreach ($data3 as $table => $row) {
	if ( isset( $data1[$table] ) ) {
	    foreach ($row as $field) {		
	    	if (  isset( $data1[$table][$field] ) ) {		    
	    	    $output[$table][] = $field;
	    	}
	    }
	}
    }
    return $output;
}
function mapeador_info_fields_data($table) {
    global $q;
    $q->fields = array(
		         'Field'=>''
		       , 'Type'=>''
		       , 'Null'=>''
		       , 'Key'=>''
		       , 'Dafault'=>''
		       , 'Extra'=>''
    		       );
    $q->sql = '
DESC ' . $table . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    $output = array();
    foreach ($data as $row) {
    	$output[] = $row['Field'];
    }
    return $output;
}
function mapeador_info_fields_data_cruda($table) {
    global $q;
    $q->fields = array(
		         'Field'=>''
		       , 'Type'=>''
		       , 'Null'=>''
		       , 'Key'=>''
		       , 'Dafault'=>''
		       , 'Extra'=>''
    		       );
    $q->sql = '
DESC ' . $table . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    $output = array();
    foreach ($data as $row) {
	if ($row['Field']!='id') {
	    $output[ $row['Field'] ] = array('tipo_real' => $row['Type']);
	}

    }
    return $output;
}
function mapeador_comparar_mapa($data1, $data2) {
    $output = array();
    foreach ( $data1 as $table => $row1 ) {
	foreach ( $row1 as $field => $row2 ) {
	    $compare1  = trim( strtoupper( $data1[$table][$field]['tipo_real'] ) );
	    $compare2  = trim( strtoupper( $data2[$table][$field]['tipo_real'] ) );
	    if ($compare1 != $compare2) {
		$output[$table][$field] = $compare1 .' != ' . $compare2;

		mapeador_comparar_mapa_data( array('nombre'=> $field ,'tipo_dato'=> $compare2 )  );
	    }
	}
    }
    return $output;
}
function mapeador_comparar_mapa_data($input) {
    global $q;
    $q->fields = array( );
    $q->sql = '
UPDATE campo SET tipo_dato = "' . $input['tipo_dato'] . '" 
WHERE nombre = "' . $input['nombre'] . '"
              ';
    $q->data = NULL;
    // $q->exe();
    echo $q->sql .';<br>';
}