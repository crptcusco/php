<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

include ("./settings.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';
EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$mysqli = new mysqli(HOST, DB_USER, DB_PASS, DB_0);
?>
<div class="row">
  <div class="large-12 columns">
    <form method="POST">
      <table>
	<tr>
	  <td>Table</td>
	  <td>
	    <input type="text" name="table" value="<?php echo $_POST['table']?>"/>
	  </td>
	</tr>
	<tr>
	  <td>Select</td>
	  <td><textarea rows="5" cols="500" name="query"><?php 
							 $query = $_POST['query'];
							 $query = str_replace("\'", "'", $query);
							 echo $query;
							 ?></textarea></td>
	</tr>
	<tr>
	  <td></td>
	  <td><input type="submit" name="generar" value="sql"></td>
	</tr>
	<tr>
	  <td> Table and SQL</td>
	  <td>
	    <textarea rows="10" cols="500" name="sql"><?php 
						      if ( isset($_POST['query']) &&
							  isset($_POST['table']) &&
							  $_POST['query']!='' &&
							  $_POST['table']!=''
							)
						      {
							if ($_POST['generar']=='sql') {
							  $query = $_POST['query'];
							  $query = str_replace("\'", "'", $query);
							  mysql_sql($query, $_POST['table']);							  
							} else {
							  $query = $_POST['sql'];
							  $query = str_replace("\'", "'", $query);
							  echo $query;
							}
						      }
						      ?></textarea>	  
	  </td>
	</tr>
      </table>
    </form>


  </div>
</div>

<?php
function mysql_sql($sql, $name) {
  global $mysqli;

  if ($mysqli->connect_errno) 
    echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
  
  $result = $mysqli->query($sql);

  $sql_create ="";

  $first =TRUE;
  while ($row = $result->fetch_assoc()) {
    if ($first==TRUE) {
      // $sql_create.= 'DROP TABLE IF EXISTS '.$name.';'."\n";
      $sql_create.= 'CREATE TABLE IF NOT EXISTS '.$name.'('."\n";
      $i=1;
      foreach ($row as $key => $value) {
	$sql_create.= '    '.$key." VARCHAR(500)";
	if ( $i==count($row) ) {
	  $sql_create.="\n";
	} else {
	  $sql_create.=",\n";
	}
	$i++;
      }
      $sql_create.= ");\n";
      echo $sql_create;
      $first =FALSE;
    }
    $sql_keys = '';
    $sql_values = '';

    foreach ($row as $key => $value) {
      $sql_keys .= $key .', ';
      // $value = utf8_decode( $value );
      $sql_values .= "'". trim($value) ."', ";
    }

    $sql_keys = substr($sql_keys, 0, -2);
    $sql_values = substr($sql_values, 0, -2);
    $sql='INSERT INTO '.$name.'('.$sql_keys.') VALUES('.$sql_values.');';
    echo $sql ."\n";
  }  
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
