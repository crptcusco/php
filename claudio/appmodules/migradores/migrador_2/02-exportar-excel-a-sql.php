
<?php 
require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
include ("./settings.php");

$celdas_tot =FUENTE_COLS;
$file = FUENTE_FILE;
$table = FUENTE;

print '<textarea rows="40" cols="300" style="width: 100%;">';
foreach ($modelos as $row)
{
  excel_to_mysql($row['col'], 'xls/'.$row['file'], $row['fuente']);
}/*end foreach*/
print '</textarea>';

/*
print '<textarea rows="40" cols="300" style="width: 100%;">';
excel_to_mysql($celdas_tot, $file, $table);
print '</textarea>';
*/


function excel_to_mysql($celdas_tot, $file, $table) 
{
    // global $mysqli;
  
    $celdas = ARRAY('A', 'B', 'C', 'D', 'E', 
		  'F', 'G', 'H', 'I', 'J', 
		  'K', 'L', 'M', 'N', 'O', 
		  'P', 'Q', 'R', 'S', 'T', 
		  'U', 'V', 'W', 'X', 'Y', 
		  'Z',
		  'AA', 'AB', 'AC', 'AD', 'AE', 
		  'AF', 'AG', 'AH', 'AI', 'AJ', 
		  'AK', 'AL', 'AM', 'AN', 'AO', 
		  'AP', 'AQ', 'AR', 'AS', 'AT', 
		  'AU', 'AV', 'AW', 'AX', 'AY', 
		  'AZ',
		  );

  $objPHPExcel = PHPExcel_IOFactory::load($file);
  $objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
  $h=0;
  $data = array();
  $header = array();
  $first = TRUE;
  
  $sql_field='';
  foreach ($objHoja as $iIndice=>$objCelda) {
    if ($first)
    {
	      $i=0;
              $sql_tabla = '';
	      do {
		  $sql_field.=','.$objCelda[$celdas[$i]];
		  $sql_tabla.= ','.$objCelda[$celdas[$i]].' TEXT';
		  $i++;
	      } while ($celdas[$i]!=$celdas_tot);

	      print 'CREATE TABLE '.$table.' (';
              print substr($sql_tabla,1);
	      print ');'."\n";
	      $sql_field = substr($sql_field,1);
	      $first=FALSE;
	      continue;
	  }/*end if*/ 

      $i=0;  
      $sql_value='';
      do {
	  $value = $objCelda[$celdas[$i]];
	  $value = trim($value);
	  $value = str_replace('"','\"' , $value);
	  $value = str_replace("\\",'\\\\',$value);
	  //$value = utf8_decode($value);
	  $sql_value.= ',"'.$value.'"';

	  $i++;
      } while ($celdas[$i]!=$celdas_tot);
      $sql_value = substr($sql_value,1);
      print 'INSERT INTO '.$table.'('.$sql_field.') VALUES ('.$sql_value.');'."\n";
      $h++;

  }
} // excel_to_mysql
?>
