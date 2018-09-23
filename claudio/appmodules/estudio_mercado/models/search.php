<?php 
class Query {
    public $fields = NULL;
    public $sql;
    public $data = NULL;

    public function exe() {
        DBConnector::$results = NULL;
        if ($this->fields == NULL) {
            DBConnector::ejecutar($this->sql, $this->data);
        } else {
            DBConnector::ejecutar($this->sql, $this->data, $this->fields);
        }
        return DBConnector::$results;
    }

}

$q = new Query();
/*
 *********************************************************
 * inmuebles
 *********************************************************
*/
function get_search_map_t($input) {
    global $q;

    $i=0;
    $filter = '';
    $tabla = '';
    $join = '';

    if ($input['tipo']=='casa') $tabla='t_casa';
    elseif ($input['tipo']=='departamento') $tabla='t_departamento';
    elseif ($input['tipo']=='local_industrial') $tabla='t_local_industrial';
    elseif ($input['tipo']=='local_comercial') $tabla='t_local_comercial';
    elseif ($input['tipo']=='terreno') $tabla='t_terreno';
    elseif ($input['tipo']=='oficina') $tabla='t_oficina';

    foreach ($input as $key => $value) {
        if ($key=='departamento' and $value!='') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_departamento_id='.$value;
            $i++;
            

        }
        if ($key=='provincia' and $value!='' and $value!='null') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_provincia_id=' . $value;
            $i++;
        }
        if ($key=='distrito' and $value!='' and $value!='null') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_distrito_id=' . $value;
            $i++;
        }
        if ($key=='cliente' and $value!='') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'dc.nombre LIKE "%'.$value.'%"';
            $join.=' JOIN diccionario_cliente dc ON dc.id=cliente_id ';
            $i++;
        }
        if ($key=='direccion' and $value!='') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubicacion LIKE "%'.$value.'%"';	    
            $i++;
        }
        if ($key=='fech_ini') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'tasacion_fecha>="'.$value.'"';
            $i++;
        }
        if ($key=='fech_end') {
            if ($i>=1)
                $filter.=' AND ';
            $filter.= 'tasacion_fecha<="'.$value.'"';
            $i++;
        }
    }
    if ($i>0) {
        $filter = ' WHERE '.$filter;	
    }   

    $q->fields = array(
        "distinct" => ""
        , "latitud" => ""
        , "longitud" => ""
        , "tipo" => ""
    );
    $q->sql = "SELECT DISTINCT concat(mapa_latitud, mapa_longitud), mapa_latitud, mapa_longitud, 't' FROM ".$tabla.$join.$filter;
    $data = '';
    $q->data = NULL;
    // printf('<textarea rows="10" cols="50" style="">%s</textarea>',$q->sql);
    // printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$q->sql);    
    $data = $q->exe();
    return $data;
}
function get_search_map_em($input) {
    global $q;
    
    $i=0;
    $filter = '';
    $tabla = '';
    $join = '';

    if ($input['tipo']=='casa') $tabla='em_casa';
    elseif ($input['tipo']=='departamento') $tabla='em_departamento';
    elseif ($input['tipo']=='local_industrial') $tabla='em_local_industrial';
    elseif ($input['tipo']=='local_comercial') $tabla='em_local_comercial';
    elseif ($input['tipo']=='terreno') $tabla='em_terreno';
    elseif ($input['tipo']=='oficina') $tabla='em_oficina';

    foreach ($input as $key => $value) {
        if ($key=='departamento' and $value!='') {	
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_departamento_id='.$value;
            $i++;
        }
        if ($key=='provincia' and $value!='' and $value!='null') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_provincia_id='.$value;
            $i++;
        }
        if ($key=='distrito' and $value!='' and $value!='null') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubi_distrito_id='.$value;
            $i++;
        }
        if ($key=='direccion' and $value!='') {	
            if ($i>=1) $filter.=' AND ';
            $filter.= 'ubicacion LIKE "%'.$value.'%"';	    
            $i++;
        }
        if ($key=='fech_ini') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'estudio_fecha>="'.$value.'"';
            $i++;
        }
        if ($key=='fech_end') {
            if ($i>=1) $filter.=' AND ';
            $filter.= 'estudio_fecha<="'.$value.'"';
            $i++;
        }
    }
    
    if ($i>0)  $filter = ' WHERE '.$filter;	
    
    $q->fields = array(
        "distinct"=>""
        , "latitud" => ""
        , "longitud" => ""
        , "tipo" => ""
    );
    $q->sql = "SELECT DISTINCT concat(mapa_latitud, mapa_longitud), mapa_latitud, mapa_longitud, 'em' FROM ".$tabla.$join.$filter;

    $data = '';
    $q->data = NULL;
    $data = $q->exe();
    // printf('<textarea rows="10" cols="50" style="">%s</textarea>',$q->sql);
    // printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$data);    
    return $data;
}
function get_search_grids_t($input) {
    global $q;

    $i=0;
    $filter = '';
    $tabla = '';
    $join = '';

    if ($input['tipo']=='casa') {
	$tabla='t_casa';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion,
        piso_cantidad, terreno_area, terreno_valorunitario,
        edificacion_area, valor_comercial, areas_complementarias,
        ruta_informe';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'', 
			    'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
			    'piso_cantidad'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'', 
			    'edificacion_area'=>'', 'valor_comercial'=>'', 'areas_complementarias'=>'', 
			    'ruta_informe'=>''
			    );
	$join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';

    }elseif ($input['tipo']=='departamento') {
	$tabla='t_departamento';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion,tasacion_fecha, zonificacion,
        piso_cantidad, piso_ubicacion, ddt.nombre,
        terreno_area,terreno_valorunitario, edificacion_area,
        valor_comercial, valor_ocupada, estacionamiento_cantidad,
        areas_complementarias, ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
			    'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
			    'piso_cantidad'=>'', 'piso_ubicacion'=>'', 'departamento_tipo'=>'',
			    'terreno_area'=>'', 'terreno_valorunitario'=>'', 'edificacion_area'=>'',
			    'valor_comercial'=>'', 'valor_ocupada'=>'', 'estacionamiento_cantidad'=>'',
			    'areas_complementarias'=>'', 'ruta_informe'=>''
			    );
	$join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
	$join.=' LEFT JOIN diccionario_departamento_tipo ddt ON ddt.id=departamento_tipo_id ';
    }elseif ($input['tipo']=='local_industrial') {
	$tabla='t_local_industrial';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion, 
        piso_cantidad, terreno_area, terreno_valorunitario, 
        edificacion_area, valor_comercial, areas_complementarias, 
        ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
			    'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
			    'piso_cantidad'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'',
			    'edificacion_area'=>'', 'valor_comercial'=>'', 'areas_complementarias'=>'', 
                            'ruta_informe'=>''
			    );
	$join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
    }elseif ($input['tipo']=='local_comercial') {
	$tabla='t_local_comercial';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion,
        piso_cantidad, dvl.nombre, terreno_area,
        terreno_valorunitario, edificacion_area, valor_comercial,
        valor_ocupada, ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
			    'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
			    'piso_cantidad'=>'', 'vista_local'=>'', 'terreno_area'=>'',
			    'terreno_valorunitario'=>'', 'edificacion_area'=>'', 'valor_comercial'=>'',
			    'areas_complementarias'=>'', 'ruta_informe'=>''
			    );
	$join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
	$join.=' LEFT JOIN diccionario_vista_local dvl ON dvl.id=vista_local_id';

    }elseif ($input['tipo']=='terreno') {
	$tabla='t_terreno';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion, 
        dct.nombre, terreno_area, terreno_valorunitario, 
        valor_comercial, ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
			    'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
			    'cultivo_tipo'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'',
			    'valor_comercial'=>'', 'ruta_informe'=>''
			    );
	$join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
	$join.=' LEFT JOIN diccionario_cultivo_tipo dct ON dct.id=cultivo_tipo_id ';
    }

    foreach ($input as $key => $value) {
	if ($key=='departamento' and $value!='') {	
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_departamento u
                         JOIN  diccionario_ubi_departamento d ON d.nombre=u.nombre
                       WHERE u.departamento_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();
	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_departamento_id='.$results[0]['id'];
	    	$i++;
	    } else {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_departamento_id=0';
	    	$i++;		
	    }
	}
	if ($key=='provincia' and $value!='' and $value!='null') {
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_provincia u
                         JOIN  diccionario_ubi_provincia d ON d.nombre=u.nombre
                       WHERE u.provincia_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();

	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_provincia_id='.$results[0]['id'];
	    	$i++;
	    } else {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_provincia_id=0';
	    	$i++;
	    }
	}
	if ($key=='distrito' and $value!='' and $value!='null') {
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_distrito u
                         JOIN diccionario_ubi_distrito d ON d.nombre=u.nombre
                       WHERE u.distrito_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();
	    //print_r($results);
	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_distrito_id='.$results[0]['id'];
	    	$i++;
	    } else{
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_distrito_id=0';
	    	$i++;
	    }
	}

	if ($key=='cliente' and $value!='') {	
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'dc.nombre LIKE "%'.$value.'%"';	    
	    $i++;
	}

	if ($key=='direccion' and $value!='') {	
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'ubicacion LIKE "%'.$value.'%"';	    
	    $i++;
	}

	if ($key=='fech_ini') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'tasacion_fecha>="'.$value.'"';
	    $i++;
	}

	if ($key=='fech_end') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'tasacion_fecha<="'.$value.'"';
	    $i++;
	}
    }
    if ($i>0){
	$filter = ' WHERE '.$filter;	
    }   
    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    // Utilidades::print_r('',$q->sql);
    $q->data = NULL;
    $data = '';
    $data = $q->exe();
    printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$q->sql);    
    
    return $data;
}
function get_search_grids_em($input) {
    global $q;

    $i=0;
    $filter = '';
    $tabla = '';
    $join = '';

    if ($input['tipo']=='casa') {
	$tabla='em_casa';
	$campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        edificacion_area, edificacion_area_uni, valor_comercial,
        piso_cantidad, contacto, telefono,
        zonificacion, ruta_informe
        ';
	$campos_arr = array(
			    'ubicacion'=>'', 'estudio_fecha'=>'' , 'terreno_area'=>'',
			    'terreno_area_uni'=>'', 'terreno_valorunitario'=>'' , 'terreno_valorunitario_uni'=>'',
			    'edificacion_area'=>'', 'edificacion_area_uni'=>'' , 'valor_comercial'=>'',
			    'piso_cantidad'=>'', 'contacto'=>'' , 'telefono'=>'',
			    'zonificacion'=>'', 'ruta_informe'=>'',
			    );
	$join.='  ';
    }elseif ($input['tipo']=='departamento') {
	$tabla='em_departamento';
	$campos_str = '
        ubicacion, estudio_fecha, terreno_area, 
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        estacionamiento_cantidad, ddt.nombre as "departamento-tipo", areas_complementarias,
        piso_cantidad, piso_ubicacion, edificacion_area, 
        edificacion_area_uni, valor_comercial, contacto,
        telefono, zonificacion, ruta_informe
        ';
	$campos_arr = array(
			    'ubicacion'=>'', 'estudio_fecha'=>'' , 'terreno_area'=>'',
			    'terreno_area_uni'=>'', 'terreno_valorunitario'=>'' , 'terreno_valorunitario_uni'=>'',
			    'estacionamiento_cantidad'=>'', 'departamento_tipo'=>'' , 'areas_complementarias'=>'',
			    'piso_cantidad'=>'', 'piso_ubicacion'=>'' , 'edificacion_area'=>'',
			    'edificacion_area_uni'=>'', 'valor_comercial'=>'' , 'contacto'=>'',
			    'telefono'=>'', 'zonificacion'=>'' , 'ruta_informe'=>'',
			    );
	$join.=' JOIN diccionario_departamento_tipo ddt ON ddt.id=departamento_tipo_id  ';
    }elseif ($input['tipo']=='local_industrial') {
	$tabla='em_local_industrial';
	$campos_str = '
         ubicacion, estudio_fecha, terreno_area,
         terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
         edificacion_area, edificacion_area_uni, valor_comercial,
         piso_cantidad, contacto, telefono,
         zonificacion, ruta_informe
        ';
	$campos_arr = array(
			    'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
			    'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
			    'edificacion_area'=>'', 'edificacion_area_uni'=>'', 'valor_comercial'=>'',
			    'piso_cantidad'=>'', 'contacto'=>'', 'telefono'=>'',
			    'zonificacion'=>'', 'ruta_informe'=>'',
			    );
	$join.='  ';
    }elseif ($input['tipo']=='local_comercial') {
	$tabla='em_local_comercial';
	$campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        piso_cantidad, dvl.nombre, edificacion_area,
        edificacion_area_uni, valor_comercial, contacto,
        telefono, zonificacion, ruta_informe
        ';
	$campos_arr = array(
			    'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
			    'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
			    'piso_cantidad'=>'', 'vista_local'=>'', 'edificacion_area'=>'',
			    'edificacion_area_uni'=>'', 'valor_comercial'=>'', 'contacto'=>'',
			    'telefono'=>'', 'zonificacion'=>'', 'ruta_informe'=>'',
			    );
	$join.=' JOIN diccionario_vista_local dvl ON dvl.id= vista_local_id ';
    }elseif ($input['tipo']=='terreno') {
	$tabla='em_terreno';
	$campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni, 
        valor_comercial, contacto, telefono,
        zonificacion, ruta_informe
        ';
	$campos_arr = array(
			    'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
			    'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
			    'valor_comercial'=>'', 'contacto'=>'', 'telefono'=>'',
			    'zonificacion'=>'', 'ruta_informe'=>'', 
			    );
	$join.='  ';
    }
    /* ****************** filters ******************* */
    foreach ($input as $key => $value) {
	if ($key=='departamento' and $value!='') {	
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_departamento u
                         JOIN  diccionario_ubi_departamento d ON d.nombre=u.nombre
                       WHERE u.departamento_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();
	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_departamento_id='.$results[0]['id'];
	    	$i++;
	    } else {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_departamento_id=0';
	    	$i++;		
	    }
	}
	if ($key=='provincia' and $value!='' and $value!='null') {
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_provincia u
                         JOIN  diccionario_ubi_provincia d ON d.nombre=u.nombre
                       WHERE u.provincia_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();

	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_provincia_id='.$results[0]['id'];
	    	$i++;
	    } else {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_provincia_id=0';
	    	$i++;
	    }
	}
	if ($key=='distrito' and $value!='' and $value!='null') {
	    $q->fields = array( "id" => "" );
	    $q->sql = "SELECT
                         d.id
                         FROM ubi_distrito u
                         JOIN diccionario_ubi_distrito d ON d.nombre=u.nombre
                       WHERE u.distrito_id=".$value;
	    $q->data = NULL;
	    $results = $q->exe();
	    //print_r($results);
	    if (is_array($results)) {
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_distrito_id='.$results[0]['id'];
	    	$i++;
	    } else{
	    	if ($i>=1)
	    	    $filter.=' AND ';
	    	$filter.= 'ubi_distrito_id=0';
	    	$i++;
	    }
	}
	if ($key=='fech_ini') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'estudio_fecha>="'.$value.'"';
	    $i++;
	}

	if ($key=='fech_end') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'estudio_fecha<="'.$value.'"';
	    $i++;
	}	
    } 
    if ($i>0){
	$filter = ' WHERE '.$filter;	
    }     
    /* ******************* query ******************** */
    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    $q->data = NULL;
    $data = '';
    
    $data = $q->exe();
    // Utilidades::print_r('',$q->sql);
    printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$q->sql);    
    return $data;
}
function search_marker_t($input) {
    global $q;
    $join = '';
    if ($input['categoria']=='casa') {
        $tabla='t_casa';
        $campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion,
        piso_cantidad, terreno_area, terreno_valorunitario,
        edificacion_area, valor_comercial, areas_complementarias,
        ruta_informe';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'', 
            'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
            'piso_cantidad'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'', 
            'edificacion_area'=>'', 'valor_comercial'=>'', 'areas_complementarias'=>'', 
            'ruta_informe'=>''
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
    } elseif ($input['categoria']=='departamento') {
        $tabla='t_departamento';
        $campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion,tasacion_fecha, zonificacion,
        piso_cantidad, piso_ubicacion, ddt.nombre,
        terreno_area,terreno_valorunitario, edificacion_area,
        valor_comercial, valor_ocupada, estacionamiento_cantidad,
        areas_complementarias, ruta_informe
        ';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
            'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
            'piso_cantidad'=>'', 'piso_ubicacion'=>'', 'departamento_tipo'=>'',
            'terreno_area'=>'', 'terreno_valorunitario'=>'', 'edificacion_area'=>'',
            'valor_comercial'=>'', 'valor_ocupada'=>'', 'estacionamiento_cantidad'=>'',
            'areas_complementarias'=>'', 'ruta_informe'=>''
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
        $join.=' LEFT JOIN diccionario_departamento_tipo ddt ON ddt.id=departamento_tipo_id ';	
    }elseif ($input['categoria']=='local_industrial') {
        $tabla='t_local_industrial';
        $campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion, 
        piso_cantidad, terreno_area, terreno_valorunitario, 
        edificacion_area, valor_comercial, areas_complementarias, 
        ruta_informe
        ';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
            'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
            'piso_cantidad'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'',
            'edificacion_area'=>'', 'valor_comercial'=>'', 'areas_complementarias'=>'', 
            'ruta_informe'=>''
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';	
    }elseif ($input['categoria']=='local_comercial') {
        $tabla='t_local_comercial';
        $campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion,
        piso_cantidad, dvl.nombre, terreno_area,
        terreno_valorunitario, edificacion_area, valor_comercial,
        valor_ocupada, ruta_informe
        ';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
            'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
            'piso_cantidad'=>'', 'vista_local'=>'', 'terreno_area'=>'',
            'terreno_valorunitario'=>'', 'edificacion_area'=>'', 'valor_comercial'=>'',
            'areas_complementarias'=>'', 'ruta_informe'=>''
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
        $join.=' LEFT JOIN diccionario_vista_local dvl ON dvl.id=vista_local_id';	
    }elseif ($input['categoria']=='terreno') {
        $tabla='t_terreno';
        $campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        ubicacion, tasacion_fecha, zonificacion, 
        dct.nombre, terreno_area, terreno_valorunitario, 
        valor_comercial, ruta_informe
        ';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
            'ubicacion'=>'', 'tasacion_fecha'=>'', 'zonificacion'=>'',
            'cultivo_tipo'=>'', 'terreno_area'=>'', 'terreno_valorunitario'=>'',
            'valor_comercial'=>'', 'ruta_informe'=>''
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
        $join.=' LEFT JOIN diccionario_cultivo_tipo dct ON dct.id=cultivo_tipo_id ';	
    } elseif ($input['categoria']=='oficina') {
        $tabla='t_oficina';
        $campos_str = '
  dc.nombre   cliente, dp.nombre propietario, ds.nombre
, ubicacion, tasacion_fecha, zonificacion

, piso_cantidad, piso_ubicacion, departamento_tipo_id

, terreno_area , terreno_valorunitario, edificacion_area
, valor_comercial, ruta_informe
        ';
        $campos_arr = array(
            'cliente'=>'', 'propietario'=>'', 'solicitante'=>'',
            'ubicacion' => '', 'tasacion_fecha' => '', 'zonificacion' => '',
            'piso_cantidad' => '', 'piso_ubicacion' => '', 'departamento_tipo_id' => '',
            'terreno_area' => '', 'terreno_valorunitario' => '', 'edificacion_area' => '',
            'valor_comercial' => '', 'ruta_informe' => '', 
        );
        $join.=' LEFT JOIN diccionario_cliente dc ON dc.id=cliente_id ';
        $join.=' LEFT JOIN diccionario_propietario dp ON dp.id=propietario_id ';
        $join.=' LEFT JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
    }

    $filter = ' WHERE mapa_latitud LIKE "%'.$input['latitud'].'%" AND mapa_longitud LIKE "%'.$input['longitud'].'%"';
	
    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    $q->data = NULL;
    $data = $q->exe();
    // printf('<textarea rows="10" cols="50" style="">%s</textarea>',$q->sql);
    return $data;
}
function search_marker_em($input) {
    global $q;
    $join = '';
    if ($input['categoria']=='casa') {
        $tabla='em_casa';
        $campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        edificacion_area, edificacion_area_uni, valor_comercial,
        piso_cantidad, contacto, telefono,
        zonificacion, ruta_informe
        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'' , 'terreno_area'=>'',
            'terreno_area_uni'=>'', 'terreno_valorunitario'=>'' , 'terreno_valorunitario_uni'=>'',
            'edificacion_area'=>'', 'edificacion_area_uni'=>'' , 'valor_comercial'=>'',
            'piso_cantidad'=>'', 'contacto'=>'' , 'telefono'=>'',
            'zonificacion'=>'', 'ruta_informe'=>'',
        );
        $join.='  ';
    }elseif ($input['categoria']=='departamento') {
        $tabla='em_departamento';
        $campos_str = '
        ubicacion, estudio_fecha, terreno_area, 
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        estacionamiento_cantidad, ddt.nombre as "departamento-tipo", areas_complementarias,
        piso_cantidad, piso_ubicacion, edificacion_area, 
        edificacion_area_uni, valor_comercial, contacto,
        telefono, zonificacion, ruta_informe
        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'' , 'terreno_area'=>'',
            'terreno_area_uni'=>'', 'terreno_valorunitario'=>'' , 'terreno_valorunitario_uni'=>'',
            'estacionamiento_cantidad'=>'', 'departamento_tipo'=>'' , 'areas_complementarias'=>'',
            'piso_cantidad'=>'', 'piso_ubicacion'=>'' , 'edificacion_area'=>'',
            'edificacion_area_uni'=>'', 'valor_comercial'=>'' , 'contacto'=>'',
            'telefono'=>'', 'zonificacion'=>'' , 'ruta_informe'=>'',
        );
        $join.=' LEFT JOIN diccionario_departamento_tipo ddt ON ddt.id=departamento_tipo_id ';	
    }elseif ($input['categoria']=='local_industrial') {
        $tabla='em_local_industrial';
        $campos_str = '
         ubicacion, estudio_fecha, terreno_area,
         terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
         edificacion_area, edificacion_area_uni, valor_comercial,
         piso_cantidad, contacto, telefono,
         zonificacion, ruta_informe
        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
            'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
            'edificacion_area'=>'', 'edificacion_area_uni'=>'', 'valor_comercial'=>'',
            'piso_cantidad'=>'', 'contacto'=>'', 'telefono'=>'',
            'zonificacion'=>'', 'ruta_informe'=>'',
        );
        $join.='  ';	
    }elseif ($input['categoria']=='local_comercial') {
        $tabla='em_local_comercial';
        $campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni,
        piso_cantidad, dvl.nombre, edificacion_area,
        edificacion_area_uni, valor_comercial, contacto,
        telefono, zonificacion, ruta_informe
        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
            'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
            'piso_cantidad'=>'', 'vista_local'=>'', 'edificacion_area'=>'',
            'edificacion_area_uni'=>'', 'valor_comercial'=>'', 'contacto'=>'',
            'telefono'=>'', 'zonificacion'=>'', 'ruta_informe'=>'',
        );
        $join.='  LEFT JOIN diccionario_vista_local dvl ON dvl.id= vista_local_id ';	
    }elseif ($input['categoria']=='terreno') {
        $tabla='em_terreno';
        $campos_str = '
        ubicacion, estudio_fecha, terreno_area,
        terreno_area_uni, terreno_valorunitario, terreno_valorunitario_uni, 
        valor_comercial, contacto, telefono,
        zonificacion, ruta_informe
        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'', 'terreno_area'=>'',
            'terreno_area_uni'=>'', 'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
            'valor_comercial'=>'', 'contacto'=>'', 'telefono'=>'',
            'zonificacion'=>'', 'ruta_informe'=>'', 
        );
        $join.='  ';	
    } elseif ($input['categoria']=='oficina') {
        $tabla='em_oficina';
        $campos_str = '
ubicacion, estudio_fecha, terreno_area, terreno_area_uni, 
terreno_valorunitario, terreno_valorunitario_uni,
edificacion_area, edificacion_area_uni, valor_comercial,
departamento_tipo_id,piso_cantidad,piso_ubicacion,
contacto, telefono,zonificacion, ruta_informe

        ';
        $campos_arr = array(
            'ubicacion'=>'', 'estudio_fecha'=>'',
            'terreno_area'=>'', 'terreno_area_uni'=>'', 
            'terreno_valorunitario'=>'', 'terreno_valorunitario_uni'=>'',
            'edificacion_area'=>'', 'edificacion_area_uni'=>'', 'valor_comercial'=>'',
            'departamento_tipo_id'=>'', 'piso_cantidad'=>'', 'piso_ubicacion'=>'',
            'contacto' => '', 'telefono' => '', 'zonificacion' => '', 'ruta_informe' => '', 
        );
        $join.='  ';	
    }

    $filter = ' WHERE mapa_latitud LIKE "%'.$input['latitud'].'%" AND mapa_longitud LIKE "%'.$input['longitud'].'%"';

		      
    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    // Utilidades::print_r('SQL',$q->sql);
    $q->data = NULL;
    $data = array();
    $data = $q->exe();
    //printf('<textarea rows="10" cols="50" style="">%s</textarea>',$q->sql);
    return $data;
}
function get_search_no_inmubles_t($input) {
    global $q;
    $data = '';
    $filter = '';
    $tabla = '';
    $join = '';
    $i=0;
    if ($input['cat']=='maquinaria') {
	$tabla='t_maquinaria';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        tasacion_fecha, dmt.nombre, dmma.nombre, 
        dmmo.nombre, fabricacion_anio, valor_similar_nuevo, 
        valor_comercial, ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'', 
    			    'tasacion_fecha'=>'', 'maquinaria_tipo'=>'', 'maquinaria_marca'=>'',
                            'maquinaria_modelo'=>'', 'fabricacion_anio'=>'', 'valor_similar_nuevo'=>'',
                            'valor_comercial'=>'', 'ruta_informe'=>'',  
			    );
	$join.=' JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
	$join.=' JOIN diccionario_maquinaria_tipo dmt ON dmt.id=maquinaria_tipo_id ';
	$join.=' JOIN diccionario_maquinaria_marca dmma ON dmma.id=maquinaria_marca_id ';
	$join.=' JOIN diccionario_maquinaria_modelo dmmo ON dmmo.id=maquinaria_modelo_id ';
    }
    if ($input['cat']=='vehiculo') {
	$tabla='t_vehiculo';
	$campos_str = '
        dc.nombre, dp.nombre, ds.nombre, 
        tasacion_fecha, dvt.nombre, dvma.nombre, 
        dvmo.nombre, fabricacion_anio, dvtr.nombre, 
        valor_similar_nuevo, valor_comercial, ruta_informe
        ';
	$campos_arr = array(
			    'cliente'=>'', 'propietario'=>'', 'solicitante'=>'', 
    			    'tasacion_fecha'=>'', 'vehiculo_tipo'=>'', 'vehiculo_marca'=>'',
                            'vehiculo_modelo'=>'', 'fabricacion_anio'=>'', 'vehiculo_traccion' =>'', 
                            'valor_similar_nuevo'=>'', 'valor_comercial'=>'', 'ruta_informe'=>'',  
			    );
	$join.=' JOIN diccionario_cliente dc ON dc.id=cliente_id ';
	$join.=' JOIN diccionario_propietario dp ON dp.id=propietario_id ';
	$join.=' JOIN diccionario_solicitante ds ON ds.id=solicitante_id ';
	$join.=' JOIN diccionario_vehiculo_tipo dvt ON dvt.id=vehiculo_tipo_id ';
	$join.=' JOIN diccionario_vehiculo_marca dvma ON dvma.id=vehiculo_marca_id ';
	$join.=' JOIN diccionario_vehiculo_modelo dvmo ON dvmo.id=vehiculo_modelo_id ';
	$join.=' JOIN diccionario_vehiculo_traccion dvtr ON dvtr.id=vehiculo_traccion_id ';
    }    
    /******************* filter *****************/
    foreach ($input as $key => $value) {
	if ($key=='tipo' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_tipo_id="'.$value.'"';    
	    $i++;
	}
	if ($key=='marca' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_marca_id="'.$value.'"';    
	    $i++;
	}	
	if ($key=='modelo' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_modelo_id="'.$value.'"';    
	    $i++;
	}
	if ($key=='tas_ini' and $value!='') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'tasacion_fecha>="'.$value.'"';
	    $i++;
	}
	if ($key=='tas_end' and $value!='') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'tasacion_fecha<="'.$value.'"';
	    $i++;
	}
	if ($key=='cliente' and $value!='') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'dc.nombre LIKE "%'.$value.'%"';
	    $i++;
	}
	if ($key=='anio_fabr' and $value!='') {
	    $value_arr = explode("!", $value); 
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'fabricacion_anio >= "'.$value_arr[0].'"';
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'fabricacion_anio <= "'.$value_arr[1].'"';
	    $i++;
	}
    }
    /******************* endfilter *****************/

    if ($i>0)
	$filter = ' WHERE '.$filter;	

    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    $q->data = NULL;
    $data = $q->exe();
    printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$q->sql);    
    return $data;
}
function get_search_no_inmubles_em($input) {
    global $q;
    $data = '';
    $filter = '';
    $tabla = '';
    $join = '';
    $i=0;
    if ($input['cat']=='maquinaria') {
	$tabla='em_maquinaria';
	$campos_str = '
        estudio_fecha, dmt.nombre, dmma.nombre, 
        dmmo.nombre, fabricacion_anio, valor_similar_nuevo,
        contacto, telefono, ruta_informe
        ';
	$campos_arr = array(
			    'estudio_fecha'=>'', 'tipo'=>'', 'marca'=>'', 
			    'modelo'=>'', 'fabricacion_anio'=>'', 'valor_similar_nuevo'=>'', 
			    'contacto'=>'', 'telefono'=>'', 'ruta_informe'=>''
			    );
	$join.=' JOIN diccionario_maquinaria_tipo dmt ON dmt.id=maquinaria_tipo_id ';
	$join.=' JOIN diccionario_maquinaria_marca dmma ON dmma.id=maquinaria_marca_id ';
	$join.=' JOIN diccionario_maquinaria_modelo dmmo ON dmmo.id=maquinaria_modelo_id ';
    }
    if ($input['cat']=='vehiculo') {
	$tabla='em_vehiculo';
	$campos_str = '
        estudio_fecha, dvt.nombre, dvma.nombre,
        dvmo.nombre, fabricacion_anio, vehiculo_traccion_id,
        valor_similar_nuevo, contacto, telefono,
        ruta_informe
        ';
	$campos_arr = array(
			    'estudio_fecha'=>'', 'tipo'=>'', 'marca'=>'', 
			    'modelo'=>'', 'fabricacion_anio'=>'', 'vehiculo_traccion'=>'',
			    'valor_similar_nuevo'=>'',  'contacto'=>'', 'telefono'=>'',
			    'ruta_informe'=>''
			    );
	$join.=' JOIN diccionario_vehiculo_tipo dvt ON dvt.id=vehiculo_tipo_id ';
	$join.=' JOIN diccionario_vehiculo_marca dvma ON dvma.id=vehiculo_marca_id ';
	$join.=' JOIN diccionario_vehiculo_modelo dvmo ON dvmo.id=vehiculo_modelo_id ';
    }    
    /******************* filter *****************/
    foreach ($input as $key => $value) {
	if ($key=='tipo' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_tipo_id="'.$value.'"';    
	    $i++;
	}
	if ($key=='marca' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_marca_id="'.$value.'"';    
	    $i++;
	}	
	if ($key=='modelo' and $value!='') {	
	    if ($i>=1) 
		$filter.=' AND ';
	    $filter.= $input['cat'].'_modelo_id="'.$value.'"';    
	    $i++;
	}
	if ($key=='tas_ini' and $value!='') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'estudio_fecha>="'.$value.'"';
	    $i++;
	}
	if ($key=='tas_end' and $value!='') {
	    if ($i>=1)
		$filter.=' AND ';
	    $filter.= 'estudio_fecha<="'.$value.'"';
	    $i++;
	}
    }
    /******************* endfilter *****************/

    if ($i>0)
	$filter = ' WHERE '.$filter;	

    $q->fields = $campos_arr;
    $q->sql = "SELECT ".$campos_str." FROM ".$tabla.$join.$filter;
    $q->data = NULL;
    $data = $q->exe();
    printf('<textarea rows="10" cols="50" style="display:none;">%s</textarea>',$q->sql);    
    return $data;
}
?>
