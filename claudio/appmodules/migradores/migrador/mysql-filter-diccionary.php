<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
include ("../../librerias.v2/html/tabla.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_1);

$list = array ('table','field','type','diccionary','procesar');
$input = procesar_campos ($list);

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
	  <td><input type="text" name="<?php echo $list[$i] ?>" id="id_<?php echo $list[$i] ?>" value="<?php echo $input[ $list[$i++] ]?>" /></td>
	</tr>
	<tr>
	  <td>Diccionario</td>
	  <td><input type="text" name="<?php echo $list[$i] ?>" id="id_<?php echo $list[$i] ?>" value="<?php echo $input[ $list[$i++] ]?>" /></td>
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
    if( $input['diccionary'] !='' ) {
      crear_diccionario($input['diccionary']);
      $count = count_rows($input['table'],$input['field'],$input['diccionary']);
      $limit = 500;
      $data = data_rows($input['table'],$input['field'],$input['diccionary'], $limit);
      imprir_html($data,$input['diccionary']);
      // eventos ajax
      if ($count > $limit ){
	EtiquetasHtml::h(1,'Hay mas data');
      }
    }
    ?>   
  </div>
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

function crear_diccionario($name) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;  
  $sql = 'CREATE TABLE IF NOT EXISTS '.$name.'_diccionary(id BIGINT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), nombre VARCHAR(500))';
  $mysqli->query($sql);
  $sql = 'CREATE TABLE IF NOT EXISTS '.$name.'_history(id BIGINT NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID), nombre VARCHAR(500), '.$name.'_diccionary_id BIGINT NOT NULL)';
  $mysqli->query($sql);
  $sql = 'ALTER TABLE '.$name.'_history ADD INDEX ('.$name.'_diccionary_id) ';
  $mysqli->query($sql);
}

function count_rows($table,$field,$diccionary) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = sprintf(''
		.'SELECT COUNT(DISTINCT %s) FROM %s WHERE %s NOT IN '
		.'(SELECT nombre FROM %s_history WHERE nombre IS NOT NULL)'
		 , $field
		 , $table
		 , $field
		 , $diccionary
		 );
  $result = $mysqli->query($sql);
  $row = $result->fetch_array();
  return $row[0];


}

function data_rows($table,$field,$diccionary,$limit) {
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = sprintf(''
		.'SELECT DISTINCT %s FROM %s WHERE %s NOT IN '
		.'(SELECT nombre FROM %s_history WHERE nombre IS NOT NULL) '
		. 'ORDER BY 1 LIMIT %s'
		 , $field
		 , $table
		 , $field
		 , $diccionary
		 , $limit
		 );
  $result = $mysqli->query($sql);
  $data = array();
  while ($row = $result->fetch_array()) {
    $data[] = trim($row[0]);
  }  
  return $data;
  
}


function imprir_html($data, $diccionary){
?>
<div id="list-diccionary">
  <?php foreach($data as $row){ ?>
    <div class="row display">
      <div class="medium-4 columns"><?php echo  utf8_encode($row) ?></div>
      <div class="medium-3 columns"><input style="width:70px"><a href='#' table="<?php echo $diccionary ?>" class="item-search">?</a></div>
      <div class="medium-1 columns"><a href='#' table="<?php echo $diccionary ?>"  value="<?php echo utf8_encode($row) ?>" class="item-add">+</a></div>
      <div class="medium-4 columns"><input style="width:70px"><a href='#' table="<?php echo $diccionary ?>"  value="<?php echo utf8_encode($row) ?>" class="item-replace">Replace</a></div>
    </div>
    <div class="row">
      <div class="medium-12 columns" style="display:none;">
	dd
      </div>
    </div>
  <?php }/*foreach*/ ?>
</div>
<?php
} // imprimit_html

// ---------------------------------------------- ini-footer
 EtiquetasHtml::$files['footer']['js'][] = './mysql-filter-diccionary.js';
EtiquetasHtml::footer();
