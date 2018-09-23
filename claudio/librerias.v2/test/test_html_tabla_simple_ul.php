<?php
include '../html/tabla.php';
include '../html/etiquetas.php';

class Test extends TablaSimple {
    protected function ini_table() {
        echo '<ul>';
    }
    protected function end_table() {
        echo '</ul>';
    }
    protected function ini_tr($args) {
        printf(''
	       . '<li style="color:%s;">Categoría %s: '
	       , $args['color']
	       , $args['categoria']
        );
    }

    protected function end_tr($args) {
        echo '</li>';
    }

    protected function td($args) {
        printf(''
                . '%s'
                , $args['nombre']
        );
    }

}
// ---------------------------------------------------------------
$data[] = array('categoria' => '1', 'nombre' => 'Rojo', 'color'=>'red');
$data[] = array('categoria' => '2', 'nombre' => 'Azul', 'color'=>'blue');
$data[] = array('categoria' => '3', 'nombre' => 'Verde', 'color'=>'green');
$data[] = array('categoria' => '4', 'nombre' => 'Rosado', 'color'=>'pink');

EtiquetasHtml::debug();
EtiquetasHtml::printr($data);

$obj = new Test();
$obj->imprimir($data);
?>