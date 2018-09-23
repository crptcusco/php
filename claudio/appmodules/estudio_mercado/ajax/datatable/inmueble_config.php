<?php
function imprimir($l, $data)
{
    $ou = array();
    foreach ($l as $row) {
        if($row['type'] == 'text')
            $ou[] = utf8_encode($data[$row['name']]);
        elseif($row['type'] == 'float')
            $ou[] = sprintf('%1.2f ', $data[$row['name']]);
        elseif($row['type'] == 'ruta')
            $ou[] = sprintf(
                '<a href="#" class="button tiny no-margin ruta" ruta="%s">Ruta</a>',
                utf8_encode($data[$row['name']])
            );
        
    }
    return $ou;
}
function where($in, $t)
{
    global $conn;
    $tipo ['t'] = 'tasacion_fecha';
    $tipo ['em'] = 'estudio_fecha';    
    $ou = '';
    $in = explode("|---|", $in);

    if (trim($in[0]) != '') {
        $ou .= ' AND ubi_departamento_id =' . trim($in[0]);
    }
    if (trim($in[1]) != '') {
        $ou .= ' AND ubi_provincia_id =' . trim($in[1]);
    }
    if (trim($in[2]) != '') {
        $ou .= ' AND ubi_distrito_id = ' . trim($in[2]);
    }
    if (trim($in[3]) != '')
        $ou .= ' AND ' . $tipo[$t] . ' >= "' . trim($in[3]) . '-01-01"';
    if (trim($in[4]) != '')
        $ou .= ' AND ' . $tipo[$t] . ' <= "' . trim($in[4]) . '-12-31"';
    if (trim($in[5]) != '' && $t == 't')
        $ou .= ' AND dc.nombre LIKE "%'   . trim($in[5]) . '%"';
    if (trim($in[6]) != '')
        $ou .= ' AND ubicacion LIKE "%'   . trim($in[6]) . '%"';
    
    if ($ou != '') $ou = ' WHERE 1=1 ' . $ou;

    // echo $ou;
    
    
    return $ou;
}
function columnas($tipo)
{
    $cols['casa_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'nro_pisos'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['casa_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'text' ,  'name' => 'edificacion_area_uni'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'text' ,  'name' => 'piso_cantidad'),
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
    $cols['departamento_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'nro_pisos'),
        array( 'type' => 'text' ,  'name' => 'piso_ubicacion'),
        array( 'type' => 'text' ,  'name' => 'departamento_tipo'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'float',  'name' => 'valor_ocupada'),
        array( 'type' => 'text',  'name' => 'estacionamiento_cantidad'),
        array( 'type' => 'text',  'name' => 'areas_complementarias'),    
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['departamento_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'text' ,  'name' => 'estacionamiento_cantidad'),
        array( 'type' => 'text' ,  'name' => 'departamento_tipo'),
        array( 'type' => 'text' ,  'name' => 'areas_complementarias'),
        array( 'type' => 'text' ,  'name' => 'piso_cantidad'),
        array( 'type' => 'text' ,  'name' => 'piso_ubicacion'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'text' ,  'name' => 'edificacion_area_uni'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
    $cols['local_comercial_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'nro_pisos'),
        array( 'type' => 'text' ,  'name' => 'vista_local'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'float',  'name' => 'valor_ocupada'),
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['local_comercial_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'text' ,  'name' => 'piso_cantidad'),
        array( 'type' => 'text' ,  'name' => 'vista_local'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'text' ,  'name' => 'edificacion_area_uni'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
    $cols['local_industrial_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'nro_pisos'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'float',  'name' => 'areas_complementarias'),
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['local_industrial_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'text' ,  'name' => 'edificacion_area_uni'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'text' ,  'name' => 'piso_cantidad'),
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
    $cols['terreno_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'cultivo_tipo'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['terreno_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
    $cols['oficina_t'] = array(
        array( 'type' => 'text' ,  'name' => 'cliente'),
        array( 'type' => 'text' ,  'name' => 'propietario'),
        array( 'type' => 'text' ,  'name' => 'solicitante'),
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'tasacion_fecha'),        
        array( 'type' => 'text' ,  'name' => 'zonificacion'),

        array( 'type' => 'text' ,  'name' => 'piso_cantidad'),
        array( 'type' => 'text' ,  'name' => 'piso_ubicacion'),
        array( 'type' => 'text' ,  'name' => 'departamento_tipo_id'),
        
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'float',  'name' => 'valor_comercial'),
        array( 'type' => 'ruta' ,  'name' => 'ruta_informe'),
    );
    $cols['oficina_em'] = array(
        array( 'type' => 'text' ,  'name' => 'ubicacion'),
        array( 'type' => 'text' ,  'name' => 'estudio_fecha'),
        
        array( 'type' => 'float',  'name' => 'terreno_area'),
        array( 'type' => 'text' ,  'name' => 'terreno_area_uni'),
        array( 'type' => 'float',  'name' => 'terreno_valorunitario'),
        array( 'type' => 'text' ,  'name' => 'terreno_valorunitario_uni'),
        array( 'type' => 'float',  'name' => 'edificacion_area'),
        array( 'type' => 'text' ,  'name' => 'edificacion_area_uni'),        
        array( 'type' => 'float',  'name' => 'valor_comercial'),

        array( 'type' => 'text',  'name' => 'departamento_tipo_id'),
        array( 'type' => 'text',  'name' => 'piso_cantidad'),
        array( 'type' => 'text',  'name' => 'piso_ubicacion'),
        
        array( 'type' => 'text' ,  'name' => 'contacto'),
        array( 'type' => 'text' ,  'name' => 'telefono'),
        array( 'type' => 'text' ,  'name' => 'zonificacion'),
        array( 'type' => 'text' ,  'name' => 'ruta_informe'),
    );
 return $cols[ $tipo ];
}