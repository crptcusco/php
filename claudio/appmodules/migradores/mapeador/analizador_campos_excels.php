<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");
// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
?>
<div class="row">
  <div class="large-12 columns">
    <?php
    CSV_to_array::$name = 'C:\Documents and Settings\Allemant\CLAUDIO\trabajo\requerimientos\modelos.csv';
// CSV_to_array::$name = './campos.csv';
    $data = CSV_to_array::get_data();

    EtiquetasHtml::h(1,'Lista de Categorias y sus campos');
    EtiquetasHtml::printr( $data );
	     
    // mostrar campos 
    $orden=NULL;
    $orden = array(0,1,2,3,4,5,6,


		   13,14,15,16,
		   10,11,12,8,9,
		   7,17,18,19,20,
		   21,22,23,24,25,
		   26,27,28,29,30,
		   31,35,36,32,37,
		   40,33,34,39,38,
		   41,42,43
		   );
    $campos = CSV_to_array::get_campos($data,$orden);
    EtiquetasHtml::h(1,'Campos');
    EtiquetasHtml::printr( $campos );

    ?>
    <style>
     td {
       border: 1px solid !important;
       text-align: center !important;
     }
    </style>
    <table>
      <!-- encabezados -->
      <tr>
	<th>Tipo</th>
	<?php 
	foreach($campos as $row){
	  printf(
	    '<th>%s (%s)</th>'
	    , $row['value']
	    , $row['key']
	  );
	}
	?>
      </tr>
      <?php
      foreach($data as $key =>$row) {
	print '<tr>';
	printf(
	  '<th>%s</th>'
	  , $key
	);
	foreach($campos as $col){
	  printf(
	    '<td><a href="#" title="%s">'
	    , $key
	  );
	  if (in_array($col['value'], $row)) {
	    print 'X';
	  } else {
	    print '--';
	  }
	  print '</a></td>';
	}

	print '</tr>';
      }
      ?>
    </table>
  </div>
</div>

<?php
class CSV_to_array {
  public static $name;
  public static function get_data() {

    $data = array();
    
    $file = fopen( self::$name, "r" );
    
    while(! feof($file))
    {
      $data[] = fgetcsv($file);
    }    
    fclose($file);
    $data = self::clean($data);
    return $data;
  }
  protected static function clean($data) {
    $data2 = array();
    foreach ($data  as $row) {
      $col_num = 0;
      if ( $row ) {
	foreach ($row  as $field) {
	  if ($field){
	    $col_num++;
	  }
	}
      }

      if ($col_num==1){
	$tipo = $row[0];
	
      } elseif ($col_num>1){
	$data2[$tipo] = array_slice($row,0,$col_num);
      }  

    }
    return $data2;
  }

  public static function get_campos($data,$orden) {
    $campos = array();
    foreach( $data as $row ) {
      foreach( $row as $col ) {
	if (!in_array($col, $campos)) {
	  $campos[] = $col;	  
	}
      }
    }

    $campos2=array();
    $i=0;
    foreach ($campos as $row) {
      $campos2[] = array('key'=>$i++, 'value'=>$row);
    }

    $campos_ordenados=array();
    if ( isset($orden) ) {
        foreach ($orden as $index) {
          $campos_ordenados[] = $campos2[$index];
        }        
    } else {
         $campos_ordenados = $campos2;
    }

    return $campos_ordenados;
    // asort($campos);
    // return $campos2;
    
  }
}

// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
