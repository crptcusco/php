<div id="map" style="width: 100%; height: 550px;"></div>
<div class="" id="list-item">
    <?php
    $i=0;
    foreach($data as $row) {
      $i++;
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
     if ( trim( $row['LATITUD'] ) != '0' or trim( $row['LONGITUD'] ) != '0'){
	 printf(
		'[%s,%s,%s,%s]'.",\n"
		, $row['LATITUD']      
		, $row['LONGITUD']
		, $row['ITEM']
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
