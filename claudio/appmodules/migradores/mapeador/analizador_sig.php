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
$mysqli = new mysqli("localhost", "root", "allemant", "allemant02");
// $mysqli = new mysqli("localhost", "root", "admin", "ella");

?>
<div class="row">
  <div class="large-12 columns">
    <form action="" metod="get">
        <input type="text" name="search" value="<?php if  (isset($_GET['search'])) echo $_GET['search']  ?>">
        <input type="text" name="pagina" value="<?php if  (isset($_GET['pagina'])) echo $_GET['pagina']  ?>">
      <input type="submit" value="Buscar">
    </form>
  </div>
  <div class="large-6 columns">
    <?php
      $mapa = mapa();
      EtiquetasHtml::h(1,'Mapa de BD');
      EtiquetasHtml::printr( $mapa );
    ?>
  </div>
  <div class="large-6 columns">
    <?php
      $fields = fields ($mapa);
      EtiquetasHtml::h(1,'Lista de campos');
      EtiquetasHtml::printr( $fields );
    ?>
  </div>
</div>
<div class="row">
  <div class="large-4 columns">
      <?php 
      $detalle ='';
      if( isset($_GET['search']) ) {
	
	$search = $_GET['search'];
	$total = 500;
	$pagina = $_GET['pagina']*$total;
	$filter_cld = ' LIMIT '.$pagina.', '.$total;
	foreach ($mapa as $table => $row) {
	  if ($row) {
	    $sql = 'SELECT * FROM '. $table.' ';
	    $filter = '';
	    $i=0;
	    foreach ($row as $field) 
	    {
	      if ($i>0) {
		$filter .= ' OR ';
	      }

	      if ( strpos($field['type'],'bigint') == 0  and strpos($field['type'],'bigint') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'char') == 0  and strpos($field['type'],'char') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'date') == 0  and strpos($field['type'],'date') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'decimal') == 0  and strpos($field['type'],'decimal') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'int') == 0  and strpos($field['type'],'int') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'smallint') == 0  and strpos($field['type'],'smallint') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'text') == 0  and strpos($field['type'],'text') !==FALSE ) {
		$filter .= $field['name'] . ' LIKE "%'.$search.'%"';
	      }
	      if ( strpos($field['type'],'time') == 0  and strpos($field['type'],'time') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'tinyint') == 0  and strpos($field['type'],'tinyint') !==FALSE ) {
		$filter .= $field['name'] . ' = "'.$search.'"';
	      }
	      if ( strpos($field['type'],'varchar') == 0  and strpos($field['type'],'varchar') !==FALSE ) {
		$filter .= $field['name'] . ' LIKE "%'.$search.'%"';
	      }
	      $i++;
	    }
	    if ($i>0) {
	      $sql = $sql.' WHERE '. $filter.$filter_cld;
	    }
	    $result = $mysqli->query($sql);
	    $row_cnt = $result->num_rows;
	    
	    if ($row_cnt >0) {
	      print $table.'('.$row_cnt.')'. '<br>';
	      $detalle .= '<h3>'.$table.'</h3>';
	      $detalle .= '<div style="max-height: 500px; overflow: scroll; max-width: 800px; background-color: rgb(226, 228, 219);">';
	      $detalle .= '<table>';
	      $j=0;
	      while ($row = $result->fetch_array()){
		$campos_num = count($row) / 2 ;
		if ($j==0){
		  $detalle .= '<tr class="alternateRow">';
		  foreach ($row as $key =>$row2){
		    if (!is_int($key)) {
		      $detalle .= '<th>'.$key.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
		    }		  
		  }
		  $detalle .= '</tr>';
		}
		
		$detalle .= '<tr>';
		for ($k=0; $k<$campos_num; $k++) {
		  // Produce: <body text='black'>
		  $str_row = str_ireplace($search, '<b style="background-color: yellow;">'.$search.'</b>' , $row[$k]); 
		  $detalle .= '<td>';
		  $detalle .= $str_row;
		  $detalle .= '</td>';

		}
		$detalle .= '</tr>';
		$j++;	      
	      }
	      $detalle .= '</table>';
	      $detalle .= '</div>';
	    }
	  }
	}
      }

    ?>
  </div>
  <div class="large-8 columns">
    <?php echo $detalle; ?>    
  </div>
</div>

<?php
function mapa() {
    global $mysqli;
    
    if ($mysqli->connect_errno) {
	echo "Fallo al contenctar a MySQL: " . $mysqli->connect_error;
    }

    // opteniendo todas las tablas
    $tables = array();
    $result = $mysqli->query("SHOW TABLES");
    while ($row = $result->fetch_array()){
	$tables[] = $row[0];    
    }

    // opteniendo todos los campos por tablas
    $fields = array();
    foreach ($tables as $row1) {
	$result = $mysqli->query("DESC ".$row1);
	while ($row2 = $result->fetch_assoc()){
	    $fields[$row1][] = array('name' => $row2['Field'], 'type' => $row2['Type']);
	}
    }
    return $fields;
}
function fields ($data) {
    $list = array();
    foreach ($data as $table) {
	foreach ($table as $field) {
	    if (!in_array($field['type'], $list)) {
		$list[] = $field['type'];
	    }  
	}
    }
    asort($list);
    return $list;
}
// ---------------------------------------------- ini-footer
// EtiquetasHtml::$files['footer']['js'][] = './scripts01.js';
EtiquetasHtml::footer();
