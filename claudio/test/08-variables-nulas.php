<?php 

$a = 12;

$b = 0;

echo '<h4>Empty(12)</h4>';
echo '<pre>';
var_dump( empty( $a ) );
echo '</pre>';

echo '<h4>Empty(0)</h4>';
echo '<pre>';
var_dump( empty( $b ) );
echo '</pre>';

echo '<h4>Empty(NULL)</h4>';
echo '<pre>';
var_dump( empty( $c ) );
echo '</pre>';
?>