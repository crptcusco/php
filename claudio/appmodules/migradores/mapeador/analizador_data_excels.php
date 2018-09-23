<?php
// ---------------------------------------------- ini-libs
include ("../../librerias.v2/html/etiquetas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 

EtiquetasHtml::$files['header']['css'][] = '../../static/css/tableContainer.css';
EtiquetasHtml::$title = 'Analizador Data Exels';
EtiquetasHtml::$path = '../../librerias.v2/';

EtiquetasHtml::header();
// ---------------------------------------------- ini-functions
function print_data_in_table($data) { ?>
<?php 
 $last = count($data[0]);
?>
<div style="">
  <div class="tableContainer">
    
    <table class="scrollTable" width="100%" border="0" cellpadding="0" cellspacing="0">
      <thead class="fixedHeader">
	<tr class="alternateRow">
	  <?php 
	  $i=1;
	  foreach($data[0] as $key => $row)
	  {
	    $class_last="";
	    if ($last==$i){
	      $class_last="col-last";
	    }
	    printf('<th class="col-%s %s">%s</th>'
		   , $i
		   , $class_last
		   , $key);
	    $i++;
          }
	  ?>
	</tr>
      </thead>
      <tbody class="scrollContent">
	<?php
	$iterate = 'alternateRow';
	foreach($data as $col)
	{
	  $class_last="";
	  if ($last==$i){
	    $class_last="col-last";
	  }
	  if ($iterate == 'alternateRow') $iterate = 'normalRow';
	  elseif ($iterate == 'normalRow') $iterate = 'alternateRow';
          printf('<tr class="%s">', $iterate);
	  $i=1;
	  foreach($col as $row)
	  {
	    $class_last="";
	    if ($last==$i){
	      $class_last="col-last";
	    }
	    printf('<td class="col-%s %s">%s</td>'
		   , $i
		   ,$class_last
		   ,$row);
	    $i++;
	  }
          printf('</tr>');
	}
	?>
      </tbody>
    </table>
  </div>
</div>
<?php } /*end function*/ 
// ---------------------------------------------- ini-body
for ($i=1; $i<=150; $i++) {
  $data[] = array(
      'campo01' =>'data'.$i.'-01'
    , 'campo02' =>'data'.$i.'-02'
    , 'campo03' =>'data'.$i.'-03'
    , 'campo04' =>'data'.$i.'-04' . ' data'.$i.'-04' . ' data'.$i.'-04'
    , 'campo05' =>'data'.$i.'-05'
    , 'campo06' =>'data'.$i.'-06'
    , 'campo07' =>'data'.$i.'-07'
    , 'campo08' =>'data'.$i.'-08'
    , 'campo09' =>'data'.$i.'-09'
  );  
}
?>
<div class="row">
  <div class="large-12 columns">
    <?php 
    print_data_in_table( $data );
    ?>
  </div>
</div>
<style>
 .col-4{
 }
</style>
<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::footer();
