<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");
include  '../../librerias.v2/acciones/validar.php';

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);

$list = array ('table','field', 'procesar','type_date');
$input = procesar_campos ($list);

$type = array(
    array('value'=>'int', 'text'=>'int')
  , array('value'=>'float', 'text'=>'float')
  , array('value'=>'date', 'text'=>'date(d/m/Y)')
);

$combo = new ComboSimple();
$combo->set_name('type_date');
$combo->set_label('[ Seleccione ]');
$combo->set_option($input['type_date']);
$combo->set_format( array('value','text') );

?>
<div class="row">
  <div class="large-4 columns">
    <form method="GET">
      <?php $i=0 ?>
      <table>      
	<tr>
	  <td>Tabla</td>
	  <td><input type="text" name="<?php echo $list[$i] ?>" id="id_<?php echo $list[$i] ?>" value="<?php echo $input[ $list[$i++] ]?>" /></td>
	</tr>
	<tr>
	  <td>Campo</td>
	  <td><input type="text" name="<?php echo $list[$i] ?>" id="id_<?php echo $list[$i] ?>" value="<?php echo $input[ $list[$i++] ]?>" /></td>
	</tr>
	<tr>
	  <td>Tipo</td>
	  <td><?php $combo->imprimir($type); ?></td>
	</tr>
	<tr>
	  <td colspan="2">
	    <input class="button" type="submit" name="<?php echo $list[$i] ?>"/>
	  </td>
	</tr>
      </table>
    </form>
  </div>
  <div class="large-8 columns">
    <?php
    if ($input['type_date']!='' && $input['type_date']!='0') {
      $count = count_rows( $input['table'], $input['field'] );
      $limit = 500;
      $data = data_rows( $input['table'], $input['field'], $limit, $input['type_date']);
      print_html($data, $input['table'], $input['field'], $input['type_date']);
      
      // verificar si hay mas
    }
    ?>
  </div>

<?php
function procesar_campos ($list) {
  $input = array();
  foreach( $list as $row ) {
    $input[$row] = '';
    if ( isset($_GET[$row]) )
      $input[$row] = $_GET[$row];
    }
  return $input;
}

function count_rows($table,$field) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = sprintf(''
		.'SELECT COUNT(DISTINCT %s) FROM %s'
		 , $field
		 , $table
		 );
  $result = $mysqli->query($sql);
  $row = $result->fetch_array();
  return $row[0];
}
function data_rows($table,$field, $limit,$type_date) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = sprintf(''
		.'SELECT DISTINCT %s FROM %s LIMIT %s'
		 , $field
		 , $table
		 , $limit
		 );
  $result = $mysqli->query($sql);
  $data = array();
  while ($row = $result->fetch_array()){
    if( que_es($row[0],$type_date) ==0) {
      $data[] = $row[0];
    }

  }
  return $data;
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

function print_html($data,$table,$field,$type_date) { ?>
<div id="list-value">
  <?php foreach($data as $row){ ?>
    <div class="row display">
      <div class="medium-6 columns"><?php echo $row ?></div>
      <div class="medium-6 columns"><input style="width:70px"><a href='#' table="<?php echo $table ?>" field="<?php echo $field ?>" type_date="<?php echo $type_date ?>" class="item-replace">Replace</a></div>
    </div>  
  <?php }/*foreach*/ ?>
</div>
<?php }
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = './mysql-filter-value.js';
EtiquetasHtml::footer();
