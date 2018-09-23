<?php 
// ---------------------------------------------- ini-libs
include "../../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../modelo/modals.php";

// ------------------------- INPUT
$lista = explode("!!-!!", $_POST['VariablePost']); 
$input['accion'] = $lista[0];
$input['id'] = $lista[1];
$input['nombre_str'] = $lista[2];
$input['nombre'] = utf8_decode( $lista[2] );
$input['info_status'] = $lista[3];
$input['info_status_str'] = $lista[3];
if ( $input['info_status']=='Activado' ) {
    $input['info_status']=1;
} elseif ( $input['info_status']=='Desactivado' ) {
    $input['info_status']=0;
}

// print_r($input);

// ------------------------- PROCESS
$id = set_modals_tipo_servicios($input);

// ------------------------- OUTPUT
if ($input['accion']=='Añadir') {
    echo '
           <tr class="lista_tipo_servicio item-' . $id . '">
             <td>' . $input['nombre_str'] . '</td>
             <td>' . $input['info_status_str'] . '</td>
             <td><a class="editar" href="#" codigo="' . $id . '">Editar</a></td>
           </tr>
          ';
}

if ($input['accion']=='Editar') {
    echo '
             <td>' . $input['nombre_str'] . '</td>
             <td>' . $input['info_status_str'] . '</td>
             <td><a class="editar" href="#" codigo="' . $id . '">Editar</a></td>
          ';
}