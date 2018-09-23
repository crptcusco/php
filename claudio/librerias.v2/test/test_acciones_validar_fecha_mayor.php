<?php
include '../acciones/validar.php';
$i=0;

printf ("<br> %d) ",++$i);//1
var_dump( validar_fecha_mayor_igual('2009-10-12','2009-10-13') );

printf ("<br> %d) ",++$i);//2
var_dump( validar_fecha_mayor_igual('2009-10-13','2009-10-13') );

printf ("<br> %d) ",++$i);//3
var_dump( validar_fecha_mayor_igual('2009-10-14','2009-10-13') );

printf ("<br> %d) ",++$i);//4
var_dump( validar_fecha_mayor_igual('2009-11-12','2009-10-13') );

printf ("<br> %d) ",++$i);//5
var_dump( validar_fecha_mayor_igual('2014-10-12','2009-10-13') );