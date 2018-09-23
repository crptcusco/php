<?php 
/*
 *
 * AUTHOR: Claudio Rodriguez
 * DESCRIPTION: capa de modelo
 * VERSION
 * -  1. 0. 0: version inicial, Claudio Rodriguez, 2015/09/08
 * -  0. 0. 0:
 * 
 */

class Coordinacion_Modelo_Logica {
    private $q;
    private $listaRol;
    function __construct() {
        $this->q = new Query();        
    }
    function getListaRol() {
        $this->q->fields = array(
            'user_id' => ''
        );
        $this->q->sql = ' 
        SELECT r.nombre
        FROM coor_rol_has_user r_u
        JOIN coor_rol r ON r.id=r_u.rol_id
        WHERE user_id=' . $_SESSION['user_id'] . '
        ';
        $this->q->data = NULL; 
        $tmp = $this->q->exe();
        $data = array();
        if ( is_array($tmp) )
            foreach ($tmp as $row) 
                $data[] = $row['user_id'];
        $this->listaRol = $data;
    }
    function searchListaRol($rol) {
        if ( array_search( $rol, $this->listaRol) === False )
            return False;
        else
            return True;        
    }
    function isConsultorListaRol($id) {
        if ( $_SESSION['user_id'] != $id) {
            if (array_search('Consultor', $this->listaRol) !== false ) {
                unset($this->listaRol[array_search('Consultor', $this->listaRol)]);
            }
        } 
    }
    function printListaRol() {
        echo '<pre>';
        print_r($this->listaRol);
        echo '</pre>';
    }
    function getCotizacion($codigo) {
        $this->q->fields = array(
            'total_monto' => ''
            , 'total_cambio' => ''
            , 'total_moneda_id' => ''
            , 'total_moneda_simbolo' => ''
        );
        $this->q->sql = ' 
SELECT p.total_monto, p.total_cambio, p.total_moneda_id, m.simbolo total_moneda_simbolo
FROM co_cotizacion co
JOIN co_pago p ON p.cotizacion_id=co.id
JOIN co_moneda m ON m.id=p.total_moneda_id
WHERE codigo="' . $codigo. '"
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function getCoordinacion($id) {
        $this->q->fields = array(
            'id' => ''
            , 'codigo' => ''
            , 'codigo_correlativo' => ''
            , 'cotizacion_id' => ''
            
            , 'modalidad_id' => ''
            , 'modalidad_nombre' => ''

            , 'tipo2_id' => ''
            , 'tipo2_nombre' => ''
            
            , 'tipo_id' => ''
            , 'coordinador_id' => ''
            , 'coordinador_nombre' => ''

            , 'solicitante_id' => ''
            , 'solicitante_nombre' => ''

            , 'solicitante_contacto_id' => ''
            , 'solicitante_contacto_nombre' => ''

            , 'solicitante_fecha' => ''
            , 'entrega_por_operaciones_fecha' => ''
            , 'entrega_al_cliente_fecha' => ''
            
            , 'cliente_id' => ''
            , 'cliente_nombre' => ''
            
            , 'sucursal' => ''
            , 'estado_id' => ''
            , 'estado_nombre' => ''

            , 'cambio_id' => ''
            , 'cambio_nombre' => ''
            , 'observacion' => ''
        );
        $cols = '
coor.id,
coor.codigo,
coor.cotizacion_correlativo, 
coor.cotizacion_id,
coor.modalidad_id,
moda.nombre modalidad_nombre, 
coor.tipo2_id,
tip2.nombre tipo2_nombre,
coor.tipo_id,
coor.coordinador_id,
coar.full_name coordinador_nombre,
CONCAT(coor.solicitante_persona_tipo,"-",coor.solicitante_persona_id) solicitante_id,
soli.nombre solicitante_nombre,
coor.solicitante_contacto_id,
solicon.nombre solicitante_contacto_nombre,
coor.solicitante_fecha,
coor.entrega_por_operaciones_fecha,
coor.entrega_al_cliente_fecha,
CONCAT(coor.cliente_persona_tipo,"-",coor.cliente_persona_id) cliente_id,
clie.nombre cliente_nombre,
coor.sucursal,
coor.estado_id,
esta.nombre estado_nombre,
coor.tipo_cambio_id,
camb.nombre tipo_cambio_nombre,
coor.observacion
        ';
        
        $this->q->sql = ' 
SELECT ' . $cols . '
FROM coor_coordinacion coor
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN co_servicio_tipo tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user coar ON coar.id=coor.coordinador_id
JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_contacto solicon ON solicon.id=coor.solicitante_contacto_id
JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
LEFT JOIN coor_coordinacion_tipo_cambio  camb ON camb.id=coor.tipo_cambio_id
WHERE coor.id="' . $id. '" AND coor.solicitante_persona_tipo="Juridica" AND coor.cliente_persona_tipo="Juridica"
UNION
SELECT  ' . $cols . '
FROM coor_coordinacion coor
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN coor_coordinacion_tipo2 tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user coar ON coar.id=coor.coordinador_id
JOIN co_involucrado_juridica soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_contacto solicon ON solicon.id=coor.solicitante_contacto_id
JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
LEFT JOIN coor_coordinacion_tipo_cambio  camb ON camb.id=coor.tipo_cambio_id
WHERE coor.id="' . $id. '" AND coor.solicitante_persona_tipo="Juridica" AND coor.cliente_persona_tipo="Natural"
UNION
SELECT ' . $cols . '
FROM coor_coordinacion coor
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN coor_coordinacion_tipo2 tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user coar ON coar.id=coor.coordinador_id
JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_contacto solicon ON solicon.id=coor.solicitante_contacto_id
JOIN co_involucrado_juridica clie ON clie.id=coor.cliente_persona_id
JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
LEFT JOIN coor_coordinacion_tipo_cambio  camb ON camb.id=coor.tipo_cambio_id
WHERE coor.id="' . $id. '" AND coor.solicitante_persona_tipo="Natural" AND coor.cliente_persona_tipo="Juridica"
UNION
SELECT ' . $cols . '
FROM coor_coordinacion coor
LEFT JOIN coor_coordinacion_modalidad moda ON moda.id=coor.modalidad_id
LEFT JOIN coor_coordinacion_tipo2 tip2 ON tip2.id=coor.tipo2_id
LEFT JOIN login_user coar ON coar.id=coor.coordinador_id
JOIN co_involucrado_natural soli ON soli.id=coor.solicitante_persona_id
LEFT JOIN co_involucrado_contacto solicon ON solicon.id=coor.solicitante_contacto_id
JOIN co_involucrado_natural clie ON clie.id=coor.cliente_persona_id
JOIN coor_coordinacion_estado esta ON esta.id=coor.estado_id
LEFT JOIN coor_coordinacion_tipo_cambio  camb ON camb.id=coor.tipo_cambio_id
WHERE coor.id="' . $id. '" AND coor.solicitante_persona_tipo="Natural" AND coor.cliente_persona_tipo="Natural"
        ';
        /* print '<pre>'; */
        /* print $this->q->sql; */
        /* print '</pre>'; */
        $this->q->data = NULL; 
        $data = $this->q->exe();

        return $data[0]; 
    }
    function getInforme($id) {
        $this->q->fields = array(
            'id' => ''
            , 'estado_id' => ''
            , 'estado_nombre' => ''
            , 'programador_id' => ''
            , 'programador_nombre' => ''
            , 'consultor_id' => ''
            , 'consultor_nombre' => ''
            , 'ruta' => ''
            , 'observacion' => ''
        );
        $this->q->sql = '
SELECT 
  i.id
, i.estado_id
, est.nombre estado_nombre
, i.programador_id
, pro.full_name programador_nombre
, i.consultor_id
, con.full_name consultor_nombre
, i.ruta 
, i.observacion
FROM coor_informe i
LEFT JOIN coor_informe_estado est ON est.id=i.estado_id
LEFT JOIN login_user pro ON pro.id=i.programador_id
LEFT JOIN login_user con ON con.id=i.consultor_id
WHERE i.coordinacion_id="' . $id . '"
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function getInspeccion($id) {
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
SELECT
  ins.id 
, ins.perito_id
, per.full_name perito_nombre
, ins.inspector_id
, pec.full_name inspector_nombre
, ins.contactos
, IF(ins.fecha = "0000-00-00 00:00:00", "", DATE_FORMAT(ins.fecha,"%d-%m-%Y"))
, ins.hora_estimada
, ins.hora_estimada_mostrar
, ins.hora_real
, ins.hora_real_mostrar
, ins.departamento_id
, dep.nombre departamento_nombre
, ins.provincia_id
, pro.nombre provincia_nombre
, ins.distrito_id
, dis.nombre distrito_nombre
, ins.direccion
, ins.observacion
FROM coor_inspeccion ins
LEFT JOIN login_user per ON per.id=ins.perito_id
LEFT JOIN login_user pec ON pec.id=ins.inspector_id
LEFT JOIN co_bien_inmuebles_ubigeo dep ON dep.departamento_id=ins.departamento_id AND dep.provincia_id=0 AND dep.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo pro ON pro.departamento_id=ins.departamento_id AND pro.provincia_id=ins.provincia_id AND pro.distrito_id=0
LEFT JOIN co_bien_inmuebles_ubigeo dis ON dis.departamento_id=ins.departamento_id AND dis.provincia_id=ins.provincia_id AND dis.distrito_id=ins.distrito_id
WHERE ins.coordinacion_id="'. $id .'"
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data[0]; 
    }
    function newCoordinacion($in) {
        $this->q->fields = array(
            'coordinacion_id' => ''
        );
        $this->q->sql = ' 
CALL coor_coordinacion_new (
  "' . $in['cotizacion_codigo'] . '"
, "' . $in['solicitante_fecha'] . '"
, "' . date('Y-m-d  H:i:s'). '"
, "' . $_SESSION['user_id'] . '"
)
        ';
        $this->q->data = NULL;
        print $this->q->sql;
        $data = $this->q->exe();
        return $data[0]; 
    }
    function deleteCoordinacion($in) {
        $this->q->fields = array();
        $this->q->sql = ' 
        DELETE FROM coor_coordinacion WHERE id="' . $in['coordinacion_id'] . '"
        ';
        $this->q->data = NULL;
        if ($_SESSION['user_id']) {
            $this->q->exe();
        }
    }
    function test() {
        $this->q->fields = array(
            '' => ''
        );
        $this->q->sql = ' 
        ';
        $this->q->data = NULL; 
        $data = $this->q->exe();
        return $data; 
    }
}