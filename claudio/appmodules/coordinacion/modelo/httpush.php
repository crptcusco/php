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

class Coordinacion_Modelo_Eventos_HttPush {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function lastTimeStamp() {
        $this->q->fields = array( 'timestamp' => '');
        $this->q->sql = sprintf(
            'SELECT info_update2  FROM coor_coordinacion 
             ORDER BY info_update2 DESC LIMIT 1
            '
        );
        $this->q->data;
        $data = $this->q->exe();
        return strtotime($data[0]['timestamp']);
    }
    function countCoordinacionNoImpresas() {
        $this->q->fields = array( 'count' => '');
        $this->q->sql = sprintf(
            '
SELECT COUNT(id) FROM coor_coordinacion 
WHERE impreso=0 AND codigo!=0 and estado_id!=1
            '
        );
        $this->q->data;
        $data = $this->q->exe();
        return $data[0]['count'];
    }
}
