<?php
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../../librerias.v2/utilidades.php";
include "../../modelo/selects.php";
include "../../modelo/tables.php";

$select = new Coordinacion_Modelo_Eventos_Selects();
$table = new Coordinacion_Modelo_Eventos_Tables();

// -------------------------------------------------------- INPUT
$in['cotizacion_id'] = Utilidades::clear_input( $_POST['cotizacion_id'] );
$in['coordinacion_id'] = Utilidades::clear_input( $_POST['coordinacion_id'] );
$in['modo'] = Utilidades::clear_input( $_POST['modo'] );
// -------------------------------------------------------- OUTPUT
$ou = $table->bienListaCoordinacion($in);

if (is_array($ou)) {
    foreach ($ou as $row) {
        echo '<tr codigo="'.$row['id'].'" class="item_' . $row['id'] . '">';
        echo '<td><pre>'. utf8_decode($row['descripcion']).'</pre></td>';
        if ($in['modo'] == 'edit') {
            echo '<td><a class="delete" style="color:red">Eliminar</a></td>';
        } else {
            echo '<td><span style="color:red">Eliminar</span></td>';
        }
        
        echo '</tr>';
    }
}