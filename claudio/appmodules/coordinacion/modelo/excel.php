<?php 
/*
 *
 * AUTHOR: Claudio Rodriguez
 * DESCRIPTION: capa de modelo
 * 
 */

class Coordinacion_Modelo_Eventos_Excel {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function listaCoordinacion($in) {
        $this->q->fields = array(
            'coordinacion_codigo' => '',
            'estado_nombre' => '',
            'perito_nombre' => '',
            'tipo2_nombre' => '',
            'solicitante_fecha' => '',
            'inspeccion_fecha' => '',
            'entrega_al_cliente_fecha' => '',
            'entrega_por_operaciones' => '',
            'observacion' => '',
            'control_nombre' => '',
            'coordinador_nombre' => '',
            'tipo_nombre' => '',
            'modalidad_nombre' => '',
            'cotizacion_codigo' => '',
            'id' => '',
            'estado_id' => '',
            'modalidad_id' => '',
            'tipo_id' => '',
            'solicitante_persona_tipo' => '',
            'solicitante_persona_id' => '',
            'cliente_persona_tipo' => '',
            'cliente_persona_id' => '',
            'coordinador_id' => '',
            'inspeccion_id' => '',
            'hora_estimada' => '',
            'hora_estimada_mostrar' => '',
            'hora_real' => '',
            'hora_real_mostrar' => '',
            'departamento_id' => '',
            'departamento_nombre' => '',
            'provincia_id' => '',
            'provincia_nombre' => '',
            'distrito_id' => '',
            'distrito_nombre' => '',
        );
        $this->q->sql = '
        SELECT 
        coor.cotizacion_correlativo
      , esta.nombre
      , peri.full_name 
      , tip2.nombre 
      , IF( coor.solicitante_fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(coor.solicitante_fecha ,"%Y-%m-%d")) 
      , IF(insp.fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(insp.fecha,"%Y-%m-%d"))
      , IF(coor.entrega_al_cliente_fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(coor.entrega_al_cliente_fecha,"%Y-%m-%d"))
      , IF(coor.entrega_por_operaciones_fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(coor.entrega_por_operaciones_fecha,"%Y-%m-%d")) 
      , coor.observacion
      , cont.full_name
      , dina.full_name
      , tip.nombre 
      , moda.nombre 
      , co.codigo 
      , coor.id
      , coor.estado_id
      , coor.modalidad_id
      , coor.tipo_id
      , coor.solicitante_persona_tipo
      , coor.solicitante_persona_id
      , coor.cliente_persona_tipo
      , coor.cliente_persona_id
      , coor.coordinador_id
      , insp.id
      , insp.hora_estimada
      , insp.hora_estimada_mostrar
      , insp.hora_real
      , insp.hora_real_mostrar

      , insp.departamento_id
      , depa.nombre 
      , insp.provincia_id
      , prov.nombre 
      , insp.distrito_id
      , dist.nombre

        FROM coor_coordinacion coor
        LEFT JOIN co_cotizacion co ON co.id=coor.cotizacion_id
        LEFT JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
        LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
        LEFT JOIN coor_coordinacion_tipo tip ON tip.id=coor.tipo_id
        LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
        LEFT JOIN login_user dina ON dina.id=coor.coordinador_id
        LEFT JOIN coor_inspeccion insp ON insp.coordinacion_id=coor.id
        LEFT JOIN login_user cont ON cont.id=insp.inspector_id
        LEFT JOIN login_user peri ON peri.id=insp.perito_id
        LEFT JOIN co_bien_inmuebles_ubigeo depa ON 
                  depa.departamento_id=insp.departamento_id and 
                  depa.provincia_id=0 and 
                  depa.distrito_id=0
        LEFT JOIN co_bien_inmuebles_ubigeo prov ON 
                  prov.departamento_id=insp.departamento_id and
                  prov.provincia_id=insp.provincia_id and 
                  prov.distrito_id=0
        LEFT JOIN co_bien_inmuebles_ubigeo dist ON 
                  dist.departamento_id=insp.departamento_id and
                  dist.provincia_id=insp.provincia_id and 
                  dist.distrito_id=insp.distrito_id
        WHERE coor.estado_id = "' . $in['tipo'] . '"
        ORDER BY 1 DESC
        ';
        $this->q->data = null;
        // Utilidades::print_r('data', $this->q->sql);
        $data= $this->q->exe();
        
        return $data;
    }
}
