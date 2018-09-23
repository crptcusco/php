<?php 
$array = array(0 => 'azul', 1 => 'rojo', 2 => 'verde', 3 => 'rojo');
test('naranja');
test('azul');
test('rojo');



function test($in){
    global $array;
    $key = array_search($in, $array);
    var_dump($key);
    echo '<br>';
}
?>