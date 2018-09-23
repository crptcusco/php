<?php 
/*
 *
 * AUTHOR: Claudio Rodriguez
 * DESCRIPTION: capa de modelo
 * VERSION
 * -  1. 0. 0: version inicial, Claudio Rodriguez, 2015/09/09
 * -  0. 0. 0:
 * 
 */

class Coordinacion_Modelo_Eventos_Buttons {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function setCoordinacion($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL coor_coordinacion_save(
  "' . $in['id'] . '"
, "' . $in['estado_id'] . '"
, "' . $in['modalidad_id'] . '"
, "' . $in['tipo_id'] . '"
, "' . $in['tipo2_id'] . '"
, "' . $in['tipo_cambio_id'] . '"
, "' . $in['solicitante_tipo'] . '"
, "' . $in['solicitante_id'] . '"
, "' . $in['solicitante_contacto_id'] . '"
, "' . $in['solicitante_fecha'] . '"
, "' . $in['entrega_por_operaciones_fecha'] . '"
, "' . $in['entrega_al_cliente_fecha'] . '"
, "' . $in['cliente_tipo'] . '"
, "' . $in['cliente_id'] . '"
, "' . $in['sucursal'] . '"
, "' . $in['observacion'] . '"
, "' . date('Y-m-d H:i:s') . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        echo $this->q->sql;
        $this->q->data = null; 
        $this->q->exe();
    }
    function setContacto($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL coor_contacto_save (
  "'.$in['id'].'",
  "'.$in['persona_id'].'",
  "'.$in['persona_tipo'].'",
  "'.$in['nombre'].'", 
  "'.$in['cargo'].'",
  "'.$in['telefono'].'", 
  "'.$in['correo'].'",
  "'.$in['status'].'",
  "' . $_SESSION['user_id'] . '" 
)
        ';
        $this->q->data = NULL; 
        $this->q->exe();
    }
    function setModalidadCoordinacion($in) {
        $this->q->fields = array();
        $this->q->sql = ' 
 CALL coor_modalidad_add_edit (
     "'.$in['id'].'",
     "'.$in['nombre'].'", 
     "'.$in['status'].'",
     "' . $_SESSION['user_id'] . '" 
 )
        ';
        $this->q->data = NULL; 
        $this->q->exe();
    }
    function setTipo2Coordinacion($in) {
        $this->q->fields = array();
        $this->q->sql = ' 
 CALL coor_tipo2_add_edit (
     "'.$in['id'].'",
     "'.$in['nombre'].'", 
     "'.$in['status'].'",
     "' . $_SESSION['user_id'] . '" 
 )
        ';
        $this->q->data = NULL; 
        $this->q->exe();
    }
    function setCambioCoordinacion($in) {
        $this->q->fields = array();
        $this->q->sql = ' 
 CALL coor_cambio_add_edit (
     "'.$in['id'].'",
     "'.$in['nombre'].'", 
     "'.$in['status'].'",
     "' . $_SESSION['user_id'] . '" 
 )
        ';
        $this->q->data = NULL; 
        $this->q->exe();
    }    
    function saveItemOperacionInspeccion($in) {
        $this->q->fields = array(
            'id' => ''
            , 'perito_id' => ''
            , 'perito_nombre' => ''
            , 'inspector_id' => ''
            , 'inspector_nombre' => ''
            , 'contactos' => ''
            , 'fecha' => ''
            , 'hora_estimada' => ''
            , 'hora_estimada_mostrar' => ''
            , 'hora_real' => ''
            , 'hora_real_mostrar' => ''
            , 'departamento_id' => ''
            , 'departamento_nombre' => ''
            , 'provincia_id' => ''
            , 'provincia_nombre' => ''
            , 'distrito_id' => ''
            , 'distrito_nombre' => ''
            , 'direccion' => ''
            , 'observacion' => ''
        );
        $this->q->sql = ' 
CALL coor_asistencia_item_update (
   "' . $in['id'] . '"
 , "' . $in['perito_id'] . '"
 , "' . $in['inspector_id'] . '"
 , "' . $in['contactos'] . '"
 , "' . $in['fecha'] . '"
 , "' . $in['hora_estimada'] . '"
 , "' . $in['hora_estimada_mostrar'] . '"
 , "' . $in['hora_real'] . '"
 , "' . $in['hora_real_mostrar'] . '"
 , "' . $in['departamento_id'] . '"
 , "' . $in['provincia_id'] . '"
 , "' . $in['distrito_id'] . '"
 , "' . $in['direccion'] . '"
 , "' . $in['observacion'] . '"
 , "' . $in['rol_user'] . '"
 , "' . date('Y-m-d H:i:s') . '"
 , "' . $_SESSION['user_id'] . '"
)
        ';
        // print $this->q->sql;
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0];
    }
    function saveItemInforme($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL coor_informe_item_save (
  "' . $in['informe_id'] . '"
, "' . $in['ruta'] . '"
, "' . $_SESSION['user_id'] . '"
) 
        ';
        $this->q->data = NULL;
        $this->q->exe();
    }
    function addPersonaToCoordinacion($in) {
        $this->q->fields = array();        
        $this->q->sql = '
CALL coor_persona_add_to_coordinacion (
  "' . $in['persona_id'] . '"
, "' . $in['cotizacion_id'] . '"
, "' . $in['persona_tipo'] . '"
, "' . $in['persona_rol_id'] . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->data = NULL; 
        $this->q->exe();
    }
    function saveFechasDeEntregaItemInforme($in) {
        $this->q->fields = array(
            'id' => ''
            , 'fecha' => ''
            , 'tipo_id' => ''
            , 'tipo_nombre' => ''
        );
        $this->q->sql = '
CALL coor_informe_fechasDeEntrega_save (
  "' . $in['id'] . '"
, "' . $in['informe_id'] . '"
, "' . $in['fecha'] . '"
, "' . $in['tipo_id'] . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function saveDocumentacionItemInforme($in) {
        $this->q->fields = array(
            'id' => ''
            , 'enlace' => ''
            , 'descripcion' => ''
        );        
        $this->q->sql = '
CALL coor_informe_documentacion_save (
  "' . $in['id'] . '"
, "' . $in['informe_id'] . '"
, "' . $in['enlace'] . '"
, "' . $in['descripcion'] . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function saveObservacionDocumentacionItemInforme($in) {
        $this->q->fields = array();        
        $this->q->sql = '
UPDATE coor_informe SET observacion="' . $in['observacion'] . '"
WHERE id="' . $in['informe_id'] . '"
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function saveFirmaItemInforme($in) {
        $this->q->fields = array(
            'id' => ''
            , 'firmante_id' => ''
            , 'firmante_nombre' => ''
        );
        $this->q->sql = '
CALL coor_informe_firma_save (
  "' . $in['id'] . '"
, "' . $in['informe_id'] . '"
, "' . $in['firmante_id'] . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function itemInspeccionObservacionAdd($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
        INSERT INTO coor_inspeccion_observacion(inspeccion_id, user_id, observacion)
        VALUES("' . $in['inspeccion_id'] . '", "' . $_SESSION['user_id'] . '", "' . $in['observacion'] . '")
        ';
        $this->q->exe();
        $this->q->sql = '
        UPDATE coor_inspeccion SET 
        observacion="' . $in['observacion'] . '",
        observacion_user_id="' . $_SESSION['user_id'] . '"
        WHERE id="' . $in['inspeccion_id'] . '"
        ';
        $this->q->exe();
    }
    function setReporteCoordinacionInspeccionInforme($in) {
        $this->q->fields = array(
            'inspeccion_id' => ''
            , 'informe_id' => ''
            , 'coordinacion_id' => ''
            , 'contactos' => ''
            , 'inspeccion_fecha' => ''
            , 'hora_estimada' => ''
            , 'hora_estimada_mostrar' => ''
            , 'hora_real' => ''
            , 'hora_real_mostrar' => ''
            , 'departamento_id' => ''
            , 'provincia_id' => ''
            , 'distrito_id' => ''
            , 'direccion' => ''
            , 'consultor_id' => ''
            , 'perito_id' => ''
            , 'inspector_id' => ''
            , 'coordinacion_estado_id' => ''
        );
        $this->q->data = NULL; 
        $this->q->sql = '
SELECT 
  i.id inspeccion_id
, f.id informe_id
, c.id coordinacion_id
, i.contactos
, i.fecha inspeccion_fecha
, i.hora_estimada
, i.hora_estimada_mostrar
, i.hora_real
, i.hora_real_mostrar
, i.departamento_id
, i.provincia_id
, i.distrito_id
, i.direccion
, f.consultor_id
, i.perito_id
, i.inspector_id
, c.estado_id
FROM coor_inspeccion i
JOIN coor_informe f ON f.id=i.informe_id
JOIN coor_coordinacion c ON c.id=f.coordinacion_id
WHERE i.id="' . $in['inspecion_id'] . '"
        ';
        
        $data = $this->q->exe();
        return $data[0];
    }
    function setReporteCoordinacionBien($in) {
        $this->q->fields = array(
            'bien_id' => ''
        );
        $this->q->data = NULL; 
        $this->q->sql = '
SELECT bien_id FROM coor_coordinacion WHERE id="' . $in['coordinacion_id'] . '"
        ';
        $data = $this->q->exe();
        if (is_array($data)) {
            $l = explode('-', $data[0]['bien_id']);
            if ($data[0]['bien_id'] != '') {
                if ($l[0]==1) {// mueble
                    $this->q->sql ='
SELECT    
   CONCAT(
   "", ca.nombre,
   "|---|-", sca.nombre,
   "|---|-", ti.nombre,
   "|---|-", ma.nombre,
   "|---|-", mo.nombre,
   "|---|-", mu.descripcion
   ) AS contexto
FROM co_bien_mueble mu
JOIN co_bien_sub_categoria sca ON sca.id=mu.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
JOIN co_bien_muebles_clasificacion ti ON ti.tipo_id=mu.tipo_id AND ti.marca_id=0 AND ti.modelo_id=0
JOIN co_bien_muebles_clasificacion ma ON ma.tipo_id=mu.tipo_id AND ma.marca_id=mu.marca_id AND ma.modelo_id=0
JOIN co_bien_muebles_clasificacion mo ON mo.tipo_id=mu.tipo_id AND mo.marca_id=mu.marca_id AND mo.modelo_id=mu.modelo_id
WHERE mu.info_status =1 AND mu.id="' . $l[2] . '"
';
                }
                if ($l[0]==2) {// inmueble
                    $this->q->sql ='
SELECT     
   CONCAT( 
   "", ca.nombre,
   "|---|-", sca.nombre,
   "|---|-", de.nombre,
   "|---|-", pr.nombre,
   "|---|-", di.nombre,
   "|---|-", inm.direccion,
   "|---|-", inm.descripcion
   ) AS contexto
FROM co_bien_inmueble inm
JOIN co_bien_sub_categoria sca ON sca.id=inm.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
JOIN co_bien_inmuebles_ubigeo de ON de.departamento_id=inm.departamento_id AND de.provincia_id = 0 AND de.distrito_id = 0
JOIN co_bien_inmuebles_ubigeo pr ON pr.departamento_id=inm.departamento_id AND pr.provincia_id = inm.provincia_id AND pr.distrito_id = 0
JOIN co_bien_inmuebles_ubigeo di ON di.departamento_id=inm.departamento_id AND di.provincia_id = inm.provincia_id AND di.distrito_id = inm.distrito_id
WHERE inm.info_status =1 AND inm.id="' . $l[2] . '"
';
                }
                if ($l[0]==3) {// cotizacion
                $this->q->sql = '
SELECT
   CONCAT(
   ca.nombre,
   "|---|-", ma.descripcion,
   "|---|-", ma.direccion
   ) AS contexto
FROM co_bien_mazivo ma
JOIN co_bien_sub_categoria sca ON sca.id=ma.sub_categoria_id
JOIN co_bien_categoria ca ON ca.id=sca.categoria_id
WHERE ma.info_status = 1 AND ma.id ="' . $l[2] . '"
';    
                }
            }
            $this->q->fields = array(
                'contexto' => ''
            );
            $this->q->data = NULL;
            $data = $this->q->exe();
            $ou = $this->setReporteCoordinacionBien_data($l, $data[0]['contexto']);
            return $ou;
        }
    }
    function setReporteCoordinacionBien_data($c, $str) {
        $ou = '';
        $d = explode("|---|-", $str);
        if ($c[0]=='1') { // muebles
            $ou = utf8_encode($d[0]);
            $ou.= ' &#x25B6; ' . utf8_encode($d[1]);
            if ($c[3] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[2]);
            }
            if ($c[4] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[3]);
            }
            if ($c[5] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[4]);
            }
            $ou.= ' &#x25B6; ' . utf8_encode($d[5]);
        } elseif ($c[0]=='2') { // inmuebles
            $ou = utf8_encode($d[0]);
            $ou.= ' &#x25B6; ' . utf8_encode($d[1]);
            if ($c[3] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[2]);
            }
            if ($c[4] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[3]);
            }
            if ($c[5] != '0') {
                $ou.= ' &#x25B6; ' . utf8_encode($d[4]);
            }
            if (trim($d[5]) != '') {
                $ou.= ' &#x25B6; <strong>Dirección: </strong>';
                $ou.= utf8_decode($d[5]);                    
            }
            if (trim($d[6]) != '') {
                $ou.= ' &#x25B6; <strong>Descripción: </strong>';
                $ou.= utf8_encode($d[6]);
            }
            $ou.= '&#x25B6; ' . utf8_encode($d[6]);
        } elseif ($c[0]=='3') { // mazivos
            $ou = utf8_decode($d[0]);
            if (trim($d[1]) != '') {
                $ou.= ' &#x25B6; <strong>Descripción: </strong> ';
                $ou.= utf8_decode($d[1]);
            }
            if (trim($d[2]) != '') {
                $ou.= ' &#x25B6; <a target="_blank" class="view" 
                    href="../../../files/cotizacion/bienes/' . $d[2] . '">Ver</a>';
            }
            // 
        }
        return $ou;
    }
    function setReporteCoordinacionEstadoCambiar($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
CALL coor_coordinacion_estado (
"' . $in['coordinacion_id'] . '"
, "' . $in['coordinacion_estado_id'] . '"
, "' . date('Y-m-d H:i:s') . '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->exe();
        // return $this->q->sql;
        

    }
    function coordinacionItemBienAdd($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
        INSERT INTO coor_coordinacion_servicio (coordinacion_id, servicio_id) 
        VALUES ("' . $in['coordinacion_id'] . '","' . $in['id'] . '")
        ';
        $this->q->exe();
        // print $this->q->sql;
        

    }
    function setCotizacionId_by_coordinacionId($id) {
        $this->q->fields = array('cotizacion_id' => '');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT cotizacion_id FROM coor_coordinacion 
        WHERE id ="' . $id . '" 
        ';
        $data = $this->q->exe();
        return $data[0]['cotizacion_id'];
    }
    function setImpresoCoordinacion($in) {
        $this->q->fields = array('impreso' => '');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT impreso FROM coor_coordinacion 
        WHERE id="' . $in['coordinacion_id'] . '"
        ';
        $data = $this->q->exe();
        return $data[0]['impreso'];
    }
    function getImpresoCoordinacion($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
        UPDATE coor_coordinacion 
        SET impreso = "' . $in['impreso'] . '"
          , info_update2= "' . date('Y-m-d H:i:s') . '"
        WHERE id ="' . $in['coordinacion_id'] . '"
        ';
        $this->q->exe();
    }
    //
    function setCoordinacionCodigoCorrelativo($in) {
        $this->q->fields = array( 'id'=>'correlativo');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT cotizacion_correlativo
        FROM `coor_coordinacion` WHERE 
        cotizacion_correlativo = "' . $in['correlativo'] . '" and id != "' . $in['coordinacion_id'] . '"
        ';
        $data = $this->q->exe();
        if (!is_array($data)) {
            $this->q->fields = array();
            $this->q->data = NULL;
            $this->q->sql = '
            UPDATE coor_coordinacion SET 
            cotizacion_correlativo = "' . $in['correlativo'] . '"
            WHERE id = "' . $in['coordinacion_id'] . '"
            ';
            // print $this->q->sql;
            $this->q->exe();
        } else
            return 'errorCodigo';

    }    
}
