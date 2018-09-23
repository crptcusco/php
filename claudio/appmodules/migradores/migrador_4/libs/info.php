<?php 

function info_data( $title, $data ) {
    echo '<h2>' . $title . '</h2>';
    echo '<textarea style="border: 1px solid; width: 100%; height: 200px;">';
    print_r($data);
    echo '</textarea>';
}


?>