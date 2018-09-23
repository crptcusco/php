<?php
include '../html/etiquetas.php';
include '../html/tabla.php';

class Test extends TablaAdminSimple {
    protected function td($args) {
        printf(''
                . '<td>%s</td>'
                . '<td>%s</td>'
                . '<td><a class="%s-td-edit">Editar</a></td>'
                , $args['nombre']
                , $args['dimi']
                , $this->id
        );
    }

}
// ------------------------------------------------------------------------

$data[] = array('categoria' => '1', 'nombre' => 'categoria 1', 'dimi' => 'cat1');
$data[] = array('categoria' => '2', 'nombre' => 'categoria 2', 'dimi' => 'cat2');
$data[] = array('categoria' => '3', 'nombre' => 'categoria 3', 'dimi' => 'cat3');
$data[] = array('categoria' => '4', 'nombre' => 'categoria 4', 'dimi' => 'cat4');

// ------------------------------------------------------------------------

EtiquetasHtml::testing_mode(); // edit to end 
EtiquetasHtml::$title = 'Admin Test';
EtiquetasHtml::$path = '../';
EtiquetasHtml::header();

EtiquetasHtml::printr($data);

$obj = new Test();
$obj->set_id('listado-categorias');
$obj->set_class('listado-datos');
$obj->set_th('<th width="120">Nombre</th>
              <th width="50">Dimin utivo</th>
              <th width="90">Acciones</th>'
	     );
$obj->set_index('categoria','');

?>
<div class="row">
  <div class="small-4 columns">
    <h3>Tabla</h3>
    <?php $obj->imprimir($data);  ?>
  </div>
  <div class="small-4 columns">
    <h3>Tr</h3>
    <table>
      <?php $obj->imprimir_tr($data[1]);  ?>
    </table>
  </div>
  <div class="small-4 columns">
    <h3>Td</h3>
    <table>
      <tr>
	<?php $obj->imprimir_td($data[2]);  ?>
      </tr>
    </table>
  </div>
</div>

<?php
EtiquetasHtml::footer();
