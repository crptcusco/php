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
$input['departamento_id'] = clear_input( $_POST['departamento_id'] );
$input['provincia_id'] = clear_input( $_POST['provincia_id'] );
$input['distrito_id'] = clear_input( $_POST['distrito_id'] );
if ($input['distrito_id'] =='') {
    $input['distrito_id'] = 0;
}
$input['direccion'] = clear_input( $_POST['direccion'] );
$input['direccion'] = utf8_encode( $input['direccion'] );
$input['descripcion'] = clear_input( $_POST['descripcion'] );
$input['descripcion'] = utf8_encode( $input['descripcion'] );


// ------------------------------------------------------- PROCESS
$output = process_buttons_bien_inmuebles_save($input);

// ------------------------------------------------------- OUTPUT

if ( $input['id']==0 )
    echo imprimir_tr( $output );
else
    echo imprimir_td( $output );

// ------------------------------------------------------- test
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
    $va = explode('|---|-', utf8_decode( $row['valor'] ) );
    $va_str = '<span>'.$va[0].'</span>';
    if ($va[1] != '') {
	$va_str.= ' <u>Descripción:</u> <span>'.$va[1].'</span>';
    }
    return '
                <td>' . $de_str . '' . $va_str . '</td>
                <td> <a href="#" class="edit">Editar</a> | <a href="#" class="delete">Eliminar</a></td>
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