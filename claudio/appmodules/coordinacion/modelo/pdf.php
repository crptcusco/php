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

class Coordinacion_Modelo_Eventos_PDF {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function setData1($in) {
        $this->q->fields = array(
            'coordinacion_codigo' => ''
            , 'coordinador_nombre' => ''
            , 'solicitante_fecha' => ''
            , 'entrega_al_cliente_fecha' => ''            
            , 'formato_nombre' => ''
            , 'solicitante_persona_tipo' => ''
            , 'solicitante_persona_id' => ''
            , 'solicitante_contacto_id' => ''
            , 'sucursal' => ''
            , 'servicio_nombre' => ''
            , 'inspeccion_tipo_nombre' => ''
            , 'tipo_cambio_nombre' => ''
            , 'cliente_persona_tipo' => ''
            , 'cliente_persona_id' => ''
            , 'perito_nombre' => ''
            , 'control_nombre' => ''
            , 'departamento_id' => ''
            , 'departamento_nombre' => ''
            , 'provincia_id' => ''
            , 'provincia_nombre' => ''
            , 'distrito_id' => ''
            , 'distrito_nombre' => ''
            , 'inspeccion_direccion' => ''
            , 'inspeccion_contactos' => ''
            , 'inspeccion_fecha' => ''
            , 'hora_estimada' => ''
            , 'hora_estimada_mostrar' => ''
            , 'hora_real' => ''
            , 'hora_real_mostrar' => ''
            , 'observacion' => ''
            , 'coordinacion_id' => ''
            , 'cotizacion_id' => ''
        );
        $this->q->sql = '
SELECT
  coor.cotizacion_correlativo coordinacion_codigo
, coordinador.full_name coordinador_nombre
, coor.solicitante_fecha
, IF(coor.entrega_al_cliente_fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(coor.entrega_al_cliente_fecha,"%d-%m-%Y"))
, modalidad.nombre formato_nombre
, coor.solicitante_persona_tipo
, coor.solicitante_persona_id
, coor.solicitante_contacto_id
, coor.sucursal
, servicio.nombre servicio_nombre
, inspeccion_tipo.nombre inspeccion_tipo_nombre
, tipo_cambio.nombre tipo_cambio_nombre
, coor.cliente_persona_tipo
, coor.cliente_persona_id
, perito.full_name perito_nombre
, inspector.full_name control_nombre
, inspeccion.departamento_id
, depa.nombre departamento_nombre
, inspeccion.provincia_id
, prov.nombre provincia_nombre
, inspeccion.distrito_id
, dist.nombre distrito_nombre
, inspeccion.direccion inspeccion_direccion
, inspeccion.contactos inspeccion_contactos
, IF(inspeccion.fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(inspeccion.fecha,"%d-%m-%Y")) inspeccion_fecha
, inspeccion.hora_estimada inspeccion_hora_estimada
, inspeccion.hora_estimada_mostrar inspeccion_hora_estimada_mostrar
, inspeccion.hora_real inspeccion_hora_real
, inspeccion.hora_real_mostrar inspeccion_hora_real_mostrar
, inspeccion.observacion 
, coor.id coordinacion_id
, coor.cotizacion_id
from coor_coordinacion coor
left join co_cotizacion coti ON coti.id=coor.cotizacion_id
left join login_user coordinador ON coordinador.id=coor.coordinador_id
left join coor_coordinacion_modalidad modalidad ON modalidad.id=coor.modalidad_id
left join co_servicio_tipo servicio ON servicio.id=coor.tipo2_id 
left join coor_coordinacion_tipo inspeccion_tipo ON inspeccion_tipo.id=coor.tipo_id
left join coor_coordinacion_tipo_cambio tipo_cambio ON tipo_cambio.id=coor.tipo_cambio_id
join coor_inspeccion inspeccion ON inspeccion.coordinacion_id=coor.id
left join login_user perito ON perito.id=inspeccion.perito_id
left join login_user inspector ON inspector.id=inspeccion.inspector_id
left join co_bien_inmuebles_ubigeo depa ON 
          depa.departamento_id=inspeccion.departamento_id and 
          depa.provincia_id=0 and 
          depa.distrito_id=0
left join co_bien_inmuebles_ubigeo prov ON 
          prov.departamento_id=inspeccion.departamento_id and
          prov.provincia_id=inspeccion.provincia_id and 
          prov.distrito_id=0
left join co_bien_inmuebles_ubigeo dist ON 
          dist.departamento_id=inspeccion.departamento_id and
          dist.provincia_id=inspeccion.provincia_id and 
          dist.distrito_id=inspeccion.distrito_id
where coor.id="' . $in['coordinacion_id'] . '"
        ';
        $this->q->data = null;        
        $data= $this->q->exe();
        // Utilidades::print_r('data',$data[0]);
        return $data[0];
    }
    function setPersona($in) {
        if ($in['tipo']=='Juridica') {
            return $this->setJuridica($in['id']);
        } elseif ($in['tipo']=='Natural') {
            return $this->setNatural($in['id']);
        }
    }
    function setJuridica($id) {
        $this->q->fields = array(
            'nombre' => ''
        );
        $this->q->sql = '
        select nombre from co_involucrado_juridica where id="'.$id.'"
        ';
        $this->q->data = null; 
        $data= $this->q->exe();
        return $data[0]['nombre'];
    }
    function setNatural($id) {
        $this->q->fields = array(
            'nombre' => ''
        );
        $this->q->sql = '
        select nombre from co_involucrado_natural where id="'.$id.'"
        ';
        $this->q->data = null; 
        $data= $this->q->exe();
        return $data[0]['nombre'];
    }
    function setContacto($id) {
        $this->q->fields = array(
            'nombre' => ''
            , 'cargo' => ''
        );
        $this->q->sql = '
        SELECT nombre, cargo FROM co_involucrado_contacto WHERE id="'.$id.'"
        ';
        $this->q->data = null; 
        $data= $this->q->exe();
        return $data[0]['nombre'] . ' ' . $data[0]['cargo'];
    }
    function setUbigeo($in) {
        $ou = '';
        $ou.= utf8_encode($in['inspeccion_direccion']) .'<br>';
        $ou.= utf8_encode($in['departamento_nombre']);
        if ($in['departamento_id']!=0) {
            $ou.= ' <span style="color:red"> -> </span> ';
        }
        $ou.= utf8_encode($in['provincia_nombre']);
        if ($in['provincia_id']!=0) {
            $ou.= ' <span style="color:red"> -> </span> ';
        }
        $ou.= utf8_encode($in['distrito_nombre']) . ' ';

        return $ou;
    }
    function setHora($in) {
        $ou  = '';
        if ($in['hora_estimada_mostrar']=='1') {
            $h  = explode("-", $in['hora_estimada']);
            $h1 = explode(":",$h[0]);
            $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
            $h2 = explode(":",$h[1]);
            $h2 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h2[0], 'minuto'=>(int)$h2[1], 'return'=>'array'));
            $ou.= sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);
            $ou.= ' - ';
            $ou.= sprintf("%02d:%02d %s" , $h2['hora'] , $h2['minuto'], $h2['meridiano']);            
        }elseif ($in['hora_real_mostrar']=='1') {
            $h1 = explode(":", $in['hora_real']);
            $h1 = Utilidades::fechas_de_militar_a_meridiano(array('hora'=>(int)$h1[0], 'minuto'=>(int)$h1[1], 'return'=>'array'));
            $ou.= sprintf("%02d:%02d %s" , $h1['hora'] , $h1['minuto'], $h1['meridiano']);            
        }
        return $ou;
    }
}
