<?php
class Documentacion_Informe_Coordinacion_Item_View {
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
        echo '<tr class="item item_' . $in['id']. '" documentacion_id="' . $in['id']. '">';
        $this->imprimirTds($in);
        echo '</tr>';
    }
    function imprimirTds($in) {
        printf('<td class="text-center">
                    <a title="%s"
                       href="%s"
                       data-reveal-id="coor_coordinacion_item_field_informe_documentacion_enlace_modal"
                       class="copy"
                    >Ver</a>
                </td>
                <td>%s</td>'
        , utf8_decode($in['enlace'])
        , utf8_decode($in['enlace'])
        , utf8_decode($in['descripcion'])
        );
        if ($this->rol=='Coordinador' and $this->mode=='edit') {
            echo '<td class="text-center">
                   <a class="edit" 
                      data-reveal-id="coor_coordinacion_item_field_informe_documentacion_modal"
                      style="font-size: 0.8em;">Editar</a> | 
                   <a class="delete" style="font-size: 0.8em;color:red;">Eliminar</a>
                  </td>';
        } else {
            echo '<td class="text-center"></td>';
        }
    }
}
