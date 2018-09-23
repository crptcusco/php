<?php 
// ---------------------------------------------- ini-libs
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/buttons.php";

$input['tipo'] = clear_input( $_POST['tipo'] );
if ($input['tipo']== 'file') {
    // ------------------------------------------------------- INPUT
    $input['categoria_id'] = clear_input( $_POST['categoria_id'] );
    $input['sub_categoria_id'] = clear_input( $_POST['sub_categoria_id'] );
    $input['cotizacion_id'] = clear_input( $_POST['cotizacion_id'] );
    $input['id'] = clear_input( $_POST['id'] );
    $input['descripcion'] = clear_input( $_POST['descripcion'] );
    $input['descripcion'] = utf8_encode( $input['descripcion'] );
    $input['archivo'] = clear_input( $_POST['archivo'] );
    $input['archivo'] = utf8_encode( $input['archivo'] );

    // ------------------------------------------------------- PROCESS
    $id = process_buttons_bien_mazivo_save( $input );
    $output = process_buttons_bien_mazivo_save_view($id);

    // ------------------------------------------------------- OUTPUT
    if ( $input['id']==0 )
	echo imprimir_tr( $output );
    else
	echo imprimir_td( $output );
}
if ($input['tipo']== 'no-file') {
    // ------------------------------------------------------- INPUT
    $input['id'] = clear_input( $_POST['id'] );
    $input['descripcion'] = clear_input( $_POST['descripcion'] );
    $input['descripcion'] = utf8_encode( $input['descripcion'] );
    // ------------------------------------------------------- PROCESS
    $id = process_buttons_bien_mazivo_save_no_file( $input );
    $output = process_buttons_bien_mazivo_save_view($id);
    // ------------------------------------------------------- OUTPUT

    echo imprimir_td( $output );
}

// ------------------------------------------------------- test
/* echo 'POST'; */
/* print_r($_POST); */
/* echo 'INPUT'; */
/* print_r($input); */
/* echo 'OUTPUT'; */
/* print_r($output); */

// ------------------------------------------------------- FUNCTIONS
function imprimir_td( $row ) {
    $row['valor'] = utf8_decode($row['valor']);
    $l = explode("|-|-|", $row['valor']);
    return '
                 <td>' . utf8_decode($row['contexto']) . ' &#9658; <span>'.$l[1].'</span> <a href="../../../files/cotizacion/bienes/' . $l[0] . '" class="view" target="_blank">Ver</a></td>
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