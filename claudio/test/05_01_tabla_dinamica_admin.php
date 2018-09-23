<?php
// ---------------------------------------------- ini-libs
include ("../librerias.v2/html/etiquetas.php");

// ---------------------------------------------- ini-header
EtiquetasHtml::testing_mode(); // edit to end 
// EtiquetasHtml::$files['header']['css'][] = './style01.css';

EtiquetasHtml::$title = 'mi titulo';
EtiquetasHtml::$path = '../librerias.v2';
EtiquetasHtml::header();
// ---------------------------------------------- ini-body
$componente['contenedor'] = 'almacen-proveedor';
?>
<div class="row">
    <div class="large-12 columns">

<div id="<?php echo $componente['contenedor'] ?>">
    <table id="<?php echo $componente['contenedor'] ?>-table">

            <tr>
                <th>Razon Social</th>
                <th>Ruc</th>
                <th>Direccion</th>
                <th colspan="2">Acciones</th>
            </tr>

            <tr id="<?php echo $componente['contenedor'] ?>-tr-1">
                <td>mercado 1</td>
                <td>123</td>
                <td>dir1</td>
                <td><button class="<?php echo $componente['contenedor'] ?>-edit" value="1">Editar</button></td>
                <td><button class="<?php echo $componente['contenedor'] ?>-delete" value="1">Eliminar</button></td>
            </tr>

    </table>
    <hr>
    <table><!-- entradas -->
        <tr>
            <td>Razon Social</td>
            <td>
                <input type="text" id="<?php echo $componente['contenedor'] ?>-razon" value="" />
            </td>
        </tr>
        <tr>
            <td>Ruc</td>
            <td>
                <input type="text" id="<?php echo $componente['contenedor'] ?>-ruc" value="" />
            </td>
        </tr>                
        <tr>
            <td>Dirección</td>
            <td>
                <input type="text" id="<?php echo $componente['contenedor'] ?>-direccion" value="" />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button id="<?php echo $componente['contenedor'] ?>-add" value="0" accion="1">Nuevo</button>
                <button id="<?php echo $componente['contenedor'] ?>-cancel">Cancelar</button>
            </td>
        </tr>
    </table>    
</div>        
        
    </div>
</div>

<?php
// ---------------------------------------------- ini-footer
EtiquetasHtml::$files['footer']['js'][] = './05_01_tabla_dinamica_admin.js';
EtiquetasHtml::footer();