<?php
require_once '../config.php';
# IMPORTACION DE MODELO DE ABSTRACCION DE BD
require_once(RUTA.'sql/db_abstract_model.php');
# IMPORTACION DE LIBRERIAS


#DECLARACION DE LA CLASE
class Solicitante extends DBAbstractModel {
############################### PROPIEDADES ################################

    public $id;
    public $proyecto_id;
    public $informe_id;

################################# MÉTODOS ##################################
# OBTENER DATOS DE UN solicitante

    public function get($id = '') {
        $this->query = "
        select id, nombre, sinonimo
        from diccionario_solicitante where id = $id;";
        $this->rows = null;
        $this->get_results_from_query();
        return $this->rows;
    }

# NUEVO solicitante
    public function set($nuevo_solicitante_data = array()) {             
        foreach ($nuevo_solicitante_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        INSERT INTO diccionario_solicitante ( nombre, sinonimo )
        VALUES('$nombre',0);";        
        $this->execute_single_query();
        $this->mensaje = 'solicitante nuevo agregado exitosamente';
        return $this->id_ultimo_solicitante();
    }

# SACAR ID DEL ULTIMO solicitante INSERTADO
    public function id_ultimo_solicitante() {
        $this->query = "SELECT MAX(id) AS id FROM diccionario_solicitante";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return 0;
    }

# VERIFICAR EXISTENCIA DEL solicitante
    public function existe_solicitante($nombre = '') {
        $this->query = "select * from diccionario_solicitante where nombre like '$nombre';";
        $this->get_results_from_query();
        if( $this->rows != null){
            return $this->rows[0]['id'];
        }
        return -1;
    }

# BUSCAR O INSERTAR UN OBJETO
    public function buscar_o_insertar($solicitante_id = '') {
        if($this->existe_solicitante($solicitante_id) < 0){
            $nuevo_solicitante_data = array('nombre' => $solicitante_id);
            $this->set($nuevo_solicitante_data);
            return $this->id_ultimo_solicitante();
        }
        else{
            return $this->existe_solicitante($solicitante_id);
        }
    }

# LISTADO DE SOLICITANTE
    public function listar_solicitantes() {
        $this->query = "select * from t_terreno";
        $this->get_results_from_query();
        return $this->rows;
    }

# MODIFICAR SOLICITANTE
    public function edit($user_data = array()) {
        foreach ($user_data as $campo => $valor) {
            $$campo = $valor;
        }
        $this->query = "
        UPDATE usuarios
        SET nombre='$nombre',
        apellido='$apellido'
        WHERE email = '$email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'Usuario modificado';
    }

# ELIMINAR SOLICITANTE
    public function delete($user_email = '') {
        $this->query = "
        DELETE FROM usuarios
        WHERE email = '$user_email'
        ";
        $this->execute_single_query();
        $this->mensaje = 'Usuario eliminado';
    }

# METODO CONSTRUCTOR DEL OBJETO
    function __construct() {
        $this->db_name = 'cotiza_factura';
    }

# METODO DESTRUCTOR DEL OBJETO
    function __destruct() {
        unset($this);
    }
}
?>