<div id="map" style="width: 100%; height: 550px;"></div>
<div class="" id="list-item">
    <?php
    $i=0;
    foreach($data as $row) {
      $i++;
      unset($row[0]);
      echo '<div class="item reveal-modal" id="item-' . $i . '" style="display:none" data-reveal>';
      echo '<pre>';
      print_r($row);
      echo '</pre>';
      echo ' <a class="close-reveal-modal">&#215;</a>';
      echo '</div>';

    }
    ?>
</div>



<script>
var locations = [
   <?php
   $i=0;
   $j=0;
   foreach($data as $row) {
     $i++;
     if ( trim( $row[0]['LATITUD'] ) != '0' or trim( $row[0]['LONGITUD'] ) != '0'){
	 printf(
		'[%s,%s,"%s",%s]'.",\n"
		, $row[0]['LATITUD']      
		, $row[0]['LONGITUD']
		, $row[0]['ITEM']
		, $i
		);     
	 $j++;
     }
   }
   ?>
];
<?php 
//echo 'alert("hay: "+'.$j.'+" puntos");';
?>

</script>
