<?php 
include ("../html/etiquetas.php");

$data[] =array('categoria'=>'1', 'producto'=>'p1');
$data[] =array('categoria'=>'2', 'producto'=>'p2');
$data[] =array('categoria'=>'2', 'producto'=>'p3');
$data[] =array('categoria'=>'3', 'producto'=>'p4');
$data[] =array('categoria'=>'3', 'producto'=>'p5');
$data[] =array('categoria'=>'3', 'producto'=>'p6');
$data[] =array('categoria'=>'3', 'producto'=>'p7');

EtiquetasHtml::debug();
EtiquetasHtml::printr($data);

?>
<script>
c('console.log');
a('alert');
</script>