<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include ("./listados/definiciones-diccionario-redundantes.php");
include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$files['header']['css'][] = '../../librerias.v2/vendor/chosen/chosen.min.css';
EtiquetasHtml::$title = 'verificar consitencias de diccionarios: fuente y destino';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body

// campos 
$fields= array('table','table_old','bad','good');
$input=array();
foreach($fields as $field) {
  if ( isset($_POST[$field]) )
    $input[$field] = $_POST[$field];
  else
    $input[$field] = 0;
}

// data
$tablas = show_tables();

$combo_tabla = new ComboSimple();
$combo_tabla->set_option( $input['table'] );
$combo_tabla->set_label( '' );
$combo_tabla->set_id( 'select-table' );
$combo_tabla->set_name( 'table' );
$combo_tabla->set_class( 'chosen-select' );

$combo_tabla->set_format( array('id','nombre') );

if ( $input['table']!=0 ) {
  $input['table'] = get_diccionario_name($input['table']);
  $input['table'] = "diccionario_".$input['table'];
  $definiciones_good = definiciones( $input['table'] );

  $definiciones_bad = definiciones_sinonimos($input['table'], $definiciones_good);


  $combo_definicion_good = new ComboSimple();
  $combo_definicion_good->set_name( 'good' );
  $combo_definicion_good->set_id( 'good' );
  $combo_definicion_good->set_class( 'chosen-select' );
  $combo_definicion_good->set_option( $input['good'] );
  $combo_definicion_good->set_label( '' );
  $combo_definicion_good->set_format( array('id','nombre') );
  
  $combo_definicion_bad = new ComboSimple();
  $combo_definicion_bad->set_name( 'bad' );
  $combo_definicion_bad->set_id( 'bad' );
  $combo_definicion_bad->set_class( 'chosen-select' );
  $combo_definicion_bad->set_label( '' );
  $combo_definicion_bad->set_option( $input['bad'] );
  $combo_definicion_bad->set_format( array('id','nombre') );
}
?>

<form method="POST">
  <table style="min-width: 500px;">
    <tr>
      <td>Tabla</td>
      <td>
	<?php $combo_tabla->imprimir($tablas); ?>
	<input type="hidden" name="table_old"  value="<?php echo $input['table'] ?>">
	
      </td>
    </tr>
    <tr>
      <td>Definicion buena</td>
      <td>
	<?php
	if ( $input['table']!="0" ) $combo_definicion_good->imprimir($definiciones_good); 	
	?>
      </td>
    </tr>
    <tr>
      <td>Definicion Mala</td>
      <td>
	<?php
	if ( $input['table']!="0" ) $combo_definicion_bad->imprimir($definiciones_bad);
	?>
      </td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" class="button" value="procesar"></td>
    </tr>
  </table>
</form>
<div>
<?php
if (
  $input['bad']!=0 &&
  $input['good']!=0 ) {  

  if ( $input['bad']!=$input['good'] ) {
    if ($input['table'] == $input['table_old']) {
      sinonimo($input['table'], $input['bad'], $input['good']);
      print '<p>Sinonimo Procesado.</p>';
    }

  } else {
    printf('<h2>ERROR: %s == %s</h2>',$input['bad'],$input['good']);
  }
}
if ( $input['good']!=0 ) {
  $definicion_name = get_definicion_name($input['table'], $input['good']);
  printf('<h4>%s</h4>'
	 , $definicion_name
	 );

  $lista = mostrar_sinonimos($input['table'], $input['good']);
  $obj = new Sinonimos();
  $obj->table_name='';
  $obj->set_name($input['table']);
  $obj->imprimir($lista);
} elseif($input['table']!="0") {
  $lista = get_bad_good_definiciones( $input['table'] );
  $obj = new Good_and_bad();
  $obj->set_name($input['table']);
  $obj->set_index('good_id', 0);
  $obj->imprimir($lista);
} else {
  echo '<table border="1">';
  foreach ($tablas as $row) {
      $existe = comprobar_existencia_tabla( 'diccionario_'.$row['nombre'] );
      if( is_object($existe) ) {
	  $lista = get_bad_good_definiciones( 'diccionario_'.$row['nombre'] );
	  if (is_array($lista[0]) ) {
	      echo '<tr>';
	      echo '<td>';
	      echo $row['nombre'];
	      echo '</td>';
	      $obj = new Good_and_bad();
	      $obj->set_name( 'diccionario_'.$row['nombre'] );
	      $obj->set_index('good_id', 0);
	      echo '<td>';
	      $obj->imprimir($lista);  
	      echo '</td>';
	      echo '<tr>';
	  }

      } /*end if*/
  }/*end foreach*/
  echo '</table>';
}
?>
</div>

<?php


function sinonimo($tabla,$bad,$good) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  UPDATE %s SET sinonimo="%s" WHERE id="%s"
  ';
  $sql = sprintf($sql,$tabla,$good,$bad);
  $mysqli->query($sql);
  
}//end-function


function show_tables() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT 
  id, nombre
  FROM campo
  WHERE
  categoria="diccionario"
  ORDER BY 2
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);

  $data = array();
  $i=0;
  while ( $data[] = $result->fetch_assoc() ){
      $i++;
  }
  unset( $data[$i] );
  return $data;

}// end-function

function definiciones($tabla_in) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT id,nombre FROM %s WHERE sinonimo=0 ORDER BY 2
  ';
  $sql = sprintf($sql, $tabla_in);

  $result = $mysqli->query($sql);
  $data = array();
  $i=0;
  while ( $data[] = $result->fetch_assoc() ) {
      $i++;
  }
  unset( $data[$i] );
  return $data;
}// end-function

function definiciones_sinonimos($tabla_in, $data_in) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT DISTINCT sinonimo FROM %s WHERE sinonimo!=0
  ';
  $sql = sprintf($sql, $tabla_in);

  $result = $mysqli->query($sql);
  $data = array();
  $i=0;
  while ( $row = $result->fetch_assoc() ) {
      $data[] = $row['sinonimo'];
      $i++;
  }
  unset( $data[$i] );
  $out = array();
  foreach ($data_in as $row) {
      if ( array_search($row['id'], $data)===FALSE ) {
	  $out[] = $row;
      }
  }

  /* EtiquetasHtml::printr($data); */
  /* EtiquetasHtml::printr($data_in); */
  /* EtiquetasHtml::printr($out); */
  return $out;
}// end-function

function get_diccionario_name($id) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT nombre FROM campo WHERE id="%s"
  ';
  $sql = sprintf($sql,$id);
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  return $row['nombre'];
}// end-function


function get_definicion_name($table,$id) {
  global $mysqli;
  
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT nombre FROM %s WHERE id="%s"
  ';
  $sql = sprintf($sql, $table, $id);
  $result = $mysqli->query($sql);
  $row = $result->fetch_assoc();
  return utf8_encode($row['nombre']);
}// end-function

function get_bad_good_definiciones($table_in) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = '
  SELECT 
    d1.sinonimo as "good_id"
  , d2.nombre as "good_nombre"
  , d1.id as "bad_id"
  , d1.nombre as "bad_nombre"
  FROM %1$s d1
  JOIN %1$s d2 ON d1.sinonimo=d2.id
  WHERE d1.sinonimo!=0
  ';
  $sql = sprintf($sql, $table_in);
  $result = $mysqli->query($sql);
  $data = array();
  $i=0;
  while ( $data[] = $result->fetch_assoc() ) {
      $i++;
  }
  unset( $data[$i] );
  return $data;
}// end-function

function mostrar_sinonimos($tabla,$id) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  SELECT id,nombre FROM %s WHERE sinonimo = "%s"
  ';
  $sql = sprintf($sql,$tabla,$id);
  $result = $mysqli->query($sql);
  $data = array();
  $i=0;
  while ( $data[] = $result->fetch_assoc() ) {
      $i++;
  }
  unset( $data[$i] );
  return $data;
}// end-function

function comprobar_existencia_tabla($name) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = ' DESC %s ';
  $sql = sprintf($sql,$name);
  $result = $mysqli->query($sql);
  return $result;
}// end-function

function sql_test() {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $sql = '
  ';
  $sql = sprintf($sql);
  $result = $mysqli->query($sql);

}// end-function

// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = '../../librerias.v2/vendor/chosen/chosen.jquery.min.js';
EtiquetasHtml::$files['footer']['js'][] = './js/identificar-definiciones.js?v=2';
EtiquetasHtml::footer();

