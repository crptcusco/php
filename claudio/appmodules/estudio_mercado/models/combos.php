<?php 
class Query {

    public $fields = NULL;
    public $sql;
    public $data = NULL;

    public function exe() {
        //DBConnector::set_db('ella');
        DBConnector::$results = NULL;
        if ($this->fields == NULL) {
            DBConnector::ejecutar($this->sql, $this->data);
        } else {
            DBConnector::ejecutar($this->sql, $this->data, $this->fields);
        }
        return DBConnector::$results;
    }

}

$q = new Query();
/*
 *********************************************************
 * inmuebles
 *********************************************************
*/
function get_options_departamentos($id=NULL) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = "SELECT departamento_id, nombre FROM ubi_departamento";
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
    return $id;
}
function get_options_provincia($departamento=NULL, $id=NULL) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = "SELECT provincia_id, nombre FROM ubi_provincia where departamento_id=".$departamento;
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
    //print $q->sql;
    return $id;
}
function get_options_distrito($provincia=NULL,$id=NULL) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = "SELECT distrito_id, nombre FROM ubi_distrito where provincia_id=".$provincia;
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);

    return $id;
}
/*
 *********************************************************
 * vehiculos / maquinarias
 *********************************************************
*/
function get_options_tipo_maquinaria($id=null) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = "
    SELECT id, nombre as 'tipo'
    FROM diccionario_maquinaria_tipo
    ";
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_tipo_vehiculo($id=Null) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    $q->sql = "
    SELECT id, nombre as 'tipo'
    FROM diccionario_vehiculo_tipo
    ";
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_marca_maquinaria($tipo, $id=Null) {
    global $q;
    $filter = '';
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    if ($tipo!=''){
	$filter = "WHERE t.maquinaria_tipo_id=".$tipo;
    }
    $q->sql = "
    (SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
    FROM t_maquinaria t
    JOIN diccionario_maquinaria_marca dmm ON dmm.id=t.maquinaria_marca_id
    ".$filter.")
    UNION
    (SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
    FROM em_maquinaria t
    JOIN diccionario_maquinaria_marca dmm ON dmm.id=t.maquinaria_marca_id
    ".$filter.")
    ";
    print $q->sql;
    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_modelo_maquinaria($tipo, $marca, $id=Null) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    if ($tipo!=''){
	$filter = " AND t.maquinaria_tipo_id=".$tipo;
    }
    $q->sql = "
    (SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
    FROM t_maquinaria t
    JOIN diccionario_maquinaria_modelo dmm ON dmm.id=t.maquinaria_modelo_id
    WHERE t.maquinaria_marca_id=" . $marca . $filter.")
    UNION
    (SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
    FROM em_maquinaria t
    JOIN diccionario_maquinaria_modelo dmm ON dmm.id=t.maquinaria_modelo_id
    WHERE t.maquinaria_marca_id=" . $marca . $filter .")
    ";
    $q->data = NULL;
    $data = $q->exe();
    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_marca_vehiculo($tipo,$id=Null) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    if ($tipo!=''){
	$filter = "WHERE t.vehiculo_tipo_id=".$tipo;
    }
    $q->sql = "
    (SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
    FROM t_vehiculo t
    JOIN diccionario_vehiculo_marca dmm ON dmm.id=t.vehiculo_marca_id
    ".$filter.")
    UNION
    (SELECT DISTINCT dmm.id, dmm.nombre as 'marca'
    FROM em_vehiculo t
    JOIN diccionario_vehiculo_marca dmm ON dmm.id=t.vehiculo_marca_id
    ".$filter.")
    ";

    $q->data = NULL;
    $data = $q->exe();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_modelo_vehiculo($tipo, $marca, $id=NULL) {
    global $q;
    $q->fields = array(
    		        "id" => ""
    			,"value"=>""
    		       );
    if ($tipo!=''){
	$filter = " AND t.vehiculo_tipo_id=".$tipo;
    }
    $q->sql = "
    (SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
    FROM t_vehiculo t
    JOIN diccionario_vehiculo_modelo dmm ON dmm.id=t.vehiculo_modelo_id
    WHERE t.vehiculo_marca_id=" . $marca . $filter . ")
    UNION
    (SELECT DISTINCT dmm.id, dmm.nombre as 'modelo'
    FROM em_vehiculo t
    JOIN diccionario_vehiculo_modelo dmm ON dmm.id=t.vehiculo_modelo_id
    WHERE t.vehiculo_marca_id=".$marca . $filter .")
    ";
    print $q->sql;
    $q->data = NULL;
    $data = $q->exe();
    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_options_zonificacion($id=NULL) {
    $data [] = array ('id'=>'1', 'value'=>'Z1');
    $data [] = array ('id'=>'2', 'value'=>'A1');
    $data [] = array ('id'=>'3', 'value'=>'B1');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data);
}
function get_tipo_departamento($id = NULL) {
    $data [] = array ('id'=>'1', 'value'=>'tipo01');
    $data [] = array ('id'=>'2', 'value'=>'tipo02');
    $data [] = array ('id'=>'3', 'value'=>'tipo03');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
function get_options_vista_local($id = NULL) {
    $data [] = array ('id'=>'1', 'value'=>'Vista del Local');
    $data [] = array ('id'=>'2', 'value'=>'Vista externa');
    $data [] = array ('id'=>'3', 'value'=>'Vista Interna');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
function get_options_tipo_cultivo($id = NULL) {
    $data [] = array ('id'=>'1', 'value'=>'No');
    $data [] = array ('id'=>'2', 'value'=>'Agricola');
    $data [] = array ('id'=>'3', 'value'=>'Algodon');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
function get_options_anio($id = NULL) {
    $data [] = array ('id'=>'2010!2015', 'value'=>'2010 - 2014');
    $data [] = array ('id'=>'2005!2009', 'value'=>'2005 - 2009');
    $data [] = array ('id'=>'2000!2004', 'value'=>'2000 - 2004');
    $data [] = array ('id'=>'1990!1999', 'value'=>'1990 - 1999');
    $data [] = array ('id'=>'0!1989', 'value'=>'......... - 1989');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
function get_options_anio_2($anio) {
    $data = array ();
    for($i=2017; $i>=2000;$i--) {
	$data [] = array ('id'=>$i, 'value'=>$i);
    }
    //$data [] = array ();
    $combo = new OptionComboSimple();
    $combo->set_option( $anio );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
function get_options_traccion_vehiculo($id = NULL) {
    $data [] = array ('id'=>'1', 'value'=>'Traccion Delantera');
    $data [] = array ('id'=>'2', 'value'=>'Automatica');
    $data [] = array ('id'=>'3', 'value'=>'Traccion Trasera');
    $data [] = array ();

    $combo = new OptionComboSimple();
    $combo->set_option( $id );
    $combo->set_format( array('id','value') );
    $combo->imprimir($data); 
}
?>