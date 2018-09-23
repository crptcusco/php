<?php 

if ( isset($_POST['ruta']) ){
    //print $_POST['ruta'];

    $_POST['ruta'] =  str_replace("\\\\", "\\", $_POST['ruta']);
    //system ( 'explorer.exe Y:\OPERACIONES\Tasaciones\Bco. Credito\2014\ABRIL\TasBCP089-2014-12160  ABOGADOS-INGENIEROS SERVICE SRLTDA' );
    //system ( 'explorer.exe '.$_POST['ruta'] );
    //exec( 'explorer.exe '.$_POST['ruta'] );
}


?>