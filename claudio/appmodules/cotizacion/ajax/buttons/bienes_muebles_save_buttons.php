<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

// ------------------------------------------------------- INPUT
$input['categoria_id'] = clear_input( $_POST['categoria_id'] );
$input['sub_categoria_id'] = clear_input( $_POST['sub_categoria_id'] );
$input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
$input['id'] = clear_input( $_POST['id'] );
$input['tipo_id'] = clear_input( $_POST['tipo_id'] );
$input['marca_id'] = str_num_null( clear_input( $_POST['marca_id'] ) );
$input['modelo_id'] = str_num_null( clear_input( $_POST['modelo_id'] ) );
$input['descripcion'] = clear_input( $_POST['descripcion'] );
$input['descripcion'] = utf8_encode( $input['descripcion'] );
if ( $input['sub_categoria_id'] ==4 ) { // en el caso de otros
    $input['marca_id'] = 0;
    $input['modelo_id'] = 0;
}
// ------------------------------------------------------- PROCESS
$output = process_buttons_bien_muebles_save($input);

// ------------------------------------------------------- OUTPUT

if ( $input['id']==0 )
  echo imprimir_tr( $output );
else
  echo imprimir_td( $output );


// ------------------------------------------------------- TEST
/*
echo 'POST';
print_r($_POST);
echo 'INPUT';
print_r($input);
echo 'OUTPUT';
print_r($output);
*/

// ------------------------------------------------------- FUNCTIONS
function imprimir_td( $row ) {
    $co = explode('-', $row['codigos'] );
    $de = explode('|---|-', utf8_encode( $row['contexto'] ) );
    $de_str = $de[0] . ' &#9658; ' . $de[1] . ' &#9658; ';
    if ($co[3] != 0) {
	$de_str .= $de[2] . ' &#9658; ';
    }
    if ($co[4] != 0) {
	$de_str .= $de[3] . ' &#9658; ';
    }
    if ($co[5] != 0) {
	$de_str .= $de[4] . ' &#9658; ';
    }

    return '
                <td>' . $de_str . '<span>' . utf8_decode($row['valor']) . '</span></td>
                <td> <a href="#" class="edit">Editar</a> | <a href="#" class="delete">Eliminar</a>
          ';
}
function imprimir_tr( $row ) {
    $co = explode('-', $row['codigos'] );
    return '
          <tr class="item_bien item_' . $co[0] . '-' . $co[2] . '" codigos="' . $row['codigos'] . '">
          ' . imprimir_td( $row ) . '
          </tr>
          ';
}
