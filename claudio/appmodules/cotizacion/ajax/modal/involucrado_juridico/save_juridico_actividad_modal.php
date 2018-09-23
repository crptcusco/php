<?php 
// ----------------- por defecto
// verificar Post e Input
// - es buena idea copiar el print del post del navegador al codigo mas rapido
// descomentar process y:
// - mostrar primero sql
// - mostrar resultado primario
// - mostrar resultado secundario (copiar del listado general)
// comentar test
// pasar output (en vase a listados )
// ---------------------------------------------- ini-libs
include "../../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../modelo/buttons.php";

// ------------------------------------------------------- INPUT
$input['id'] = clear_input( $_POST['id'] );
$input['nombre'] = utf8_decode( clear_input( $_POST['nombre'] ) );
$input['status'] = clear_input( $_POST['status'] );
if ( $input['status'] == 'true' ) {
    $input['status'] = '1';
} elseif ( $input['status'] == 'false' ) {
    $input['status'] = '0';
}

/* $input[''] = clear_input( $_POST[''] );  */
/* $input[''] = utf8_decode( clear_input( $_POST[''] ) );  */
/* $input[''] = is_null_id( clear_input( $_POST[''] ) ); */
/* $input['status'] = clear_input( $_POST['status'] ); */
/* if ( $input['status'] == 'true' ) { */
/*     $input['status'] = '1'; */
/* } elseif ( $input['status'] == 'false' ) { */
/*     $input['status'] = '0'; */
/* } */


// ------------------------------------------------------- PROCESS
$output = set_buttons_involucrados_juridico_actividad($input);


// ------------------------------------------------------- OUTPUT
if ( $input['id']==0 )
    echo imprimir_tr( $output );
else
    echo imprimir_td( $output );


// ------------------------------------------------------- test
/*
echo '<h3>POST</h3>';
echo '<pre>';
print_r($_POST);
echo '</pre>';

echo '<h3>INPUT</h3>';
echo '<pre>';
print_r($input);
echo '</pre>';

echo '<h3>OUTPUT</h3>';
echo '<pre>';
print_r($output);
echo '</pre>';
*/
// ------------------------------------------------------- FUNCTIONS

// usualmente se remplazaran por su par en el listado
function imprimir_td( $row ) {
    if ( $row['status']==1 ){
    	$row['status'] = 'Activo';
    }else {
	$row['status'] = 'Desactivo';
    }
    $output = '
          <td>' . utf8_encode($row['nombre']) . '</td>
          <td>' . $row['status'] . '</td>
          <td><a href="" class="edit" >Editar</a></td>
          ';
    return $output;
}
function imprimir_tr( $row ) {
    $output = '
          <tr class="item item_' . $row['id'] . '" codigo="' . $row['id'] . '">
          ' . imprimir_td( $row ) . '
          </tr>
          ';
    return $output;
}
