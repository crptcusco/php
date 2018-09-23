<?php


function info_clds_print($title, $data) {
    if (! is_null($title) ) {
	echo '<h2 style="margin: 0px; background-color: rgb(179, 195, 255); color: rgb(105, 84, 204);">';
	echo $title;
	echo '</h2>';
    }
    if (! is_null($data) ) {
	echo '<pre style="background-color: rgb(248, 235, 172); color: rgb(78, 84, 98); font-size: 0.8em; padding: 0.5em; margin: 0px; overflow: scroll; height: 8em;">';
	print_r($data);
	echo '</pre>';
    }
}
?>