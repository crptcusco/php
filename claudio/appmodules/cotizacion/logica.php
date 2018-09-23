<?php 
/*
 *********************************************************
 * funciones
 *********************************************************
*/
function get_cotizacion_generar_id() {
    global $q;
    $q->data = NULL;
    $q->fields = array(
    		       "id" => ""
    		       );
    $q->sql = '
              SELECT co_nuevo(' . $_SESSION["user_id"] . ') 
              AS id
              ';

    $data = $q->exe();
    // print $q->sql;
    return $data[0]['id'];
}
function set_cotizacion( $input ) {
    global $q;
    $q->data = NULL;
    $q->fields = array('codigo'=>'');
    $q->sql = '
              SELECT co_save(  ' . $input['id'] . '
                           , ' . $input['actualizacion'] . '
                           , ' . $input['tipo_cotizacion'] . '
                           , ' . $input['desglose'] . '
                           , ' . $input['tipo_servicio'] . '
                           , ' . $input['estado_cotizacion'] . '
                           , "' . $input['co_fecha_solicitud'] . '"
                           , "' . $input['co_fecha_envio_cliente'] . '"
                           , "' . $input['co_fecha_finalizado'] . '"
                           , "' . $input['co_involucrados_vendedor'] . '"
                           , ' . $_SESSION["user_id"]  . '
                           ) as codigo
              ';
    // print $q->sql;
    $data = $q->exe();
    return $data[0]['codigo'];
}
function get_cotizacion( $codigo ) {
    global $q;
    $q->data = NULL;
    $q->fields = array(   'id'=>''
			, 'codigo_cotizacion'=>''
			, 'actualizacion'=>''
            , 'tipo_cotizacion' => ''
			, 'tipo_servicio'=>''
			, 'estado_cotizacion'=>''
		    , 'adjunto'=>''
            , 'desglose' => ''
			, 'fecha_solicitud' =>''
			, 'fecha_envio_cliente' =>''
			, 'fecha_finalizacion' =>''
			, 'coordinador' => ''
			, 'vendedor' => ''
		      );
    $q->sql = '
              SELECT 
                -- General
                co.id
              , co.codigo
              , co.actualizacion
              , co.tipo_cotizacion_id
              , co.servicio_tipo_id
              , co.estado_id
              , co.adjunto
              , co.desglose_id
              -- fechas
              , co.fecha_solicitud
              , co.fecha_envio_cliente
              , co.fecha_finalizacion
	      -- involucrados
	      , u.full_name as co
	      , co.vendedor_id
              FROM co_cotizacion co
	      JOIN login_user u  ON u.id=co.info_create_user
              WHERE codigo= ' . $codigo . '
              LIMIT 1
              ';

    $data = $q->exe();
    return $data[0];
}
function find_cotizacion( $input ) {
    global $q;
    $q->data = NULL;
    $filters = '';
    $joins = '';
    $filters.= add_and_filter( $filters, 'co.codigo!=0');
    $columns = 'co.id as cotizacion_id';
    // general
    if ( $input['general_actualizacion_si'] != $input['general_actualizacion_no'] ) {
	$columns.= add_coma_col( $columns, 'co.actualizacion' );
	if ( $input['general_actualizacion_si'] ) {
	    $filters.= add_and_filter( $filters, 'co.actualizacion = 1' );
	}
	if ( $input['general_actualizacion_no'] ) {
	    $filters.= add_and_filter( $filters, 'co.actualizacion = 0' );
	}
    }
    if ( $input['general_tipo_servicio'] ) {
	$columns.= add_coma_col( $columns, 'co.servicio_tipo_id' );
	$filters.= add_and_filter( $filters, 'co.servicio_tipo_id = '. $input['general_tipo_servicio'] );
    }
    if ( $input['general_estado_cotizacion'] ) {
	$columns.= add_coma_col( $columns, 'co.estado_id' );
	$filters.= add_and_filter( $filters, 'co.estado_id = '. $input['general_estado_cotizacion'] );
    }
    // involucrados
    if ( $input['involucrados_coordinador_id'] ) {
	$columns.= add_coma_col( $columns, 'co.info_create_user, co.info_update_user' );
	$filters.= add_and_filter( $filters, '(co.info_create_user = '. $input['involucrados_coordinador_id'] . ' OR ' . 'co.info_update_user = ' . $input['involucrados_coordinador_id']. ')');
    }
    
    $joins.='LEFT JOIN co_involucrado i1 ON i1.cotizacion_id=co.id AND i1.rol_id=1'."\n";
    $joins.='LEFT JOIN co_involucrado i2 ON i2.cotizacion_id=co.id AND i2.rol_id=2'."\n";
    $joins.='LEFT JOIN co_involucrado i3 ON i3.cotizacion_id=co.id AND i3.rol_id=3'."\n";

    $filters_involucrado = '';
    if ( $input['involucrados_rol_cliente'] ) {
	if ( $input['involucrados_tipo'] == 'jurudico' ) {
	    if ( $input['involucrados_juridico_id'] ) {
		$joins.='LEFT JOIN co_involucrado_juridica iju1 ON iju1.id=i1.persona_id'."\n";		
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i1.persona_tipo = "Juridica" AND '
						      . 'iju1.id = ' . $input['involucrados_juridico_id']
						      . ')'
						      );
	    }
	}elseif( $input['involucrados_tipo'] == 'natural' ) {
	    if ( $input['involucrados_natural_id'] ) {
		$joins.='LEFT JOIN co_involucrado_natural  ina1 ON ina1.id=i1.persona_id'."\n";
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i1.persona_tipo = "Natural" AND '
						      . 'ina1.id = ' . $input['involucrados_natural_id']
						      . ')'
						      );
	    }
	}
    }

    if ( $input['involucrados_rol_solicitante'] ) {
	if ( $input['involucrados_tipo'] == 'jurudico' ) {
	    if ( $input['involucrados_juridico_id'] ) {
		$joins.='LEFT JOIN co_involucrado_juridica iju2 ON iju2.id=i2.persona_id'."\n";
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i2.persona_tipo = "Juridica" AND '
						      . 'iju2.id = ' . $input['involucrados_juridico_id']
						      . ')'
						      );
	    }
	}elseif( $input['involucrados_tipo'] == 'natural' ) {
	    if ( $input['involucrados_natural_id'] ) {
		$joins.='LEFT JOIN co_involucrado_natural  ina2 ON ina2.id=i2.persona_id'."\n";
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i2.persona_tipo = "Natural" AND '
						      . 'ina2.id = ' . $input['involucrados_natural_id']
						      . ')'
						      );
	    }
	}
    }

    if ( $input['involucrados_rol_propietario'] ) {
	if ( $input['involucrados_tipo'] == 'jurudico' ) {
	    if ( $input['involucrados_juridico_id'] ) {
		$joins.='LEFT JOIN co_involucrado_juridica iju3 ON iju3.id=i3.persona_id'."\n";
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i3.persona_tipo = "Juridica" AND '
						      . 'iju3.id = ' . $input['involucrados_juridico_id']
						      . ')'
						      );
	    }
	}elseif( $input['involucrados_tipo'] == 'natural' ) {
	    if ( $input['involucrados_natural_id'] ) {
		$joins.='LEFT JOIN co_involucrado_natural  ina3 ON ina3.id=i3.persona_id'."\n";
		$filters_involucrado.= add_or_filter( $filters_involucrado
						      , '(i3.persona_tipo = "Natural" AND '
						      . 'ina3.id = ' . $input['involucrados_natural_id']
						      . ')'
						      );
	    }
	}
    }
    if ($filters_involucrado!='') {
	$filters_involucrado = '(' . $filters_involucrado . ')';
	$filters.= add_and_filter( $filters, $filters_involucrado );
    } 
    

    
    if ( $input['involucrados_vendedor_id'] ) {
	$columns.= add_coma_col( $columns, 'co.vendedor_id' );
	$filters.= add_and_filter( $filters, 'co.vendedor_id = '. $input['involucrados_vendedor_id'] );
    }
    // bienes
    if ( $input['bienes_cateroria_mueble'] ) {
	if ( $input['bienes_sub_cateroria_mueble'] ) {
	    $columns.= add_coma_col( $columns, 'bm.sub_categoria_id' );
	    $joins.='LEFT JOIN co_bien_mueble bm ON bm.cotizacion_id=co.id'."\n";
	    $filters.= add_and_filter( $filters, 'bm.sub_categoria_id = '. $input['bienes_sub_cateroria_mueble'] );
	    if ( $input['bienes_sub_mueble_tipo'] ) {
		$columns.= add_coma_col( $columns, 'bm.tipo_id' );
		$filters.= add_and_filter( $filters, 'bm.tipo_id = '. $input['bienes_sub_mueble_tipo'] );
	    }
	    if ( $input['bienes_sub_mueble_marca'] ) {
		$columns.= add_coma_col( $columns, 'bm.marca_id' );
		$filters.= add_and_filter( $filters, 'bm.marca_id = '. $input['bienes_sub_mueble_marca'] );
	    }
	    if ( $input['bienes_sub_mueble_modelo'] ) {
		$columns.= add_coma_col( $columns, 'bm.modelo_id' );
		$filters.= add_and_filter( $filters, 'bm.modelo_id = '. $input['bienes_sub_mueble_modelo'] );
	    }
	    if ( $input['bienes_sub_mueble_descripcion'] ) {
		$columns.= add_coma_col( $columns, 'bm.descripcion' );
		$filters.= add_and_filter( $filters, 'bm.descripcion LIKE "%' . $input['bienes_sub_mueble_descripcion'] . '%"' );
	    }
	}
    }
    if ( $input['bienes_cateroria_inmueble'] ) {
	if ( $input['bienes_sub_cateroria_inmueble'] ) {
	    $columns.= add_coma_col( $columns, 'bi.sub_categoria_id' );
	    $joins.='LEFT JOIN co_bien_inmueble bi ON bi.cotizacion_id=co.id'."\n";
	    $filters.= add_and_filter( $filters, 'bi.sub_categoria_id = '. $input['bienes_sub_cateroria_inmueble'] );
	    if ( $input['bienes_sub_inmueble_departamento'] ) {
		$columns.= add_coma_col( $columns, 'bi.departamento_id' );
		$filters.= add_and_filter( $filters, 'bi.departamento_id = '. $input['bienes_sub_inmueble_departamento'] );
	    }
	    if ( $input['bienes_sub_inmueble_provincia'] ) {
		$columns.= add_coma_col( $columns, 'bi.provincia_id' );
		$filters.= add_and_filter( $filters, 'bi.provincia_id = '. $input['bienes_sub_inmueble_provincia'] );
	    }
	    if ( $input['bienes_sub_inmueble_distrito'] ) {
		$columns.= add_coma_col( $columns, 'bi.distrito_id' );
		$filters.= add_and_filter( $filters, 'bi.distrito_id = '. $input['bienes_sub_inmueble_distrito'] );
	    }
	    if ( $input['bienes_sub_inmueble_direccion'] ) {
		$columns.= add_coma_col( $columns, 'bi.direccion' );
		$filters.= add_and_filter( $filters, 'bi.direccion LIKE "%' . $input['bienes_sub_inmueble_direccion'] . '%"' );
	    }
	}
    }
    $joins.='LEFT JOIN co_servicio_tipo st ON st.id=co.servicio_tipo_id '."\n";
    $joins.='LEFT JOIN co_pago pa ON pa.cotizacion_id=co.id'."\n";
    $joins.='LEFT JOIN co_estado es ON es.id=co.estado_id'."\n";
    $joins.='LEFT JOIN co_vendedor ve ON ve.id=co.vendedor_id'."\n";
    $joins.='LEFT JOIN login_user lgu ON lgu.id=co.info_create_user'."\n";    
    
    // finale
    if ( $filters != '' ) {	
	$filters = 'WHERE co.info_status != 0 AND '.$filters;
    }
    $q->fields = array(
		       'codigo'=>''
		       , 'servicio_tipo'=>''
		       , 'total_con_igv'=>''
		       , 'total_moneda'=>''
		       , 'fecha_solicitud'=>''
		       , 'fecha_envio'=>''
		       , 'estado'=>''
		       , '1_persona_tipo'=>''
		       , '1_persona_id'=>''
		       , '2_persona_tipo'=>''
		       , '2_persona_id'=>''
		       , 'vendedor' =>''
		       , 'coordinador'=>''
		       );
    $q->sql = '
SELECT
  DISTINCT co.codigo
, st.nombre
, pa.total_monto_igv
, pa.total_moneda_id
, DATE_FORMAT(co.fecha_solicitud, "%d-%m-%Y")
, DATE_FORMAT(co.fecha_envio_cliente, "%d-%m-%Y")
, es.nombre
, i1.persona_tipo
, i1.persona_id
, i2.persona_tipo
, i2.persona_id
, ve.nombre
, lgu.full_name
FROM co_cotizacion co
' . $joins . '
' . $filters . '
ORDER BY 1 DESC
;';
    /* echo '<textarea>'; */
    /* echo $q->sql; */
    /* echo '</textarea>'; */
    return $q->exe();
}
function find_involucrados() {
    global $q;
    $q->data = NULL;
    $q->fields = array('tipo'=>''
		       , 'id'=>''
		       , 'nombre'=>''
		      );
    $q->sql = '
SELECT "Natural",id,nombre
FROM co_involucrado_natural
              ';
    $data1 = $q->exe();
    $q->sql = '
SELECT "Juridica",id,nombre
FROM co_involucrado_juridica
              ';
    $data2 = $q->exe();        
    if ( is_array( $data1) ) {
	foreach($data1 as $row) {
	    $data[ $row['tipo'] . '-' . $row['id'] ] = utf8_encode( $row['nombre'] );
	}
    }
    if ( is_array( $data2) ) {
	foreach($data2 as $row) {
	    $data[ $row['tipo'] . '-' . $row['id'] ] = utf8_encode( $row['nombre'] );
	}
    }
    if ( is_array( $data1) and is_array( $data2) ) {
	return $data;
    }
 
    
}
function find_monedas() {
    global $q;
    $q->data = NULL;
    $q->fields = array('id'=>''
		       , 'simbolo'=>''
		      );
    $q->sql = '
select id, simbolo from co_moneda
              ';
    $data = $q->exe();

    $output = array();
    foreach ($data as $row) {
	$output[$row['id']] = $row['simbolo'];
    }


    return $output;
}
function add_and_filter( $total, $new ) {
    if ($total!='') {
	$new = "\n" . 'AND '.$new;
    }
    return $new;
}
function add_or_filter( $total, $new ) {
    if ($total!='') {
	$new = "\n" . 'OR '.$new;
    }
    return $new;
}
function add_coma_col( $total, $new ) {
    if ($total!='') {
	$new = ', '.$new;
    }
    return $new;
}