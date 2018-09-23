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

class Coordinacion_Modelo_Eventos_Selects {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function estadoIdCoordinacion($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
        SELECT id, nombre FROM coor_coordinacion_estado WHERE info_status!=0
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);                
    }
    function solicitanteId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
SELECT
  DISTINCT CONCAT(i.persona_tipo, "-", i.persona_id) id
, ju.nombre
FROM co_involucrado i
JOIN co_involucrado_juridica ju ON ju.id=i.persona_id
WHERE i.persona_tipo="Juridica" AND i.cotizacion_id="' . $in['cotizacion_id'] . '" AND i.rol_id=2
UNION
SELECT
  DISTINCT CONCAT(i.persona_tipo, "-", i.persona_id) id
, na.nombre
FROM co_involucrado i
JOIN co_involucrado_natural na ON na.id=i.persona_id
WHERE i.persona_tipo="Natural" AND i.cotizacion_id="' . $in['cotizacion_id'] . '" AND i.rol_id=2
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function solicitanteContactoId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
select id, nombre from co_involucrado_contacto WHERE
        ';
        if ($in['tipo_persona']=='Juridica')
            $this->q->sql.=' juridica_id=' . $in['solicitante_id'] ;
        elseif($in['tipo_persona']=='Natural')
            $this->q->sql.=' natural_id=' . $in['solicitante_id'] ;
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function clienteId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
SELECT
  Distinct concat(i.persona_tipo, "-", i.persona_id) id
, ju.nombre
from co_involucrado i
join co_involucrado_juridica ju ON ju.id=i.persona_id
where i.persona_tipo="Juridica" and i.cotizacion_id="' . $in['cotizacion_id'] . '" and i.rol_id=1
UNION
select
  Distinct concat(i.persona_tipo, "-", i.persona_id) id
, na.nombre
from co_involucrado i
join co_involucrado_natural na ON na.id=i.persona_id
where i.persona_tipo="Natural" and i.cotizacion_id="' . $in['cotizacion_id'] . '" and i.rol_id=1
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function modalidadId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
SELECT id, nombre FROM coor_coordinacion_modalidad
WHERE info_status=1 ORDER BY 2 ASC
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function tipo2Id($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
SELECT id, nombre FROM co_servicio_tipo
WHERE info_status=1 order by 2 ASC
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function cambioId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
SELECT id, nombre FROM coor_coordinacion_tipo_cambio
WHERE info_status=1 order by 2 ASC
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);
    }
    function consultorId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
SELECT
  ru.user_id
, u.full_name user_name
FROM coor_rol_has_user ru
JOIN login_user u ON u.id=ru.user_id
JOIN coor_rol r ON r.id=ru.rol_id
WHERE r.nombre = "Consultor"
ORDER BY 2
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);        
    }
    function peritoOinspectorId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
SELECT
  ru.user_id
, u.full_name user_name
FROM coor_rol_has_user ru
JOIN login_user u ON u.id=ru.user_id
JOIN coor_rol r ON r.id=ru.rol_id
WHERE r.id = "' . $in['persona_rol_id'] . '"
ORDER BY 2
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['persona_id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);                
    }
    function informeTipoId($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
SELECT id, nombre FROM coor_informe_entrega_tipo 
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);                
    }
    function firmanteIdNoAnadido($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
SELECT
  ru.user_id
, u.full_name user_name
FROM coor_rol_has_user ru
JOIN login_user u ON u.id=ru.user_id
JOIN coor_rol r ON r.id=ru.rol_id
WHERE r.nombre = "Firma" and
NOT EXISTS (
SELECT * FROM coor_informe_firma f
WHERE ru.user_id=f.firmante_id AND f.info_status!=0 and f.informe_id="' . $in['informe_id'] . '"
)
ORDER BY 2
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);                
    }
    function bienListaCoordinacion($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = '
        SELECT s.id, s.descripcion FROM co_servicio s WHERE s.cotizacion_id = "' . $in['cotizacion_id'] . '"  AND 
        s.info_status= "1" AND 
        NOT EXISTS (SELECT 1 FROM `coor_coordinacion_servicio` d where d.servicio_id = s.id and d.info_status="1")
        ';
        $this->q->data = NULL;
        //echo $this->q->sql;
        $data = $this->q->exe();
        return $data;
    }

    function reporteInicialAutoCompletado($in) {
        $this->q->fields = array(
            'text' => ''
        );
        if (strlen($in['text']) == 1) {
            $filter = $in['text'] . '%';
        } else {
            $filter = '%' . $in['text'] . '%';            
        }
        
        if($in['code'] == 'coordinacion_modalidad') {
            $this->q->sql = 'SELECT DISTINCT nombre FROM coor_coordinacion_modalidad
                             WHERE nombre LIKE "' . $filter . '" ORDER BY 1';
        } elseif($in['code'] == 'coordinacion_tipo2') {
            $this->q->sql = 'SELECT DISTINCT nombre FROM co_servicio_tipo
                             WHERE nombre LIKE "' . $filter . '" ORDER BY 1';
        } elseif($in['code'] == 'coordinacion_solicitante' or $in['code'] == 'coordinacion_cliente') {
            $this->q->sql = 'SELECT DISTINCT nombre FROM (
                             SELECT DISTINCT nombre FROM co_involucrado_juridica
                             UNION
                             SELECT DISTINCT nombre FROM co_involucrado_natural
                             ) unido
                             WHERE nombre LIKE "' . $filter . '" ORDER BY 1';
        } elseif($in['code'] == 'coordinacion_coordinador') {
            $this->q->sql = 'SELECT DISTINCT full_name FROM login_user u
                             JOIN coor_rol_has_user ru ON u.id=ru.user_id
                             WHERE ru.rol_id=6 AND full_name LIKE "' . $filter . '" ORDER BY 1';
        } elseif($in['code'] == 'coordinacion_consultor') {
            $this->q->sql = 'SELECT DISTINCT full_name FROM login_user u
                             JOIN coor_rol_has_user ru ON u.id=ru.user_id
                             WHERE ru.rol_id=2 AND full_name LIKE "' . $filter . '" ORDER BY 1';
        } elseif($in['code'] == 'coordinacion_perito') {
            $this->q->sql = 'SELECT DISTINCT full_name FROM login_user u
                             JOIN coor_rol_has_user ru ON u.id=ru.user_id
                             WHERE ru.rol_id=3 AND full_name LIKE "' . $filter . '" ORDER BY 1';
        }
        
        $this->q->data = NULL;
        $data = $this->q->exe();
        // $data[] = array( 'text' => $this->q->sql);
        return $data;
    }
    function test($in) {
        $this->q->fields = array(
            'id' => ''
            , 'value' => ''
        );
        $this->q->sql = ' 
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple_Upper();
        $combo->set_option( $in['id'] );
        $combo->set_format( array('id','value') );
        $combo->imprimir($data);                
    }
}
