<?php 

include "../../../../librerias.v2/html/tabla.php";
include "../../../../librerias.v2/html/tree.php";
include "../../../../librerias.v2/mysql/dbconnector.php";
include "../../../../librerias.v2/mysql/reutilizabes_cotizacion.php";
include "../../modelo/tree.php";

// ---------------------------------------------- INPUT
$input['propuesta_id'] = clear_input( $_POST['propuesta_id'] );
$input['vendedor_id'] = clear_input( $_POST['vendedor_id'] );

$permiso = tree_is_user_by_vendedor( $input['vendedor_id'] );
// ---------------------------------------------- PROCESS
$output = tree_servicio_tipo($input);

// ---------------------------------------------- OUTPUT
/*
print_test('$_POST', $_POST);
print_test('$input', $input);
print_test('$output', $output);
*/    
// ---------------------------------------------- OUTPUT

if ($permiso) {
    if ( is_array( $output ) ) {
	imprimir($output['root']);
	
    }
}else {
    echo 'Sin Permiso';
}
// ---------------------------------------------- FUNCTIONS
function imprimir($tree) {
    $first = current($tree);
    $style = ($first['parentId']==0) ? 'display:block;' : 'display:none;' ;
    echo '<ul id="servicio_tipo_list_' . $first['parentId'] . '" style="' . $style . '">';
    foreach ($tree as $row) {
	echo '<li>';
	$l = explode("!-%|", $row['nombre'] );
	$checked = ($l[1]!=0) ? 'checked' : '' ;
	
	if ( count( $row['children'] ) > 0 ) {
	    echo '<a my_id="' . $row['id'] . '" estado="0">(+) </a>';
	    echo '<label for="servicio_tipo_item_' . $row['id'] . '"  style="display: inline;">' . strtoupper( $l[0] ) . '</label>';
	    echo '<input class="servicio_tipo_item" id="servicio_tipo_item_' . $row['id'] . '" type="checkbox" my_id="' . $row['id'] . '" ' . $checked . ' style="margin: 0px;">';
	    imprimir( $row['children'] );
	} else {	    
	    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="servicio_tipo_item_' . $row['id'] . '"  style="display: inline;">' . strtoupper( $l[0] ) . '</label>';
	    echo '<input class="servicio_tipo_item" id="servicio_tipo_item_' . $row['id'] . '" type="checkbox" my_id="' . $row['id'] . '" ' . $checked . ' style="margin: 0px;">';
	}	
	echo '</li>';
	// js
	if ($checked== 'checked') {
	    echo '<script>
                     $("#servicio_tipo_list_' . $row['parentId'] . '").show();
                     $("#servicio_tipo_list_' . $row['parentId'] . '").parent().find("a").eq(0).attr("estado","1");

                     $("#servicio_tipo_list_' . $row['parentId'] . '").parent().parent().show();
                     $("#servicio_tipo_list_' . $row['parentId'] . '").parent().parent().parent().find("a").eq(0).attr("estado","1");
                  </script>';
	}
    }
    echo '</ul>';    
}
