<?php
class Fechasdeentrega_Informe_Coordinacion_Item_View {
    private $rol;
    private $mode;
    function getRol($name) {
        $this->rol=$name;
    }
    function getMode($name) {
        $this->mode=$name;
    }
    function imprimirTbody($in) {
        if (is_array($in)) {
            foreach ($in as $row) {
                $this->imprimirTr($row);
            }
        }
    }
    function imprimirTr($in) {
        echo '<tr class="item item_' . $in['id']. '" entrega_id="' . $in['id']. '">';
        $this->imprimirTds($in);
        echo '</tr>';
    }
    function imprimirTds($in) {
        $f = Utilidades::fechas_de_MysqlTimeStamp_a_array($in['fecha']);
        $in['fecha'] = $f['dia'] . '-' . $f['mes'] . '-' . $f['anio'];
        printf('<td>%s</td>
                <td tipo_id="%d">%s</td>'
        , $in['fecha']
        , $in['tipo_id']
        , $in['tipo_nombre']
        );
        if ($this->rol=='Coordinador' and $this->mode=='edit') {
            echo '<td>
                   <a class="edit" data-reveal-id="coor_coordinacion_item_field_informe_fechas_modal" style="font-size: 0.8em;">Editar</a> | 
                   <a class="delete" style="font-size: 0.8em;color:red;">Eliminar</a>
                  </td>';
        } else {
            echo '<td></td>';
        }
    }
}
