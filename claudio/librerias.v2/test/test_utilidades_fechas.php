<?php
include '../utilidades.php';
echo '<h2>De militar a meridiano</h2>';
echo '<table border="1">';
$cnt=1;
for ($i=0; $i<24;$i++) {
  echo '<tr>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  echo $cnt++;
  echo '</td>';
  echo '<td>';
  printf("%02d:%02d", $i, 0);
  echo '</td>';
  echo '<td>';
  echo Utilitarios::fechas_de_militar_a_meridiano( array('hora'=>$i, 'minuto'=>0, 'return'=>'') );
  echo '</td>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  var_dump( Utilitarios::fechas_de_militar_a_meridiano( array('hora'=>$i, 'minuto'=>0, 'return'=>'array') ) );
  echo '</td>';       
  echo '</tr>';
}
echo '</table>';
echo '<h2>De militar a meridiano</h2>';
echo '<table border="1">';
$cnt=1;
$meridiano='am';
for ($i=1; $i<13;$i++) {
  echo '<tr>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  echo $cnt++;
  echo '</td>';
  echo '<td>';
  printf("%02d:%02d %s", $i, 0, $meridiano);
  echo '</td>';
  echo '<td>';
  echo Utilitarios::fechas_de_meridiano_a_militar( array('hora'=>$i, 'minuto'=>0, 'meridiano' => $meridiano, 'return'=>'') );
  echo '</td>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  var_dump( Utilitarios::fechas_de_meridiano_a_militar( array('hora'=>$i, 'minuto'=>0, 'meridiano' => $meridiano, 'return'=>'array') ) );
  echo '</td>';
}
$meridiano='pm';
for ($i=1; $i<13;$i++) {
  echo '<tr>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  echo $cnt++;
  echo '</td>';
  echo '<td>';
  printf("%02d:%02d %s", $i, 0, $meridiano);
  echo '</td>';
  echo '<td>';
  echo Utilitarios::fechas_de_meridiano_a_militar( array('hora'=>$i, 'minuto'=>0, 'meridiano' => $meridiano, 'return'=>'') );
  echo '</td>';
  echo '<td style="background-color: rgb(183, 183, 183);">';
  var_dump( Utilitarios::fechas_de_meridiano_a_militar( array('hora'=>$i, 'minuto'=>0, 'meridiano' => $meridiano, 'return'=>'array') ) );
  echo '</td>';
}
echo '</table>';

echo '<h2>De MysqlTimeStamp a array</h2>';
$fecha = '2015-07-09 10:13:35';
echo '<table border="1">';
echo '<tr>';
echo '<td>';
echo $fecha;
echo '</td>';
echo '<td>';
echo '<pre>';
print_r( Utilitarios::fechas_de_MysqlTimeStamp_a_array($fecha) );
echo '</pre>';
echo '</td>';
echo '</tr>';
echo '</table>';

echo '<h2>De array a MysqlTimeStamp</h2>';
$fecha = array('anio'=>'2015'
		    , 'mes'=>'7'
		    , 'dia'=>'9'
		    , 'hora'=>'1'
		    , 'minuto'=>'4'
		    , 'segundo'=>'5'
		    );
echo '<table border="1">';
echo '<tr>';
echo '<td>';
echo '<pre>';
print_r( $fecha );
echo '</pre>';
echo '</td>';
echo '<td>';
echo Utilitarios::fechas_de_array_a_MysqlTimeStamp($fecha);
echo '</td>';
echo '</tr>';
echo '</table>';
?>
