<?php
function table_modal_vendedor() {
    global $q;
    $q->fields = array(
		       "id"         => ""
		       , "nombre"   => ""
		       , "telefono" => ""
		       , "correo"   => ""
		       , "estado"   => ""
		       , "login"    => ""
    		       );
    $q->sql = '
SELECT v.id, v.nombre, v.telefono, v.correo, v.info_status, u.login
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.user_id=' . $_SESSION['user_id'] . '
UNION
SELECT v.id, v.nombre, v.telefono, v.correo, v.info_status, u.login
FROM co_vendedor v
JOIN login_user u ON u.id=v.user_id
WHERE v.parent_id=' . $_SESSION['user_id'] . '
ORDER BY 2
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_modal_juridico_no_coordinador() {
    global $q;
    $q->fields = array(
		       'id' => ''
		       , 'clasificacion_id' => ''
		       , 'clasificacion_nombre' => ''
		       , 'actividad_id' => ''
		       , 'actividad_nombre' => ''
		       , 'grupo_id' => ''
		       , 'grupo_nombre' => ''
		       , 'nombre' => ''
		       , 'ruc' => ''
		       , 'direccion' => ''
		       , 'telefono' => ''
		       , 'status' =>''
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''		       
    		       );    
    $q->sql = '
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
                    , ve.id
                    , ve.nombre
                    , pe.id persona_estado_id
                    , pe.nombre persona_estado_nombre
                    , ju.observacion
                    , ju.importante_id
                    , ju.referido_id
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
               LEFT JOIN co_vendedor ve ON ve.id=ju.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
               WHERE ve.user_id= ' . $_SESSION['user_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_modal_juridico_coordinador() {
    global $q;
    $q->fields = array(
		       'id' => ''
		       , 'clasificacion_id' => ''
		       , 'clasificacion_nombre' => ''
		       , 'actividad_id' => ''
		       , 'actividad_nombre' => ''
		       , 'grupo_id' => ''
		       , 'grupo_nombre' => ''
		       , 'nombre' => ''
		       , 'ruc' => ''
		       , 'direccion' => ''
		       , 'telefono' => ''
		       , 'status' =>''
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''
    		       );    
    $q->sql = '
SELECT * FROM (
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
                    , ve.id vendedor_id
                    , ve.nombre vendedor_nombre
                    , pe.id persona_estado_id
                    , pe.nombre persona_estado_nombre
                    , ju.observacion
                    , ju.importante_id
                    , ju.referido_id
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
                    JOIN co_vendedor ve ON ve.id=ju.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
               WHERE ve.user_id= ' . $_SESSION['user_id'] . '
UNION
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
                    , ve.id vendedor_id
                    , ve.nombre vendedor_nombre
                    , pe.id persona_estado_id
                    , pe.nombre persona_estado_nombre
                    , ju.observacion
                    , ju.importante_id
                    , ju.referido_id
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
                    JOIN co_vendedor ve ON ve.id=ju.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
               WHERE ve.parent_id= ' . $_SESSION['user_id'] . '
UNION
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
                    , ve.id vendedor_id
                    , ve.nombre vendedor_nombre
                    , pe.id persona_estado_id
                    , pe.nombre persona_estado_nombre
                    , ju.observacion
                    , ju.importante_id
                    , ju.referido_id
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
                    JOIN co_vendedor ve ON ve.id=ju.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
               WHERE ve.rol_id = 1 OR ve.id = 2
UNION
               SELECT  
                      ju.id
                    , ju.clasificacion_id
                    , cl.nombre clasificacion_nombre
                    , ju.actividad_id
                    , ac.nombre actividad_nombre
                    , ju.grupo_id
                    , gr.nombre grupo_nombre
                    , ju.nombre
                    , ju.ruc
                    , ju.direccion
                    , ju.telefono
                    , ju.info_status
                    , "" as vendedor_id
                    , "" as vendedor_nombre
                    , pe.id persona_estado_id
                    , pe.nombre persona_estado_nombre
                    , ju.observacion
                    , ju.importante_id
                    , ju.referido_id
               FROM co_involucrado_juridica ju
               LEFT JOIN co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
               LEFT JOIN co_involucrado_actividad ac ON ac.id=ju.actividad_id
               LEFT JOIN co_involucrado_grupo gr ON gr.id=ju.grupo_id
               LEFT JOIN ve_persona_estado pe ON pe.id=ju.estado_id
               WHERE ju.vendedor_id = 0
) s
ORDER BY 1
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_modal_natural_no_coordinador() {
    global $q;
    $q->fields = array(
		       'id' => ''
		       , 'nombre' => ''
		       , 'documento_id' => ''
		       , 'documento_tipo'=>''
		       , 'documento_numero'=>''
		       , 'direccion'=>''
		       , 'telefono'=>''
		       , 'correo'=>''
		       , 'info_status'=>''
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''
    		       );
    $q->sql = '
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
                      , ve.id
                      , ve.nombre
                      , pe.id persona_estado_id
                      , pe.nombre persona_estado_nombre
                      , na.observacion
                      , na.importante_id
                      , na.referido_id
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
               WHERE ve.user_id= ' . $_SESSION['user_id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;    
}
function table_modal_natural_coordinador() {
    global $q;
    $q->fields = array(
		       'id' => ''
		       , 'nombre' => ''
		       , 'documento_id' => ''
		       , 'documento_tipo'=>''
		       , 'documento_numero'=>''
		       , 'direccion'=>''
		       , 'telefono'=>''
		       , 'correo'=>''
		       , 'info_status'=>''
		       , 'vendedor_id' =>''
		       , 'vendedor' =>''
		       , 'persona_estado_id' =>''
		       , 'persona_estado_nombre' =>''
		       , 'observacion' =>''
		       , 'importante_id' =>''
		       , 'referido' =>''
    		       );
    $q->sql = '
SELECT * FROM (
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
                      , ve.id vendedor_id
                      , ve.nombre vendedor_nombre
                      , pe.id persona_estado_id
                      , pe.nombre persona_estado_nombre
                      , na.observacion
                      , na.importante_id
                      , na.referido_id
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
               WHERE ve.user_id = ' . $_SESSION['user_id'] . '
UNION
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
                      , ve.id vendedor_id
                      , ve.nombre vendedor_nombre
                      , pe.id persona_estado_id
                      , pe.nombre persona_estado_nombre
                      , na.observacion
                      , na.importante_id
                      , na.referido_id
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
               WHERE ve.parent_id= ' . $_SESSION['user_id'] . '
UNION
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
                      , ve.id vendedor_id
                      , ve.nombre vendedor_nombre
                      , pe.id persona_estado_id
                      , pe.nombre persona_estado_nombre
                      , na.observacion
                      , na.importante_id
                      , na.referido_id
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               LEFT JOIN co_vendedor ve ON ve.id=na.vendedor_id
               LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
               WHERE ve.rol_id=1
UNION
               SELECT  na.id
                      , na.nombre
                      , na.documento_tipo_id
                      , do.nombre as "documento_tipo"
                      , na.documento as "documento_numero"
                      , na.direccion
                      , na.telefono
                      , na.correo
                      , na.info_status
                      , "" vendedor_id
                      , "" vendedor_nombre
                      , pe.id persona_estado_id
                      , pe.nombre persona_estado_nombre
                      , na.observacion
                      , na.importante_id
                      , na.referido_id
               FROM co_involucrado_natural na 
               LEFT JOIN co_involucrado_documento_tipo do ON do.id=na.documento_tipo_id
               LEFT JOIN ve_persona_estado pe ON pe.id=na.estado_id
               WHERE na.vendedor_id = 0
) as d
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;    
}
function table_rol_id_by_user() {
    global $q;
    $q->fields = array(
		       "id" => ""
    		       );
    $q->sql = '
SELECT rol_id FROM co_vendedor WHERE user_id=' . $_SESSION['user_id'] . ';
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0]['id'];
}
function table_modal_contacto_j($input) {
    global $q;
    $q->fields = array(
                          'id' => ''
		        , 'persona_id' => ''
		        , 'nombre' => ''
		        , 'cargo' => ''
			, 'telefono' =>''
			, 'correo' =>''
			, 'status' =>''
    		       );

    $q->sql = '
              SELECT  c.id, c.juridica_id, c.nombre, c.cargo, c.telefono, c.correo, c.info_status
              FROM co_involucrado_contacto c
              WHERE c.juridica_id = '.$input['persona_id'] .' AND c.info_status 
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_modal_contacto_n($input) {
    global $q;
    $q->fields = array(
                          'id' => ''
		        , 'persona_id' => ''
		        , 'nombre' => ''
		        , 'cargo' => ''
			, 'telefono' =>''
			, 'correo' =>''
			, 'status' =>''
    		       );

    $q->sql = '
              SELECT  c.id, c.natural_id, c.nombre, c.cargo, c.telefono, c.correo, c.info_status
              FROM co_involucrado_contacto c
              WHERE c.natural_id = '.$input['persona_id'] .' AND c.info_status
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_modal_contacto_verificar($persona_id, $persona_tipo) {
    $user_id = table_modal_contacto_verificar_user_id($persona_id, $persona_tipo);
    $rol_id = table_modal_contacto_verificar_rol_id();
    if ( $user_id == $_SESSION['user_id'] || ($user_id == 0 && $rol_id == 2) ) {
	return true;
    } else {	
	if ( $rol_id == 2 ) {

	    return table_modal_contacto_verificar_final( $user_id );
	} else {
	    return false;
	}
    }
}
function table_modal_contacto_verificar_user_id($persona_id, $persona_tipo) {
    global $q;
    $q->fields = array(
		       "user_id" => ""
    		       );

    if ( $persona_tipo == 'juridica' ) {
    $q->sql = '
SELECT ve.user_id FROM co_involucrado_juridica ju
JOIN co_vendedor ve ON ve.id=ju.vendedor_id
WHERE ju.id=' . $persona_id . '
              ';
    } elseif ( $persona_tipo == 'natural' ) {
    $q->sql = '
SELECT ve.user_id FROM co_involucrado_natural na
JOIN co_vendedor ve ON ve.id=na.vendedor_id
WHERE na.id=' . $persona_id . '
              ';
    } 
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array( $data ) ) {
	return $data[0]['user_id'];
    } else {
	return 0;
    }
}
function table_modal_contacto_verificar_rol_id() {
    global $q;
    $q->fields = array(
		       "rol_id" => ""
    		       );
    $q->sql = '
SELECT rol_id FROM co_vendedor
WHERE user_id=' . $_SESSION['user_id'] . '
              ';    
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array( $data ) ) {
	return $data[0]['rol_id'];
    }
}
function table_modal_contacto_verificar_final( $user_id ) {
    global $q;
    $q->fields = array(
		       "cnt" => ""
    		       );
    $q->sql = '
SELECT COUNT(id) FROM co_vendedor 
WHERE  user_id = "' . $user_id . '" AND (parent_id = "' . $_SESSION['user_id'] . '" OR rol_id=1)

              ';    
    $q->data = NULL;
    $data = $q->exe();
    if ( is_array( $data ) ) {
	if ( $data[0]['cnt'] == '0' ) {
	    return false;
	} else {
	    return true;
	}
    }
}
function table_visitas_propuesta($input) {
    global $q;
    $q->fields = array(
		       'id' =>''
		       , 'estado_id' =>''
		       , 'estado_nombre' =>''
		       , 'contacto_id' =>''
		       , 'contacto_nombre' =>''
		       , 'fecha' =>''
		       , 'hora' =>''
		       , 'minuto' =>''
		       , 'departamento_id' =>''
		       , 'departamento_nombre' =>''
		       , 'provincia_id' =>''
		       , 'provincia_nombre' =>''
		       , 'distrito_id' =>''
		       , 'distrito_nombre' =>''
		       , 'direccion' =>''
		       , 'observacion' =>''
    		       );
    $q->sql = '
SELECT
  vi.id
, vi.estado_id
, es.nombre estado_nombre
, vi.contacto_id
, co.nombre contacto_nombre
, vi.fecha
, vi.hora
, vi.minuto
, vi.departamento_id
, dep.nombre departamento_nombre
, vi.provincia_id
, pro.nombre provincia_nombre
, vi.distrito_id
, dis.nombre distrito_nombre
, vi.direccion
, vi.observacion
FROM ve_visita vi
LEFT JOIN ve_estado es ON es.id=vi.estado_id
LEFT JOIN co_involucrado_contacto co ON co.id=vi.contacto_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON (dep.departamento_id=vi.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0)
LEFT JOIN co_bien_inmuebles_ubigeo pro ON (pro.departamento_id=vi.departamento_id AND pro.provincia_id=vi.provincia_id AND pro.distrito_id=0)
LEFT JOIN co_bien_inmuebles_ubigeo dis ON (dis.departamento_id=vi.departamento_id AND dis.provincia_id=vi.provincia_id AND dis.distrito_id=vi.distrito_id)
WHERE vi.propuesta_id=' . $input['propuesta_id'] . ' AND vi.info_status!=0
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_search_propuesta($input) {
    global $q;
    $rol_id = table_rol_id_by_user();

    $filter = '';
    if ( $rol_id != 2 ) {
	$filter = ' AND v.user_id=' . $_SESSION['user_id'];
    }
    
    $q->fields = array('id' => ''
		       , 'codigo'=>''
		       , 'vendedor_nombre'=>''
		       , 'persona_nombre'=>''
		       , 'estado_nombre'=>''
		       , 'contacto_nombre'=>''
		       , 'contacto_cargo'=>''
		       , 'fecha'=>''
		       , 'hora'=>''
		       , 'minuto'=>''
    		       );
    $q->sql = '
SELECT * FROM (
   SELECT 
     p.id
   , p.codigo
   , v.nombre vendedor_nombre
   , j.nombre persona_nombre
   , e.nombre estado_nombre
   , c.nombre contacto_nombre
   , c.cargo contacto_cargo
   , p.fecha
   , p.hora
   , p.minuto
   FROM ve_propuesta p
   LEFT JOIN co_involucrado_juridica j ON j.id=p.persona_id
   LEFT JOIN co_vendedor v ON v.id=p.vendedor_id
   LEFT JOIN ve_estado e ON e.id=p.estado_id
   LEFT JOIN co_involucrado_contacto c ON c.id=p.contacto_id
   WHERE codigo!=0 AND p.persona_tipo="Juridica" AND p.info_status!=0 ' . $filter . '
UNION
   SELECT
     p.id 
   , p.codigo
   , v.nombre vendedor_nombre
   , n.nombre persona_nombre
   , e.nombre estado_nombre
   , c.nombre contacto_nombre
   , c.cargo contacto_cargo
   , p.fecha
   , p.hora
   , p.minuto
   FROM ve_propuesta p
   LEFT JOIN co_involucrado_natural n ON n.id=p.persona_id
   LEFT JOIN co_vendedor v ON v.id=p.vendedor_id
   LEFT JOIN ve_estado e ON e.id=p.estado_id
   LEFT JOIN co_involucrado_contacto c ON c.id=p.contacto_id
   WHERE codigo!=0 AND p.persona_tipo="Natural" AND p.info_status!=0 ' . $filter . '
) dd
ORDER BY 1 DESC
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data;
}
function table_($input) {
    global $q;
    $q->fields = array(
		       "" => ""
    		       );
    $q->sql = '
SELECT 
FROM 
WHERE .id=' . $input['id'] . '
              ';
    $q->data = NULL;
    $data = $q->exe();
    return $data[0];
}

