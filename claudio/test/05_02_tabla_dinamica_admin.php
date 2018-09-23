<?php


function add($args) {
    $componente['contenedor'] = 'almacen-proveedor';
    $out='
            <tr id="%1$s-tr-%5$s">
                <td>%2$s</td>
                <td>%3$s</td>
                <td>%4$s</td>
                <td><button class="%1$s-edit" value="%5$s">Editar</button></td>
                <td><button class="%1$s-delete" value="%5$s">Eliminar</button></td>
            </tr>        
         ';
           
    printf( $out
            , $componente['contenedor']
            , $args['proveedor-razon']
            , $args['proveedor-ruc']
            , $args['proveedor-direccion']
            , $args['proveedor-id']
            );
}

function edit($args) {
    $componente['contenedor'] = 'almacen-proveedor';
    $out='
                <td>%2$s</td>
                <td>%3$s</td>
                <td>%4$s</td>
                <td><button class="%1$s-edit" value="%5$s">Editar</button></td>
                <td><button class="%1$s-delete" value="%5$s">Eliminar</button></td>
     
         ';
           
    printf( $out
            , $componente['contenedor']
            , $args['proveedor-razon']
            , $args['proveedor-ruc']
            , $args['proveedor-direccion']
            , $args['proveedor-id']
            );
}

if (isset($_POST['VariableEnviarPost'])) {
    $fila = explode('!!-!!', $_POST['VariableEnviarPost']);

    $args['proveedor-id'] = $fila[0];
    $args['proveedor-razon'] = $fila[1];
    $args['proveedor-ruc'] = $fila[2];
    $args['proveedor-direccion'] = $fila[3];
    $args['accion'] = $fila[4];
    

    if ($args['accion']==0) {
        print 'exito';
    } else if ($args['accion']==1) {
        add($args);
    } else if ($args['accion']==2) {
        edit($args);
    } 

}
