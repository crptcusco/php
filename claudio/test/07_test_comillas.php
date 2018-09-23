<pre>
CREATE TABLE test_comilla(
   paramentro VARCHAR(500) 
);
</pre>
<?php 
// creando tabla


// prueba 1: paramentros con comillas simples con cadenas con comillas simples
$parametro = '"aa" aa'; 
$sql = 'SELECT * from test_comilla WHERE paramentro="%s";';
printf($sql,$parametro);
echo '<br>';

$parametro = '\"aa\" aa'; 
$sql = 'SELECT * from test_comilla WHERE paramentro="%s";';
printf($sql,$parametro);
echo '<br>';
$sql = 'INSERT INTO test_comilla(paramentro) VALUES("%s");';
printf($sql.'<br>',$parametro);
echo '<br>';

/*
 CONCLUSIONES:
 - en las cadenas php usamos comillas simples ' y no "
 - en las consultas sql usamos "
 - y en caso que el dato contenga un " para evitar error remplazar por \"
*/
?>
