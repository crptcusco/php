<?php
include '../html/tabla.php';
include '../html/etiquetas.php';

class Test extends TablaDoble {

    protected function ini_table() {
        print '<table border="1">';
    }

    protected function end_table() {
        print '</table>';
    }

    protected function ini_tr($args) {
        printf(''
                . '<tr><td>Categoria: %s</td><td><ul>'
                , $args['categoria']
        );
    }

    protected function end_tr($args) {
        printf(''
                . '</ul></td><td>Categoria: %s</td></tr>'
                , $args['categoria']
        );
    }

    protected function td($args) {
        printf(''
                . '<li>producto: %s</li>'
                , $args['producto']
        );
    }

}

$data[] = array('categoria' => '1', 'producto' => 'p1');
$data[] = array('categoria' => '2', 'producto' => 'p2');
$data[] = array('categoria' => '2', 'producto' => 'p3');
$data[] = array('categoria' => '3', 'producto' => 'p4');
$data[] = array('categoria' => '3', 'producto' => 'p5');
$data[] = array('categoria' => '3', 'producto' => 'p6');
$data[] = array('categoria' => '3', 'producto' => 'p7');

EtiquetasHtml::debug();
EtiquetasHtml::printr($data);

$obj = new Test();
$obj->set_index('categoria', 0);
$obj->imprimir($data);
?>