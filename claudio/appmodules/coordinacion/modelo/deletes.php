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

class Coordinacion_Modelo_Eventos_Deletes {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function fechasDeEntregaInformeItem($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
UPDATE coor_informe_entrega SET
info_status="0" AND info_update_user="' . $_SESSION['user_id'] . '"
WHERE id="' . $in['id'] . '" 
        ';        
        $this->q->exe();
        $this->q->sql = '
INSERT INTO coor_informe_entrega_history (entrega_id, info_status, info_create_user)
VALUES ("' . $in['id'] . '", "0", "' . $_SESSION['user_id'] . '")
        ';        
        $this->q->exe();
    }
    function documentacionInformeItem($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
UPDATE coor_informe_documentacion SET
info_status="0" AND info_update_user="' . $_SESSION['user_id'] . '"
WHERE id="' . $in['id'] . '" 
        ';        
        $this->q->exe();
        $this->q->sql = '
INSERT INTO coor_informe_documentacion_history (documentacion_id, info_status, info_create_user)
VALUES ("' . $in['id'] . '", "0", "' . $_SESSION['user_id'] . '")
        ';        
        $this->q->exe();        
    }
    function firmaInformeItem($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
UPDATE coor_informe_firma SET
info_status="0" AND info_update_user="' . $_SESSION['user_id'] . '"
WHERE id="' . $in['id'] . '" 
        ';        
        $this->q->exe();
        $this->q->sql = '
INSERT INTO coor_informe_firma_history (firma_id, info_status, info_create_user)
VALUES ("' . $in['id'] . '", "0", "' . $_SESSION['user_id'] . '")
        ';        
        $this->q->exe();        
    }
    function test($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
UPDATE coor_informe_entrega SET
info_status="0" AND info_update_user="' . $_SESSION['user_id'] . '"
WHERE id="' . $in['id'] . '" 
        ';        
        $this->q->exe();
        $this->q->sql = '
INSERT INTO coor_informe_entrega_history (entrega_id, info_status, info_create_user)
VALUES ("' . $in['id'] . '", "0", "' . $_SESSION['user_id'] . '")
        ';        
        $this->q->exe();        
    }
    function coordinacionItenBienDelete($in) {
        $this->q->fields = array();
        $this->q->data = NULL; 
        $this->q->sql = '
DELETE FROM coor_coordinacion_servicio
WHERE coordinacion_id="' . $in['coordinacion_id'] . '" AND servicio_id="' . $in['id'] . '"
        ';        
        $this->q->exe();
        // print $this->q->sql;
    }
}
