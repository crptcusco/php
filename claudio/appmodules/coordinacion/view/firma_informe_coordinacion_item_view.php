<?php
class Firma_Informe_Coordinacion_Item_View {
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
        echo '<tr class="item item_' . $in['id']. '" firma_id="' . $in['id']. '">';
        $this->imprimirTds($in);
        echo '</tr>';
    }
    function imprimirTds($in) {
        printf('<td class="item item_%d" firmante_id="%d">%s</td>'
        , $in['firmante_id']
        , $in['firmante_id']
        , utf8_encode($in['firmante_nombre'])
        );
        if (($this->rol=='Coordinador' or $this->rol=='Consultor') and $this->mode=='edit') {
            echo '<td class="text-center">
                    <a class="delete" style="font-size: 0.8em;color:red;">Eliminar</a>
                  </td>';
        } else {
            echo '<td class="text-center"></td>';
        }
    }
}
