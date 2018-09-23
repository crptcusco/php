<?php 
// ---------------------------------------------- ini-libs
include "../../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../../modelo/modals.php";

$input['accion'] = clear_input( $_POST['accion'] );
if ($input['accion']=='Añadir') {
    $input['accion']='add';
}
if ($input['accion']=='Editar') {
    $input['accion']='edit';
}

$input['codigo'] = clear_input( $_POST['codigo'] );
$input['nombre'] = clear_input( $_POST['nombre'] );
$input['telefono'] = clear_input( $_POST['telefono'] );
$input['correo'] = clear_input( $_POST['correo'] );
$input['activo'] = clear_input( $_POST['activo'] );

// ----------------------------------------------- proceso
$output = set_modals_involucrados_vendedor($input);
if($output['status']==0) {
    $output['status'] = 'Desactivado';
} elseif($output['status']==1) {
    $output['status'] = 'Activado';
}
// ----------------------------------------------- output

/* echo '<h3>POST</h3>'; */
/* echo '<pre>'; */
/* print_r( $_POST ); */
/* echo '</pre>'; */

/* echo '<h3>Input</h3>'; */
/* echo '<pre>'; */
/* print_r( $input ); */
/* echo '</pre>'; */

/* echo '<h3>Output</h3>'; */
/* echo '<pre>'; */
/* print_r( $output ); */
/* echo '</pre>'; */


if ($input['accion']=='add') {
    echo '<tr class="lista_vendedores_item item-'.$output['id'].'">';
    printf('<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a class="editar" href="#" codigo="%s">Editar</a></td>'
	   , utf8_encode($output['nombre'])
	   , utf8_encode($output['telefono'])
	   , utf8_encode($output['correo'])
	   , $output['status']
	   , $output['id']
	   );
	echo '</tr>';
}
if ($input['accion']=='edit') {
    printf('<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><a class="editar" href="#" codigo="%s">Editar</a></td>'
	   , utf8_encode($output['nombre'])
	   , utf8_encode($output['telefono'])
	   , utf8_encode($output['correo'])
	   , $output['status']
	   , $output['id']
	   );
}
