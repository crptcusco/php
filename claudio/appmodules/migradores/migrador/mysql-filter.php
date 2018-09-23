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

$url['diccionary'] = './mysql-filter-diccionary.php';
$url['value'] = './mysql-filter-value.php';
?>
<div class="row">
  <div class="large-12 columns">
    <form method="POST">
      <table>
	<tr>
	  <td>Table Name:</td>
	  <td>
	    <?php 
	    $tables = show_tables();
	    $combo = new ComboSimple();
	    $combo->set_name('table_name');
	    if (isset($_POST['table_name']))	    
	      $combo->set_option($_POST['table_name']);
	    $combo->set_format( array('value','text') );
	    $combo->imprimir($tables);
	    ?>
	  </td>
	  <td>
	    <input class="button" type="submit">
	  </td>
	</tr>
	<tr>
	  <td colspan="3">
	    <?php 
	    if (isset($_POST['table_name']) &&  $_POST['table_name'] != '') {
	      $campos = mysql_tables( $_POST['table_name'] );
	      echo '<table>';
	      $tbl_tr01 = '';
	      $tbl_tr02 = '';
	      $tbl_tr03 = '';

	      foreach($campos as $row) {
		$tbl_tr01.= sprintf(''
				   . '<td>%s<br>(%s)</td>'
				    , $row['field']
				    , $row['type']
				    );
		$tbl_tr02.= sprintf(''
				   . '<td><a href="%s?table=%s&field=%s&type=%s" target="_blank">Diccionario</a></td>'
				    , $url['diccionary']
				    , $_POST['table_name']
				    , $row['field']
				    , $row['type']
				    );
		$tbl_tr03.= sprintf(''
				   . '<td><a href="%s?table=%s&field=%s&type=%s" target="_blank">Valor</a></td>'
				    , $url['value']	
				    , $_POST['table_name']
				    , $row['field']
				    , $row['type']
				    );
	      }
	      echo '<tr>'.$tbl_tr01.'</tr>';
	      echo '<tr>'.$tbl_tr02.'</tr>';
	      echo '<tr>'.$tbl_tr03.'</tr>';
	      echo '</table>';
	    }
	    ?>
	  </td>
	</tr>
      </table>     
    </form>
  </div>
</div>

<?php
function show_tables(){
  global $mysqli;
  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $result = $mysqli->query('SHOW TABLES');

  $data = array();
  while ($row = $result->fetch_array()) {
    $data[] = array('value'=>$row[0], 'text'=>$row[0]);
  }  
  return $data;
}

function mysql_tables($name) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  $sql = 'DESC '.$name;
  $result = $mysqli->query($sql);

  $data = array();
  while ($row = $result->fetch_assoc()) {
    $type = $row['Type'];
    $arr = explode("(", $type);
    $data[] = array(
        'field' => $row['Field']
      , 'type'  => $arr[0]
    );  
  }  
  return $data;
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
