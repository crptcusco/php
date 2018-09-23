<?php
include '../acciones/validar.php';
$i=0;

printf ("<br> %d) ",++$i);//1
var_dump(validar_fecha('2012-02-28 12:12:12')); # true

printf ("<br> %d) ",++$i);//2
var_dump(validar_fecha('2012-02-30 12:12:12')); # false

printf ("<br> %d) ",++$i);//3
var_dump(validar_fecha('2012-02-28', 'Y-m-d')); # true

printf ("<br> %d) ",++$i);//4
var_dump(validar_fecha('28/02/2012', 'd/m/Y')); # true

printf ("<br> %d) ",++$i);//5
var_dump(validar_fecha('30/02/2012', 'd/m/Y')); # false

printf ("<br> %d) ",++$i);//6
var_dump(validar_fecha('14:50', 'H:i')); # true

printf ("<br> %d) ",++$i);//7
var_dump(validar_fecha('14:77', 'H:i')); # false

printf ("<br> %d) ",++$i);//8
var_dump(validar_fecha(14, 'H')); # true

printf ("<br> %d) ",++$i);//9
var_dump(validar_fecha('14', 'H')); # true

printf ("<br> %d) ",++$i);//10
var_dump(validar_fecha('2012-02-28T12:12:12+02:00', 'Y-m-d\TH:i:sP')); # true

# or
printf ("<br> %d) ",++$i);//11
var_dump(validar_fecha('2012-02-28T12:12:12+02:00', DateTime::ATOM)); # true

printf ("<br> %d) ",++$i);//12
var_dump(validar_fecha('Tue, 28 Feb 2012 12:12:12 +0200', 'D, d M Y H:i:s O')); # true

# or
printf ("<br> %d) ",++$i);//13
var_dump(validar_fecha('Tue, 28 Feb 2012 12:12:12 +0200', DateTime::RSS)); # true

printf ("<br> %d) ",++$i);//14
var_dump(validar_fecha('Tue, 27 Feb 2012 12:12:12 +0200', DateTime::RSS)); # false