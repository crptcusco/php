
<?php 
require_once '../../librerias.v2/vendor/PHPExcel/Classes/PHPExcel/IOFactory.php';
ini_set('memory_limit','256M');
// $mysqli = new mysqli("localhost", "root", "admin", "allemant_clds_01");

$celdas_tot ='AD';
$file = 'xls/test2.xls';


excel_to_mysql($celdas_tot, $file);

function excel_to_mysql($celdas_tot, $file) 
{
    // global $mysqli;
  
  // $campos = ARRAY('proyecto_id',                           // 00
		  // 'informe_id',                            // 01   
		  // 'cliente_nombre',                        // 02   
		  // 'propietario_nombre',                    // 03   
		  // 'solicitante_nombre',                    // 04
		  // 'ubi_ubicacion_tipo',                    // 05
		  // 'ubi_ubicacion_dato',                    // 06
		  // 'tasacion_fecha',                        // 07
		  // 'ubi_departamento_dato',                 // 08 
		  // 'ubi_provincia_dato',                    // 09
		  // 'ubi_distrito_dato',                     // 10
		  // 'valor_comercial',                       // 11
		  // 'tipo_cambio',                           // 12
		  // 'observacion',                           // 13
		  // 'ruta_informe',                          // 14
		  // 'map_latitud',                           // 15
		  // 'map_longitud',                          // 16
		  // 'inm_zonificacion',                      // 17
		  // 'inm_terreno_area',                      // 18
		  // 'inm_terreno_area_unidad',               // 19
		  // 'inm_terreno_valor_unitario',            // 20
		  // 'inm_terreno_valor_unitario_unidad',     // 21
		  // 'inm_num_pisos',                         // 22
		  // 'inm_edificacion_area',                  // 23
		  // 'inm_edificacion_area_unidad',           // 24
		  // 'inm_edificacion_valor_unitario',        // 25
 		  // 'inm_edificacion_valor_unitario_unidad', // 26
		  // 'inm_area_complementarias',              // 27
		  // 'dep_piso',                              // 28
		  // 'dep_tipo',                              // 29
		  // 'dep_estacionamiento_num',               // 30
		  // 'lco_vista',                             // 31
		  // 'inm_valor_area_ocupada',                // 32
		  // 'ter_cultivo',                           // 33
		  // 'ter_cultivo_tipo',                      // 34
		  // 'maq_tipo',                              // 35
		  // 'nin_marca',                             // 36
		  // 'nin_modelo',                            // 37
		  // 'nin_fabricacion_anio',                  // 38
		  // 'nin_antiguedad',                        // 39
		  // 'nin_valor_nuevo',                       // 40
		  // 'veh_tipo',                              // 41
		  // 'veh_traccion',                          // 42
		  // 'origen',                                // 43
		  // );
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
  $header =TRUE;
  $sql= array();
  echo '<table border="1" width="100%" cellpadding="0" cellspacing="0">';
  $min=10;
  $max=20;
  $x =-1;
  foreach ($objHoja as $iIndice=>$objCelda) {
	$x++;
	if ($min>$x)
		continue;
	if ($max<$x)
		exit;
    $insert = '';
    if ($header) {
      $header=FALSE;
      print '<thead>';
      print '<tr>';
      do {
	printf('<th>%s</th>'
	       , utf8_decode($objCelda[$celdas[$i]])
	       );
	$i++;
      } while ($celdas[$i]!=$celdas_tot);
      print '</tr>';
      print '</thead>';
      print '<tbody>';
    } else {
      print '<tr>';
      do {
	printf('<td>%s</td>'
	       , utf8_decode($objCelda[$celdas[$i]])
	       );
	$insert .= "'".utf8_decode($objCelda[$celdas[$i]])."', ";
	$i++;
      } while ($celdas[$i]!=$celdas_tot);
      $sql[] = $insert;
      print '</tr>';
    }
  }
  echo '</tbody>';
  echo '</table>';
} // excel_to_mysql
?>
