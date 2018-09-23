<?php 
// ------------------------------------------------------ INPUT

$indice = explode(" ", $indice);
$cambiar = explode(" ", $cambiar);

// ----------------------------------------------------- PROCES
$repetidos = array();
$error = 0;
$consultar = mapear('algoritmo01_field_a_consultar', $indice);
$consultar_repetidos = $repetidos;

$repetidos = array();
$modificar_antes = mapear('algoritmo01_field_a_modificar', $indice);
$modificar_antes_repetidos = $repetidos;

$repetidos = array();
$modificar_despues = cambiar($modificar_antes, $consultar, $cambiar);
$modificar_despues_repetidos = $repetidos;
// ------------------------------------------------------- TEST
/*
info_clds_print('Consultar', $consultar);
info_clds_print('Modificar (Antes)', $modificar_antes);
info_clds_print('Modificar (Despues)', $modificar_despues);
*/
// ------------------------------------------------------ OUTPUT
?>
<div class="row collapse">
  <div class="small-3 columns">
    <ul class="tabs vertical" data-tab>
      <li class="tab-title active" style="width: 200px; padding: 0;"><a href="#panel11">Datos Cambiados</a></li>
      <li class="tab-title" style="width: 200px; padding: 0;"><a href="#panel21">Datos Originales</a></li>
      <li class="tab-title" style="width: 200px; padding: 0;"><a href="#panel31">Datos de consulta</a></li>
      <li class="tab-title" style="width: 200px; padding: 0;"><a href="#panel41">Importante</a></li>
    </ul>
    <div style="clear:both"></div>
  </div>
  <div class="small-9 columns">
    <div class="tabs-content">
      <div class="content active" id="panel11" style="padding: 0">
	<?php table($modificar_despues) ?>
      </div>
      <div class="content" id="panel21" style="padding: 0">
	<?php table($modificar_antes) ?>
      </div>
      <div class="content" id="panel31" style="padding: 0">
	<?php table($consultar) ?>
      </div>
      <div class="content" id="panel41" style="padding: 0">
	<div class="row">
	  <div class="small-4 columns">
	    <h3>Datos Cambiados</h3>
	    <?php table($modificar_despues_repetidos); ?>
	  </div>
	  <div class="small-4 columns" style="background-color: rgb(227, 227, 227);">
	    <h3>Datos Originales</h3>
	    <?php table($modificar_antes_repetidos); ?>
	  </div>
	  <div class="small-4 columns">
	    <h3>Datos de Consulta</h3>
	    <?php table($consultar_repetidos); ?>
	  </div>      
	</div>
      </div>
    </div>
  </div>
</div>
<?php
// -------------------------------------------------- FUNCTIONS
function mapear($name,$index) {
  GLOBAL $repetidos;
  GLOBAL $error;
  $file = fopen($_FILES[$name]['tmp_name'], 'r');
  $data = array();
  $header = array();
  $first = true;
  $search = array();

  while(! feof($file)) {
    if ( $first ) {
      $first=false;
      $header = array();
      $header = fgetcsv($file, 0,';','"');
    }
    $temp = fgetcsv($file, 0,';','"') ;
    if ( is_array( $temp ) ) {
      $i = 0;
      foreach ( $temp as $value ) {
	$row[ $header[$i] ] = utf8_decode($value);
	$i++; 
      }
      $unico = ' ';
      foreach ( $index as $value ) {
	$unico.= ' ' . $row[$value];
      }      
      if ( array_search($unico, $search) !== False)
      {		
       $repetidos[] = array( 'Repetidos' => $unico);              
       }
      else
      {
	$search[] = $unico;	
      }
      if ( isset($data[$unico]) && is_array($data[$unico]) ) {
	$error++;
	$unico = 'Error-codigo-'.$error;
      }      
      $data[$unico] = $row;
    }
  }
  return $data;
}
function cambiar($modificar, $consultar, $cambiar) {
  GLOBAL $repetidos;
  foreach ($modificar as $codigos => $row) {
    // Verificando que existe fila
    if ( isset( $consultar[ $codigos ] ) ) {
      if ( is_array( $consultar[ $codigos ] )  ) {
	foreach ( $row as $key => $value ) {
	  // Verificando que existe columna
	  if ( isset($consultar[ $codigos ][ $key ]) ) {
	    if ( array_search($key, $cambiar) !== False ) {
	      if ( trim($consultar[ $codigos ][ $key ]) != '' && trim($consultar[ $codigos ][ $key ]) != '0' ) {
		$modificar[ $codigos ][ $key ] = $consultar[ $codigos ][ $key ];
	      }
	    }
	  }
	}
      }
    } else {
      if ( substr($codigos,0,13) != 'Error-codigo-' ) {
	$repetidos[] = array('No Encontrados' => $codigos );
      }      
    }
  }    
  return $modificar;
}
function table($a) {
  if( count($a) != 0 ) {
    echo '<table style="width: 100%">';
    echo '<tr>';
    foreach ( current($a) as $key => $value ) {
      echo '<th>';
      echo $key;
      echo '</th>';	
    }
    echo '</tr>';
    $count = 0;
    foreach ($a as $row) {
      $count++;
      echo '<tr>';
      foreach ($row as $col) {
	echo '<td>';
	echo $col;
	echo '</td>';
      }
      echo '</tr>';
    }
    echo '<caption>';
    echo 'Número de filas: "' . $count . '" ';
    echo '</caption>';
    echo '</table>';	
  }
}
?>
