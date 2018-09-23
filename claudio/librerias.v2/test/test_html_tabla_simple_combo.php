<?php
include '../html/tabla.php'; 
include '../html/etiquetas.php';

$data[] =array('categoria'=>'1', 'nombre'=>'cat1');
$data[] =array('categoria'=>'2', 'nombre'=>'cat2');
$data[] =array('categoria'=>'3', 'nombre'=>'cat3');
$data[] =array('categoria'=>'4', 'nombre'=>'cat4');	

EtiquetasHtml::debug();
EtiquetasHtml::printr($data);

$obj1 = new ComboSimple();
$obj1->set_name( 'myname2' );
$obj1->set_id( 'myid2' );
$obj1->set_label( '[mylabel]' );
$obj1->set_option( '3' );
$obj1->set_format( array('categoria','nombre') );
$obj1->imprimir($data);

$obj2 = new ComboSimple();
$obj2->set_name( NULL );
$obj2->set_id( NULL );
$obj2->set_label( NULL );
$obj2->set_option( NULL );
$obj2->set_format( array('categoria','nombre') );
$obj2->imprimir($data);

$obj3 = new ComboSimple();
$obj3->set_format( array('categoria','nombre') );
$obj3->imprimir($data);

