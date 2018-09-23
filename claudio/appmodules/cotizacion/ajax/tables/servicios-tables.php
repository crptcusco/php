<?php 
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tables.php";

// echo '<h2>POST</h2>';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

$in['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );

$lista = get_tables_servicios($in);

if (is_array($lista))
    foreach($lista as $row)
    {
        $row['descripcion'] = str_replace('\\n', '<br>', $row['descripcion']);
        printf( 
            '<tr>
                <td><pre>%s</pre></td>
                <td class="text-center">%1.2f</td>
                <td class="text-center acciones">
                  <a codigo="%s" class="edit">Editar</a> | 
                  <a codigo="%s" style="color:red" class="delete">Eliminar</a>
                </td>
             </tr>'
            , utf8_decode($row['descripcion'])
            , $row['subtotal']
            , $row['id']
            , $row['id']
        );
    }
