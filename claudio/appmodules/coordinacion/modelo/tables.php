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

class Coordinacion_Modelo_Eventos_Tables {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function coordinaciones_por_cotizacion_onload() {
        $this->q->fields = array(
            '' => ''
        );
        $this->q->sql = ' 
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data; 
    }
    function juridicaInfo($in) {
        $this->q->fields = array(
            'clasificacion_id' => ''
            , 'clasificacion_nombre' => ''
            , 'actividad_id' => ''
            , 'actividad_nombre' => ''
            , 'grupo_id' => ''
            , 'grupo_nombre' => ''
            , 'nombre' => ''
            , 'ruc' => ''
            , 'direccion' => ''
            , 'telefono' => ''
            
        );
        $this->q->sql = ' 
select 
  ju.clasificacion_id
, cl.nombre clasificacion_nombre
, ju.actividad_id
, ac.nombre actividad_nombre
, ju.grupo_id
, gr.nombre grupo_nombre
, ju.nombre
, ju.ruc
, ju.direccion
, ju.telefono
from co_involucrado_juridica ju
Left join co_involucrado_clasificacion cl ON cl.id=ju.clasificacion_id
Left join co_involucrado_actividad ac ON ac.id=ju.actividad_id
Left join co_involucrado_grupo gr ON gr.id=ju.grupo_id
where ju.id='.$in['id'].'
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function naturalInfo($in) {
        $this->q->fields = array(
            'nombre' => ''
            , 'documento' => ''
            , 'direccion' => ''
            , 'telefono' => ''
            , 'correo' => ''
        );
        $this->q->sql = '
SELECT 
  nombre 
, documento
, direccion
, telefono
, correo
FROM co_involucrado_natural
WHERE id=' . $in['id'] . '
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function contactoInfo($in) {
        $this->q->fields = array(
            'nombre' => ''
            , 'cargo' => ''
            , 'telefono' => ''
            , 'correo' => ''
        );
        $this->q->sql = ' 
SELECT
  nombre
, cargo
, telefono
, correo
FROM co_involucrado_contacto
WHERE id='.$in['id'] .'
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function fechasDeEntregaTable($in) {
        $this->q->fields = array(
            'id' => ''
            , 'fecha' => ''
            , 'tipo_id' => ''
            , 'tipo_nombre' => ''
        );
        $this->q->sql = '
SELECT e.id, e.fecha, e.tipo_id, t.nombre tipo_nombre
FROM coor_informe_entrega e
LEFT JOIN coor_informe_entrega_tipo t ON t.id=e.tipo_id
WHERE e.informe_id=' . $in['informe_id'] . ' AND e.info_status 
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data; 
    }
    function documentacionTable($in) {
        $this->q->fields = array(
            'id' => ''
            , 'enlace' => ''
            , 'descripcion' => ''
        );
        $this->q->sql = ' 
SELECT id, enlace, descripcion 
FROM coor_informe_documentacion
WHERE informe_id="' . $in['informe_id'] . '" AND info_status=1
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data; 
    }
    function firmaTable($in) {
        $this->q->fields = array(
            'id' => ''
            , 'firmante_id' => ''
            , 'firmante_nombre' => ''
        );
        $this->q->sql = ' 
SELECT f.id, f.firmante_id, u.full_name firmante_nombre 
FROM coor_informe_firma f
JOIN login_user u ON u.id=f.firmante_id
WHERE informe_id="' . $in['informe_id'] . '" AND f.info_status=1
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data; 
    }
    function bienListaCoordinacion($in) {
        $this->q->fields = array(
            'id' => '',
            'descripcion' => '',
        );
        $this->q->sql = ' 
        SELECT s.id, s.descripcion FROM coor_coordinacion_servicio b
        LEFT JOIN co_servicio s ON s.id = b.servicio_id
        WHERE coordinacion_id="'. $in['coordinacion_id'] . '"
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data;
    }
}
